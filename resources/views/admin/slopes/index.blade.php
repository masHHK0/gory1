{{-- resources/views/admin/slopes/index.blade.php --}}
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

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(3, 83, 138, 0.06);
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

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        text-align: left;
        padding: 14px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        font-weight: 700;
        border-bottom: 2px solid var(--border);
    }

    .admin-table td {
        padding: 12px;
        font-size: 13px;
        color: var(--text);
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .admin-table tr:hover td {
        background: #fafbfc;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
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

    /* Стили для сложности как в мега-меню */
    .difficulty {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .dot--green {
        background-color: #27ae60;
        box-shadow: 0 0 0 2px rgba(39, 174, 96, 0.2);
    }

    .dot--blue {
        background-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .dot--red {
        background-color: #e74c3c;
        box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.2);
    }

    .dot--black {
        background-color: #2c3e50;
        box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.2);
    }

    .difficulty-text {
        font-size: 13px;
        font-weight: 500;
        color: var(--text);
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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
        .admin-table {
            display: block;
            overflow-x: auto;
        }
        .actions-cell {
            flex-direction: column;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление трассами</h1>
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
                <h3 class="form-section__title">Добавить трассу</h3>
            </div>
            <form action="{{ route('admin.slopes.store') }}" method="POST">
                @csrf
                <div class="form-grid-4">
                    <div class="form-group">
                        <label class="form-label">Название</label>
                        <input type="text" name="name" class="form-input" required placeholder="Название трассы">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Сложность</label>
                        <select name="difficulty" class="form-select" required>
                            <option value="beginner">Начинающий</option>
                            <option value="intermediate">Средний</option>
                            <option value="advanced">Продвинутый</option>
                            <option value="expert">Эксперт</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Длина (м)</label>
                        <input type="number" name="length" class="form-input" required placeholder="1200">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Перепад высот (м)</label>
                        <input type="number" name="elevation" class="form-input" required placeholder="300">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Статус</label>
                        <select name="status" class="form-select" required>
                            <option value="open">Открыта</option>
                            <option value="closed">Закрыта</option>
                            <option value="maintenance">Обслуживание</option>
                        </select>
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-label">Описание</label>
                        <textarea name="description" class="form-textarea" rows="2" placeholder="Описание трассы..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Добавить трассу</button>
            </form>
        </div>

        {{-- Список трасс --}}
        <h2 class="section-title">Все трассы</h2>
        
        @if($slopes->count() > 0)
        <div class="table-section">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Сложность</th>
                        <th>Длина (м)</th>
                        <th>Перепад (м)</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slopes as $slope)
                    <tr>
                        <td>#{{ $slope->id }}</td>
                        <td><strong>{{ $slope->name }}</strong></td>
                        <td>
                            <div class="difficulty">
                                @switch($slope->difficulty)
                                    @case('beginner')
                                        <span class="dot dot--green"></span>
                                        <span class="difficulty-text">Начинающий</span>
                                        @break
                                    @case('intermediate')
                                        <span class="dot dot--blue"></span>
                                        <span class="difficulty-text">Средний</span>
                                        @break
                                    @case('advanced')
                                        <span class="dot dot--red"></span>
                                        <span class="difficulty-text">Продвинутый</span>
                                        @break
                                    @case('expert')
                                        <span class="dot dot--black"></span>
                                        <span class="difficulty-text">Эксперт</span>
                                        @break
                                @endswitch
                            </div>
                        </td>
                        <td>{{ $slope->length }}</td>
                        <td>{{ $slope->elevation }}</td>
                        <td>
                            <span class="status-badge status-{{ $slope->status }}">
                                @switch($slope->status)
                                    @case('open') Открыта @break
                                    @case('closed') Закрыта @break
                                    @case('maintenance') Обслуживание @break
                                @endswitch
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <button onclick="openEditModal({{ $slope }})" class="btn btn-primary btn-sm">Редактировать</button>
                                <form action="{{ route('admin.slopes.delete', $slope) }}" method="POST" onsubmit="return confirm('Удалить трассу «{{ $slope->name }}»?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            Трассы ещё не добавлены
        </div>
        @endif
    </div>
</div>

{{-- Модальное окно редактирования --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <h3 class="modal-title">Редактировать трассу</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Название</label>
                    <input type="text" name="name" id="edit_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Сложность</label>
                    <select name="difficulty" id="edit_difficulty" class="form-select" required>
                        <option value="beginner">Начинающий</option>
                        <option value="intermediate">Средний</option>
                        <option value="advanced">Продвинутый</option>
                        <option value="expert">Эксперт</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Длина (м)</label>
                    <input type="number" name="length" id="edit_length" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Перепад высот (м)</label>
                    <input type="number" name="elevation" id="edit_elevation" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Статус</label>
                    <select name="status" id="edit_status" class="form-select" required>
                        <option value="open">Открыта</option>
                        <option value="closed">Закрыта</option>
                        <option value="maintenance">Обслуживание</option>
                    </select>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Описание</label>
                    <textarea name="description" id="edit_description" class="form-textarea" rows="3"></textarea>
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
function openEditModal(slope) {
    document.getElementById('edit_name').value = slope.name;
    document.getElementById('edit_difficulty').value = slope.difficulty;
    document.getElementById('edit_length').value = slope.length;
    document.getElementById('edit_elevation').value = slope.elevation;
    document.getElementById('edit_status').value = slope.status;
    document.getElementById('edit_description').value = slope.description || '';
    document.getElementById('editForm').action = "{{ route('admin.slopes.update', '') }}/" + slope.id;
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