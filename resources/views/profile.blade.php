{{-- resources/views/profile.blade.php --}}
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

    .profile-page {

        min-height: 100vh;
        padding: 40px 0 80px;
    }

    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 30px;
    }

    .profile-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .profile-avatar-block {
        background: #fff;
        border-radius: 20px;
        padding: 30px 24px;
        text-align: center;
        border: 1px solid var(--border);
        margin-bottom: 16px;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #FF772D;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
    }

    .profile-name {
        font-size: 18px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
    }

    .profile-email {
        font-size: 13px;
        color: var(--text-light);
    }

    .profile-menu {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .profile-menu__link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        color: var(--text-light);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }

    .profile-menu__link:hover {
        background: #f8f9fb;
        color: var(--primary);
    }

    .profile-menu__link.active {
        background: #fff8f2;
        color: var(--accent);
        border-left-color: var(--accent);
        font-weight: 600;
    }

    .profile-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .profile-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
    }

    .profile-section__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border);
    }

    .profile-section__title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .profile-section__subtitle {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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
        padding: 14px 16px;
        border: 1px solid #eef0f2;
        border-radius: 12px;
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

    .form-input:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .form-hint {
        font-size: 11px;
        color: #bbb;
        margin-top: 2px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 8px;
    }

    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        font-family: 'M', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .btn-primary {
        background: #FF772D;
        color: #fff;
        border-radius: 18px;
        border: 1px solid #FF772D;
    }
    .btn-primary:hover {
        background: none;
       color: #FF772D;
    }

    .btn-outline {
        background: #fff;
        color: var(--text-light);
        border: 2px solid #eef0f2;
    }
    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .password-section {
        background: #fff8f2;
        border: 1px solid #ffe8d6;
        border-radius: 16px;
        padding: 20px 24px;
        margin-top: 8px;
    }

    .password-section__title {
        font-size: 14px;
        font-weight: 700;
        color: var(--accent);
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
    .alert-error {
        background: #fdf0ef;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
        .profile-sidebar {
            position: static;
        }
        .profile-menu {
            display: flex;
            overflow-x: auto;
        }
        .profile-menu__link {
            white-space: nowrap;
            border-left: none;
            border-bottom: 3px solid transparent;
        }
        .profile-menu__link.active {
            border-left: none;
            border-bottom-color: var(--accent);
        }
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-actions {
            flex-direction: column;
        }
        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="profile-page">
    <div class="profile-container">
        
        <aside class="profile-sidebar">
            <div class="profile-avatar-block">
                <div class="profile-avatar">
                    {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-email">{{ Auth::user()->email }}</div>
            </div>
            
            <nav class="profile-menu">
                <a href="{{ route('profile') }}" class="profile-menu__link active">
                    Профиль
                </a>
                <a href="{{ route('bookings') }}" class="profile-menu__link">
                    Мои бронирования
                </a>
            </nav>
        </aside>
        
        <div class="profile-content">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            @endif

            {{-- Форма профиля и пароля в одном --}}
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- Личные данные --}}
                <div class="profile-section">
                    <div class="profile-section__header">
                        <div>
                            <h2 class="profile-section__title">Личные данные</h2>
                            <p class="profile-section__subtitle">Обновите вашу контактную информацию</p>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Имя</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-input" placeholder="Введите имя" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-input" placeholder="Введите email" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Телефон</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="form-input" placeholder="+7 999 123-45-67">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Дата регистрации</label>
                            <input type="text" value="{{ Auth::user()->created_at->format('d.m.Y') }}" class="form-input" disabled>
                        </div>
                    </div>
                </div>

                {{-- Смена пароля --}}
                <div class="profile-section" style="margin-top: 24px;">
                    <div class="profile-section__header">
                        <div>
                            <h2 class="profile-section__title">Безопасность</h2>
                            <p class="profile-section__subtitle">Оставьте поля пустыми, если не хотите менять пароль</p>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Новый пароль</label>
                            <input type="password" name="password" class="form-input" placeholder="Минимум 8 символов">
                            <span class="form-hint">Оставьте пустым, если не хотите менять</span>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Подтверждение пароля</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Повторите пароль">
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="margin-top: 24px;">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <button type="reset" class="btn btn-outline">Отмена</button>
                </div>
            </form>
            
        </div>
        
    </div>
</div>
@endsection