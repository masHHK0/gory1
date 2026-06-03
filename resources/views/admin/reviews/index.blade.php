{{-- resources/views/admin/reviews/index.blade.php --}}
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

    .table-section {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border);
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
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
        white-space: nowrap;
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

    .col-id { width: 60px; }
    .col-user { width: 160px; }
    .col-type { width: 110px; }
    .col-rating { width: 130px; }
    .col-comment { }
    .col-status { width: 130px; }
    .col-actions { width: 180px; }

    .review-user {
        font-weight: 600;
        color: var(--text);
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .review-user-email {
        font-size: 11px;
        color: var(--text-light);
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .review-type {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 10px;
        font-weight: 600;
        background: #f8f9fb;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .review-rating {
        color: var(--accent);
        font-size: 15px;
        letter-spacing: 2px;
        white-space: nowrap;
    }

    .comment-cell {
        position: relative;
    }

    .comment-preview {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        font-size: 13px;
        color: var(--text-light);
        word-break: break-word;
    }

    .comment-read-btn {
        font-size: 11px;
        color: var(--accent);
        cursor: pointer;
        font-weight: 600;
        background: none;
        border: none;
        padding: 2px 0;
        margin-top: 4px;
        font-family: 'M', sans-serif;
    }
    .comment-read-btn:hover {
        color: var(--primary);
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-approved {
        background: var(--primary);
        color: #fff;
    }

    .status-pending {
        background: var(--accent);
        color: #fff;
    }

    .btn {
        padding: 8px 14px;
        width: 110px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 11px;
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
        white-space: nowrap;
        height: 34px;
        box-sizing: border-box;
    }

    .btn-approve {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }
    .btn-approve:hover {
        background: #fff;
        color: var(--primary);
        border-color: var(--primary);
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

    .actions-cell {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .empty-row td {
        text-align: center;
        color: var(--text-light);
        padding: 60px;
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
    max-width: 500px;
    overflow-y: visible;
    max-height: none;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--border);
}

.modal-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.modal-close {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #ccc;
    padding: 0;
    line-height: 1;
}
.modal-close:hover {
    color: var(--text);
}

.modal-rating {
    color: var(--accent);
    font-size: 22px;
    letter-spacing: 3px;
    margin-bottom: 16px;
}

.modal-user {
    font-size: 15px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 4px;
}

.modal-email {
    font-size: 12px;
    color: var(--text-light);
    margin-bottom: 12px;
}

.modal-type-status {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
}

.modal-comment {
    font-size: 14px;
    color: var(--text);
    line-height: 1.8;
    background: #f8f9fb;
    padding: 16px;
    border-radius: 12px;
    word-wrap: break-word;
    white-space: normal;
}

.modal-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

    @media (max-width: 768px) {
        .admin-table {
            table-layout: auto;
        }
        .actions-cell {
            flex-direction: column;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">
        
        <div class="admin-header">
            <h1 class="admin-title">Управление отзывами</h1>
            <a href="{{ route('admin.dashboard') }}" class="admin-back">← Панель управления</a>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="table-section">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-user">Пользователь</th>
                        <th class="col-type">Тип</th>
                        <th class="col-rating">Рейтинг</th>
                        <th class="col-comment">Комментарий</th>
                        <th class="col-status">Статус</th>
                        <th class="col-actions">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td><strong>#{{ $review->id }}</strong></td>
                        <td>
                            <span class="review-user" title="{{ $review->user->name }}">{{ $review->user->name }}</span>
                            <span class="review-user-email" title="{{ $review->user->email }}">{{ $review->user->email }}</span>
                        </td>
                        <td>
                            <span class="review-type">
                                @if($review->instructor_id) Инструктор
                                @elseif($review->hotel_id) Отель
                                @else Общий
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="review-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating) ★ @else ☆ @endif
                                @endfor
                            </span>
                        </td>
                        <td class="comment-cell">
                            <div class="comment-preview">{{ $review->comment }}</div>
                            @if(mb_strlen($review->comment) > 80)
                            <button class="comment-read-btn" onclick="openReviewModal({{ $review->id }})">Читать полностью</button>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $review->is_approved ? 'status-approved' : 'status-pending' }}">
                                {{ $review->is_approved ? 'Одобрен' : 'На модерации' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                @if(!$review->is_approved)
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-approve">Одобрить</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.reviews.delete', $review) }}" method="POST" onsubmit="return confirm('Удалить отзыв?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="7">Отзывы не добавлены</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>

{{-- Модальное окно --}}
<div class="modal-overlay" id="reviewModal">
    <div class="modal-content" style="overflow-y: visible; max-height: none;">
        <div class="modal-header">
            <h3 class="modal-title">Отзыв #<span id="modalId"></span></h3>
            <button class="modal-close" onclick="closeReviewModal()">&times;</button>
        </div>
        
        <div class="modal-user" id="modalUser"></div>
        <div class="modal-email" id="modalEmail"></div>
        
        <div class="modal-type-status">
            <span class="review-type" id="modalType"></span>
            <span class="status-badge" id="modalStatus"></span>
        </div>
        
        <div class="modal-rating" id="modalRating"></div>
        <div class="modal-comment" id="modalComment" style="word-wrap: break-word; white-space: normal;"></div>
        
        <div class="modal-actions">
            <button class="btn btn-approve" id="modalApproveBtn" style="display: none;" onclick="approveFromModal()">Одобрить</button>
            <button class="btn btn-danger" onclick="deleteFromModal()">Удалить</button>
        </div>
    </div>
</div>

<script>
const reviewsData = @json($reviews->keyBy('id'));
let currentReviewId = null;

function openReviewModal(reviewId) {
    const review = reviewsData[reviewId];
    if (!review) return;
    
    currentReviewId = reviewId;
    
    const typeText = review.instructor_id ? 'Инструктор' : (review.hotel_id ? 'Отель' : 'Общий');
    const statusText = review.is_approved ? 'Одобрен' : 'На модерации';
    
    document.getElementById('modalId').textContent = review.id;
    document.getElementById('modalUser').textContent = review.user.name;
    document.getElementById('modalEmail').textContent = review.user.email;
    document.getElementById('modalType').textContent = typeText;
    
    const statusEl = document.getElementById('modalStatus');
    statusEl.textContent = statusText;
    statusEl.className = 'status-badge ' + (review.is_approved ? 'status-approved' : 'status-pending');
    
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += (i <= review.rating) ? '★' : '☆';
    }
    document.getElementById('modalRating').textContent = stars;
    document.getElementById('modalComment').textContent = review.comment || 'Нет комментария';
    
    const approveBtn = document.getElementById('modalApproveBtn');
    approveBtn.style.display = review.is_approved ? 'none' : 'inline-flex';
    
    document.getElementById('reviewModal').classList.add('active');
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.remove('active');
    currentReviewId = null;
}

function approveFromModal() {
    if (!currentReviewId) return;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('admin.reviews.approve', '') }}/" + currentReviewId;
    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
    document.body.appendChild(form);
    form.submit();
}

function deleteFromModal() {
    if (!currentReviewId) return;
    if (!confirm('Удалить отзыв?')) return;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('admin.reviews.delete', '') }}/" + currentReviewId;
    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">';
    document.body.appendChild(form);
    form.submit();
}

document.getElementById('reviewModal').addEventListener('click', function(e) {
    if (e.target === this) closeReviewModal();
});
</script>
@endsection