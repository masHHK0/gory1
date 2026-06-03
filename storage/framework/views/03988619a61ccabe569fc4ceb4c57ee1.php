


<?php $__env->startSection('content'); ?>
    <style>
        .news-page {
            padding: 60px 0 80px;
        }

        .news-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .news-page h2 {
            font-size: 45px;
            color: #03538A;
            text-align: center;
            font-family: R;
            margin-bottom: 50px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 24px;
        }

        .news-card {
            border: 1px solid #03548a1d;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.35s;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            border-color: #03548a40;
        }

        .news-card__image {
            height: 220px;
            overflow: hidden;
            background: #f5f6f8;
        }

        .news-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .news-card:hover .news-card__image img {
            transform: scale(1.04);
        }

        .news-card__placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #e8ecf1, #d5dbe3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .news-card__placeholder svg {
            width: 48px;
            height: 48px;
            color: #ccc;
        }

        .news-card__body {
            padding: 22px 24px 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .news-card__date {
            font-size: 12px;
            font-weight: 600;
            color: #FF772D;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .news-card__title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 50px;
        }

        .news-card__text {
            font-size: 14px;
            color: #888;
            line-height: 1.7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-card__link {
            font-size: 14px;
            font-weight: 600;
            color: #03538A;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.2s;
            margin-top: auto;
        }

        .news-card__link:hover {
            gap: 10px;
        }

        .news-empty {
            text-align: center;
            color: #aaa;
            padding: 80px 0;
            font-size: 16px;
        }

        /* Пагинация */
        .news-pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }

        .news-pagination a,
        .news-pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            border: 1px solid #eef0f2;
            color: #888;
            background: #fff;
        }

        .news-pagination a:hover {
            border-color: #03538A;
            color: #03538A;
        }

        .news-pagination .active {
            background: #03538A;
            color: #fff;
            border-color: #03538A;
        }

        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr;
            }

            .news-page h2 {
                font-size: 32px;
            }
        }
    </style>

    <div class="news-page">
        <div class="news-container">
            <h2>НОВОСТИ КУРОРТА</h2>

            <?php if($news->count() > 0): ?>
                <div class="news-grid">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="news-card">
                            <div class="news-card__image">
                                <?php if($item->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->title); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="news-card__placeholder">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="2" y="2" width="20" height="20" rx="3" />
                                            <circle cx="8.5" cy="8.5" r="2" />
                                            <path d="M22 15l-5-5-8 8-3-3-4 4" />
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="news-card__body">
                                <time class="news-card__date">
                                    <?php echo e($item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d.m.Y') : ''); ?>

                                </time>
                                <h3 class="news-card__title"><?php echo e($item->title); ?></h3>
                                <p class="news-card__text"><?php echo e(Str::limit(strip_tags($item->content), 120)); ?></p>
                                <a href="<?php echo e(route('news.show', $item)); ?>" class="news-card__link">
                                    Читать далее <span>→</span>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($news->hasPages()): ?>
                    <div class="news-pagination">
                        <?php echo e($news->links()); ?>

                    </div>
                <?php endif; ?>

            <?php else: ?>
                <p class="news-empty">Новостей пока нет</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\gory\resources\views/news/index.blade.php ENDPATH**/ ?>