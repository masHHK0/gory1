{{-- resources/views/admin/bookings/index.blade.php --}}
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

    .admin-page {
        background: var(--bg);
        min-height: 100vh;
        padding: 40px 0 80px;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .admin-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary);
        font-family: R;
        text-transform: uppercase;
    }

    .admin-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-light);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 16px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }
    .admin-back:hover {
        color: var(--primary);
        border-color: var(--primary);
    }

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

    .table-section {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        text-align: left;
        padding: 14px 16px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        font-weight: 700;
        border-bottom: 2px solid var(--border);
        white-space: nowrap;
    }

    .admin-table td {
        padding: 16px;
        font-size: 14px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .admin-table tr:hover td {
        background: #fafbfc;
    }

    .booking-id {
        font-weight: 700;
        color: var(--accent);
    }

    .user-name {
        font-weight: 600;
        color: var(--text);
    }

    .user-email {
        font-size: 12px;
        color: var(--text-light);
        display: block;
        margin-top: 2px;
    }

    .booking-type {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #f8f9fb;
        color: var(--text);
    }

    .amount {
        font-weight: 700;
        color: var(--text);
        white-space: nowrap;
    }

    .status-select {
        padding: 8px 32px 8px 12px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        background: #fafbfc;
        cursor: pointer;
        font-family: 'M', sans-serif;
        transition: all 0.3s;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23888' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        min-width: 140px;
    }

    .status-select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .status-select--confirmed {
        color: var(--primary);
        border-color: var(--primary);
        background: #edf2f7;
    }

    .status-select--pending {
        color: var(--accent);
        border-color: var(--accent);
        background: #fff8f2;
    }

    .status-select--cancelled {
        color: #e74c3c;
        border-color: #e74c3c;
        background: #fdf0ef;
    }

    .status-select--completed {
        color: #8e99a3;
        border-color: #8e99a3;
        background: #f8f9fb;
    }

    .payment-status {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .payment-unpaid {
        background: #fff8f2;
        color: var(--accent);
        border: 1px solid #ffe8d6;
    }

    .payment-paid {
        background: #edf2f7;
        color: var(--primary);
        border: 1px solid #d0dce8;
    }

    .payment-refunded {
        background: #fdf0ef;
        color: #e74c3c;
        border: 1px solid #f5c6cb;
    }

    .btn-detail {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        background: #fff;
        color: var(--primary);
        border: 1px solid var(--border);
        transition: all 0.3s;
        white-space: nowrap;
    }
    .btn-detail:hover {
        background: #f8f9fb;
        border-color: var(--primary);
    }

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 60px;
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .admin-table th,
        .admin-table td {
            padding: 12px 10px;
            font-size: 12px;
        }
        .status-select {
            min-width: auto;
            font-size: 11px;
            padding: 6px 28px 6px 10px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление бронированиями</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="table-section">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Клиент</th>
                            <th>Тип</th>
                            <th>Даты</th>
                            <th>Гости</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Оплата</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>
                                <span class="booking-id">#{{ $booking->id }}</span>
                            </td>
                            <td>
                                <span class="user-name">{{ $booking->user->name }}</span>
                                <span class="user-email">{{ $booking->user->email }}</span>
                            </td>
                            <td>
                                <span class="booking-type">
                                    @switch($booking->booking_type)
                                        @case('instructor') Инструктор @break
                                        @case('hotel') Отель @break
                                        @case('lift_pass') Ски-пасс @break
                                        @default {{ $booking->booking_type }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 13px;">
                                    {{ $booking->start_date->format('d.m.Y') }}
                                    @if($booking->end_date)
                                        <br><span style="color: var(--text-light);">→ {{ $booking->end_date->format('d.m.Y') }}</span>
                                    @endif
                                </div>
                            </td>
                            <td style="text-align: center;">
                                {{ $booking->guests_count ?: '—' }}
                            </td>
                            <td>
                                <span class="amount">{{ number_format($booking->total_price, 0, ',', ' ') }} руб</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                    @csrf
                                    <select name="status" class="status-select status-select--{{ $booking->status }}" onchange="this.form.submit()">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Ожидает</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Подтверждено</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Отменено</option>
                                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                                    @csrf
                                    <select name="payment_status" class="status-select" onchange="this.form.submit()" style="min-width: 130px;">
                                        <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Не оплачено</option>
                                        <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Оплачено</option>
                                        <option value="refunded" {{ $booking->payment_status == 'refunded' ? 'selected' : '' }}>Возврат</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('bookings.show', $booking) }}" class="btn-detail">Детали</a>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="9">Нет бронирований</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection