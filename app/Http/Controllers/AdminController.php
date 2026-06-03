<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Slope;
use App\Models\Instructor;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Tariff;
use App\Models\Camera;
use App\Models\Gallery;
use App\Models\Review;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'users_count' => User::count(),
            'bookings_count' => Booking::count(),
            'slopes_count' => Slope::count(),
            'instructors_count' => Instructor::count(),
            'hotels_count' => Hotel::count(),
        ];

        $recentBookings = Booking::with('user')->latest()->take(10)->get();
        $pendingReviews = Review::where('is_approved', false)->count();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'pendingReviews'));
    }

    // ==================== ТРАССЫ ====================
    public function slopes()
    {
        $slopes = Slope::all();
        return view('admin.slopes.index', compact('slopes'));
    }

    public function storeSlope(Request $request)
    {
        Slope::create($request->validate([
            'name' => 'required|string|max:255',
            'difficulty' => 'required|in:beginner,intermediate,advanced,expert',
            'length' => 'required|integer',
            'elevation' => 'required|integer',
            'status' => 'required|in:open,closed,maintenance',
            'description' => 'nullable|string',
        ]));

        return back()->with('success', 'Трасса добавлена');
    }

    public function updateSlope(Request $request, Slope $slope)
    {
        $slope->update($request->validate([
            'name' => 'required|string|max:255',
            'difficulty' => 'required|in:beginner,intermediate,advanced,expert',
            'length' => 'required|integer',
            'elevation' => 'required|integer',
            'status' => 'required|in:open,closed,maintenance',
            'description' => 'nullable|string',
        ]));

        return back()->with('success', 'Трасса обновлена');
    }

    public function deleteSlope(Slope $slope)
    {
        $slope->delete();
        return back()->with('success', 'Трасса удалена');
    }
    public function updateSlopeStatus(Request $request, Slope $slope)
    {
        $request->validate([
            'status' => 'required|in:open,closed,maintenance'
        ]);

        $slope->update(['status' => $request->status]);

        $statusText = $request->status == 'open' ? 'открыта' : ($request->status == 'closed' ? 'закрыта' : 'на обслуживании');
        return back()->with('success', "Статус трассы изменен на '{$statusText}'");
    }

    // ==================== ИНСТРУКТОРЫ ====================
    public function instructors()
    {
        $instructors = Instructor::all();
        return view('admin.instructors.index', compact('instructors'));
    }

    public function storeInstructor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('instructors', 'public');
        }

        Instructor::create($validated);

        return back()->with('success', 'Инструктор добавлен');
    }

    public function updateInstructor(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'available' => 'boolean',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Удалить старое фото
            if ($instructor->photo) {
                Storage::disk('public')->delete($instructor->photo);
            }
            $validated['photo'] = $request->file('photo')->store('instructors', 'public');
        }

        $instructor->update($validated);

        return back()->with('success', 'Инструктор обновлен');
    }
    public function deleteInstructor(Instructor $instructor)
    {
        $instructor->delete();
        return back()->with('success', 'Инструктор удален');
    }

    // ==================== ОТЕЛИ ====================
    public function hotels()
    {
        $hotels = Hotel::with('rooms')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function storeHotel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stars' => 'required|integer|min:1|max:5',
            'address' => 'required|string',
            'distance_to_lift' => 'required|integer',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        unset($validated['images']);

        $hotel = Hotel::create($validated);

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('hotels/' . $hotel->id, 'public');
                $paths[] = $path;
            }
            $hotel->update(['images' => implode(',', $paths)]);
        }

        return back()->with('success', 'Отель успешно добавлен!');
    }

    public function deleteHotel(Hotel $hotel)
    {
        // Удаляем фото отеля
        if ($hotel->images) {
            $images = explode(',', $hotel->images);
            foreach ($images as $image) {
                Storage::disk('public')->delete(trim($image));
            }
        }

        // Удаляем фото номеров
        foreach ($hotel->rooms as $room) {
            if ($room->images) {
                $roomImages = explode(',', $room->images);
                foreach ($roomImages as $image) {
                    Storage::disk('public')->delete(trim($image));
                }
            }
        }

        $hotel->delete();
        return back()->with('success', 'Отель удален');
    }
    public function updateHotel(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stars' => 'required|integer|min:1|max:5',
            'address' => 'required|string',
            'distance_to_lift' => 'required|integer',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Обновляем основные данные
        $hotel->update([
            'name' => $validated['name'],
            'stars' => $validated['stars'],
            'address' => $validated['address'],
            'distance_to_lift' => $validated['distance_to_lift'],
            'description' => $validated['description'] ?? null,
        ]);

        // Добавляем новые фото
        if ($request->hasFile('images')) {
            $existingImages = $hotel->images ? explode(',', $hotel->images) : [];
            $newPaths = [];

            foreach ($request->file('images') as $image) {
                $path = $image->store('hotels/' . $hotel->id, 'public');
                $newPaths[] = $path;
            }

            // Объединяем старые и новые фото
            $allImages = array_merge($existingImages, $newPaths);
            $hotel->update(['images' => implode(',', $allImages)]);
        }

        return back()->with('success', 'Отель успешно обновлен!');
    }

    // ==================== НОМЕРА ====================
    public function rooms()
    {
        $rooms = HotelRoom::with('hotel')->get();
        $hotels = Hotel::all();
        return view('admin.rooms.index', compact('rooms', 'hotels'));
    }

    public function storeRoom(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'available_rooms' => 'required|integer|min:0',
            'amenities' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        unset($validated['images']);

        $room = HotelRoom::create($validated);

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms/' . $room->id, 'public');
                $paths[] = $path;
            }
            $room->update(['images' => implode(',', $paths)]);
        }

        return back()->with('success', 'Номер успешно добавлен!');
    }

    public function updateRoom(Request $request, HotelRoom $room)
    {
        $room->update($request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric',
            'available_rooms' => 'required|integer',
            'amenities' => 'nullable|string',
        ]));

        return back()->with('success', 'Номер обновлен');
    }

    public function deleteRoom(HotelRoom $room)
    {
        // Удаляем фото номера
        if ($room->images) {
            $images = explode(',', $room->images);
            foreach ($images as $image) {
                Storage::disk('public')->delete(trim($image));
            }
        }

        $room->delete();
        return back()->with('success', 'Номер удален');
    }

    // ==================== ТАРИФЫ ====================
    public function tariffs()
    {
        $tariffs = Tariff::all();
        return view('admin.tariffs.index', compact('tariffs'));
    }

    public function storeTariff(Request $request)
    {
        Tariff::create($request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:hour,day,week,season',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'valid_from' => 'required|date',
            'valid_to' => 'nullable|date|after:valid_from',
        ]));

        return back()->with('success', 'Тариф добавлен');
    }

    public function updateTariff(Request $request, Tariff $tariff)
    {
        $tariff->update($request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:hour,day,week,season',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'valid_from' => 'required|date',
            'valid_to' => 'nullable|date|after:valid_from',
            'is_active' => 'boolean',
        ]));

        return back()->with('success', 'Тариф обновлен');
    }

    public function deleteTariff(Tariff $tariff)
    {
        $tariff->delete();
        return back()->with('success', 'Тариф удален');
    }

    // ==================== КАМЕРЫ ====================
    public function cameras()
    {
        $cameras = Camera::all();
        return view('admin.cameras.index', compact('cameras'));
    }

    public function storeCamera(Request $request)
    {
        Camera::create($request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'stream_url' => 'required|url',
            'sort_order' => 'integer',
        ]));

        return back()->with('success', 'Камера добавлена');
    }

    public function updateCamera(Request $request, Camera $camera)
    {
        $camera->update($request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'stream_url' => 'required|url',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]));

        return back()->with('success', 'Камера обновлена');
    }

    public function deleteCamera(Camera $camera)
    {
        $camera->delete();
        return back()->with('success', 'Камера удалена');
    }

    // ==================== ГАЛЕРЕЯ ====================
    public function gallery()
    {
        $images = Gallery::all();
        return view('admin.gallery.index', compact('images'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'title' => 'nullable|string',
            'category' => 'required|in:slopes,hotels,events,nature,other',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image_path' => $path,
            'category' => $request->category,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', 'Изображение добавлено');
    }

    public function deleteGallery(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Изображение удалено');
    }

    // ==================== НОВОСТИ ====================
    public function news()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['published_at'] = now();

        News::create($validated);

        return back()->with('success', 'Новость добавлена');
    }

    public function updateNews(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return back()->with('success', 'Новость обновлена');
    }

    public function deleteNews(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return back()->with('success', 'Новость удалена');
    }

    // ==================== БРОНИРОВАНИЯ ====================
    public function bookings()
    {
        $bookings = Booking::with('user')->latest()->paginate(20);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Статус бронирования обновлен');
    }

    // ==================== ПОЛЬЗОВАТЕЛИ ====================
    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Роль пользователя обновлена');
    }

    // ==================== ОТЗЫВЫ ====================
    public function reviews()
    {
        $reviews = Review::with(['user', 'instructor', 'hotel'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approveReview(Review $review)
    {
        $review->update(['is_approved' => true]);
        return back()->with('success', 'Отзыв одобрен');
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Отзыв удален');
    }
}