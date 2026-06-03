<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Instructor;
use App\Models\HotelRoom;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
                          ->latest()
                          ->get();
        return view('bookings.index', compact('bookings'));
    }
    
    public function create(Request $request)
    {
        $type = $request->input('type', 'instructor');
        $itemId = $request->input('item_id');
        
        $item = match($type) {
            'instructor' => Instructor::findOrFail($itemId),
            'hotel' => HotelRoom::with('hotel')->findOrFail($itemId),
            'lift_pass' => Tariff::findOrFail($itemId),
            default => abort(404),
        };
        
        return view('bookings.create', compact('type', 'item'));
    }
    
    public function store(Request $request)
    {
        $rules = [
            'booking_type' => 'required|in:instructor,hotel,lift_pass',
            'item_id' => 'required|integer',
            'start_date' => 'required|date|after:today',
            'comment' => 'nullable|string',
        ];
        
        if ($request->booking_type === 'hotel') {
            $rules['end_date'] = 'required|date|after:start_date';
            $rules['guests_count'] = 'required|integer|min:1';
        }
        
        if ($request->booking_type === 'instructor') {
            $rules['hours'] = 'required|integer|min:1|max:8';
        }
        
        $validated = $request->validate($rules);
        
        // Рассчитываем количество ночей для отеля
        if ($request->booking_type === 'hotel') {
            $start = new \DateTime($validated['start_date']);
            $end = new \DateTime($validated['end_date']);
            $validated['nights'] = $end->diff($start)->days;
        }
        
        $totalPrice = $this->calculatePrice($validated, $request);
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'booking_type' => $validated['booking_type'],
            'item_id' => $validated['item_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'guests_count' => $validated['guests_count'] ?? 1,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'comment' => $validated['comment'] ?? null,
        ]);
        
        // Перенаправляем на страницу оплаты
        return redirect()->route('bookings.payment', $booking);
    }
    
    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('bookings.show', compact('booking'));
    }
    
    public function payment(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('bookings.payment', compact('booking'));
    }
    
    public function processPayment(Request $request, Booking $booking)
    {
        $this->authorizeBooking($booking);
        
        // Здесь будет интеграция с ЮKassa
        // Пока просто имитируем оплату
        
        return redirect()->route('bookings.payment.success', $booking)
                        ->with('payment_url', 'https://demo.yookassa.ru/payment?amount=' . $booking->total_price);
    }
    
    public function paymentSuccess(Booking $booking)
    {
        $this->authorizeBooking($booking);
        
        // Обновляем статус бронирования
        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);
        
        return redirect()->route('bookings.show', $booking)
                        ->with('success', 'Бронирование успешно оплачено!');
    }
    
    public function cancel(Booking $booking)
    {
        $this->authorizeBooking($booking);
        
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Бронирование отменено');
        }
        
        return back()->with('error', 'Нельзя отменить это бронирование');
    }
    
    private function calculatePrice($data, $request = null)
    {
        switch ($data['booking_type']) {
            case 'instructor':
                $instructor = Instructor::find($data['item_id']);
                $hours = $request ? (int)$request->input('hours', 1) : 1;
                return $instructor->price_per_hour * $hours;
                
            case 'hotel':
                $room = HotelRoom::find($data['item_id']);
                $nights = $data['nights'] ?? 1;
                return $room->price_per_night * $nights;
                
            case 'lift_pass':
                $tariff = Tariff::find($data['item_id']);
                return $tariff->price;
                
            default:
                return 0;
        }
    }
    
    private function authorizeBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
    }
}