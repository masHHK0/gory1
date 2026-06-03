{{-- resources/views/admin/instructors/index.blade.php --}}
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

    /* Карточки инструкторов */
    .instructors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    .instructor-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }

    .instructor-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(3, 83, 138, 0.08);
    }

    .instructor-card__photo {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .instructor-card__placeholder {
        width: 100%;
        height: 240px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 64px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .instructor-card__body {
        padding: 24px;
    }

    .instructor-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .instructor-card__name {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .instructor-card__status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-available {
        background: var(--primary);
        color: #fff;
    }

    .status-busy {
        background: #e74c3c;
        color: #fff;
    }

    .instructor-card__stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 16px;
    }

    .stat-item {
        background: #f8f9fb;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
    }

    .stat-label {
        font-size: 10px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
    }

    .stat-value--price {
        color: var(--accent);
    }

    .instructor-card__description {
        font-size: 13px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .instructor-card__actions {
        display: flex;
        gap: 10px;
    }

    .instructor-card__actions .btn {
        flex: 1;
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
        max-width: 600px;
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

    .modal-photo-preview {
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-photo-preview img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--accent);
    }

    .modal-photo-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: #f8f9fb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #ccc;
        font-size: 48px;
        font-weight: 700;
        border: 3px solid var(--border);
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
        .instructors-grid {
            grid-template-columns: 1fr;
        }
        .form-section {
            padding: 20px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление инструкторами</h1>
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
                <h3 class="form-section__title">Добавить инструктора</h3>
            </div>
            <form action="{{ route('admin.instructors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Имя</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Специализация</label>
                        <input type="text" name="specialization" class="form-input" required placeholder="Горные лыжи, сноуборд...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Опыт (лет)</label>
                        <input type="number" name="experience_years" class="form-input" required min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Цена за час (руб)</label>
                        <input type="number" name="price_per_hour" class="form-input" required min="0">
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Описание</label>
                    <textarea name="description" class="form-textarea" rows="3" placeholder="Расскажите об инструкторе..."></textarea>
                </div>
                
                <div class="form-group" style="margin-top: 16px;">
                    <label class="form-label">Фото инструктора</label>
                    <input type="file" name="photo" class="form-input" accept="image/*">
                    <span class="form-hint">Рекомендуемый размер: 400x400 пикселей</span>
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Добавить инструктора</button>
            </form>
        </div>

        {{-- Список инструкторов --}}
        <h2 class="section-title">Все инструкторы</h2>
        
        @if($instructors->count() > 0)
        <div class="instructors-grid">
            @foreach($instructors as $instructor)
            <div class="instructor-card">
                @if($instructor->photo)
                <img src="{{ asset('storage/' . $instructor->photo) }}" alt="{{ $instructor->name }}" class="instructor-card__photo">
                @else
                <div class="instructor-card__placeholder">
                    {{ strtoupper(mb_substr($instructor->name, 0, 1)) }}
                </div>
                @endif
                
                <div class="instructor-card__body">
                    <div class="instructor-card__header">
                        <h3 class="instructor-card__name">{{ $instructor->name }}</h3>
                        <span class="instructor-card__status {{ $instructor->available ? 'status-available' : 'status-busy' }}">
                            {{ $instructor->available ? 'Доступен' : 'Занят' }}
                        </span>
                    </div>
                    
                    <div class="instructor-card__stats">
                        <div class="stat-item">
                            <div class="stat-label">Специализация</div>
                            <div class="stat-value">{{ $instructor->specialization }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Опыт</div>
                            <div class="stat-value">{{ $instructor->experience_years }} лет</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Цена</div>
                            <div class="stat-value stat-value--price">{{ number_format($instructor->price_per_hour, 0, ',', ' ') }} руб/ч</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">ID</div>
                            <div class="stat-value">#{{ $instructor->id }}</div>
                        </div>
                    </div>
                    
                    @if($instructor->description)
                    <p class="instructor-card__description">{{ Str::limit($instructor->description, 100) }}</p>
                    @endif
                    
                    <div class="instructor-card__actions">
                        <button onclick="openEditModal({{ $instructor }})" class="btn btn-primary btn-sm">Редактировать</button>
                        <form action="{{ route('admin.instructors.delete', $instructor) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Удалить инструктора?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">Инструкторы не добавлены</div>
        @endif
    </div>
</div>

{{-- Модальное окно --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <h3 class="modal-title">Редактировать инструктора</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="modal-photo-preview">
                <img id="edit_photo_preview" src="" alt="Фото" style="display: none;">
                <div class="modal-photo-placeholder" id="edit_photo_placeholder"></div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Имя</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Специализация</label>
                    <input type="text" name="specialization" id="edit_specialization" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Опыт (лет)</label>
                    <input type="number" name="experience_years" id="edit_experience_years" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Цена за час (руб)</label>
                    <input type="number" name="price_per_hour" id="edit_price_per_hour" class="form-input" required>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Описание</label>
                    <textarea name="description" id="edit_description" class="form-textarea" rows="3"></textarea>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Статус</label>
                    <select name="available" id="edit_available" class="form-select" required>
                        <option value="1">Доступен</option>
                        <option value="0">Занят</option>
                    </select>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Новое фото</label>
                    <input type="file" name="photo" id="edit_photo" class="form-input" accept="image/*">
                    <span class="form-hint">Оставьте пустым, чтобы не менять фото</span>
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
function openEditModal(instructor) {
    document.getElementById('edit_name').value = instructor.name;
    document.getElementById('edit_specialization').value = instructor.specialization;
    document.getElementById('edit_experience_years').value = instructor.experience_years;
    document.getElementById('edit_price_per_hour').value = instructor.price_per_hour;
    document.getElementById('edit_description').value = instructor.description || '';
    document.getElementById('edit_available').value = instructor.available ? 1 : 0;
    document.getElementById('editForm').action = "{{ route('admin.instructors.update', '') }}/" + instructor.id;
    
    const preview = document.getElementById('edit_photo_preview');
    const placeholder = document.getElementById('edit_photo_placeholder');
    
    if (instructor.photo) {
        preview.src = "{{ asset('storage') }}/" + instructor.photo;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    } else {
        preview.style.display = 'none';
        placeholder.style.display = 'flex';
        placeholder.textContent = instructor.name.charAt(0).toUpperCase();
    }
    
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