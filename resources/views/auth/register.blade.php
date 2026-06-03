{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app', ['headerClass' => 'header--transparent'])
@section('content')



<div class="auth-page">
    <div class="auth-card">
        <h2 class="auth-title">Регистрация</h2>
        <p class="auth-subtitle">Создайте аккаунт для бронирования</p>
        
        @if($errors->any())
        <div class="auth-error">
            @foreach($errors->all() as $error)
            <p style="margin:0;">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="auth-row">
                <div class="auth-field">
                    <label>Имя</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Иван">
                </div>
                
                <div class="auth-field">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
                </div>
            </div>
            
            <div class="auth-field">
                <label>Телефон</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+7 (999) 123-45-67">
            </div>
            
            <div class="auth-row">
                <div class="auth-field">
                    <label>Пароль</label>
                    <input type="password" name="password" required placeholder="Минимум 8 символов">
                </div>
                
                <div class="auth-field">
                    <label>Подтверждение</label>
                    <input type="password" name="password_confirmation" required placeholder="Повторите пароль">
                </div>
            </div>
            
            <label class="auth-checkbox">
                <input type="checkbox" name="agree" required {{ old('agree') ? 'checked' : '' }}>
                <span>Принимаю <a href="#">условия соглашения</a> и <a href="#">обработку данных</a></span>
            </label>
            
            <button type="submit" class="auth-submit">Зарегистрироваться</button>
        </form>
        
        <p class="auth-footer">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </p>
    </div>
</div>
@endsection