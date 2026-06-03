{{-- resources/views/news/show.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    .article-page {
        padding: 60px 0 80px;
        background: #fff;
    }
    .article-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 400px 1fr;
        gap: 50px;
        align-items: start;
    }

    /* Назад */
    .article-back {
        grid-column: 1 / -1;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #888;
        text-decoration: none;
        margin-bottom: 10px;
        transition: 0.2s;
    }
    .article-back:hover {
        color: #03538A;
    }

    /* Обложка */
    .article-cover {
        border-radius: 16px;
        overflow: hidden;
        position: sticky;
        top: 100px;
    }
    .article-cover img {
        width: 100%;
        display: block;
        border-radius: 16px;
    }

    /* Дата */
    .article-date {
        font-size: 13px;
        font-weight: 600;
        color: #FF772D;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    /* Заголовок */
    .article-title {
        font-size: 38px;
        font-weight: 800;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 30px;
        letter-spacing: -0.3px;
    }

    /* Текст */
    .article-content {
        font-size: 17px;
        color: #444;
        line-height: 1.85;
    }
    .article-content p {
        margin-bottom: 18px;
    }

    /* Кнопка назад */
    .article-footer {
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid #eef0f2;
    }
    .article-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: 1px solid #03548a40;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #03538A;
        text-decoration: none;
        transition: all 0.2s;
    }
    .article-btn:hover {
        background: #03538A;
        color: #fff;
        border-color: #03538A;
    }

    @media (max-width: 860px) {
        .article-container {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        .article-cover {
            position: static;
            max-width: 400px;
        }
        .article-title {
            font-size: 28px;
        }
    }
</style>

<div class="article-page">
    <div class="article-container">
        
        <a href="{{ route('news') }}" class="article-back">
            ← Все новости
        </a>

        {{-- Левая колонка: фото --}}
        <div class="article-cover">
            @if($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
            @endif
        </div>

        {{-- Правая колонка: контент --}}
        <div>
            <time class="article-date">
                {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d.m.Y') : '' }}
            </time>

            <h1 class="article-title">{{ $news->title }}</h1>

            <div class="article-content">
                {!! nl2br(e($news->content)) !!}
            </div>

            <div class="article-footer">
                <a href="{{ route('news') }}" class="article-btn">← Все новости</a>
            </div>
        </div>

    </div>
</div>
@endsection