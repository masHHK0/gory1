{{-- resources/views/search.blade.php --}}
@extends('layouts.app')

@section('content')
<section style="padding: 60px 0;">
    <div class="tabs__container">
        <h1 style="font-size: 36px; color: var(--primary); margin-bottom: 30px;">Результаты поиска: "{{ $query }}"</h1>
        
        @if($slopes->isEmpty() && $hotels->isEmpty() && $instructors->isEmpty())
        <p style="text-align: center; font-size: 18px; color: #666; padding: 60px 0;">Ничего не найдено</p>
        @endif
        
        @if($slopes->isNotEmpty())
        <h2 style="color: var(--primary); margin-bottom: 20px;">Трассы</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
            @foreach($slopes as $slope)
            <div class="card">
                <div class="card__body">
                    <h3>{{ $slope->name }}</h3>
                    <p>Длина: {{ $slope->length }} м | Перепад: {{ $slope->elevation }} м</p>
                    <span class="badge {{ $slope->status == 'open' ? 'badge--success' : 'badge--danger' }}">
                        {{ $slope->status == 'open' ? 'Открыта' : 'Закрыта' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        @if($hotels->isNotEmpty())
        <h2 style="color: var(--primary); margin-bottom: 20px;">Отели</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
            @foreach($hotels as $hotel)
            <div class="card">
                <div class="card__body">
                    <h3>{{ $hotel->name }}</h3>
                    <p>⭐ × {{ $hotel->stars }} | {{ $hotel->address }}</p>
                    <a href="{{ route('hotels.show', $hotel) }}">Подробнее →</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        @if($instructors->isNotEmpty())
        <h2 style="color: var(--primary); margin-bottom: 20px;">Инструкторы</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            @foreach($instructors as $instructor)
            <div class="card">
                <div class="card__body">
                    <h3>{{ $instructor->name }}</h3>
                    <p>{{ $instructor->specialization }} | Опыт: {{ $instructor->experience_years }} лет</p>
                    <p>Цена: {{ number_format($instructor->price_per_hour, 0, ',', ' ') }} ₽/час</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection