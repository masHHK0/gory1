{{-- resources/views/hotels/show.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    :root {
        --hotel-primary: #03538A;
        --hotel-secondary: #FF772D;
        --hotel-text: #1a1a1a;
        --hotel-text-light: #888;
        --hotel-border: #03548a1d;
        --hotel-bg: #f8f9fb;
    }

    .hotel-page {
        background: #f8f9fb;
        min-height: 100vh;
    }

    .hotel-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px 80px;
    }

    /* Хлебные крошки */
    .hotel-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #888;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 24px;
        transition: all 0.3s;
        padding: 8px 16px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #03548a1d;
    }
    .hotel-back:hover { 
        color: #03538A; 
        border-color: #03538A;
        transform: translateX(-3px);
    }

    /* Звезды над фото */
    .hotel-stars-top { 
        color: #FF772D; 
        font-size: 25px; 
        letter-spacing: 4px; 
        margin-bottom: 16px;
        text-align: left;
    }

    /* Галерея */
    .hotel-gallery {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 260px 260px;
        gap: 10px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .hotel-gallery__item {
        background: #e8ecf1;
        cursor: pointer;
        overflow: hidden;
        position: relative;
        border-radius: 12px;
    }
    .hotel-gallery__item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hotel-gallery__item:hover img { 
        transform: scale(1.06); 
    }
    .hotel-gallery__item:first-child { 
        grid-row: span 2; 
        border-radius: 14px;
    }
    .hotel-gallery__more {
        position: absolute;
        bottom: 14px;
        right: 14px;
        background: rgba(3, 83, 138, 0.9);
        backdrop-filter: blur(8px);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
    .hotel-gallery__placeholder {
        width: 100%;
        height: 520px;
        background: linear-gradient(135deg, #e8ecf1, #d5dbe3);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        font-size: 64px;
        margin-bottom: 24px;
    }

    /* Заголовок после фото */
    .hotel-header {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 24px;
        border: 1px solid #03548a1d;
    }
    .hotel-name { 
        font-size: 36px; 
        font-weight: 700; 
        color: #03538A;
        margin: 0 0 12px 0; 
    }
    .hotel-meta { 
        display: flex; 
        gap: 16px; 
        flex-wrap: wrap; 
        font-size: 14px; 
        color: #888; 
    }
    .hotel-meta span {
        background: #f8f9fb;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 13px;
    }

    /* Сетка страницы */
    .hotel-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 30px;
    }

    /* Секции */
    .hotel-section { 
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 24px;
        border: 1px solid #03548a1d;
    }
    .hotel-section h2 { 
        font-size: 22px; 
        font-weight: 700; 
        color: #03538A;
        text-transform: uppercase;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #03548a1d;
    }
    .hotel-section p { 
        font-size: 14px; 
        line-height: 1.8; 
        color: #666; 
    }

    /* Удобства */
    .amenities-list { 
        display: flex; 
        flex-wrap: wrap; 
        gap: 8px; 
        margin-top: 16px;
    }
    .amenity-tag {
        padding: 8px 16px;
        background: #f8f9fb;
        border: 1px solid #eef0f2;
        border-radius: 20px;
        font-size: 13px;
        color: #555;
        transition: all 0.3s;
    }
    .amenity-tag:hover {
        border-color: #FF772D;
        color: #FF772D;
    }

    /* Номера */
    .room-card {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        margin-bottom: 16px;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .room-card:hover { 
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(3, 83, 138, 0.08);
        border-color: #03548a30;
    }
    .room-card__img {
        width: 280px;
        flex-shrink: 0;
        background: #e8ecf1;
        position: relative;
        overflow: hidden;
    }
    .room-card__img img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover;
        transition: transform 0.5s;
    }
    .room-card:hover .room-card__img img {
        transform: scale(1.05);
    }
    .room-card__body { 
        padding: 24px; 
        flex: 1; 
        display: flex; 
        flex-direction: column; 
        justify-content: space-between; 
    }
    .room-card__title { 
        font-size: 20px; 
        font-weight: 700; 
        color: #03538A;
        margin-bottom: 8px; 
    }
    .room-card__specs { 
        display: flex; 
        gap: 12px; 
        font-size: 13px; 
        color: #888; 
        flex-wrap: wrap; 
        margin: 8px 0; 
    }
    .room-card__specs span {
        background: #f8f9fb;
        padding: 5px 12px;
        border-radius: 15px;
    }
    .room-card__amenities { 
        font-size: 13px; 
        color: #aaa; 
        margin: 8px 0; 
        line-height: 1.6;
    }
    .room-card__bottom { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }
    .room-card__price { 
        font-size: 24px; 
        font-weight: 700; 
        color: #03538A;
    }
    .room-card__price span { 
        font-size: 13px; 
        color: #aaa; 
        font-weight: 400; 
    }
    .room-card__btn {
        padding: 12px 28px;
        background: #FF772D;
        color: #fff;
        border: 1px solid #FF772D;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.5s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .room-card__btn:hover { 
       background: none;
        color:#FF772D ;
    }
    .room-card__btn--login {
        background: #aaa;
    }
    .room-card__btn--login:hover {
        background: #999;
    }

    /* Сайдбар */
    .hotel-sidebar-card {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 20px;
        padding: 28px;
        position: sticky;
        top: 100px;
    }
    .hotel-sidebar-card h3 { 
        font-size: 18px; 
        font-weight: 700; 
        color: #03538A;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid #03548a1d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .hotel-sidebar-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        font-size: 14px;
        color: #666;
        border-bottom: 1px solid #f8f9fb;
    }
    .hotel-sidebar-row:last-of-type {
        border-bottom: none;
    }
    .hotel-sidebar-row span:first-child {
        color: #aaa;
        font-size: 13px;
    }
    .hotel-sidebar-row span:last-child {
        font-weight: 600;
        color: #03538A;
    }
    .hotel-sidebar-row--total {
        border-top: 2px solid #03548a1d;
        margin-top: 12px;
        padding-top: 16px;
        font-size: 18px;
    }
    .hotel-sidebar-row--total span:last-child {
        color: #FF772D;
        font-size: 22px;
    }
    .hotel-sidebar-guarantee {
        margin-top: 20px;
        padding: 16px;
        background: #f8f9fb;
        border-radius: 12px;
        font-size: 12px;
        color: #888;
        line-height: 1.8;
        border: 1px solid #eef0f2;
    }

    /* Отзывы */
    .review-card {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 12px;
        transition: all 0.3s;
    }
    .review-card:hover {
        border-color: #03548a30;
    }
    .review-card__top { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 10px; 
    }
    .review-card__name { 
        font-weight: 700; 
        color: #03538A;
        font-size: 15px;
    }
    .review-card__stars { 
        color: #FF772D; 
        font-size: 14px;
    }
    .review-card__text { 
        font-size: 14px; 
        color: #666; 
        line-height: 1.7; 
    }
    .review-card__date { 
        font-size: 12px; 
        color: #ccc; 
        margin-top: 8px; 
    }

    .review-form {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .review-form h3 { 
        font-weight: 700; 
        color: #03538A;
        margin-bottom: 16px;
        font-size: 18px;
    }
    .review-stars { 
        font-size: 32px; 
        cursor: pointer; 
        user-select: none; 
        display: flex;
        gap: 4px;
    }
    .review-stars .star { 
        color: #ddd; 
        transition: all 0.2s; 
    }
    .review-stars .star.filled { 
        color: #FF772D; 
    }
    .review-stars .star:hover {
        transform: scale(1.2);
    }
    .review-form textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        margin-top: 12px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        resize: vertical;
        transition: all 0.3s;
        color: #555;
    }
    .review-form textarea:focus {
        outline: none;
        border-color: #03538A;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.05);
    }
    .review-form button {
        margin-top: 12px;
        padding: 12px 28px;
        background: #FF772D;
        color: #fff;
        border: 1px solid #FF772D;
        border-radius: 16px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.5s;
        font-family: 'M', sans-serif;
    }
    .review-form button:hover {
        background: none;
        color:#FF772D ;
    }
    .review-login-hint {
        color: #aaa;
        font-size: 14px;
    }
    .review-login-hint a {
        color: #03538A;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }
    .review-login-hint a:hover {
        color: #FF772D;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 12px;
        font-size: 13px;
    }
    .alert-error {
        background: #fdf0ef;
        color: #c0392b;
        border: 1px solid #f5c6cb;
    }
    .alert-success {
        background: #edf7ed;
        color: #27ae60;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 900px) {
        .hotel-layout { 
            grid-template-columns: 1fr; 
        }
        .hotel-gallery { 
            grid-template-columns: 1fr 1fr; 
            grid-template-rows: 200px 200px; 
        }
        .hotel-gallery__item:first-child { 
            grid-row: span 1; 
            grid-column: span 2; 
        }
        .room-card { 
            flex-direction: column; 
        }
        .room-card__img { 
            width: 100%; 
            height: 220px; 
        }
        .hotel-name { 
            font-size: 28px; 
        }
    }
    @media (max-width: 500px) {
        .hotel-gallery { 
            grid-template-columns: 1fr; 
            grid-template-rows: auto; 
        }
        .hotel-gallery__item:first-child { 
            grid-column: span 1; 
        }
        .hotel-name { 
            font-size: 24px; 
        }
        .room-card__bottom {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
    }
</style>

<div class="hotel-page">
    <div class="hotel-container">

        <a href="{{ route('hotels') }}" class="hotel-back">← Все отели</a>

        {{-- Звезды --}}
        <div class="hotel-stars-top">@for($i=0;$i<$hotel->stars;$i++)★@endfor</div>

        {{-- Галерея --}}
        @php
            $imgs = [];
            if($hotel->images) $imgs = explode(',', $hotel->images);
            elseif($hotel->main_image) $imgs = [$hotel->main_image];
            $showImgs = array_slice($imgs, 0, 5);
            $moreCount = count($imgs) - count($showImgs);
        @endphp
        @if(!empty($showImgs))
        <div class="hotel-gallery">
            @foreach($showImgs as $i => $img)
            <div class="hotel-gallery__item">
                <img src="{{ asset('storage/'.trim($img)) }}" alt="Фото {{ $i+1 }}">
                @if($i==4 && $moreCount>0)
                <span class="hotel-gallery__more">+{{ $moreCount }} фото</span>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="hotel-gallery__placeholder"></div>
        @endif

        {{-- Название и описание --}}
        <div class="hotel-header">
            <h1 class="hotel-name">{{ $hotel->name }}</h1>
            <div class="hotel-meta">
                <span>{{ $hotel->address }}</span>
                <span>{{ $hotel->distance_to_lift }} м до подъёмника</span>
            </div>
        </div>

        <div class="hotel-layout">
            <div class="hotel-main">

                <section class="hotel-section">
                    <h2>Об отеле</h2>
                    <p>{{ $hotel->description ?: 'Информация уточняется.' }}</p>

                    @if($hotel->amenities)
                    @php $amenities = is_string($hotel->amenities) ? (json_decode($hotel->amenities,true) ?? explode(',',$hotel->amenities)) : []; @endphp
                    <div class="amenities-list">
                        @foreach($amenities as $a)
                        <span class="amenity-tag">{{ trim($a) }}</span>
                        @endforeach
                    </div>
                    @endif
                </section>

                <section class="hotel-section">
                    <h2>Номера</h2>
                    @forelse($hotel->rooms as $room)
                    @php
                        $rImgs = [];
                        if($room->images) $rImgs = explode(',', $room->images);
                        elseif($room->image) $rImgs = [$room->image];
                    @endphp
                    <div class="room-card">
                        <div class="room-card__img">
                            @if(!empty($rImgs))
                            <img src="{{ asset('storage/'.trim($rImgs[0])) }}" alt="{{ $room->room_type }}">
                            @endif
                        </div>
                        <div class="room-card__body">
                            <div>
                                <h3 class="room-card__title">{{ $room->room_type }}</h3>
                                <div class="room-card__specs">
                                    <span>до {{ $room->capacity }} гостей</span>
                                    <span>{{ $room->available_rooms }} свободно</span>
                                </div>
                                @if($room->amenities)<p class="room-card__amenities">{{ $room->amenities }}</p>@endif
                            </div>
                            <div class="room-card__bottom">
                                <div class="room-card__price">{{ number_format($room->price_per_night,0,',',' ') }} <span>₽/ночь</span></div>
                                @auth
                                <a href="{{ route('bookings.create',['type'=>'hotel','item_id'=>$room->id]) }}" class="room-card__btn">Забронировать</a>
                                @else
                                <a href="{{ route('login') }}" class="room-card__btn room-card__btn--login">Войти</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color:#aaa; text-align: center; padding: 40px;">Номера не добавлены.</p>
                    @endforelse
                </section>

                <section class="hotel-section">
                    <h2>Отзывы</h2>

                    <div class="review-form">
                        <h3>Оставить отзыв</h3>
                        @auth
                        @if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <div class="review-stars" id="stars">
                                @for($i=1;$i<=5;$i++)<span class="star filled" data-v="{{ $i }}">★</span>@endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="5">
                            <textarea name="comment" rows="3" placeholder="Ваши впечатления об отеле..."></textarea>
                            <button type="submit">Отправить отзыв</button>
                        </form>
                        @else
                        <p class="review-login-hint"><a href="{{ route('login') }}">Войдите</a>, чтобы оставить отзыв.</p>
                        @endauth
                    </div>

                    @php $reviews = \App\Models\Review::where('hotel_id',$hotel->id)->where('is_approved',true)->with('user')->latest()->get(); @endphp
                    @forelse($reviews as $r)
                    <div class="review-card">
                        <div class="review-card__top">
                            <span class="review-card__name">{{ $r->user->name }}</span>
                            <span class="review-card__stars">@for($i=1;$i<=5;$i++){{ $i<=$r->rating?'★':'☆' }}@endfor</span>
                        </div>
                        <p class="review-card__text">{{ $r->comment }}</p>
                        <p class="review-card__date">{{ $r->created_at->format('d.m.Y') }}</p>
                    </div>
                    @empty
                    <p style="color:#aaa; text-align: center; padding: 30px;">Пока нет отзывов.</p>
                    @endforelse
                </section>

            </div>

            <aside>
                <div class="hotel-sidebar-card">
                    <h3>Информация</h3>
                    <div class="hotel-sidebar-row">
                        <span>Адрес</span>
                        <span>{{ Str::limit($hotel->address, 25) }}</span>
                    </div>
                    <div class="hotel-sidebar-row">
                        <span>Подъёмник</span>
                        <span>{{ $hotel->distance_to_lift }} м</span>
                    </div>
                    <div class="hotel-sidebar-row">
                        <span>Категория</span>
                        <span>@for($i=0;$i<$hotel->stars;$i++)★@endfor</span>
                    </div>
                    <div class="hotel-sidebar-row">
                        <span>Типов номеров</span>
                        <span>{{ $hotel->rooms->count() }}</span>
                    </div>
                    @if($hotel->rooms->min('price_per_night'))
                    <div class="hotel-sidebar-row hotel-sidebar-row--total">
                        <span>Цена от</span>
                        <span>{{ number_format($hotel->rooms->min('price_per_night'),0,',',' ') }} ₽</span>
                    </div>
                    @endif
                    <div class="hotel-sidebar-guarantee">
                        Бесплатная отмена за 48 ч<br>
                        Консьерж 24/7<br>
                        Лучшая цена на сайте
                    </div>
                </div>
            </aside>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('#stars .star').forEach(s => {
        s.addEventListener('click', function(){
            const v = parseInt(this.dataset.v);
            document.getElementById('rating').value = v;
            document.querySelectorAll('#stars .star').forEach((st,i) => st.classList.toggle('filled', i<v));
        });
        s.addEventListener('mouseover', function(){
            const v = parseInt(this.dataset.v);
            document.querySelectorAll('#stars .star').forEach((st,i) => st.classList.toggle('filled', i<v));
        });
    });
    document.getElementById('stars').addEventListener('mouseleave', function(){
        const currentV = parseInt(document.getElementById('rating').value);
        document.querySelectorAll('#stars .star').forEach((st,i) => st.classList.toggle('filled', i<currentV));
    });
</script>
@endpush
@endsection