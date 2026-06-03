{{-- resources/views/bookings/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #03538A;
        --accent: #FF772D;
        --border: #03548a1d;
        --bg: #f8f9fb;
        --text: #1a1a1a;
        --text-light: #888;
        --danger: #e74c3c;
    }

    .bookings-page {
        min-height: 100vh;
        padding: 60px 0;
    }

    .bookings-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .bookings-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 30px;
        font-family: R;
        text-transform: uppercase;
    }

    /* Карточка бронирования */
    .booking-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        margin-bottom: 16px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .booking-card:hover {
        box-shadow: 0 8px 30px rgba(3, 83, 138, 0.08);
    }

    /* Верхняя часть карточки */
    .booking-card__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #f0f0f0;
    }

    .booking-card__number {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
    }

    .booking-card__number span {
        color: var(--accent);
    }

    .booking-card__status {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-dot--pending { background: var(--accent); }
    .status-dot--confirmed { background: var(--primary); }
    .status-dot--cancelled { background: #e74c3c; }
    .status-dot--completed { background: #8e99a3; }

    .status-text {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
    }

    /* Основная часть карточки */
    .booking-card__body {
        padding: 24px;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 24px;
    }

    .booking-card__main {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .booking-card__type {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .booking-type-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        background: #fff8f2;
        color: var(--accent);
    }

    .booking-type-info h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 2px;
    }

    .booking-type-info p {
        font-size: 13px;
        color: var(--text-light);
        margin: 0;
    }

    .booking-card__dates {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .date-block {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .date-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #aaa;
        font-weight: 600;
    }

    .date-value {
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
    }

    .booking-card__details {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .detail-item {
        font-size: 13px;
        color: var(--text-light);
        background: #f8f9fb;
        padding: 6px 14px;
        border-radius: 20px;
    }

    /* Правая часть с ценой и кнопками */
    .booking-card__aside {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        gap: 12px;
    }

    .booking-card__price {
        font-size: 24px;
        font-weight: 700;
        color: var(--accent);
        text-align: right;
    }

    .booking-card__price span {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-light);
    }

    .booking-card__payment {
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
    }

    .payment-paid {
        background: #edf7ed;
        color: #03538A;
    }

    .payment-unpaid {
        background: #fff8f2;
        color: var(--accent);
    }

    .payment-refunded {
        background: #fdf0ef;
        color: #e74c3c;
    }

    .booking-card__actions {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .btn-outline {
        background: #fff;
        color: var(--primary);
        border: 2px solid var(--border);
    }
    .btn-outline:hover {
        background: #f8f9fb;
        border-color: var(--primary);
    }

    .btn-danger {
        background: #fff;
        color: #e74c3c;
        border: 2px solid #f5c6cb;
    }
    .btn-danger:hover {
        background: #fdf0ef;
        border-color: #e74c3c;
    }

    .btn-pay {
        background: var(--accent);
        color: #fff;
        border: 2px solid var(--accent);
    }
    .btn-pay:hover {
        background: #e6681f;
        border-color: #e6681f;
    }

    /* Пустое состояние */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
    }

    .empty-state-text {
        font-size: 18px;
        color: #aaa;
        margin-bottom: 20px;
    }

    .empty-state-link {
        display: inline-block;
        padding: 14px 32px;
        background: var(--accent);
        color: #fff;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .empty-state-link:hover {
        background: #e6681f;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 119, 45, 0.3);
    }

    @media (max-width: 700px) {
        .booking-card__body {
            grid-template-columns: 1fr;
        }
        .booking-card__aside {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .booking-card__dates {
            flex-direction: column;
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .booking-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .booking-card__aside {
            flex-direction: column;
            align-items: flex-start;
        }
        .booking-card__actions {
            width: 100%;
            flex-direction: column;
        }
        .btn-sm {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="bookings-page">
    <div class="bookings-container">
        
        <h1 class="bookings-title">Мои бронирования</h1>
        
        @if($bookings->isEmpty())
        <div class="empty-state">
            <div class="empty-state-text">У вас пока нет бронирований</div>
            <a href="{{ url('/') }}" class="empty-state-link">Выбрать услуги</a>
        </div>
        @else
            @foreach($bookings as $booking)
            <div class="booking-card">
                {{-- Верхняя строка --}}
                <div class="booking-card__header">
                    <div class="booking-card__number">
                        Бронирование <span>#{{ $booking->id }}</span>
                    </div>
                    <div class="booking-card__status">
                        <span class="status-dot 
                            @switch($booking->status)
                                @case('pending') status-dot--pending @break
                                @case('confirmed') status-dot--confirmed @break
                                @case('cancelled') status-dot--cancelled @break
                                @case('completed') status-dot--completed @break
                            @endswitch
                        "></span>
                        <span class="status-text">
                            @switch($booking->status)
                                @case('pending') Ожидает подтверждения @break
                                @case('confirmed') Подтверждено @break
                                @case('cancelled') Отменено @break
                                @case('completed') Завершено @break
                            @endswitch
                        </span>
                    </div>
                </div>

                {{-- Основная часть --}}
                <div class="booking-card__body">
                    <div class="booking-card__main">
                        {{-- Тип услуги --}}
                        <div class="booking-card__type">
                            <div class="booking-type-icon">
                                @switch($booking->booking_type)
                                    @case('instructor') И @break
                                    @case('hotel') О @break
                                    @case('lift_pass') С @break
                                @endswitch
                            </div>
                            <div class="booking-type-info">
                                <h4>
                                    @switch($booking->booking_type)
                                        @case('instructor') Инструктор @break
                                        @case('hotel') Отель @break
                                        @case('lift_pass') Ски-пасс @break
                                    @endswitch
                                </h4>
                                <p>
                                    @if($booking->booking_type === 'instructor')
                                        @php $instructor = \App\Models\Instructor::find($booking->item_id); @endphp
                                        {{ $instructor ? $instructor->name : '' }}
                                    @elseif($booking->booking_type === 'hotel')
                                        @php $room = \App\Models\HotelRoom::with('hotel')->find($booking->item_id); @endphp
                                        {{ $room ? $room->hotel->name . ' - ' . $room->room_type : '' }}
                                    @else
                                        @php $tariff = \App\Models\Tariff::find($booking->item_id); @endphp
                                        {{ $tariff ? $tariff->name : '' }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Даты --}}
                        <div class="booking-card__dates">
                            <div class="date-block">
                                <span class="date-label">Заезд / Начало</span>
                                <span class="date-value">{{ $booking->start_date->format('d.m.Y') }}</span>
                            </div>
                            @if($booking->end_date)
                            <div class="date-block">
                                <span class="date-label">Выезд / Конец</span>
                                <span class="date-value">{{ $booking->end_date->format('d.m.Y') }}</span>
                            </div>
                            @endif
                        </div>

                        {{-- Детали --}}
                        <div class="booking-card__details">
                            @if($booking->booking_type === 'instructor' && isset($instructor))
                                <span class="detail-item">{{ $instructor->specialization }}</span>
                                <span class="detail-item">{{ $instructor->experience_years }} лет опыта</span>
                            @endif
                            @if($booking->guests_count)
                                <span class="detail-item">{{ $booking->guests_count }} гостей</span>
                            @endif
                            @if($booking->comment)
                                <span class="detail-item">Комментарий: {{ Str::limit($booking->comment, 50) }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Цена и действия --}}
                    <div class="booking-card__aside">
                        <div class="booking-card__price">
                            {{ number_format($booking->total_price, 0, ',', ' ') }} <span>руб</span>
                        </div>
                        <div class="booking-card__payment 
                            @switch($booking->payment_status)
                                @case('paid') payment-paid @break
                                @case('unpaid') payment-unpaid @break
                                @case('refunded') payment-refunded @break
                            @endswitch
                        ">
                            @switch($booking->payment_status)
                                @case('unpaid') Не оплачено @break
                                @case('paid') Оплачено @break
                                @case('refunded') Возврат @break
                            @endswitch
                        </div>
                        <div class="booking-card__actions">
                            <a href="{{ route('bookings.show', $booking) }}" class="btn-sm btn-outline">Детали</a>
                            @if($booking->status === 'pending' && $booking->payment_status === 'unpaid')
                                <a href="{{ route('bookings.payment', $booking) }}" class="btn-sm btn-pay">Оплатить</a>
                            @endif
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Отменить бронирование?')">Отменить</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        
    </div>
</div>
@endsection