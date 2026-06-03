{{-- resources/views/hotels/index.blade.php --}}
@extends('layouts.app', ['headerClass' => 'header--transparent'])

@section('content')
    <style>
        /* ========== ПЕРЕМЕННЫЕ В СТИЛЕ САЙТА ========== */
        :root {
            --hotel-primary: #03538A;
            --hotel-secondary: #FF772D;
            --hotel-text: #1a1a1a;
            --hotel-text-light: #888;
            --hotel-border: #03548a1d;
            --hotel-bg: #f8f9fb;
            --hotel-card-hover: #03548a05;
        }

        /* ========== БАННЕР С ПОИСКОМ ========== */
        .search-banner {
            height: 520px;
            background: url('/images/banner.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 119, 45, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .search-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .search-box {
            margin-top: 100px;
            position: relative;
            z-index: 1;
            background: rgba(57, 56, 56, 0.12);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(124, 121, 121, 0.15);
            border-radius: 20px;
            padding: 50px 25px;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .search-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .search-field label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 1px;
        }

        .search-field input,
        .search-field select {
            padding: 12px 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-family: 'M', sans-serif;
            transition: all 0.3s;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
        }

        .search-field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='white' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 35px;
        }

        .search-field input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-field input:focus,
        .search-field select:focus {
            outline: none;
            border-color: #FF772D;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(255, 119, 45, 0.1);
        }

        .search-field input[type="date"] {
            color-scheme: dark;
        }

        .search-field input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .search-field input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        .search-btn {
            background: #FF772D;
            color: #fff;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            height: 44px;
            font-family: 'M', sans-serif;
            font-size: 14px;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-btn:hover {
            background: #e6681f;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(255, 119, 45, 0.3);
        }

        /* ========== ОСНОВНОЙ МАКЕТ ========== */
        .hotels-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        /* ========== БОКОВАЯ ПАНЕЛЬ ФИЛЬТРОВ ========== */
        .sidebar-filters {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #03548a1d;
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            color: #03538A;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #03548a1d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .filter-group-sidebar {
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .filter-group-sidebar:last-of-type {
            border-bottom: none;
        }

        .filter-group-sidebar h4 {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stars-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .star-btn {
            background: #f8f9fb;
            border: 1px solid #eef0f2;
            padding: 8px 14px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s;
            color: #888;
            font-family: 'M', sans-serif;
        }

        .star-btn:hover {
            border-color: #FF772D;
            color: #FF772D;
        }

        .star-btn.active {
            background: #FF772D;
            color: #fff;
            border-color: #FF772D;
        }

        .distance-radio label,
        .price-radio label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            padding: 7px 0;
            color: #666;
            transition: color 0.2s;
        }

        .distance-radio label:hover,
        .price-radio label:hover {
            color: #03538A;
        }

        .distance-radio input[type="radio"],
        .price-radio input[type="radio"] {
            accent-color: #FF772D;
            border: #FF772D;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .sort-select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #eef0f2;
            font-size: 13px;
            color: #555;
            background: #f8f9fb;
            cursor: pointer;
            font-family: 'M', sans-serif;
            transition: all 0.3s;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23888' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .sort-select:focus {
            outline: none;
            border-color: #03538A;
        }

        .reset-btn {
            width: 100%;
            padding: 10px;
            background: #fff;
            border: 1px solid #eef0f2;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s;
            font-size: 13px;
            font-weight: 500;
            color: #888;
            font-family: 'M', sans-serif;
        }

        .reset-btn:hover {
            background: #f8f9fb;
            border-color: #FF772D;
            color: #FF772D;
        }

        /* ========== КАРТОЧКА ОТЕЛЯ ========== */
        .hotel-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #03548a1d;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 20px;
            display: flex;
            cursor: pointer;
        }

        .hotel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(3, 83, 138, 0.08);
            border-color: #03548a30;
        }

        .hotel-image-section {
            width: 300px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .hotel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hotel-card:hover .hotel-image {
            transform: scale(1.06);
        }

        .hotel-image-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, transparent 60%, rgba(255, 255, 255, 0.05));
        }

        .hotel-content-section {
            flex: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
        }

        .hotel-name {
            font-size: 22px;
            font-weight: 700;
            color: #03538A;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .hotel-stars {
            display: flex;
            gap: 2px;
            margin-bottom: 10px;
        }

        .star {
            color: #FF772D;
            font-size: 15px;
        }

        .hotel-address {
            color: #aaa;
            font-size: 13px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .hotel-address svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            color: #FF772D;
        }

        .hotel-features {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 16px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #888;
            background: #f8f9fb;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .feature svg {
            width: 14px;
            height: 14px;
            color: #03538A;
        }

        .hotel-description {
            color: #999;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .hotel-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid #f0f0f0;
        }

        .room-types {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .room-type-badge {
            background: #f8f9fb;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 11px;
            color: #888;
            border: 1px solid #eef0f2;
        }

        .price-section {
            text-align: right;
        }

        .price-value {
            font-size: 26px;
            font-weight: 700;
            color: #03538A;
        }

        .price-period {
            font-size: 11px;
            color: #aaa;
            margin-bottom: 8px;
        }

        .book-btn {
            background: #FF772D;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'M', sans-serif;
        }

        .book-btn:hover {
            background: #e6681f;
            transform: translateX(3px);
            box-shadow: 0 5px 20px rgba(255, 119, 45, 0.25);
        }

        .results-count {
            background: #fff;
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #888;
            border: 1px solid #03548a1d;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .results-count strong {
            color: #03538A;
        }

        .clear-search {
            color: #FF772D;
            text-decoration: none;
            font-weight: 500;
            font-size: 12px;
            transition: color 0.2s;
        }

        .clear-search:hover {
            color: #e6681f;
        }

        /* Пустое состояние */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: #fff;
            border-radius: 20px;
            border: 1px solid #03548a1d;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 22px;
            color: #03538A;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .empty-state p {
            color: #aaa;
            font-size: 14px;
        }

        /* ========== АДАПТИВ ========== */
        @media (max-width: 992px) {
            .hotels-layout {
                grid-template-columns: 1fr;
            }

            .sidebar-filters {
                position: static;
                margin-bottom: 20px;
            }

            .hotel-card {
                flex-direction: column;
            }

            .hotel-image-section {
                width: 100%;
                height: 240px;
            }

            .search-form {
                grid-template-columns: 1fr 1fr;
            }

            .search-btn {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 576px) {
            .search-form {
                grid-template-columns: 1fr;
            }

            .hotel-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .price-section {
                text-align: left;
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }
    </style>

    <!-- Баннер с поиском -->
    <div class="search-banner">
        <div class="tabs__container">
            <div class="search-box">
                <form method="GET" action="{{ route('hotels') }}" class="search-form">
                    <div class="search-field">
                        <label>Отель или курорт</label>
                        <select name="hotel_id" class="hotel-select">
                            <option value="">Все отели</option>
                            @foreach($allHotels as $hotelOption)
                                <option value="{{ $hotelOption->id }}" {{ request('hotel_id') == $hotelOption->id ? 'selected' : '' }}>
                                    {{ $hotelOption->name }} ({{ $hotelOption->stars }}★)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-field">
                        <label>Заезд</label>
                        <input type="date" name="check_in" value="{{ request('check_in') }}" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="search-field">
                        <label>Выезд</label>
                        <input type="date" name="check_out" value="{{ request('check_out') }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                    <div class="search-field">
                        <label>Гостей</label>
                        <select name="guests">
                            <option value="1" {{ request('guests') == 1 ? 'selected' : '' }}>1 гость</option>
                            <option value="2" {{ request('guests') == 2 ? 'selected' : '' }}>2 гостя</option>
                            <option value="3" {{ request('guests') == 3 ? 'selected' : '' }}>3 гостя</option>
                            <option value="4" {{ request('guests') == 4 ? 'selected' : '' }}>4 гостя</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">Найти</button>
                </form>
            </div>
        </div>
    </div>

    <div class="tabs__container">
        <div class="hotels-layout">
            <!-- Боковая панель фильтров -->
            <aside class="sidebar-filters">
                <h3 class="sidebar-title">Фильтры</h3>

                <div class="filter-group-sidebar">
                    <h4>Количество звёзд</h4>
                    <div class="stars-filter" id="starsFilter">
                        <button class="star-btn active" data-stars="all">Все</button>
                        <button class="star-btn" data-stars="5">5 звёзд</button>
                        <button class="star-btn" data-stars="4">4 звезды</button>
                        <button class="star-btn" data-stars="3">3 звезды</button>
                    </div>
                </div>

                <div class="filter-group-sidebar">
                    <h4>Расстояние до подъёмника</h4>
                    <div class="distance-radio" id="distanceFilter">
                        <label><input type="radio" name="distance" value="all" checked> Любое</label>
                        <label><input type="radio" name="distance" value="100"> До 100 м</label>
                        <label><input type="radio" name="distance" value="300"> До 300 м</label>
                        <label><input type="radio" name="distance" value="500"> До 500 м</label>
                        <label><input type="radio" name="distance" value="1000"> До 1 км</label>
                    </div>
                </div>

                <div class="filter-group-sidebar">
                    <h4>Цена за ночь</h4>
                    <div class="price-radio" id="priceFilter">
                        <label><input type="radio" name="price" value="all" checked> Любая</label>
                        <label><input type="radio" name="price" value="0-5000"> до 5 000 ₽</label>
                        <label><input type="radio" name="price" value="5000-10000"> 5 000 — 10 000 ₽</label>
                        <label><input type="radio" name="price" value="10000-20000"> 10 000 — 20 000 ₽</label>
                        <label><input type="radio" name="price" value="20000+"> от 20 000 ₽</label>
                    </div>
                </div>

                <div class="filter-group-sidebar">
                    <h4>Сортировка</h4>
                    <select id="sortSelect" class="sort-select">
                        <option value="default">По умолчанию</option>
                        <option value="stars_desc">По звёздам (сначала высокие)</option>
                        <option value="distance_asc">По расстоянию (сначала близкие)</option>
                        <option value="price_asc">Цена (сначала дешёвые)</option>
                        <option value="price_desc">Цена (сначала дорогие)</option>
                    </select>
                </div>

                <button id="resetFilters" class="reset-btn">Сбросить все фильтры</button>
            </aside>

            <!-- Список отелей -->
            <div>
                <div class="results-count">
                    <span>Найдено отелей: <strong><span id="hotelCount">0</span></strong></span>
                    @if(request('search'))
                        <span>
                            Поиск: <strong>"{{ request('search') }}"</strong>
                            <a href="{{ route('hotels') }}" class="clear-search">✕ Очистить</a>
                        </span>
                    @endif
                </div>

                <div id="hotelsList">
                    @foreach($hotels as $hotel)
                        @php
                            $images = [];
                            if ($hotel->images) {
                                $images = explode(',', $hotel->images);
                            } elseif ($hotel->main_image) {
                                $images = [$hotel->main_image];
                            }
                            $minPrice = $hotel->rooms->min('price_per_night') ?? 0;
                        @endphp

                        <div class="hotel-card" data-stars="{{ $hotel->stars }}" data-distance="{{ $hotel->distance_to_lift }}"
                            data-price="{{ $minPrice }}" onclick="window.location='{{ route('hotels.show', $hotel) }}'">

                            <div class="hotel-image-section">
                                @if(count($images) > 0)
                                    <img src="{{ asset('storage/' . trim($images[0])) }}" alt="{{ $hotel->name }}"
                                        class="hotel-image">
                                @else
                                    <div
                                        style="background: linear-gradient(135deg, #e8ecf1, #d5dbe3); height: 100%; display: flex; align-items: center; justify-content: center;">
                                        <span style="font-size: 56px; opacity: 0.4;">🏨</span>
                                    </div>
                                @endif
                            </div>

                            <div class="hotel-content-section">
                                <div>
                                    <h3 class="hotel-name">{{ $hotel->name }}</h3>
                                    <div class="hotel-stars">
                                        @for($i = 0; $i < $hotel->stars; $i++)
                                            <span class="star">★</span>
                                        @endfor
                                    </div>
                                </div>

                                <div class="hotel-address">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $hotel->address }}
                                </div>

                                <div class="hotel-features">
                                    <span class="feature">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M17 17l-5-5V4" />
                                        </svg>
                                        {{ $hotel->distance_to_lift }} м до подъёмника
                                    </span>
                                    <span class="feature">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        </svg>
                                        {{ $hotel->rooms->count() }} номеров
                                    </span>
                                </div>

                                <p class="hotel-description">
                                    {{ Str::limit($hotel->description, 120) }}
                                </p>

                                <div class="hotel-footer">
                                    <div class="room-types">
                                        @foreach($hotel->rooms->take(3) as $room)
                                            <span class="room-type-badge">{{ $room->room_type }}</span>
                                        @endforeach
                                    </div>
                                    <div class="price-section">
                                        <div class="price-value">
                                            {{ $minPrice > 0 ? number_format($minPrice, 0, ',', ' ') : 'По запросу' }} ₽</div>
                                        <div class="price-period">за номер в сутки</div>
                                        <a href="{{ route('hotels.show', $hotel) }}" class="book-btn"
                                            onclick="event.stopPropagation()">Выбрать номер</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($hotels->isEmpty())
                        <div class="empty-state">
                            <div class="empty-state-icon">🏨</div>
                            <h3>Отели не найдены</h3>
                            <p>Попробуйте изменить параметры поиска или сбросить фильтры</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hotelsList = document.getElementById('hotelsList');
            const hotelCountSpan = document.getElementById('hotelCount');

            let currentFilters = {
                stars: 'all',
                distance: 'all',
                price: 'all',
                sort: 'default'
            };

            function filterAndSortHotels() {
                const hotels = Array.from(document.querySelectorAll('.hotel-card'));

                let filtered = hotels.filter(hotel => {
                    const stars = parseInt(hotel.dataset.stars);
                    const distance = parseInt(hotel.dataset.distance);
                    const price = parseInt(hotel.dataset.price);

                    if (currentFilters.stars !== 'all' && stars !== parseInt(currentFilters.stars)) return false;
                    if (currentFilters.distance !== 'all' && distance > parseInt(currentFilters.distance)) return false;

                    if (currentFilters.price !== 'all') {
                        if (currentFilters.price === '20000+' && price < 20000) return false;
                        if (currentFilters.price !== '20000+') {
                            const [min, max] = currentFilters.price.split('-').map(Number);
                            if (price < min || (max && price > max)) return false;
                        }
                    }

                    return true;
                });

                filtered.sort((a, b) => {
                    switch (currentFilters.sort) {
                        case 'price_asc': return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                        case 'price_desc': return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                        case 'stars_desc': return parseInt(b.dataset.stars) - parseInt(a.dataset.stars);
                        case 'distance_asc': return parseInt(a.dataset.distance) - parseInt(b.dataset.distance);
                        default: return 0;
                    }
                });

                hotelCountSpan.textContent = filtered.length;

                hotels.forEach(hotel => hotel.style.display = 'none');
                filtered.forEach(hotel => hotel.style.display = 'flex');
            }

            // Фильтр по звездам
            document.querySelectorAll('.star-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.star-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilters.stars = this.dataset.stars;
                    filterAndSortHotels();
                });
            });

            // Фильтр по расстоянию
            document.querySelectorAll('#distanceFilter input').forEach(radio => {
                radio.addEventListener('change', function () {
                    currentFilters.distance = this.value;
                    filterAndSortHotels();
                });
            });

            // Фильтр по цене
            document.querySelectorAll('#priceFilter input').forEach(radio => {
                radio.addEventListener('change', function () {
                    currentFilters.price = this.value;
                    filterAndSortHotels();
                });
            });

            // Сортировка
            document.getElementById('sortSelect').addEventListener('change', function () {
                currentFilters.sort = this.value;
                filterAndSortHotels();
            });

            // Сброс фильтров
            document.getElementById('resetFilters').addEventListener('click', function () {
                document.querySelectorAll('.star-btn').forEach(b => b.classList.remove('active'));
                document.querySelector('.star-btn[data-stars="all"]').classList.add('active');
                document.querySelector('#distanceFilter input[value="all"]').checked = true;
                document.querySelector('#priceFilter input[value="all"]').checked = true;
                document.getElementById('sortSelect').value = 'default';

                currentFilters = { stars: 'all', distance: 'all', price: 'all', sort: 'default' };
                filterAndSortHotels();
            });

            // Инициализация
            filterAndSortHotels();
        });
    </script>
@endsection