{{-- resources/views/tariffs/index.blade.php --}}
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

    .tariffs-page {
        min-height: 100vh;
        padding: 60px 0 80px;
    }

    .tariffs-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .hero-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .hero-title {
        font-size: 48px;
        font-weight: 800;
        color: var(--primary);
        text-transform: uppercase;
        margin-bottom: 16px;
        letter-spacing: 2px;
    }

    .hero-subtitle {
        font-size: 18px;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
    }

    .info-banner {
        background: #fff;
        border-radius: 16px;
        padding: 20px 30px;
        margin-bottom: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-icon {
        width: 44px;
        height: 44px;
        background: #fff8f2;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .info-text {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 11px;
        text-transform: uppercase;
        color: var(--text-light);
        letter-spacing: 1px;
    }

    .info-value {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
    }

    .tariffs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .tariff-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid var(--border);
        position: relative;
    }

    .tariff-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(3, 83, 138, 0.12);
    }

    .tariff-card.popular {
        border: 2px solid var(--accent);
        transform: scale(1.02);
    }

    .tariff-card.popular:hover {
        transform: scale(1.02) translateY(-8px);
    }

    .popular-badge {
        position: absolute;
        top: 7px;
        right: 16px;
        background: var(--accent);
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tariff-header {
        padding: 35px 24px 20px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }

    .tariff-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .tariff-type {
        font-size: 13px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .tariff-body {
        padding: 24px;
        text-align: center;
    }

    .tariff-price {
        margin-bottom: 20px;
    }

    .price-value {
        font-size: 44px;
        font-weight: 800;
        color: var(--accent);
    }

    .price-currency {
        font-size: 18px;
        font-weight: 600;
        color: var(--accent);
    }

    .price-period {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 4px;
    }

    .tariff-description {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .tariff-features {
        list-style: none;
        padding: 0;
        margin: 0 0 24px 0;
        text-align: left;
    }

    .tariff-features li {
        font-size: 13px;
        color: var(--text-light);
        padding: 6px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .tariff-features li::before {
        content: "✓";
        color: var(--accent);
        font-weight: 700;
    }

    .tariff-date {
        font-size: 11px;
        color: #bbb;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }

    .tariff-footer {
        padding: 0 24px 28px;
    }

    .btn-buy {
        display: block;
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
        background: var(--accent);
        color: #fff;
        border: 2px solid var(--accent);
    }

    .btn-buy:hover {
        background: #fff;
        color: var(--accent);
    }

    .info-footer {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        text-align: center;
        border: 1px solid var(--border);
    }

    .info-footer h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 12px;
    }

    .info-footer p {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 20px;
    }

    .contact-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }
    .contact-link:hover {
        text-decoration: underline;
    }

    .empty-state {
        text-align: center;
        padding: 60px;
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        color: var(--text-light);
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 32px; }
        .hero-subtitle { font-size: 16px; }
        .info-banner { flex-direction: column; align-items: flex-start; }
        .tariffs-grid { grid-template-columns: 1fr; }
        .tariff-card.popular { transform: scale(1); }
        .tariff-card.popular:hover { transform: translateY(-8px); }
    }
</style>

<div class="tariffs-page">
    <div class="tariffs-container">
        
        <div class="hero-section">
            <h1 class="hero-title">Тарифы на подъемники</h1>
            <p class="hero-subtitle">Выберите удобный тариф для катания на наших трассах</p>
        </div>

        <div class="info-banner">
            <div class="info-item">
                <div class="info-text">
                    <span class="info-label">Работа подъемников</span>
                    <span class="info-value">Ежедневно 09:00 - 21:00</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-text">
                    <span class="info-label">Прокат снаряжения</span>
                    <span class="info-value">Включен в сезонный тариф</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-text">
                    <span class="info-label">Детский билет</span>
                    <span class="info-value">Скидка на снаряжение</span>
                </div>
            </div>
        </div>

        @if($tariffs->count() > 0)
        <div class="tariffs-grid">
            @foreach($tariffs as $index => $tariff)
            @php
                $isPopular = ($tariff->type == 'day' || $tariff->type == 'week');
                $features = [
                    'hour' => ['Безлимитный подъем', 'Страховка включена', 'Подходит для туристов'],
                    'day' => ['Безлимитный подъем', 'Страховка включена', 'Скидка в кафе 10%'],
                    'week' => ['Безлимитный подъем', 'Страховка включена', 'Скидка в кафе 15%', 'Один день проката'],
                    'season' => ['Безлимитный подъем', 'Страховка включена', 'Скидка в кафе 20%', 'Прокат на весь сезон', 'Приоритетная очередь'],
                ];
                $currentFeatures = $features[$tariff->type] ?? $features['day'];
                $typeNames = ['hour' => 'Почасовой', 'day' => 'Дневной', 'week' => 'Недельный', 'season' => 'Сезонный'];
            @endphp
            
            <div class="tariff-card {{ $isPopular ? 'popular' : '' }}">
                @if($isPopular)
                <div class="popular-badge">Популярный</div>
                @endif
                
                <div class="tariff-header">
                    <h3 class="tariff-name">{{ $tariff->name }}</h3>
                    <div class="tariff-type">{{ $typeNames[$tariff->type] ?? $tariff->type }}</div>
                </div>
                
                <div class="tariff-body">
                    <div class="tariff-price">
                        <span class="price-value">{{ number_format($tariff->price, 0, ',', ' ') }}</span>
                        <span class="price-currency">₽</span>
                        <div class="price-period">
                            @switch($tariff->type)
                                @case('hour') за час @break
                                @case('day') за день @break
                                @case('week') за неделю @break
                                @case('season') за сезон @break
                            @endswitch
                        </div>
                    </div>
                    
                    @if($tariff->description)
                    <div class="tariff-description">{{ $tariff->description }}</div>
                    @endif
                    
                    <ul class="tariff-features">
                        @foreach($currentFeatures as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    
                    <div class="tariff-date">
                        Действует с {{ \Carbon\Carbon::parse($tariff->valid_from)->format('d.m.Y') }}
                        @if($tariff->valid_to)
                        по {{ \Carbon\Carbon::parse($tariff->valid_to)->format('d.m.Y') }}
                        @endif
                    </div>
                </div>
                
                <div class="tariff-footer">
                    @auth
                    <a href="{{ route('bookings.create', ['type' => 'lift_pass', 'item_id' => $tariff->id]) }}" 
                       class="btn-buy">Выбрать тариф</a>
                    @else
                    <a href="{{ route('login') }}" class="btn-buy">Войти для покупки</a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="info-footer">
            <h3>Остались вопросы?</h3>
            <p>Свяжитесь с нами для консультации по тарифам и условиям использования</p>
            <a href="#contact" class="contact-link">Напишите нам</a>
        </div>
        
        @else
        <div class="empty-state">
            <h3>Тарифы временно недоступны</h3>
            <p>Пожалуйста, зайдите позже</p>
        </div>
        @endif
        
    </div>
</div>
@endsection