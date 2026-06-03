{{-- resources/views/admin/tariffs/index.blade.php --}}
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
        max-width: 1100px;
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

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        font-family: R;
        text-transform: uppercase;
    }

    /* Форма добавления */
    .form-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
        margin-bottom: 32px;
    }

    .form-section__header {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border);
    }

    .form-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-grid-4 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group--full {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 12px;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-input {
        padding: 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        transition: all 0.3s;
        background: #fafbfc;
        color: var(--text);
        height: 46px;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-textarea {
        padding: 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        transition: all 0.3s;
        background: #fafbfc;
        color: var(--text);
        resize: vertical;
        min-height: 80px;
    }

    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-select {
        padding: 12px 36px 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        background: #fafbfc;
        color: var(--text);
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23888' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        transition: all 0.3s;
        height: 46px;
        box-sizing: border-box;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    /* Кнопки */
    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        height: 46px;
        box-sizing: border-box;
    }

    .btn-primary {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
    }
    .btn-primary:hover {
        background: #fff;
        color: var(--accent);
        border-color: var(--accent);
    }

    .btn-danger {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
    }
    .btn-danger:hover {
        background: #fff;
        color: var(--accent);
        border-color: var(--accent);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 11px;
        height: 38px;
        border-radius: 8px;
    }

    /* Таблица */
    .table-section {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border);
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        text-align: left;
        padding: 14px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        font-weight: 700;
        border-bottom: 2px solid var(--border);
    }

    .admin-table td {
        padding: 12px;
        font-size: 13px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .admin-table tr:hover td {
        background: #fafbfc;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-active {
        background: var(--primary);
        color: #fff;
    }

    .status-inactive {
        background: #e74c3c;
        color: #fff;
    }

    .type-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        background: #f8f9fb;
        color: var(--text-light);
    }

    .price-value {
        font-weight: 700;
        color: var(--accent);
        font-size: 15px;
    }

    .date-range {
        font-size: 12px;
        color: var(--text-light);
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 60px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        color: var(--text-light);
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .form-grid-4 {
            grid-template-columns: 1fr 1fr;
        }
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-section {
            padding: 20px;
        }
        .admin-table {
            display: block;
            overflow-x: auto;
        }
        .date-range {
            white-space: normal;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление тарифами</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        {{-- Форма добавления --}}
        <div class="form-section">
            <div class="form-section__header">
                <h3 class="form-section__title">Добавить тариф</h3>
            </div>
            <form action="{{ route('admin.tariffs.store') }}" method="POST">
                @csrf
                <div class="form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input type="text" name="name" class="form-input" required placeholder="Название тарифа">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Тип</label>
                        <select name="type" class="form-select" required>
                            <option value="hour">Почасовая оплата</option>
                            <option value="day">Дневной</option>
                            <option value="week">Недельный</option>
                            <option value="season">Сезонный</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Цена (руб)</label>
                        <input type="number" name="price" class="form-input" required placeholder="1000">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Действует с</label>
                        <input type="date" name="valid_from" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Действует до</label>
                        <input type="date" name="valid_to" class="form-input">
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-label">Описание</label>
                        <textarea name="description" class="form-textarea" rows="2" placeholder="Описание тарифа..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Добавить тариф</button>
            </form>
        </div>

        {{-- Список тарифов --}}
        <h2 class="section-title">Все тарифы</h2>
        
        @if($tariffs->count() > 0)
        <div class="table-section">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Цена (руб)</th>
                        <th>Период действия</th>
                        <th>Активен</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tariffs as $tariff)
                    <tr>
                        <td>#{{ $tariff->id }}</td>
                        <td><strong>{{ $tariff->name }}</strong></td>
                        <td>
                            <span class="type-badge">
                                @switch($tariff->type)
                                    @case('hour') Почасовая @break
                                    @case('day') Дневной @break
                                    @case('week') Недельный @break
                                    @case('season') Сезонный @break
                                @endswitch
                            </span>
                         </td>
                        <td>
                            <span class="price-value">{{ number_format($tariff->price, 0, ',', ' ') }} руб</span>
                         </td>
                        <td>
                            <span class="date-range">
                                {{ \Carbon\Carbon::parse($tariff->valid_from)->format('d.m.Y') }}
                                -
                                {{ $tariff->valid_to ? \Carbon\Carbon::parse($tariff->valid_to)->format('d.m.Y') : 'бессрочно' }}
                            </span>
                         </td>
                        <td>
                            <span class="status-badge {{ $tariff->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $tariff->is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                         </td>
                        <td>
                            <form action="{{ route('admin.tariffs.delete', $tariff) }}" method="POST" onsubmit="return confirm('Удалить тариф «{{ $tariff->name }}»?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                         </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            Тарифы ещё не добавлены
        </div>
        @endif
    </div>
</div>
@endsection