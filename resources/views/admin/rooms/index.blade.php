{{-- resources/views/admin/rooms/index.blade.php --}}
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

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        font-family: R;
        text-transform: uppercase;
    }

    /* Форма добавления */
    .form-section {
        background: #fff;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid var(--border);
        margin-bottom: 32px;
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

    /* Карточки номеров */
    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 20px;
    }

    .room-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }

    .room-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(3, 83, 138, 0.08);
    }

    .room-card__image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .room-card__image-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 48px;
    }

    .room-card__badge {
        position: relative;
    }

    .room-card__photos-count {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .room-card__body {
        padding: 24px;
    }

    .room-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 8px;
    }

    .room-card__type {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .room-card__id {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-light);
        background: #f8f9fb;
        padding: 4px 12px;
        border-radius: 20px;
    }

    .room-card__hotel {
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }

    .room-card__hotel strong {
        color: var(--text);
    }

    .room-card__stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
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
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
    }

    .stat-value--price {
        color: var(--accent);
        font-size: 18px;
    }

    .room-card__amenities {
        font-size: 12px;
        color: var(--text-light);
        background: #f8f9fb;
        padding: 10px 12px;
        border-radius: 10px;
        margin-bottom: 16px;
        word-break: break-word;
    }

    .room-card__gallery {
        display: flex;
        gap: 6px;
        margin: 12px 0;
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .gallery-thumb {
        width: 65px;
        height: 65px;
        border-radius: 10px;
        object-fit: cover;
        cursor: pointer;
        flex-shrink: 0;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .gallery-thumb:hover {
        border-color: var(--accent);
        transform: scale(1.02);
    }

    .room-card__actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
    }

    .room-card__actions form {
        flex: 1;
    }

    .room-card__actions .btn {
        width: 100%;
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
        .rooms-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление номерами</h1>
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
                <h3 class="form-section__title">Добавить номер</h3>
            </div>
            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Отель</label>
                        <select name="hotel_id" class="form-select" required>
                            <option value="">Выберите отель</option>
                            @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->stars }} звезд)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Тип номера</label>
                        <input type="text" name="room_type" class="form-input" required placeholder="Стандарт, Люкс, Семейный...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Вместимость (чел.)</label>
                        <input type="number" name="capacity" class="form-input" value="2" required min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Цена за ночь (руб)</label>
                        <input type="number" name="price_per_night" class="form-input" required min="0" placeholder="5000">
                    </div>
                </div>
                
                <div class="form-grid" style="margin-top: 16px;">
                    <div class="form-group">
                        <label class="form-label">Доступно номеров</label>
                        <input type="number" name="available_rooms" class="form-input" value="5" required min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Удобства</label>
                        <input type="text" name="amenities" class="form-input" placeholder="WiFi, TV, душ, балкон, кондиционер...">
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Фотографии номера (можно несколько)</label>
                    <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
                    <span class="form-hint">Первое фото будет главным. Рекомендуемый размер: 800x600 пикселей.</span>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Добавить номер</button>
            </form>
        </div>

        {{-- Список номеров --}}
        <h2 class="section-title">Все номера</h2>
        
        @if($rooms->count() > 0)
        <div class="rooms-grid">
            @foreach($rooms as $room)
            @php
                $images = [];
                if ($room->images) {
                    $images = explode(',', $room->images);
                } elseif ($room->image) {
                    $images = [$room->image];
                }
            @endphp
            
            <div class="room-card">
                <div class="room-card__badge">
                    @if(count($images) > 0)
                    <img src="{{ asset('storage/' . trim($images[0])) }}" 
                         alt="{{ $room->room_type }}" 
                         class="room-card__image">
                    @if(count($images) > 1)
                    <span class="room-card__photos-count">+{{ count($images) - 1 }} фото</span>
                    @endif
                    @else
                    <div class="room-card__image-placeholder">
                        Нет фото
                    </div>
                    @endif
                </div>
                
                <div class="room-card__body">
                    <div class="room-card__header">
                        <h3 class="room-card__type">{{ $room->room_type }}</h3>
                        <span class="room-card__id">ID: {{ $room->id }}</span>
                    </div>
                    
                    <div class="room-card__hotel">
                        <strong>Отель:</strong> {{ $room->hotel->name }}
                    </div>
                    
                    <div class="room-card__stats">
                        <div class="stat-item">
                            <div class="stat-label">Вместимость</div>
                            <div class="stat-value">{{ $room->capacity }} чел.</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Цена за ночь</div>
                            <div class="stat-value stat-value--price">{{ number_format($room->price_per_night, 0, ',', ' ') }} руб</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Доступно</div>
                            <div class="stat-value">{{ $room->available_rooms }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ID отеля</div>
                            <div class="stat-value">{{ $room->hotel_id }}</div>
                        </div>
                    </div>
                    
                    @if($room->amenities)
                    <div class="room-card__amenities">
                        <strong>Удобства:</strong> {{ $room->amenities }}
                    </div>
                    @endif
                    

                    
                    <div class="room-card__actions">
                        <button onclick="openEditModal({{ $room }})" class="btn btn-primary btn-sm">Редактировать</button>
                        <form action="{{ route('admin.rooms.delete', $room) }}" method="POST" onsubmit="return confirm('Удалить номер «{{ $room->room_type }}»?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            Номера ещё не добавлены
        </div>
        @endif
    </div>
</div>

{{-- Модальное окно редактирования --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <h3 class="modal-title">Редактировать номер</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Отель</label>
                    <select name="hotel_id" id="edit_hotel_id" class="form-select" required>
                        <option value="">Выберите отель</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->stars }} звезд)</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Тип номера</label>
                    <input type="text" name="room_type" id="edit_room_type" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Вместимость (чел.)</label>
                    <input type="number" name="capacity" id="edit_capacity" class="form-input" required min="1">
                </div>
                <div class="form-group">
                    <label class="form-label">Цена за ночь (руб)</label>
                    <input type="number" name="price_per_night" id="edit_price_per_night" class="form-input" required min="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Доступно номеров</label>
                    <input type="number" name="available_rooms" id="edit_available_rooms" class="form-input" required min="0">
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Удобства</label>
                    <input type="text" name="amenities" id="edit_amenities" class="form-input" placeholder="WiFi, TV, душ, балкон...">
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Добавить новые фотографии</label>
                    <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
                    <span class="form-hint">Новые фото добавятся к существующим. Первое фото будет главным.</span>
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
function openEditModal(room) {
    document.getElementById('edit_hotel_id').value = room.hotel_id;
    document.getElementById('edit_room_type').value = room.room_type;
    document.getElementById('edit_capacity').value = room.capacity;
    document.getElementById('edit_price_per_night').value = room.price_per_night;
    document.getElementById('edit_available_rooms').value = room.available_rooms;
    document.getElementById('edit_amenities').value = room.amenities || '';
    document.getElementById('editForm').action = "{{ route('admin.rooms.update', '') }}/" + room.id;
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