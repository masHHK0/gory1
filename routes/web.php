<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

// Главная

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/getto', [HomeController::class, 'getto'])->name('getto');
Route::get('/rules', [HomeController::class, 'rules'])->name('rules');
Route::get('/weather', [WeatherController::class, 'getSkiWeather']);

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Публичные страницы
Route::get('/slopes', [HomeController::class, 'slopes'])->name('slopes');
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');
Route::get('/instructors/{instructor}', [InstructorController::class, 'show'])->name('instructors.show');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/tariffs', [TariffController::class, 'index'])->name('tariffs');
Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/news/{news}', [HomeController::class, 'newsShow'])->name('news.show');

// ==================== ЛИЧНЫЙ КАБИНЕТ (ДЛЯ ПОЛЬЗОВАТЕЛЕЙ) ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Бронирования для пользователей
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment'); // 👈 ЭТОТ МАРШРУТ ДОЛЖЕН БЫТЬ ЗДЕСЬ
    Route::post('/bookings/{booking}/payment', [BookingController::class, 'processPayment'])->name('bookings.process-payment');
    Route::get('/bookings/{booking}/payment/success', [BookingController::class, 'paymentSuccess'])->name('bookings.payment.success');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Отзывы
    Route::post('/reviews', [HomeController::class, 'storeReview'])->name('reviews.store');
});

// ==================== АДМИН-ПАНЕЛЬ ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Управление трассами
    Route::get('/slopes', [AdminController::class, 'slopes'])->name('slopes');
    Route::post('/slopes', [AdminController::class, 'storeSlope'])->name('slopes.store');
    Route::put('/slopes/{slope}', [AdminController::class, 'updateSlope'])->name('slopes.update');
    Route::delete('/slopes/{slope}', [AdminController::class, 'deleteSlope'])->name('slopes.delete');
    Route::put('/slopes/{slope}/update-status', [AdminController::class, 'updateSlopeStatus'])->name('slopes.update-status');

    // Управление инструкторами
    Route::get('/instructors', [AdminController::class, 'instructors'])->name('instructors');
    Route::post('/instructors', [AdminController::class, 'storeInstructor'])->name('instructors.store');
    Route::put('/instructors/{instructor}', [AdminController::class, 'updateInstructor'])->name('instructors.update');
    Route::delete('/instructors/{instructor}', [AdminController::class, 'deleteInstructor'])->name('instructors.delete');

    // Управление отелями
    Route::get('/hotels', [AdminController::class, 'hotels'])->name('hotels');
    Route::post('/hotels', [AdminController::class, 'storeHotel'])->name('hotels.store');
    Route::put('/hotels/{hotel}', [AdminController::class, 'updateHotel'])->name('hotels.update');
    Route::delete('/hotels/{hotel}', [AdminController::class, 'deleteHotel'])->name('hotels.delete');

    // Управление номерами
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::post('/rooms', [AdminController::class, 'storeRoom'])->name('rooms.store');
    Route::put('/rooms/{room}', [AdminController::class, 'updateRoom'])->name('rooms.update');
    Route::delete('/rooms/{room}', [AdminController::class, 'deleteRoom'])->name('rooms.delete');

    // Управление тарифами
    Route::get('/tariffs', [AdminController::class, 'tariffs'])->name('tariffs');
    Route::post('/tariffs', [AdminController::class, 'storeTariff'])->name('tariffs.store');
    Route::put('/tariffs/{tariff}', [AdminController::class, 'updateTariff'])->name('tariffs.update');
    Route::delete('/tariffs/{tariff}', [AdminController::class, 'deleteTariff'])->name('tariffs.delete');

    // Управление камерами
    Route::get('/cameras', [AdminController::class, 'cameras'])->name('cameras');
    Route::post('/cameras', [AdminController::class, 'storeCamera'])->name('cameras.store');
    Route::put('/cameras/{camera}', [AdminController::class, 'updateCamera'])->name('cameras.update');
    Route::delete('/cameras/{camera}', [AdminController::class, 'deleteCamera'])->name('cameras.delete');

    // Управление галереей
    Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
    Route::post('/gallery', [AdminController::class, 'storeGallery'])->name('gallery.store');
    Route::delete('/gallery/{gallery}', [AdminController::class, 'deleteGallery'])->name('gallery.delete');

    // Управление новостями
    Route::get('/news', [AdminController::class, 'news'])->name('news');
    Route::post('/news', [AdminController::class, 'storeNews'])->name('news.store');
    Route::put('/news/{news}', [AdminController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{news}', [AdminController::class, 'deleteNews'])->name('news.delete');

    // Бронирования для админа (только просмотр)
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{booking}', [AdminController::class, 'updateBookingStatus'])->name('bookings.update');

    // Пользователи
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::put('/users/{user}', [AdminController::class, 'updateUserRole'])->name('users.update');

    // Отзывы
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/approve', [AdminController::class, 'approveReview'])->name('reviews.approve');
    Route::delete('/reviews/{review}', [AdminController::class, 'deleteReview'])->name('reviews.delete');
});