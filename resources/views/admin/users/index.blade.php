{{-- resources/views/admin/users/index.blade.php --}}
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

    .user-email {
        color: var(--text-light);
        font-size: 13px;
    }

    .role-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .role-admin {
        background: #e74c3c;
        color: #fff;
    }

    .role-client {
        background: var(--primary);
        color: #fff;
    }

    .role-guest {
        background: #8e99a3;
        color: #fff;
    }

    .form-select-sm {
        padding: 6px 28px 6px 12px;
        border: 1px solid #eef0f2;
        border-radius: 8px;
        font-size: 12px;
        font-family: 'M', sans-serif;
        background: #fafbfc;
        color: var(--text);
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23888' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        transition: all 0.3s;
    }

    .form-select-sm:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 2px rgba(3, 83, 138, 0.06);
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

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 60px;
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .table-section {
            padding: 16px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление пользователями</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Таблица пользователей --}}

        
        <div class="table-section">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Телефон</th>
                            <th>Роль</th>
                            <th>Дата регистрации</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td><strong>#{{ $user->id }}</strong></td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td><span class="user-email">{{ $user->email }}</span></td>
                            <td>{{ $user->phone ?? '—' }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    @switch($user->role)
                                        @case('admin') Админ @break
                                        @case('client') Клиент @break
                                        @case('guest') Гость @break
                                        @default {{ $user->role }}
                                    @endswitch
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d.m.Y') }}</td>
                            <td>
                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="form-select-sm" onchange="this.form.submit()">
                                        <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Гость</option>
                                        <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Клиент</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Админ</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="7">Пользователи не найдены</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection