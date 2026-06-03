{{-- resources/views/admin/hotels/index.blade.php --}}
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

    /* Форма добавления */
    .form-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
        margin-bottom: 24px;
    }

    .form-section__header {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--border);
    }

    .form-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        font-family: R;
        text-transform: uppercase;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-grid-4 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 16px;
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
        padding: 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        transition: all 0.3s;
        background: #fafbfc;
        color: var(--text);
        height: 46px;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-select {
        padding: 12px 36px 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        background: #fafbfc;
        color: var(--text);
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23888' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        transition: all 0.3s;
        height: 46px;
        box-sizing: border-box;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-textarea {
        padding: 12px 16px;
        border: 1px solid #eef0f2;
        border-radius: 10px;
        font-size: 14px;
        font-family: 'M', sans-serif;
        transition: all 0.3s;
        background: #fafbfc;
        color: var(--text);
        resize: vertical;
        min-height: 80px;
    }

    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
    }

    .form-input[type="file"] {
        padding: 8px 12px;
        line-height: 28px;
    }

    .form-input[type="file"]::file-selector-button {
        padding: 6px 14px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: #f8f9fb;
        color: var(--text);
        font-family: 'M', sans-serif;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s;
        margin-right: 10px;
    }

    .form-hint {
        font-size: 11px;
        color: #bbb;
        margin-top: 4px;
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

    /* Карточка отеля */
    .hotel-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .hotel-card__gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        padding: 16px;
        background: #fafbfc;
        border-bottom: 1px solid var(--border);
    }

    .hotel-card__image-wrap {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .hotel-card__image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
    }

    .hotel-card__main-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--accent);
        color: #fff;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    .hotel-card__empty {
        padding: 40px;
        text-align: center;
        background: #fafbfc;
        color: #ccc;
        font-size: 14px;
        border-bottom: 1px solid var(--border);
    }

    .hotel-card__body {
        padding: 24px;
    }

    .hotel-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hotel-card__name {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .hotel-card__stars {
        color: var(--accent);
        font-size: 16px;
        letter-spacing: 3px;
        margin-top: 4px;
    }

    .hotel-card__id {
        font-size: 12px;
        color: var(--text-light);
        background: #f8f9fb;
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 600;
    }

    .hotel-card__info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .info-item {
        font-size: 13px;
        color: var(--text-light);
        background: #f8f9fb;
        padding: 10px 14px;
        border-radius: 10px;
    }

    .info-item strong {
        color: var(--text);
        font-weight: 600;
    }

    .hotel-card__description {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.7;
        margin-bottom: 16px;
    }

    .hotel-card__actions {
        display: flex;
        gap: 10px;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
        flex-wrap: wrap;
    }

    /* Номера */
    .rooms-section {
        margin-top: 16px;
    }

    .rooms-toggle {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        cursor: pointer;
        padding: 12px 16px;
        background: #f8f9fb;
        border-radius: 12px;
        border: 1px solid var(--border);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .rooms-toggle:hover {
        background: #eef0f2;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 14px;
        margin-top: 14px;
    }

    .room-card {
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.3s;
    }

    .room-card:hover {
        box-shadow: 0 4px 15px rgba(3, 83, 138, 0.06);
    }

    .room-card__image {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .room-card__placeholder {
        width: 100%;
        height: 140px;
        background: #f8f9fb;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 13px;
    }

    .room-card__body {
        padding: 14px;
    }

    .room-card__type {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 8px;
    }

    .room-card__spec {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 4px;
    }

    .room-card__price {
        font-size: 16px;
        font-weight: 700;
        color: var(--accent);
        margin-top: 8px;
    }

    /* Модальное окно */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        width: 90%;
        max-width: 700px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--border);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
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
        .form-grid-4 {
            grid-template-columns: 1fr 1fr;
        }
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-section {
            padding: 20px;
        }
        .hotel-card__body {
            padding: 16px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление отелями</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        {{-- Форма добавления --}}
        <div class="form-section">
            <div class="form-section__header">
                <h3 class="form-section__title">Добавить отель</h3>
            </div>
            <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Звезды</label>
                        <select name="stars" class="form-select" required>
                            @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} звезд</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Адрес</label>
                        <input type="text" name="address" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">До подъемника (м)</label>
                        <input type="number" name="distance_to_lift" class="form-input" required>
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Описание</label>
                    <textarea name="description" class="form-textarea" rows="3"></textarea>
                </div>
                
                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Фотографии отеля</label>
                    <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
                    <span class="form-hint">Первое фото будет главным. Можно загрузить до 10 фото.</span>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Добавить отель</button>
            </form>
        </div>

        {{-- Список отелей --}}
        <h2 class="section-title">Существующие отели</h2>
        
        @forelse($hotels as $hotel)
        <div class="hotel-card">
            @php
                $images = [];
                if ($hotel->images) {
                    $images = explode(',', $hotel->images);
                } elseif ($hotel->main_image) {
                    $images = [$hotel->main_image];
                }
            @endphp
            
            @if(count($images) > 0)
            <div class="hotel-card__gallery">
                @foreach($images as $index => $image)
                <div class="hotel-card__image-wrap">
                    <img src="{{ asset('storage/' . trim($image)) }}" alt="{{ $hotel->name }}" class="hotel-card__image">
                    @if($index === 0)
                    <span class="hotel-card__main-badge">Главное</span>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="hotel-card__empty">Нет фотографий</div>
            @endif
            
            <div class="hotel-card__body">
                <div class="hotel-card__header">
                    <div>
                        <h3 class="hotel-card__name">{{ $hotel->name }}</h3>
                        <div class="hotel-card__stars">
                            @for($i = 0; $i < $hotel->stars; $i++) ★ @endfor
                        </div>
                    </div>
                    <span class="hotel-card__id">ID: {{ $hotel->id }}</span>
                </div>
                
                <div class="hotel-card__info">
                    <div class="info-item"><strong>Адрес:</strong> {{ $hotel->address }}</div>
                    <div class="info-item"><strong>Подъёмник:</strong> {{ $hotel->distance_to_lift }} м</div>
                    <div class="info-item"><strong>Номеров:</strong> {{ $hotel->rooms->count() }}</div>
                </div>
                
                @if($hotel->description)
                <p class="hotel-card__description">{{ $hotel->description }}</p>
                @endif
                
                @if($hotel->rooms->count() > 0)
                <div class="rooms-section">
                    <details>
                        <summary class="rooms-toggle">
                            <span>Номера ({{ $hotel->rooms->count() }})</span>
                            <span>▼</span>
                        </summary>
                        <div class="rooms-grid">
                            @foreach($hotel->rooms as $room)
                            <div class="room-card">
                                @if($room->images)
                                    @php $roomImages = explode(',', $room->images); @endphp
                                    <img src="{{ asset('storage/' . trim($roomImages[0])) }}" alt="{{ $room->room_type }}" class="room-card__image">
                                @elseif($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->room_type }}" class="room-card__image">
                                @else
                                    <div class="room-card__placeholder">Нет фото</div>
                                @endif
                                <div class="room-card__body">
                                    <div class="room-card__type">{{ $room->room_type }}</div>
                                    <div class="room-card__spec">Вместимость: {{ $room->capacity }} чел.</div>
                                    <div class="room-card__spec">Доступно: {{ $room->available_rooms }}</div>
                                    <div class="room-card__price">{{ number_format($room->price_per_night, 0, ',', ' ') }} руб/ночь</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </details>
                </div>
                @endif
                
                <div class="hotel-card__actions">
                    <button onclick="openEditModal({{ $hotel }})" class="btn btn-primary btn-sm">Редактировать</button>
                    <form action="{{ route('admin.hotels.delete', $hotel) }}" method="POST" onsubmit="return confirm('Удалить отель и все его номера?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">Отели не добавлены</div>
        @endforelse
    </div>
</div>

{{-- Модальное окно --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <h3 class="modal-title">Редактировать отель</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Название</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Звезды</label>
                    <select name="stars" id="edit_stars" class="form-select" required>
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} звезд</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Адрес</label>
                    <input type="text" name="address" id="edit_address" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">До подъемника (м)</label>
                    <input type="number" name="distance_to_lift" id="edit_distance_to_lift" class="form-input" required>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Описание</label>
                    <textarea name="description" id="edit_description" class="form-textarea" rows="3"></textarea>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Добавить новые фотографии</label>
                    <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
                    <span class="form-hint">Новые фото добавятся к существующим.</span>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button type="button" onclick="closeEditModal()" class="btn" style="background: #fff; color: var(--text-light); border-color: #eef0f2;">Отмена</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(hotel) {
    document.getElementById('edit_name').value = hotel.name;
    document.getElementById('edit_stars').value = hotel.stars;
    document.getElementById('edit_address').value = hotel.address;
    document.getElementById('edit_distance_to_lift').value = hotel.distance_to_lift;
    document.getElementById('edit_description').value = hotel.description || '';
    document.getElementById('editForm').action = "{{ route('admin.hotels.update', '') }}/" + hotel.id;
    document.getElementById('editModal').classList.add('active');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('active');
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>
@endsection