{{-- resources/views/bookings/show.blade.php --}}
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

    .booking-show-page {
        min-height: 100vh;
        padding: 60px 0;
    }

    .booking-show-container {
        max-width: 720px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .booking-show-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        font-family: R;
        text-transform: uppercase;
        margin-bottom: 8px;
        text-align: center;
    }

    .booking-show-subtitle {
        text-align: center;
        color: var(--accent);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .booking-show-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        border: 1px solid var(--border);
    }

    /* Алерты */
    .alert {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .alert-success {
        background: #edf7ed;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Статусы */
    .status-block {
        display: flex;
        gap: 12px;
        margin-bottom: 28px;
        padding: 20px;
        background: #fff8f2;
        border-radius: 16px;
        border: 1px solid #ffe8d6;
        flex-wrap: wrap;
    }

    .status-badge {
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .status-pending {
        background: var(--accent);
        color: #fff;
    }

    .status-confirmed {
        background: var(--primary);
        color: #fff;
    }

    .status-cancelled {
        background: #e74c3c;
        color: #fff;
    }

    .status-completed {
        background: #8e99a3;
        color: #fff;
    }

    .payment-unpaid {
        background: #fff;
        color: var(--accent);
        border: 2px solid var(--accent);
    }

    .payment-paid {
        background: #fff;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .payment-refunded {
        background: #fff;
        color: #e74c3c;
        border: 2px solid #e74c3c;
    }

    /* Детали */
    .detail-section {
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-section:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        font-size: 14px;
    }

    .detail-label {
        color: var(--text-light);
        font-weight: 500;
        font-size: 13px;
    }

    .detail-value {
        font-weight: 600;
        color: #03538A;
        text-align: right;
        font-size: 14px;
    }

    .detail-value--large {
        font-size: 28px;
        font-weight: 700;
        color: #03538A;
    }

    .detail-value--large span {
        font-size: 16px;
        font-weight: 500;
        color: #03538A;
    }

    /* Блок информации */
    .info-block {
        background: #fff8f2;
        padding: 20px 24px;
        border-radius: 16px;
        margin: 20px 0;
        border: 1px solid #ffe8d6;

    }

    .info-block h4 {
        font-size: 15px;
        font-weight: 700;
        color: var(--accent);
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-block ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-block ul li {
        font-size: 14px;
        color: #666;
        padding: 6px 0;
        padding-left: 22px;
        position: relative;
        line-height: 1.6;
    }

    .info-block ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 14px;
        width: 8px;
        height: 8px;
        background: var(--accent);
        border-radius: 50%;
        opacity: 0.6;
    }

    .info-block ul li strong {
        color: var(--primary);
        font-weight: 700;
    }

    /* Комментарий */
    .comment-block {
        margin: 20px 0;
        padding: 16px 20px;
        background: #f8f9fb;
        border-radius: 14px;

    }

    .comment-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--accent);
        font-weight: 700;
        margin-bottom: 8px;
    }

    .comment-text {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    /* Кнопки */
    .button-row {
        display: flex;
        gap: 12px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 2px solid #f0f0f0;
        flex-wrap: wrap;
    }

    .btn {
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1;
        min-width: 160px;
    }

    .btn-back {
        background: #fff;
        color: var(--primary);
        border: 2px solid var(--border);
    }
    .btn-back:hover {
        background: #f8f9fb;
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .btn-pay {
        background: var(--accent);
        color: #fff;
        box-shadow: 0 4px 20px rgba(255, 119, 45, 0.3);
        border: 2px solid var(--accent);
    }
    .btn-pay:hover {
        background: #e6681f;
        border-color: #e6681f;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(255, 119, 45, 0.4);
    }

    .btn-cancel {
        background: #fff;
        color: #e74c3c;
        border: 2px solid #f5c6cb;
    }
    .btn-cancel:hover {
        background: #fdf0ef;
        border-color: #e74c3c;
        transform: translateY(-2px);
    }

    @media (max-width: 480px) {
        .booking-show-card {
            padding: 20px;
        }
        .booking-show-title {
            font-size: 26px;
        }
        .status-block {
            flex-direction: column;
            align-items: center;
        }
        .button-row {
            flex-direction: column;
        }
        .btn {
            width: 100%;
            min-width: auto;
        }
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        .detail-value {
            text-align: left;
        }
    }
</style>

<div class="booking-show-page">
    <div class="booking-show-container">
        
        <h1 class="booking-show-title">Бронирование #{{ $booking->id }}</h1>
        <div class="booking-show-subtitle">Детали заказа</div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="booking-show-card">
            
            <div class="status-block">
                <span class="status-badge 
                    @switch($booking->status)
                        @case('pending') status-pending @break
                        @case('confirmed') status-confirmed @break
                        @case('cancelled') status-cancelled @break
                        @case('completed') status-completed @break
                    @endswitch
                ">
                    @switch($booking->status)
                        @case('pending') Ожидает оплаты @break
                        @case('confirmed') Подтверждено @break
                        @case('cancelled') Отменено @break
                        @case('completed') Завершено @break
                    @endswitch
                </span>
                <span class="status-badge 
                    @switch($booking->payment_status)
                        @case('unpaid') payment-unpaid @break
                        @case('paid') payment-paid @break
                        @case('refunded') payment-refunded @break
                    @endswitch
                ">
                    @switch($booking->payment_status)
                        @case('unpaid') Не оплачено @break
                        @case('paid') Оплачено @break
                        @case('refunded') Возврат @break
                    @endswitch
                </span>
            </div>

            <div class="detail-section">
                <div class="detail-row">
                    <span class="detail-label">Тип услуги</span>
                    <span class="detail-value">
                        @switch($booking->booking_type)
                            @case('instructor') Инструктор @break
                            @case('hotel') Отель @break
                            @case('lift_pass') Ски-пасс @break
                        @endswitch
                    </span>
                </div>

                @if($booking->booking_type === 'instructor')
                    @php $instructor = \App\Models\Instructor::find($booking->item_id); @endphp
                    @if($instructor)
                    <div class="detail-row">
                        <span class="detail-label">Инструктор</span>
                        <span class="detail-value">{{ $instructor->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Специализация</span>
                        <span class="detail-value">{{ $instructor->specialization }}</span>
                    </div>
                    @endif
                @endif

                @if($booking->booking_type === 'hotel')
                    @php $room = \App\Models\HotelRoom::with('hotel')->find($booking->item_id); @endphp
                    @if($room)
                    <div class="detail-row">
                        <span class="detail-label">Отель</span>
                        <span class="detail-value">{{ $room->hotel->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Номер</span>
                        <span class="detail-value">{{ $room->room_type }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Гостей</span>
                        <span class="detail-value">{{ $booking->guests_count }} чел.</span>
                    </div>
                    @endif
                @endif

                @if($booking->booking_type === 'lift_pass')
                    @php $tariff = \App\Models\Tariff::find($booking->item_id); @endphp
                    @if($tariff)
                    <div class="detail-row">
                        <span class="detail-label">Тариф</span>
                        <span class="detail-value">{{ $tariff->name }}</span>
                    </div>
                    @endif
                @endif

                <div class="detail-row">
                    <span class="detail-label">Дата начала</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y') }}</span>
                </div>

                @if($booking->end_date)
                <div class="detail-row">
                    <span class="detail-label">Дата окончания</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->end_date)->format('d.m.Y') }}</span>
                </div>
                @endif
            </div>

            @if($booking->booking_type === 'hotel')
            <div class="info-block">
                <h4>Информация о заезде</h4>
                <ul>
                    <li>Заезд с <strong>14:00</strong></li>
                    <li>Выезд до <strong>12:00</strong></li>
                    <li>При себе необходимо иметь паспорт</li>
                    <li>Возможно раннее заселение (по наличию номеров)</li>
                    <li>Камера хранения багажа доступна</li>
                </ul>
            </div>
            @endif

            <div class="detail-section">
                <div class="detail-row">
                    <span class="detail-label">Сумма к оплате</span>
                    <span class="detail-value detail-value--large">
                        {{ number_format($booking->total_price, 0, ',', ' ') }} <span>руб</span>
                    </span>
                </div>
            </div>

            @if($booking->comment)
            <div class="comment-block">
                <div class="comment-label">Комментарий</div>
                <div class="comment-text">{{ $booking->comment }}</div>
            </div>
            @endif

            <div class="button-row">
                <a href="{{ route('bookings') }}" class="btn btn-back">К списку</a>
                
                @if($booking->status === 'pending' && $booking->payment_status === 'unpaid')
                    <a href="{{ route('bookings.payment', $booking) }}" class="btn btn-pay">Оплатить</a>
                    <form action="{{ route('bookings.cancel', $booking) }}" method="POST" style="display: inline; flex: 1;" onsubmit="return confirm('Отменить бронирование?')">
                        @csrf
                        <button type="submit" class="btn btn-cancel" style="width: 100%;">Отменить</button>
                    </form>
                @endif
            </div>
            
        </div>
        
    </div>
</div>
@endsection