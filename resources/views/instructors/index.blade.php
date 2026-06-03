{{-- resources/views/instructors/index.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    .instructors-page {
        background: #fff;
        padding: 40px 0 80px;
    }
    .instructors-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .instructors-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .instructors-header h1 {
        font-size: 42px;
        font-family: R;
        color: #03538A;
        margin-bottom: 6px;
        text-transform: uppercase;
    }
    .instructors-header p {
        color: #888;
        font-size: 15px;
    }
    .instructors-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .instructor-card {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 20px;
        padding: 24px 28px;
        transition: all 0.25s;
        display: flex;
        gap: 20px;
        position: relative;
    }
    .instructor-card:hover {
        border-color: #03548a40;
    }
    .instructor-card__photo {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #fff;
        background: #03538A;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .instructor-card__photo:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .instructor-card__photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .instructor-card__body {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 0;
    }
    .instructor-card__top-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .instructor-card__name {
        font-size: 19px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }
    .instructor-card__status {
        font-size: 11px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        flex-shrink: 0;
        white-space: nowrap;
    }
    .instructor-card__status--open {
        background: #03548a0a;
        color: #03538A;
    }
    .instructor-card__status--closed {
        background: #f8d7da;
        color: #721c24;
    }
    .instructor-card__spec {
        font-size: 14px;
        color: #03538A;
        font-weight: 500;
    }
    .instructor-card__exp {
        font-size: 13px;
        color: #888;
    }
    .instructor-card__rating {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
    }
    .instructor-card__stars {
        color: #FF772D;
        font-size: 14px;
        letter-spacing: 1px;
    }
    .instructor-card__reviews {
        color: #aaa;
        font-size: 12px;
    }
    .instructor-card__desc {
        font-size: 13px;
        color: #888;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .instructor-card__bottom {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: auto;
        padding-top: 12px;
    }
    .instructor-card__price {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        white-space: nowrap;
    }
    .instructor-card__price span {
        font-size: 12px;
        color: #999;
        font-weight: 400;
    }
    .instructor-card__actions {
        display: flex;
        gap: 8px;
        margin-left: auto;
    }
    .instructor-btn {
        padding: 9px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        font-family: inherit;
        border: 1px solid #03548a40;
        color: #03538A;
        background: transparent;
        white-space: nowrap;
    }
    .instructor-btn:hover {
        background: #03538A;
        color: #fff;
    }
    .instructor-btn--accent {
        background: #FF772D;
        color: #fff;
        border-color: #FF772D;
    }
    .instructor-btn--accent:hover {
        background: #e6681f;
    }

    /* Модалка */
    .instructor-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 2000;
        align-items: center;
        justify-content: center;
    }
    .instructor-modal.active { display: flex; }
    .instructor-modal__content {
        background: #fff;
        border-radius: 24px;
        padding: 32px;
        max-width: 520px;
        width: 95%;
        max-height: 85vh;
        overflow-y: auto;
        position: relative;
    }
    .instructor-modal__close {
        position: absolute;
        top: 16px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: #aaa;
        background: none;
        border: none;
    }
    .instructor-modal__close:hover { color: #333; }
    .review-item {
        padding: 14px 0;
        border-bottom: 1px solid #f5f5f5;
    }
    .review-item:last-child { border-bottom: none; }
    .review-item__top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }
    .review-item__name { font-weight: 600; font-size: 14px; }
    .review-item__stars { color: #FF772D; font-size: 13px; }
    .review-item__text { color: #888; font-size: 13px; line-height: 1.5; }
    .review-item__date { color: #ccc; font-size: 11px; margin-top: 4px; }
    .review-form-box {
        background: #f8f9fb;
        padding: 18px;
        border-radius: 14px;
        margin-top: 18px;
    }
    .review-form-box h4 { margin: 0 0 10px; font-size: 15px; font-weight: 700; }
    .stars-input { font-size: 28px; cursor: pointer; user-select: none; }
    .stars-input span { color: #ddd; transition: 0.15s; }
    .stars-input span.filled { color: #FF772D; }

    /* Модалка для увеличения фото */
    .photo-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.9);
        z-index: 3000;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .photo-modal.active {
        display: flex;
    }
    .photo-modal__image {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }
    .photo-modal__close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 40px;
        color: white;
        cursor: pointer;
        background: none;
        border: none;
        transition: transform 0.2s;
    }
    .photo-modal__close:hover {
        transform: scale(1.1);
    }

    @media (max-width: 860px) {
        .instructors-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
        .instructor-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .instructor-card__bottom { flex-direction: column; }
        .instructor-card__actions { margin-left: 0; }
    }
</style>

<div class="instructors-page">
    <div class="instructors-container">
        <div class="instructors-header">
            <h1>Инструкторы</h1>
            <p>Профессиональные инструкторы по горным лыжам и сноуборду</p>
        </div>

        @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:12px 16px;border-radius:10px;margin-bottom:20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div style="background:#f8d7da;color:#721c24;padding:12px 16px;border-radius:10px;margin-bottom:20px;">{{ session('error') }}</div>
        @endif

        <div class="instructors-grid">
            @foreach($instructors as $instructor)
            @php
                $avgRating = \App\Models\Review::where('instructor_id', $instructor->id)->where('is_approved', true)->avg('rating');
                $reviewsCount = \App\Models\Review::where('instructor_id', $instructor->id)->where('is_approved', true)->count();
                $photoUrl = $instructor->photo ? asset('storage/'.$instructor->photo) : null;
            @endphp
            <div class="instructor-card">
                <div class="instructor-card__photo" onclick="openPhotoModal('{{ $photoUrl }}', '{{ $instructor->name }}')">
                    @if($instructor->photo)
                    <img src="{{ asset('storage/'.$instructor->photo) }}" alt="{{ $instructor->name }}">
                    @else
                    {{ mb_substr($instructor->name, 0, 1) }}
                    @endif
                </div>
                <div class="instructor-card__body">
                    <div class="instructor-card__top-row">
                        <h3 class="instructor-card__name">{{ $instructor->name }}</h3>
                        <span class="instructor-card__status {{ $instructor->available ? 'instructor-card__status--open' : 'instructor-card__status--closed' }}">
                            {{ $instructor->available ? 'Свободен' : 'Занят' }}
                        </span>
                    </div>
                    <div class="instructor-card__spec">{{ $instructor->specialization }}</div>
                    <div class="instructor-card__exp">Стаж {{ $instructor->experience_years }} лет</div>
                    <div class="instructor-card__rating">
                        <span class="instructor-card__stars">
                            @if($avgRating)
                                @for($i=1;$i<=5;$i++){{ $i<=round($avgRating)?'★':'☆' }}@endfor
                            @else ☆☆☆☆☆ @endif
                        </span>
                        <span class="instructor-card__reviews">{{ $reviewsCount }} отзывов</span>
                    </div>
                    @if($instructor->description)
                    <p class="instructor-card__desc">{{ $instructor->description }}</p>
                    @endif
                    <div class="instructor-card__bottom">
                        <div class="instructor-card__price">{{ number_format($instructor->price_per_hour,0,',',' ') }} <span>₽/час</span></div>
                        <div class="instructor-card__actions">
                            <button onclick="openModal({{ $instructor->id }})" class="instructor-btn">Подробнее</button>
                            @auth
                                @if($instructor->available)
                                <a href="{{ route('bookings.create',['type'=>'instructor','item_id'=>$instructor->id]) }}" class="instructor-btn instructor-btn--accent">Забронировать</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="instructor-btn instructor-btn--accent">Войти</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Модалка для увеличения фото --}}
<div class="photo-modal" id="photoModal" onclick="closePhotoModal()">
    <button class="photo-modal__close" onclick="closePhotoModal()">&times;</button>
    <img class="photo-modal__image" id="photoModalImage" src="" alt="">
</div>

{{-- Модалки с отзывами --}}
@foreach($instructors as $instructor)
@php $modalReviews = \App\Models\Review::where('instructor_id', $instructor->id)->where('is_approved',true)->with('user')->latest()->get(); @endphp
<div class="instructor-modal" id="modal-{{ $instructor->id }}">
    <div class="instructor-modal__content">
        <button class="instructor-modal__close" onclick="closeModal({{ $instructor->id }})">&times;</button>
        <div style="display:flex;gap:16px;align-items:center;margin-bottom:18px;">
            <div class="instructor-card__photo" style="width:64px;height:64px;font-size:24px;cursor:pointer;" onclick="openPhotoModalFromModal('{{ $instructor->photo ? asset('storage/'.$instructor->photo) : null }}', '{{ $instructor->name }}')">
                @if($instructor->photo)
                <img src="{{ asset('storage/'.$instructor->photo) }}" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">@else{{ mb_substr($instructor->name,0,1) }}@endif
            </div>
            <div>
                <h3 style="margin:0;font-size:20px;color:#1a1a1a;">{{ $instructor->name }}</h3>
                <p style="margin:2px 0;color:#888;font-size:14px;">{{ $instructor->specialization }} • {{ $instructor->experience_years }} лет</p>
                <p style="margin:0;font-weight:700;color:#03538A;">{{ number_format($instructor->price_per_hour,0,',',' ') }} ₽/час</p>
            </div>
        </div>
        @if($instructor->description)
        <p style="color:#666;line-height:1.7;font-size:14px;">{{ $instructor->description }}</p>
        @endif
        <h4 style="margin-top:24px;font-weight:700;">Отзывы ({{ $modalReviews->count() }})</h4>
        @forelse($modalReviews->take(10) as $r)
        <div class="review-item">
            <div class="review-item__top">
                <span class="review-item__name">{{ $r->user->name }}</span>
                <span class="review-item__stars">@for($i=1;$i<=5;$i++){{ $i<=$r->rating?'★':'☆' }}@endfor</span>
            </div>
            @if($r->comment)<p class="review-item__text">{{ $r->comment }}</p>@endif
            <p class="review-item__date">{{ $r->created_at->format('d.m.Y') }}</p>
        </div>
        @empty
        <p style="color:#aaa;font-size:13px;">Пока нет отзывов</p>
        @endforelse
        <div class="review-form-box">
            <h4>Оставить отзыв</h4>
            @auth
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
                <div class="stars-input" id="stars-modal-{{ $instructor->id }}">
                    @for($i=1;$i<=5;$i++)<span data-v="{{ $i }}" class="filled">★</span>@endfor
                </div>
                <input type="hidden" name="rating" id="rating-modal-{{ $instructor->id }}" value="5">
                <textarea name="comment" rows="2" style="width:100%;padding:10px;border:1px solid #e0e0e0;border-radius:10px;margin-top:8px;font-size:13px;resize:vertical;font-family:inherit;" placeholder="Поделитесь впечатлениями..."></textarea>
                <button type="submit" style="margin-top:8px;padding:10px 20px;background:#FF772D;color:#fff;border:none;border-radius:10px;font-weight:600;cursor:pointer;font-family:inherit;">Отправить</button>
            </form>
            @else
            <p style="font-size:13px;color:#999;"><a href="{{ route('login') }}" style="color:#03538A;">Войдите</a>, чтобы оставить отзыв</p>
            @endauth
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
// Модалки с отзывами
function openModal(id) { 
    document.getElementById('modal-'+id).classList.add('active'); 
}
function closeModal(id) { 
    document.getElementById('modal-'+id).classList.remove('active'); 
}

// Закрытие при клике на фон
document.querySelectorAll('.instructor-modal').forEach(m => {
    m.addEventListener('click', function(e){ 
        if(e.target === this) this.classList.remove('active'); 
    });
});

// Звездочки в отзывах
document.querySelectorAll('.stars-input').forEach(container => {
    const modalId = container.id.replace('stars-modal-','');
    const input = document.getElementById('rating-modal-'+modalId);
    if(!input) return;
    container.querySelectorAll('span').forEach(star => {
        star.addEventListener('click', function(){
            const v = parseInt(this.dataset.v);
            input.value = v;
            container.querySelectorAll('span').forEach((s,i) => s.classList.toggle('filled', i<v));
        });
    });
});

// ========== УВЕЛИЧЕНИЕ ФОТО ==========
const photoModal = document.getElementById('photoModal');
const photoModalImage = document.getElementById('photoModalImage');
let currentPhotoUrl = null;

function openPhotoModal(photoUrl, instructorName) {
    if (!photoUrl) {
        // Если фото нет, показываем уведомление или ничего не делаем
        return;
    }
    photoModalImage.src = photoUrl;
    photoModalImage.alt = instructorName;
    photoModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function openPhotoModalFromModal(photoUrl, instructorName) {
    if (!photoUrl) return;
    // Закрываем текущую модалку с отзывами
    const activeModal = document.querySelector('.instructor-modal.active');
    if (activeModal) {
        activeModal.classList.remove('active');
    }
    openPhotoModal(photoUrl, instructorName);
}

function closePhotoModal() {
    photoModal.classList.remove('active');
    photoModalImage.src = '';
    document.body.style.overflow = '';
}

// Закрытие по Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (photoModal.classList.contains('active')) {
            closePhotoModal();
        }
    }
});
</script>
@endpush
@endsection