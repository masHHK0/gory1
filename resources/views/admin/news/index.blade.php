{{-- resources/views/admin/news/index.blade.php --}}
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

    .admin-page {
        background: var(--bg);
        min-height: 100vh;
        padding: 40px 0 80px;
    }

    .admin-container {
        max-width: 1000px;
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

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
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
        min-height: 120px;
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

    .form-input[type="file"]::file-selector-button:hover {
        background: #eef0f2;
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

    /* Таблица */
    .table-section {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        text-align: left;
        padding: 14px 16px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        font-weight: 700;
        border-bottom: 2px solid var(--border);
        white-space: nowrap;
    }

    .admin-table td {
        padding: 14px 16px;
        font-size: 14px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .admin-table tr:hover td {
        background: #fafbfc;
    }

    .news-title-cell {
        font-weight: 600;
        color: var(--text);
    }

    .news-date {
        color: var(--text-light);
        font-size: 13px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-published {
        background: var(--primary);
        color: #fff;
    }

    .status-draft {
        background: var(--accent);
        color: #fff;
    }

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 60px;
        font-size: 15px;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 20px;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление новостями</h1>
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
                <h3 class="form-section__title">Добавить новость</h3>
            </div>
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Заголовок</label>
                    <input type="text" name="title" class="form-input" placeholder="Введите заголовок новости" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Содержание</label>
                    <textarea name="content" class="form-textarea" rows="5" placeholder="Текст новости..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Изображение</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                    <span class="form-hint">Рекомендуемый размер: 1200x600 пикселей</span>
                </div>
                
                <button type="submit" class="btn btn-primary">Опубликовать новость</button>
            </form>
        </div>

        {{-- Таблица новостей --}}
        <h2 class="section-title">Все новости</h2>
        
        <div class="table-section">
            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Заголовок</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                        <tr>
                            <td><strong>#{{ $item->id }}</strong></td>
                            <td>
                                <span class="news-title-cell">{{ Str::limit($item->title, 50) }}</span>
                            </td>
                            <td>
                                <span class="news-date">
                                    {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d.m.Y H:i') : '—' }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $item->is_published ? 'status-published' : 'status-draft' }}">
                                    {{ $item->is_published ? 'Опубликована' : 'Черновик' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.news.delete', $item) }}" method="POST" onsubmit="return confirm('Удалить новость?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="empty-row">
                            <td colspan="5">Новости не добавлены</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection