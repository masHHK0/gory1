<?php

namespace App\Http\Controllers;

use App\Models\Slope;
use App\Models\Camera;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Hotel;
use App\Models\Instructor;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slopes = Slope::where('status', 'open')->get();
        $cameras = Camera::where('is_active', true)->orderBy('sort_order')->get();
        $gallery = Gallery::published()->latest()->take(12)->get();
        $news = News::published()->latest()->take(3)->get();

        // FAQ прописан в коде
        $faqs = [
            [
                'question' => 'Как работает ски-пасс?',
                'answer' => 'Ски-пасс — это электронная карта, которая крепится к одежде. Она срабатывает автоматически на турникетах подъемников. Активируется при первом проходе.'
            ],
            [
                'question' => 'Можно ли вернуть или обменять ски-пасс?',
                'answer' => 'Возврат возможен не позднее чем за 24 часа до начала действия ски-пасса. Комиссия за возврат — 10%. Обменять можно на другой тариф с доплатой разницы.'
            ],
            [
                'question' => 'Нужна ли страховка?',
                'answer' => 'Настоятельно рекомендуем оформить спортивную страховку. Это можно сделать онлайн при покупке ски-пасса или в кассе курорта.'
            ],
            [
                'question' => 'Есть ли прокат снаряжения?',
                'answer' => 'Да, на курорте работают 3 пункта проката. Полный комплект (лыжи/сноуборд + ботинки + палки + шлем) — от 1500 ₽/день.'
            ],
            
        ];

        return view('home', compact('slopes', 'cameras', 'gallery', 'news', 'faqs'));
    }

    // Страница всех трасс
    public function slopes(Request $request)
    {
        $difficulty = $request->input('difficulty');

        if ($difficulty) {
            $slopes = Slope::byDifficulty($difficulty)->get();
        } else {
            $slopes = Slope::all();
        }

        return view('slopes', compact('slopes', 'difficulty'));
    }

    // Страница поиска
    public function search(Request $request)
    {
        $query = $request->input('q');

        $slopes = Slope::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        $hotels = Hotel::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        $instructors = Instructor::where('name', 'like', "%$query%")
            ->orWhere('specialization', 'like', "%$query%")
            ->get();

        return view('search', compact('query', 'slopes', 'hotels', 'instructors'));
    }

    // Страница новостей
    public function news()
    {
        $news = News::published()->latest()->paginate(9);
        return view('news.index', compact('news'));
    }
    // Страница О нас
    public function about()
    {
        return view('about');
    }
    // Страница Как добраться
    public function rules()
    {
        return view('rules');
    }

    // Страница Как добраться
    public function getto()
    {
        return view('getto');
    }
    // Детальная страница новости
    public function newsShow(News $news)
    {
        return view('news.show', compact('news'));
    }

    // Сохранение отзыва
// app/Http/Controllers/HomeController.php

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'instructor_id' => 'nullable|exists:instructors,id',
            'hotel_id' => 'nullable|exists:hotels,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $userId = auth()->id();

        // Проверка: было ли подтверждённое бронирование
        $hasBooking = false;

        if (!empty($validated['hotel_id'])) {
            // Проверяем бронирования отеля
            $hasBooking = Booking::where('user_id', $userId)
                ->where('booking_type', 'hotel')
                ->where('status', 'confirmed')
                ->whereHas('hotelRoom', function ($q) use ($validated) {
                    $q->where('hotel_id', $validated['hotel_id']);
                })
                ->exists();
        }

        if (!empty($validated['instructor_id'])) {
            // Проверяем бронирования инструктора
            $hasBooking = Booking::where('user_id', $userId)
                ->where('booking_type', 'instructor')
                ->where('item_id', $validated['instructor_id'])
                ->where('status', 'confirmed')
                ->exists();
        }

        if (!$hasBooking) {
            return back()->with('error', 'Оставить отзыв могут только гости с подтверждённым бронированием.');
        }

        // Проверка: не оставлял ли уже отзыв
        $alreadyReviewed = Review::where('user_id', $userId)
            ->where(function ($q) use ($validated) {
                if (!empty($validated['hotel_id'])) {
                    $q->where('hotel_id', $validated['hotel_id']);
                }
                if (!empty($validated['instructor_id'])) {
                    $q->where('instructor_id', $validated['instructor_id']);
                }
            })
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Вы уже оставили отзыв. Можно оставить только один отзыв.');
        }

        $validated['user_id'] = $userId;

        Review::create($validated);

        return back()->with('success', 'Спасибо за отзыв! Он появится после проверки модератором.');
    }
}