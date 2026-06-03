<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        // Получаем все отели для выпадающего списка
        $allHotels = Hotel::orderBy('name')->get();
        
        $query = Hotel::with('rooms');
        
        // Фильтр по конкретному отелю
        if ($request->filled('hotel_id')) {
            $query->where('id', $request->hotel_id);
        }
        
        // Поиск по названию (если нужно)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
        
        $hotels = $query->get();
        
        return view('hotels.index', compact('hotels', 'allHotels'));
    }
    
    public function show(Hotel $hotel)
    {
        $hotel->load('rooms');
        return view('hotels.show', compact('hotel'));
    }
}