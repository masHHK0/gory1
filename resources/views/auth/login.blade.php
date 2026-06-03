{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app', ['headerClass' => 'header--transparent'])
@section('content')


<div class="auth-page">
    <div class="auth-card">
        <h2 class="auth-title">Вход</h2>
        <p class="auth-subtitle">Войдите в личный кабинет</p>
        
        @if(session('success'))
        <div class="auth-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if($errors->any())
        <div class="auth-error">
            @foreach($errors->all() as $error)
            <p style="margin:0;">{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="auth-field">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
            </div>
            
            <div class="auth-field">
                <label>Пароль</label>
                <input type="password" name="password" required placeholder="Введите пароль">
            </div>
            
            <label class="auth-checkbox">
                <input type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>
            
            <button type="submit" class="auth-submit">Войти</button>
        </form>
        
        <p class="auth-footer">
            Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
        </p>
    </div>
</div>
@endsection