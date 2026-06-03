{{-- resources/views/bookings/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary: #03538A;
            --accent: #FF772D;
            --danger: #e74c3c;
            --success: #27ae60;
            --gray: #f8f9fb;
            --border: #03548a1d;
        }

        .booking-page {

            min-height: 100vh;
            padding: 40px 0;
            font-family: 'M', sans-serif;
        }

        .booking-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Хлебные крошки */
        .booking-breadcrumbs {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .booking-breadcrumbs a {
            color: #888;
            text-decoration: none;
            transition: 0.2s;
        }

        .booking-breadcrumbs a:hover {
            color: var(--primary);
        }

        /* Сетка */
        .booking-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            align-items: start;
        }

        /* Карточка услуги */
        .booking-service-card {
            display: flex;
            gap: 24px;
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .service-card__image {
            width: 140px;
            height: 140px;
            border-radius: 16px;
            overflow: hidden;
            flex-shrink: 0;
            background: linear-gradient(135deg, #e8ecf1, #d5dbe3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .service-card__info {
            flex: 1;
        }

        .service-card__type {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #aaa;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .service-card__title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 6px;
        }

        .service-card__subtitle {
            font-size: 13px;
            color: #888;
            margin-bottom: 12px;
        }

        .service-card__price {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .service-card__price span {
            font-size: 14px;
            font-weight: 500;
            color: #aaa;
        }

        /* Секции формы */
        .booking-section {
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 16px;
            border: 1px solid var(--border);
        }

        .booking-section__title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--border);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Сетка полей */
        .form-row {
            display: grid;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-row--2 {
            grid-template-columns: 1fr 1fr;
        }

        .form-row--3 {
            grid-template-columns: 1fr 1fr 1fr;
        }

        /* Поля */
        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #888;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #eef0f2;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fafbfc;
            color: #1a1a1a;
            font-family: 'M', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group small {
            display: block;
            font-size: 11px;
            color: #bbb;
            margin-top: 4px;
            text-transform: none;
            letter-spacing: 0;
            font-weight: 400;
        }

        /* Стилизация календаря */
        .form-group input[type="date"] {
            color-scheme: light;
            cursor: pointer;
            position: relative;
        }

        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%2303538A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E") !important;
            background-size: 18px 18px !important;
            width: 18px !important;
            height: 18px !important;
            cursor: pointer !important;
            opacity: 0.6 !important;
            transition: all 0.3s !important;
        }

        .form-group input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1 !important;
            transform: scale(1.1) !important;
        }

        /* Select */
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23888' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
            cursor: pointer;
        }

        /* Range slider */
        .range-wrap input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #eef0f2;
            outline: none;
            padding: 0;
            border: none;
            margin: 12px 0 6px;
        }

        .range-wrap input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--accent);
            cursor: pointer;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(255, 119, 45, 0.3);
        }

        .range-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #ccc;
        }

        #guests-label {
            font-weight: 700;
            color: var(--accent);
        }

        /* Quantity */
        .quantity-input {
            display: inline-flex;
            align-items: center;
            border: 1px solid #eef0f2;
            border-radius: 12px;
            overflow: hidden;
            background: #fafbfc;
        }

        .quantity-input button {
            width: 42px;
            height: 46px;
            border: none;
            background: none;
            font-size: 22px;
            cursor: pointer;
            color: var(--primary);
            font-weight: 600;
            transition: 0.2s;
        }

        .quantity-input button:hover {
            background: #f0f2f5;
        }

        .quantity-input input {
            width: 48px;
            text-align: center;
            border: none;
            font-weight: 700;
            font-size: 16px;
            background: transparent;
            padding: 0;
        }

        /* Checkbox */
        .checkbox-label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: #888;
            cursor: pointer;
            margin-top: 16px;
        }

        .checkbox-label input {
            margin-top: 2px;
            width: 16px;
            height: 16px;
            accent-color: var(--accent);
        }

        .checkbox-label a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-label a:hover {
            text-decoration: underline;
        }

        /* Tariff */
        .tariff-desc {
            font-size: 14px;
            color: #888;
            margin-top: 6px;
            line-height: 1.6;
        }

        /* Кнопка */
        .booking-submit-btn {
            width: 100%;
            padding: 18px 28px;
            background: var(--accent);
            color: #fff;
            border: 1px solid #FF772D;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            margin-top: 8px;
            text-transform: uppercase;

        }

        .booking-submit-btn:hover {
            background: none;
            color: #FF772D;
           
        }

        /* Сайдбар */
        .sidebar-card {
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid var(--border);
            position: sticky;
            top: 100px;
        }

        .sidebar-card__title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 2px solid var(--border);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-card__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .sidebar-card__label {
            color: #aaa;
        }

        .sidebar-card__value {
            font-weight: 600;
            color: #1a1a1a;
            text-align: right;
        }

        .sidebar-card__divider {
            border-top: 1px solid #f0f0f0;
            margin: 16px 0;
        }

        .sidebar-card__total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 22px;
            font-weight: 700;
            padding-top: 16px;
            border-top: 2px solid var(--border);
            margin-top: 12px;
            color: var(--primary);
        }

        .sidebar-card__guarantees {
            margin-top: 20px;
            padding: 16px;
            background: #f8f9fb;
            border-radius: 12px;
            border: 1px solid #eef0f2;
        }

        .guarantee-item {
            font-size: 12px;
            color: #888;
            padding: 3px 0;
            line-height: 1.6;
        }

        /* Адаптив */
        @media (max-width: 860px) {
            .booking-layout {
                grid-template-columns: 1fr;
            }

            .form-row--3 {
                grid-template-columns: 1fr 1fr;
            }

            .form-row--2 {
                grid-template-columns: 1fr;
            }

            .booking-service-card {
                flex-direction: column;
            }

            .service-card__image {
                width: 100%;
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .form-row--3 {
                grid-template-columns: 1fr;
            }

            .booking-section {
                padding: 20px;
            }
        }

        /* ========== СТИЛИЗАЦИЯ ВЫПАДАЮЩЕГО КАЛЕНДАРЯ ========== */

        /* Основные стили поля с датой */
        .form-group input[type="date"] {
            color-scheme: light !important;
            cursor: pointer;
            position: relative;
            color: #1a1a1a !important;
        }

        /* Иконка календаря в поле */
        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2303538A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E") !important;
            background-size: 20px 20px !important;
            width: 20px !important;
            height: 20px !important;
            cursor: pointer !important;
            opacity: 0.6 !important;
            transition: all 0.3s ease !important;
        }

        .form-group input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1 !important;
            transform: scale(1.1) !important;
        }

        /* Стилизация текста даты в поле */
        .form-group input[type="date"]::-webkit-datetime-edit {
            color: #1a1a1a !important;
            padding: 0 !important;
        }

        .form-group input[type="date"]::-webkit-datetime-edit-fields-wrapper {
            color: #1a1a1a !important;
        }

        .form-group input[type="date"]::-webkit-datetime-edit-text {
            color: #aaa !important;
            padding: 0 2px !important;
        }

        .form-group input[type="date"]::-webkit-datetime-edit-month-field,
        .form-group input[type="date"]::-webkit-datetime-edit-day-field,
        .form-group input[type="date"]::-webkit-datetime-edit-year-field {
            color: #1a1a1a !important;
            font-weight: 500 !important;
        }

        .form-group input[type="date"]::-webkit-datetime-edit-month-field:focus,
        .form-group input[type="date"]::-webkit-datetime-edit-day-field:focus,
        .form-group input[type="date"]::-webkit-datetime-edit-year-field:focus {
            background: rgba(3, 83, 138, 0.1) !important;
            color: #03538A !important;
            border-radius: 3px !important;
        }

        /* Пустое поле (placeholder) */
        .form-group input[type="date"]:not(:valid)::-webkit-datetime-edit {
            color: #bbb !important;
        }

        /* Стилизация самого выпадающего календаря */
        ::-webkit-calendar-picker {
            background: #fff !important;
            border: 1px solid #eef0f2 !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12) !important;
            padding: 16px !important;
        }

        /* Контейнер календаря */
        ::-webkit-datetime-edit {
            color: #1a1a1a !important;
        }

        /* Кнопки навигации в календаре */
        ::-webkit-calendar-picker-indicator {
            filter: none !important;
        }

        /* Месяц и год в шапке календаря */
        ::-webkit-datetime-edit-month-field,
        ::-webkit-datetime-edit-year-field {
            color: #03538A !important;
        }

        /* Стили для Firefox */
        @-moz-document url-prefix() {
            .form-group input[type="date"] {
                color-scheme: light !important;
            }
        }

        /* Дополнительные стили для улучшения внешнего вида */
        .form-group input[type="date"]:hover {
            border-color: #03538A !important;
            background: #fff !important;
        }

        .form-group input[type="date"]:focus {
            border-color: #03538A !important;
            background: #fff !important;
            box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.08) !important;
        }
    </style>

    <div class="booking-page">
        <div class="booking-container">

            <div class="booking-breadcrumbs">
                <a href="{{ url('/') }}">Главная</a>
                <span>/</span>
                <a href="javascript:history.back()">
                    @if($type === 'instructor') Инструкторы
                    @elseif($type === 'hotel') Отели
                    @else Тарифы
                    @endif
                </a>
                <span>/</span>
                <span>Бронирование</span>
            </div>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_type" value="{{ $type }}">
                <input type="hidden" name="item_id" value="{{ $item->id }}">

                <div class="booking-layout">

                    <div>

                        <div class="booking-service-card">
                            <div class="service-card__image">
                                @if($type === 'instructor')
                                    @if($item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}">
                                    @endif
                                @elseif($type === 'hotel')
                                    @php 
                                        $imgs = $item->images ? explode(',', $item->images) : ($item->hotel->images ? explode(',', $item->hotel->images) : []);
                                    @endphp
                                    @if(!empty($imgs))
                                        <img src="{{ asset('storage/' . trim($imgs[0])) }}" alt="{{ $item->hotel->name }}">
                                    @endif
                                @endif
                            </div>
                            <div class="service-card__info">
                                <div class="service-card__type">
                                    @if($type === 'instructor') Инструктор
                                    @elseif($type === 'hotel') Отель
                                    @else Тариф
                                    @endif
                                </div>
                                <h2 class="service-card__title">
                                    @if($type === 'instructor') {{ $item->name }}
                                    @elseif($type === 'hotel') {{ $item->hotel->name }}
                                    @else {{ $item->name }}
                                    @endif
                                </h2>

                                                               @if($type === 'instructor')
                                                                <p class="service-card__subtitle">{{ $item->specialization }} / {{ $item->experience_years }} лет опыта</p>
                                                            @elseif($type === 'hotel')
                                    <p class="service-card__subtitle">{{ $item->room_type }} / {{ $item->hotel->address }}</p>
                                @endif
                            <div class="service-card__price">
                                    @if($type === 'instructor')
                                        {{ number_format($item->price_per_hour, 0, ',', ' ') }} <span>₽/час</span>
                                    @elseif($type === 'hotel')
                                        {{ number_format($item->price_per_night, 0, ',', ' ') }} <span>₽/ночь</span>
                                    @else
                                        {{ number_format($item->price, 0, ',', ' ') }} <span>₽</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="booking-section">
                            <h3 class="booking-section__title">Параметры бронирования</h3>

                            @if($type === 'instructor')
                                <div class="form-row form-row--3">
                                    <div class="form-group">

                                                                           <label>Дата</label>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Время</label>
                                        <select name="start_time">
                                            @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'] as $t)
                                                <option value="{{ $t }}">{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Часы</label>
                                        <div class="quantity-input">
                                            <button type="button" onclick="changeHours(-1)">-</button>
                                            <input type="text" id="hours-input" value="2" readonly>
                                            <button type="button" onclick="changeHours(1)">+</button>
                                        </div>
                                        <input type="hidden" name="hours" value="2">
                                    </div>
                                </div>

                            @elseif($type === 'hotel')
                                <div class="form-row form-row--2">
                                    <div class="form-group">

                                                                           <label>Заезд</label>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                        <small>Заезд с 14:00</small>
                                    </div>
                                    <div class="form-group">

                                                                           <label>Выезд</label>
                                        <input type="date" name="end_date" required min="{{ date('Y-m-d', strtotime('+2 days')) }}">
                                        <small>Выезд до 12:00</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group range-wrap">

                                                                           <label>Количество гостей: <span id="guests-label">1</span></label>
                                        <input type="range" name="guests_count" min="1" max="{{ $item->capacity }}" value="1" oninput="document.getElementById('guests-label').textContent=this.value">
                                        <div class="range-labels"><span>1</span><span>{{ $item->capacity }}</span></div>
                                    </div>
                                </div>

                            @else
                                <div class="form-row">
                                    <div class="form-group">

                                                                     <label>Дата начала</label>
                                        <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                    </div>
                                </div>
                                <p class="tariff-desc">{{ $item->description }}</p>
                            @endif
                        </div>

                        <div class="booking-section">
                            <h3 class="booking-section__title">Данные гостя</h3>

                                                               <div class="form-row form-row--2">

                                                 <div class="form-group"><label>Фамилия</label><input type="text" name="surname" placeholder="Иванов" required></div>
                                <div class="form-group"><label>Имя</label><input type="text" name="first_name" placeholder="Иван" required></div>
                            </div>

                                                               <div class="form-row form-row--2">

                                                                   <div class="form-group"><label>Отчество</label><input type="text" name="patronymic" placeholder="Иванович"></div>
                                <div class="form-group"><label>Дата рождения</label><input type="date" name="birth_date" required max="{{ date('Y-m-d', strtotime('-14 years')) }}"></div>
                            </div>

                                                               <div class="form-row form-row--2">

                                                                   <div class="form-group"><label>Телефон</label><input type="tel" name="phone" value="{{ Auth::user()->phone }}" placeholder="+7 999 123-45-67" required></div>
                                <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ Auth::user()->email }}" required></div>
                            </div>
                        </div>

                        @if($type === 'hotel')
                            <div class="booking-section">
                                <h3 class="booking-section__title">Паспортные данные</h3>

                                                                   <div class="form-row form-row--2">

                                                                       <div class="form-group"><label>Серия</label><input type="text" name="passport_series" placeholder="1234" maxlength="4"></div>
                                    <div class="form-group"><label>Номер</label><input type="text" name="passport_number" placeholder="567890" maxlength="6"></div>
                                </div>

                                                                   <div class="form-row form-row--2">

                                                                       <div class="form-group"><label>Кем выдан</label><input type="text" name="passport_issued_by" placeholder="ОВД района..."></div>
                                    <div class="form-group"><label>Дата выдачи</label><input type="date" name="passport_issued_date" max="{{ date('Y-m-d') }}"></div>
                                </div>
                            </div>
                        @endif

                        <div class="booking-section">
                            <h3 class="booking-section__title">Дополнительно</h3>
                            <div class="form-group">
                                <textarea name="comment" rows="3" placeholder="Ваши пожелания..."></textarea>
                            </div>
                            <label class="checkbox-label">

                                                                <input type="checkbox" name="agree_rules" required>
                                <span>Принимаю <a href="#">правила курорта</a> и <a href="#">обработку персональных данных</a></span>
                            </label>
                        </div>

                        <button type="submit" class="booking-submit-btn">Перейти к оплате</button>
                    </div>

                    <div>
                        <div class="sidebar-card">
                            <div class="sidebar-card__title">Ваш заказ</div>

                            <div class="sidebar-card__item">
                                <span class="sidebar-card__label">
                                    @if($type === 'instructor') Инструктор
                                    @elseif($type === 'hotel') Отель
                                    @else Тариф
                                    @endif
                                </span>
                                <span class="sidebar-card__value">
                                    @if($type === 'instructor') {{ $item->name }}
                                    @elseif($type === 'hotel') {{ $item->hotel->name }}
                                    @else {{ $item->name }}
                                    @endif
                                </span>
                            </div>

                            <div class="sidebar-card__item">
                                <span class="sidebar-card__label">Детали</span>

                                                <span class="sidebar-card__value">
                                    @if($type === 'instructor') {{ number_format($item->price_per_hour, 0, ',', ' ') }} ₽/час
                                    @elseif($type === 'hotel') {{ $item->room_type }}
                                    @else {{ $item->description }}
                                    @endif
                                </span>
                            </div>

                            <div class="sidebar-card__divider"></div>

                            <div class="sidebar-card__item">
                                <span class="sidebar-card__label" id="sidebar-qty-label">
                                    @if($type === 'instructor') 2 часа
                                    @elseif($type === 'hotel') 1 ночь
                                    @else -
                                    @endif
                                </span>

                                    <span class="sidebar-card__value" id="sidebar-subtotal">
                                    @if($type === 'instructor') {{ number_format($item->price_per_hour * 2, 0, ',', ' ') }} ₽
                                    @elseif($type === 'hotel') {{ number_format($item->price_per_night, 0, ',', ' ') }} ₽
                                    @else {{ number_format($item->price, 0, ',', ' ') }} ₽
                                    @endif
                                </span>
                            </div>

                            <div class="sidebar-card__total">
                                <span>Итого</span>

                                            <span id="sidebar-total">
                                    @if($type === 'instructor') {{ number_format($item->price_per_hour * 2, 0, ',', ' ') }} ₽
                                    @elseif($type === 'hotel') {{ number_format($item->price_per_night, 0, ',', ' ') }} ₽
                                    @else {{ number_format($item->price, 0, ',', ' ') }} ₽
                                    @endif
                                </span>
                            </div>

                            <div class="sidebar-card__guarantees">
                                <div class="guarantee-item">Бесплатная отмена за 24 ч</div>
                                <div class="guarantee-item">Поддержка 24/7</div>
                                <div class="guarantee-item">Без скрытых платежей</div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

        @push('scripts')
                <script>
                function changeHours(d) {
                    const inp = document.getElementById('hours-input');
                    const hid = document.querySelector('input[name="hours"]');
                    let v = parseInt(inp.value) + d;
                    if (v < 1) v = 1;
                    if (v > 8) v = 8;
                    inp.value = v;
                    hid.value = v;
                    updateSidebar();
                }
            function updateSidebar() {
                @if($type === 'instructor')
                    const h = parseInt(document.getElementById('hours-input').value);
                    const p = {{ $item->price_per_hour }} ;
                      const t = h * p;
                    const w = h + ' час' + (h===1?'':h<5?'а':'ов');
                    document.getElementById('sidebar-qty-label').textContent = w;
                        document.getElementById('sidebar-subtotal').textContent = new Intl.NumberFormat('ru-RU').format(t) + ' ₽';
                    document.getElementById('sidebar-total').textContent = new Intl.NumberFormat('ru-RU').format(t) + ' ₽';
                @endif
                }
                @if($type === 'hotel')
                        document.querySelector('input[name="end_date"]').addEventListener('change', calc);
                     docu   ment.querySelector('input[name="start_date"]').addEventListener('change', calc);
                      func  tion calc() {
                            const s = new Date(document.querySelector('input[name="start_date"]').value);
                            const e = new Date(docu m en t .querySelector('input[name="end_date"]').value);
                            if (isNaN(s) || isNaN(e) || e <= s) return;
                            const n = Math.round((e-s)/(86400000));
                            const p = {{ $item->price_per_night }};
                                        const t = n * p;
                            document.getElementById('sidebar-qty-label').textContent = n + ' ноч' + (n===1?'ь':n<5?'и':'ей');
                            document.getElementById('sidebar-subtotal').textContent = new Intl.NumberFormat('ru-RU').format(t) + ' ₽';
                            document.getElementById('sidebar-total').textContent = new Intl.NumberFormat('ru-RU').format(t) + ' ₽';
                    }
                @endif
            </script>
        @endpush
@endsection