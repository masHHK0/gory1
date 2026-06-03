{{-- resources/views/slopes.blade.php --}}
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

    .slopes-page {
        background: var(--bg);
        min-height: 100vh;
        padding: 60px 0;
    }

    .slopes-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .page-title {
        font-size: 42px;
        font-weight: 700;
        color: var(--primary);
        font-family: R;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 40px;
    }

    /* Фильтры */
    .filters-section {
        margin-bottom: 40px;
    }

    .filters-group {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 24px;
        border-radius: 40px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        background: #fff;
        border: 2px solid var(--border);
        color: var(--text);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(3, 83, 138, 0.1);
    }

    .filter-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .filter-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .dot-green { background: #27ae60; }
    .dot-blue { background: #2980b9; }
    .dot-red { background: #e74c3c; }
    .dot-black { background: #2c3e50; }

    /* Сетка трасс */
    .slopes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    /* Карточка */
    .slope-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }

    .slope-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(3, 83, 138, 0.08);
    }

    .slope-card__header {
        padding: 20px 20px 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .slope-card__title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .slope-card__body {
        padding: 20px;
    }

    .slope-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .stat-item {
        background: #f8f9fb;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
    }

    .stat-label {
        font-size: 10px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
    }

    .slope-description {
        font-size: 13px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .slope-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }

    .difficulty-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .difficulty-beginner { color: #27ae60; }
    .difficulty-intermediate { color: #2980b9; }
    .difficulty-advanced { color: #e74c3c; }
    .difficulty-expert { color: #2c3e50; }

    .difficulty-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .difficulty-dot-green { background: #27ae60; }
    .difficulty-dot-blue { background: #2980b9; }
    .difficulty-dot-red { background: #e74c3c; }
    .difficulty-dot-black { background: #2c3e50; }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-open {
        background: var(--primary);
        color: #fff;
    }

    .status-closed {
        background: #e74c3c;
        color: #fff;
    }

    .status-maintenance {
        background: #f39c12;
        color: #fff;
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
        .page-title { font-size: 32px; }
        .slopes-grid { grid-template-columns: 1fr; }
        .filters-group { gap: 8px; }
        .filter-btn { padding: 6px 16px; font-size: 12px; }
    }
</style>

<div class="slopes-page">
    <div class="slopes-container">
        
        <h1 class="page-title">Трассы курорта</h1>
        
        {{-- Фильтр по сложности --}}
        <div class="filters-section">
            <div class="filters-group">
                <a href="{{ route('slopes') }}" class="filter-btn {{ !request('difficulty') ? 'active' : '' }}">Все трассы</a>
                <a href="{{ route('slopes', ['difficulty' => 'beginner']) }}" class="filter-btn {{ request('difficulty') == 'beginner' ? 'active' : '' }}">
                    <span class="filter-dot dot-green"></span> Начинающие
                </a>
                <a href="{{ route('slopes', ['difficulty' => 'intermediate']) }}" class="filter-btn {{ request('difficulty') == 'intermediate' ? 'active' : '' }}">
                    <span class="filter-dot dot-blue"></span> Средние
                </a>
                <a href="{{ route('slopes', ['difficulty' => 'advanced']) }}" class="filter-btn {{ request('difficulty') == 'advanced' ? 'active' : '' }}">
                    <span class="filter-dot dot-red"></span> Продвинутые
                </a>
                <a href="{{ route('slopes', ['difficulty' => 'expert']) }}" class="filter-btn {{ request('difficulty') == 'expert' ? 'active' : '' }}">
                    <span class="filter-dot dot-black"></span> Экспертные
                </a>
            </div>
        </div>
        
        {{-- Список трасс --}}
        @if($slopes->count() > 0)
        <div class="slopes-grid">
            @foreach($slopes as $slope)
            <div class="slope-card">
                <div class="slope-card__header">
                    <h3 class="slope-card__title">{{ $slope->name }}</h3>
                    <span class="status-badge status-{{ $slope->status }}">
                        @switch($slope->status)
                            @case('open') Открыта @break
                            @case('closed') Закрыта @break
                            @case('maintenance') Обслуживание @break
                        @endswitch
                    </span>
                </div>
                
                <div class="slope-card__body">
                    <div class="slope-stats">
                        <div class="stat-item">
                            <div class="stat-label">Длина</div>
                            <div class="stat-value">{{ number_format($slope->length, 0, '', ' ') }} м</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Перепад высот</div>
                            <div class="stat-value">{{ number_format($slope->elevation, 0, '', ' ') }} м</div>
                        </div>
                    </div>
                    
                    <p class="slope-description">
                        {{ $slope->description ?: 'Описание отсутствует' }}
                    </p>
                    
                    <div class="slope-footer">
                        <span class="difficulty-badge difficulty-{{ $slope->difficulty }}">
                            @switch($slope->difficulty)
                                @case('beginner')
                                    <span class="difficulty-dot difficulty-dot-green"></span>
                                    Начинающий
                                    @break
                                @case('intermediate')
                                    <span class="difficulty-dot difficulty-dot-blue"></span>
                                    Средний
                                    @break
                                @case('advanced')
                                    <span class="difficulty-dot difficulty-dot-red"></span>
                                    Продвинутый
                                    @break
                                @case('expert')
                                    <span class="difficulty-dot difficulty-dot-black"></span>
                                    Эксперт
                                    @break
                            @endswitch
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            Трассы не найдены
        </div>
        @endif
        
    </div>
</div>
@endsection