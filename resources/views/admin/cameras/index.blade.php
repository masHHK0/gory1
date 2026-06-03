{{-- resources/views/admin/cameras/index.blade.php --}}
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

    /* Форма добавления */
    .form-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
        margin-bottom: 24px;
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
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-input::placeholder {
        color: #ccc;
    }

    /* Таблица */
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
        padding: 14px 16px;
        font-size: 14px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .admin-table tr:hover td {
        background: #fafbfc;
    }

    .camera-name {
        font-weight: 600;
        color: var(--text);
    }

    .camera-url {
        font-size: 12px;
        color: var(--text-light);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
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

    .status-active {
        background: var(--primary);
        color: #fff;
    }

    .status-inactive {
        background: #e74c3c;
        color: #fff;
    }

    .sort-order {
        display: inline-block;
        padding: 4px 10px;
        background: #f8f9fb;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-light);
    }

    /* Кнопки */
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-primary {
        background: var(--accent);
        color: #fff;
        box-shadow: 0 4px 15px rgba(255, 119, 45, 0.2);
    }
    .btn-primary:hover {
        background: #e6681f;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 119, 45, 0.3);
    }

    .btn-danger {
        background: #fff;
        color: #e74c3c;
        border: 1px solid #f5c6cb;
    }
    .btn-danger:hover {
        background: #fdf0ef;
        border-color: #e74c3c;
    }

    .btn-sm {
        padding: 6px 14px;
        font-size: 11px;
        border-radius: 8px;
    }

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 60px;
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-section {
            padding: 20px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление камерами</h1>
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
                <h3 class="form-section__title">Добавить камеру</h3>
            </div>
            <form action="{{ route('admin.cameras.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input type="text" name="name" class="form-input" placeholder="Веб-камера склона" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Местоположение</label>
                        <input type="text" name="location" class="form-input" placeholder="Северный склон" required>
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-label">URL потока</label>
                        <input type="url" name="stream_url" class="form-input" placeholder="https://..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Порядок сортировки</label>
                        <input type="number" name="sort_order" class="form-input" value="0" min="0">
                    </div>
                    <div class="form-group" style="justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary" style="margin-top: auto;">Добавить камеру</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Таблица камер --}}
        <div class="table-section">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Местоположение</th>
                            <th>URL потока</th>
                            <th>Порядок</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cameras as $camera)
                        <tr>
                            <td><strong>#{{ $camera->id }}</strong></td>
                            <td>
                                <span class="camera-name">{{ $camera->name }}</span>
                            </td>
                            <td>{{ $camera->location }}</td>
                            <td>
                                <span class="camera-url" title="{{ $camera->stream_url }}">{{ $camera->stream_url }}</span>
                            </td>
                            <td>
                                <span class="sort-order">{{ $camera->sort_order }}</span>
                            </td>
                            <td>
                                <span class="status-badge {{ $camera->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $camera->is_active ? 'Активна' : 'Неактивна' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.cameras.delete', $camera) }}" method="POST" onsubmit="return confirm('Удалить камеру?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="7">Нет добавленных камер</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection