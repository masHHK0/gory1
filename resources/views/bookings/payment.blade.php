{{-- resources/views/bookings/payment.blade.php --}}
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
    }

    .payment-page {

        min-height: 100vh;
        padding: 60px 0;
    }

    .payment-container {
        max-width: 640px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .payment-title {
        font-family: R;
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 30px;
        text-align: center;
        text-transform: uppercase;
    }

    .payment-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        border: 1px solid var(--border);
    }

    /* Заголовок заказа */
    .payment-order-header {
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border);
    }

    .payment-order-header h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .payment-order-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 14px;
    }

    .payment-order-label {
        color: #aaa;
    }

    .payment-order-value {
        font-weight: 600;
        color: var(--text);
    }

    /* Блок суммы */
    .payment-total-block {
        background: #f8f9fb;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 24px;
        text-align: center;
        border: 1px solid #eef0f2;
    }

    .payment-total-label {
        font-size: 13px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .payment-total-amount {
        font-size: 36px;
        font-weight: 700;
        color: var(--primary);
    }

    .payment-total-amount span {
        font-size: 18px;
        font-weight: 500;
        color: #aaa;
    }

    /* Блок правил */
    .payment-rules-block {
        background: #f8f9fb;
        border-radius: 14px;
        padding: 20px 24px;
        margin-bottom: 24px;
        border: 1px solid #eef0f2;
    }

    .payment-rules-block h4 {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .payment-rules-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .payment-rules-list li {
        font-size: 13px;
        color: #888;
        padding: 6px 0;
        padding-left: 20px;
        position: relative;
        line-height: 1.6;
    }

    .payment-rules-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 13px;
        width: 6px;
        height: 6px;
        background: var(--accent);
        border-radius: 50%;
    }

    /* Кнопка оплаты */
    .payment-submit-btn {
        width: 100%;
        padding: 16px 24px;
        background: var(--accent);
        color: #fff;
        border: 1px solid #FF772D;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;

    }

    .payment-submit-btn:hover {
        background: none;

        color: #FF772D;
        
    }

    /* Информация о платежной системе */
    .payment-info {
        text-align: center;
        margin-top: 16px;
        font-size: 12px;
        color: #bbb;
        line-height: 1.6;
    }

    .payment-info span {
        display: block;
    }

    /* Иконка замка */
    .payment-secure {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 12px;
        font-size: 11px;
        color: #ccc;
    }

    .payment-secure svg {
        width: 12px;
        height: 12px;
    }

    @media (max-width: 480px) {
        .payment-card {
            padding: 20px;
        }
        .payment-title {
            font-size: 26px;
        }
        .payment-total-amount {
            font-size: 28px;
        }
    }
</style>

<div class="payment-page">
    <div class="payment-container">
        
        <h1 class="payment-title">Оплата бронирования</h1>
        
        <div class="payment-card">
            
            <div class="payment-order-header">
                <h3>Детали заказа</h3>
                <div class="payment-order-row">
                    <span class="payment-order-label">Номер бронирования</span>
                    <span class="payment-order-value">#{{ $booking->id }}</span>
                </div>
                <div class="payment-order-row">
                    <span class="payment-order-label">Тип услуги</span>
                    <span class="payment-order-value">
                        @switch($booking->booking_type)
                            @case('instructor') Инструктор @break
                            @case('hotel') Отель @break
                            @case('lift_pass') Ски-пасс @break
                        @endswitch
                    </span>
                </div>
                @if($booking->start_date)
                <div class="payment-order-row">
                    <span class="payment-order-label">Дата</span>
                    <span class="payment-order-value">{{ \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y') }}</span>
                </div>
                @endif
            </div>

            <div class="payment-total-block">
                <div class="payment-total-label">Сумма к оплате</div>
                <div class="payment-total-amount">
                    {{ number_format($booking->total_price, 0, ',', ' ') }} <span>руб</span>
                </div>
            </div>

            @if($booking->booking_type === 'hotel')
            <div class="payment-rules-block">
                <h4>Правила проживания</h4>
                <ul class="payment-rules-list">
                    <li>Заезд с 14:00, выезд до 12:00</li>
                    <li>При заезде необходим паспорт</li>
                    <li>Залог за номер не требуется</li>
                    <li>Курение в номерах запрещено</li>
                    <li>Домашние животные обсуждаются отдельно</li>
                </ul>
            </div>
            @endif

            <form action="{{ route('bookings.process-payment', $booking) }}" method="POST">
                @csrf
                <button type="submit" class="payment-submit-btn">Перейти к оплате</button>
            </form>

            <div class="payment-info">
                <span>Оплата через ЮKassa</span>
                <span>Банковские карты, SberPay, Apple Pay, Google Pay</span>
            </div>

            <div class="payment-secure">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Безопасное соединение
            </div>
            
        </div>
        
    </div>
</div>
@endsection