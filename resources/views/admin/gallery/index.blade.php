{{-- resources/views/admin/gallery/index.blade.php --}}
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

    /* Форма загрузки */
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

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr auto;
    gap: 16px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-label {
    font-size: 12px;
    font-weight: 700;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
    white-space: nowrap;
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

/* Специальные стили для поля с файлом */
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

.form-input[type="file"]::file-selector-button:hover {
    background: #eef0f2;
}

/* Кнопка */
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
        margin-bottom: 20px;
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
        width: 100%;
    }
    .btn-danger:hover {
        background: #fff;
        color: var(--accent);
        border-color: var(--accent);
    }

    /* Сетка изображений */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }

    .gallery-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s;
    }

    .gallery-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(3, 83, 138, 0.08);
    }

    .gallery-card__image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        display: block;
    }

    .gallery-card__body {
        padding: 14px 16px;
    }

    .gallery-card__title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gallery-card__category {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        background: #f8f9fb;
        color: var(--text-light);
        margin-bottom: 12px;
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
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .form-grid {
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
            <h1 class="admin-title">Управление галереей</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        {{-- Форма загрузки --}}
        <div class="form-section">
            <div class="form-section__header">
                <h3 class="form-section__title">Загрузить изображение</h3>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input type="text" name="title" class="form-input" placeholder="Закат на склоне">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Категория</label>
                        <select name="category" class="form-select" required>
                            <option value="slopes">Трассы</option>
                            <option value="hotels">Отели</option>
                            <option value="events">События</option>
                            <option value="nature">Природа</option>
                            <option value="other">Другое</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Изображение</label>
                        <input type="file" name="image" class="form-input" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Загрузить</button>
                </div>
            </form>
        </div>

        {{-- Сетка изображений --}}
        @if($images->count() > 0)
        <div class="gallery-grid">
            @foreach($images as $image)
            <div class="gallery-card">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title ?? 'Изображение' }}" class="gallery-card__image">
                <div class="gallery-card__body">
                    <div class="gallery-card__title">{{ $image->title ?? 'Без названия' }}</div>
                    <span class="gallery-card__category">{{ $image->category }}</span>
                    <form action="{{ route('admin.gallery.delete', $image) }}" method="POST" onsubmit="return confirm('Удалить изображение?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            Галерея пуста. Загрузите первое изображение.
        </div>
        @endif
        
    </div>
</div>
@endsection