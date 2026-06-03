{{-- resources/views/admin/dashboard.blade.php --}}
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
        margin-bottom: 32px;
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

    .admin-date {
        font-size: 14px;
        color: var(--text-light);
        background: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    /* Статистика */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(3, 83, 138, 0.08);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }

    .stat-card--users::before { background: var(--accent); }
    .stat-card--bookings::before { background: var(--primary); }
    .stat-card--slopes::before { background: #8e44ad; }
    .stat-card--hotels::before { background: #e67e22; }

    .stat-card__icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .stat-card--users .stat-card__icon { background: #fff8f2; color: var(--accent); }
    .stat-card--bookings .stat-card__icon { background: #edf2f7; color: var(--primary); }
    .stat-card--slopes .stat-card__icon { background: #f5f0f8; color: #8e44ad; }
    .stat-card--hotels .stat-card__icon { background: #fef5ec; color: #e67e22; }

    .stat-card__value {
        font-size: 32px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
    }

    .stat-card__label {
        font-size: 13px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Сетка управления */
    .management-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 32px;
    }

    .management-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--border);
        text-decoration: none;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .management-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(3, 83, 138, 0.08);
        border-color: var(--accent);
    }

    .management-card__icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #fff8f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--accent);
        flex-shrink: 0;
    }

    .management-card__info h4 {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
        margin: 0 0 2px;
    }

    .management-card__info span {
        font-size: 11px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Последние бронирования */
    .recent-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
    }

    .recent-section__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border);
    }

    .recent-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .recent-section__link {
        font-size: 13px;
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }
    .recent-section__link:hover {
        text-decoration: underline;
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
        padding: 12px 16px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        font-weight: 600;
        border-bottom: 2px solid var(--border);
    }

    .admin-table td {
        padding: 14px 16px;
        font-size: 14px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
    }

    .admin-table tr:hover td {
        background: #f8f9fb;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-confirmed {
        background: var(--primary);
        color: #fff;
    }

    .status-pending {
        background: var(--accent);
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

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 40px;
        font-size: 14px;
    }

    @media (max-width: 1000px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .management-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .management-grid {
            grid-template-columns: 1fr;
        }
        .admin-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .recent-section {
            padding: 20px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Панель управления</h1>
            <div class="admin-date">{{ now()->format('d.m.Y, H:i') }}</div>
        </div>


        {{-- Управление --}}
        <div class="management-grid">
            <a href="{{ route('admin.slopes') }}" class="management-card">
                <div class="management-card__icon">T</div>
                <div class="management-card__info">
                    <h4>Трассы</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.instructors') }}" class="management-card">
                <div class="management-card__icon">I</div>
                <div class="management-card__info">
                    <h4>Инструкторы</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.hotels') }}" class="management-card">
                <div class="management-card__icon">H</div>
                <div class="management-card__info">
                    <h4>Отели</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.rooms') }}" class="management-card">
                <div class="management-card__icon">R</div>
                <div class="management-card__info">
                    <h4>Номера</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.tariffs') }}" class="management-card">
                <div class="management-card__icon">P</div>
                <div class="management-card__info">
                    <h4>Тарифы</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.cameras') }}" class="management-card">
                <div class="management-card__icon">C</div>
                <div class="management-card__info">
                    <h4>Камеры</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.gallery') }}" class="management-card">
                <div class="management-card__icon">G</div>
                <div class="management-card__info">
                    <h4>Галерея</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.news') }}" class="management-card">
                <div class="management-card__icon">N</div>
                <div class="management-card__info">
                    <h4>Новости</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.bookings') }}" class="management-card">
                <div class="management-card__icon">B</div>
                <div class="management-card__info">
                    <h4>Бронирования</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.users') }}" class="management-card">
                <div class="management-card__icon">U</div>
                <div class="management-card__info">
                    <h4>Пользователи</h4>
                    <span>Управление</span>
                </div>
            </a>
            <a href="{{ route('admin.reviews') }}" class="management-card">
                <div class="management-card__icon">R</div>
                <div class="management-card__info">
                    <h4>Отзывы</h4>
                    <span>Управление</span>
                </div>
            </a>
        </div>

        {{-- Последние бронирования --}}
        <div class="recent-section">
            <div class="recent-section__header">
                <h2 class="recent-section__title">Последние бронирования</h2>
                <a href="{{ route('admin.bookings') }}" class="recent-section__link">Все бронирования</a>
            </div>
            
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Клиент</th>
                            <th>Тип</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td><strong>#{{ $booking->id }}</strong></td>
                                <td>{{ $booking->user->name }}</td>
                                <td>
                                    @switch($booking->booking_type)
                                        @case('instructor') Инструктор @break
                                        @case('hotel') Отель @break
                                        @case('lift_pass') Ски-пасс @break
                                        @default {{ $booking->booking_type }}
                                    @endswitch
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d.m.Y') }}</td>
                                <td><strong>{{ number_format($booking->total_price, 0, ',', ' ') }} руб</strong></td>
                                <td>
                                    <span class="status-badge status-{{ $booking->status }}">
                                        @switch($booking->status)
                                            @case('confirmed') Подтверждено @break
                                            @case('pending') Ожидает @break
                                            @case('cancelled') Отменено @break
                                            @case('completed') Завершено @break
                                            @default {{ $booking->status }}
                                        @endswitch
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="6">Нет бронирований</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection