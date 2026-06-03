{{-- resources/views/home.blade.php --}}
@extends('layouts.app', ['headerClass' => 'header--transparent'])
@section('content')
<style>
    /* ==================================================================
       ДОПОЛНИТЕЛЬНЫЕ СТИЛИ ДЛЯ КАМЕР И ПОГОДЫ
    ================================================================== */
    .camera-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #03548a1d;
        transition: all 0.3s;
    }

    .camera-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(3, 83, 138, 0.1);
        border-color: #03548a40;
    }

    .camera-video-container {
        position: relative;
        background: #1a1a2e;
        aspect-ratio: 16/9;
        overflow: hidden;
    }

    .camera-video-container iframe,
    .camera-video-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: none;
    }

    .camera-live-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(4px);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 6px;
        z-index: 1;
    }

    .live-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ff4444;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
        100% { opacity: 1; transform: scale(1); }
    }

    .camera-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f5f7fa, #e4e8f0);
    }

    .camera-placeholder-content {
        text-align: center;
        color: #999;
    }

    .camera-placeholder-icon {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .camera-placeholder-content p {
        font-size: 13px;
    }

    .camera-info {
        padding: 16px 20px;
        background: white;
    }

    .camera-name {
        margin-bottom: 6px;
        font-size: 17px;
        font-weight: 700;
        color: #03538A;
    }

    .camera-location {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #888;
        font-size: 13px;
        margin: 0;
    }

    .camera-location svg {
        flex-shrink: 0;
    }

    /* Погода */
    .weather-container {
        padding: 20px 0;
    }

    .weather-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .weather-header h2 {
        font-size: 32px;
        color: #03538A;
        margin-bottom: 8px;
        text-align: center;
    }

    .weather-date {
        font-size: 14px;
        color: #888;
        font-weight: 400;
    }

    .weather-loader {
        text-align: center;
        padding: 40px;
        color: #888;
    }

    .loader-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid #03548a1d;
        border-top-color: #03538A;
        border-radius: 50%;
        margin: 0 auto 15px;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .ski-weather-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 20px;
    }

    .ski-weather-card {
        background: #fff;
        border: 1px solid #03548a1d;
        border-radius: 20px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s;
    }

    .ski-weather-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(3, 83, 138, 0.08);
        border-color: #03548a40;
    }

    .ski-weather-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: #03538A;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #03548a1d;
    }

    .ski-weather-icon img {
        width: 80px;
        height: 80px;
        margin: 10px auto;
    }

    .ski-weather-temp {
        font-size: 28px;
        font-weight: 700;
        color: #FF772D;
        margin: 12px 0;
    }

    .ski-weather-desc {
        color: #666;
        font-size: 14px;
        margin: 8px 0;
        text-transform: capitalize;
    }

    .ski-weather-details {
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid #f0f0f0;
    }

    .ski-weather-details p {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin: 8px 0;
        font-size: 13px;
        color: #888;
    }

    @media (max-width: 900px) {
        .ski-weather-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .ski-weather-card {
            padding: 20px;
        }
        .weather-header h2 {
            font-size: 28px;
        }
    }
</style>

<!-- Banner -->
<section class="banner">
    <div class="banner__content">
        <h1 class="banner__title">ГОРЫ</h1>
        <p class="banner__subtitle">ЗДЕСЬ начинается любовь к горам</p>
        <a href="{{ route('tariffs') }}" class="btn btn-banner">ТАРИФЫ</a>
    </div>
</section>

<!-- About -->
<section class="about" id="about">
    <div class="about__container">
        <div>
            <img src="{{ asset('images/about_img.svg') }}" alt="О курорте" class="about__image" id="aboutImage">
        </div>
        <div class="about_right">
            <h2 class="about__title">О НАС</h2>
            <p class="about__text">
                40 километров трасс любой сложности, скоростные подъемники без очередей, уютные шале у подножия и
                панорамные рестораны с видом на заснеженные вершины. Приезжайте за эмоциями, которые остаются с вами
                навсегда.
            </p>
            <a href="{{ route('about') }}" class="btn btn-banner">Подробнее</a>
        </div>
    </div>
</section>

<!-- Tabs: Trails & Cameras -->
<section class="tabs" id="tabs">
    <h2>КАТАНИЯ</h2>
    <div class="tabs__container">
        <div class="tabs__nav">
            <button class="tabs__btn active" data-tab="trails">Трассы</button>
            <button class="tabs__btn" data-tab="cameras">Камеры</button>
            <button class="tabs__btn" data-tab="weather">Погода</button>
        </div>

        <!-- Trails Tab -->
        <div class="tabs__content active" id="trails">
            <div class="trails-container">
                <div class="trails-table-wrapper">
                    <table class="trails-table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Перепад высот</th>
                                <th>Протяженность</th>
                                <th>Уровень</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slopes as $slope)
                            <tr>
                                <td class="trail-name">{{ $slope->name }}</td>
                                <td class="trail-elevation">{{ $slope->elevation }} м</td>
                                <td class="trail-length">{{ $slope->length }} м</td>
                                <td class="trail-difficulty">
                                    @php
                                        $difficultyMap = [
                                            'beginner' => ['class' => 'difficulty-beginner', 'text' => 'Начинающий', 'color' => '#27ae60'],
                                            'intermediate' => ['class' => 'difficulty-intermediate', 'text' => 'Средний', 'color' => '#2980b9'],
                                            'advanced' => ['class' => 'difficulty-advanced', 'text' => 'Продвинутый', 'color' => '#e74c3c'],
                                            'expert' => ['class' => 'difficulty-expert', 'text' => 'Эксперт', 'color' => '#2c3e50'],
                                        ];
                                        $difficulty = $difficultyMap[$slope->difficulty] ?? $difficultyMap['beginner'];
                                    @endphp
                                    <span class="difficulty-badge {{ $difficulty['class'] }}">
                                        <span class="difficulty-dot" style="background: {{ $difficulty['color'] }};"></span>
                                        {{ $difficulty['text'] }}
                                    </span>
                                </td>
                                <td class="trail-status">
                                    <span class="status-badge {{ $slope->status == 'open' ? 'status-open' : 'status-closed' }}">
                                        {{ $slope->status == 'open' ? 'Открыта' : 'Закрыта' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cameras Tab -->
        <div class="tabs__content" id="cameras">
            <div class="cameras-slider-container">
                <button class="slider-arrow slider-arrow-prev" id="camerasPrevBtn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div class="cameras-slider-wrapper">
                    <div class="cameras-slider" id="camerasSlider">
                        @foreach($cameras as $camera)
                        <div class="camera-slide">
                            <div class="camera-card">
                                <div class="camera-video-container">
                                    @if($camera->is_active && $camera->stream_url)
                                        @if(str_contains($camera->stream_url, 'youtube.com') || str_contains($camera->stream_url, 'vkvideo.ru'))
                                            <iframe src="{{ $camera->stream_url }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        @else
                                            <img src="{{ $camera->stream_url }}" alt="{{ $camera->name }}">
                                        @endif
                                    @else
                                        <div class="camera-placeholder">
                                            <div class="camera-placeholder-content">
                                                <div class="camera-placeholder-icon">🎥</div>
                                                <p>Камера временно недоступна</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="camera-live-badge">
                                        <span class="live-dot"></span> LIVE
                                    </div>
                                </div>
                                <div class="camera-info">
                                    <h3 class="camera-name">{{ $camera->name }}</h3>
                                    <p class="camera-location">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        {{ $camera->location }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="slider-arrow slider-arrow-next" id="camerasNextBtn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="slider-dots" id="camerasDots"></div>
        </div>

        <!-- Weather Tab -->
        <div class="tabs__content" id="weather">
            <div class="weather-container">
                <div class="weather-header">
                    <h2>Погода на склонах</h2>
                    <p class="weather-date data"></p>
                </div>
                <div id="ski-weather-widget">
                    <div class="weather-loader">
                        <div class="loader-spinner"></div>
                        <p>Загружаем сводку с вершин...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="gallery" id="gallery">
    <div class="gallery__container">
        <h2>ФОТОГАЛЕРЕЯ</h2>
        
        <div class="gallery__slider">
            <div class="gallery__track" id="galleryTrack">
                @foreach($gallery as $index => $item)
                <div class="gallery__slide" data-index="{{ $index }}">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" loading="lazy">
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="gallery__nav" id="galleryNav">
            @foreach($gallery as $index => $item)
            <div class="gallery__dot {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq" id="faq">
    <div class="faq__container">
        <h2>ВОПРОСЫ И ОТВЕТЫ</h2>
        @foreach($faqs as $faq)
        <div class="faq__item">
            <div class="faq__question">
                {{ $faq['question'] }}
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq__answer">
                {{ $faq['answer'] }}
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- News Section -->
<section class="news-section">
    <div class="news-container">
        <h2 class="news-title">НОВОСТИ</h2>
        <div class="news-grid">
            @foreach($news as $item)
            <article class="news-card">
                <div class="news-card__image">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                    <div class="news-card__placeholder">📰</div>
                    @endif
                    <div class="news-card__date">
                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d.m.Y') : '' }}
                    </div>
                </div>
                <div class="news-card__body">
                    <h3 class="news-card__title">{{ $item->title }}</h3>
                    <a href="{{ route('news.show', $item) }}" class="btn-news">Узнать больше</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Форматирование даты и времени
    function formatDateTime() {
        const now = new Date();
        const dateOptions = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
        const date = now.toLocaleDateString('ru-RU', dateOptions);
        const time = now.toLocaleTimeString('ru-RU', timeOptions);
        return `Погода сейчас, ${date} | ${time}`;
    }

    function updateWeatherDate() {
        const dataElement = document.querySelector('.data');
        if (dataElement) dataElement.textContent = formatDateTime();
    }

    // Погода
    document.addEventListener('DOMContentLoaded', () => {
        updateWeatherDate();
        setInterval(updateWeatherDate, 1000);
        
        const widget = document.getElementById('ski-weather-widget');
        if (widget) {
            fetch('/weather')
                .then(response => response.json())
                .then(data => {
                    if (!data || !data.weather) {
                        widget.innerHTML = '<p style="text-align: center;">Не удалось загрузить погоду</p>';
                        return;
                    }
                    renderSkiWeatherWidget(data);
                })
                .catch(() => {
                    widget.innerHTML = '<p style="text-align: center;">Ошибка загрузки погоды</p>';
                });
        }
    });

    function renderSkiWeatherWidget(data) {
        const weather = data.weather[0];
        const widget = document.getElementById('ski-weather-widget');

        let html = '<div class="ski-weather-grid">';

        // Вершина
        html += `
            <div class="ski-weather-card">
                <h3>Вершина</h3>
                <div class="ski-weather-icon">
                    <img src="${weather.top[0].weatherIconUrl[0].value}" alt="Погода">
                </div>
                <div class="ski-weather-temp">${weather.top[0].tempMaxC}° / ${weather.top[0].tempMinC}°</div>
                <div class="ski-weather-desc">${weather.top[0].weatherDesc[0].value}</div>
                <div class="ski-weather-details">
                    <p>Ветер: ${weather.top[0].windspeedKmph} км/ч</p>
                    <p>Снегопад: ${weather.top[0].totalSnowfall_cm} см</p>
                </div>
            </div>`;

        // Середина
        html += `
            <div class="ski-weather-card">
                <h3>Середина</h3>
                <div class="ski-weather-icon">
                    <img src="${weather.mid[0].weatherIconUrl[0].value}" alt="Погода">
                </div>
                <div class="ski-weather-temp">${weather.mid[0].tempMaxC}° / ${weather.mid[0].tempMinC}°</div>
                <div class="ski-weather-desc">${weather.mid[0].weatherDesc[0].value}</div>
                <div class="ski-weather-details">
                    <p>Ветер: ${weather.mid[0].windspeedKmph} км/ч</p>
                    <p>Снегопад: ${weather.mid[0].totalSnowfall_cm} см</p>
                </div>
            </div>`;

        // Подножие
        html += `
            <div class="ski-weather-card">
                <h3>Подножие</h3>
                <div class="ski-weather-icon">
                    <img src="${weather.bottom[0].weatherIconUrl[0].value}" alt="Погода">
                </div>
                <div class="ski-weather-temp">${weather.bottom[0].tempMaxC}° / ${weather.bottom[0].tempMinC}°</div>
                <div class="ski-weather-desc">${weather.bottom[0].weatherDesc[0].value}</div>
                <div class="ski-weather-details">
                    <p>Ветер: ${weather.bottom[0].windspeedKmph} км/ч</p>
                    <p>Снегопад: ${weather.bottom[0].totalSnowfall_cm} см</p>
                </div>
            </div>`;

        html += '</div>';
        widget.innerHTML = html;
    }

    // Анимация изображения
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.3 });
    const aboutImage = document.getElementById('aboutImage');
    if (aboutImage) observer.observe(aboutImage);

    // Слайдер камер
    function initCamerasSlider() {
        const slider = document.getElementById('camerasSlider');
        const prevBtn = document.getElementById('camerasPrevBtn');
        const nextBtn = document.getElementById('camerasNextBtn');
        const dotsContainer = document.getElementById('camerasDots');
        if (!slider || !prevBtn || !nextBtn) return;

        const slides = document.querySelectorAll('.camera-slide');
        const slidesCount = slides.length;
        if (slidesCount === 0) return;

        let currentIndex = 0;
        let slidesPerView = getSlidesPerView();
        let maxIndex = Math.max(0, slidesCount - slidesPerView);

        const totalDots = Math.ceil(slidesCount / slidesPerView);
        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('div');
            dot.classList.add('slider-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i * slidesPerView));
            dotsContainer.appendChild(dot);
        }

        function getSlidesPerView() {
            const width = window.innerWidth;
            if (width <= 768) return 1;
            if (width <= 1024) return 2;
            return 3;
        }

        function updateSlider() {
            slidesPerView = getSlidesPerView();
            maxIndex = Math.max(0, slidesCount - slidesPerView);
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            if (currentIndex < 0) currentIndex = 0;

            const slideWidth = slides[0]?.offsetWidth || 0;
            const gap = 20;
            const offset = -(currentIndex * (slideWidth + gap));
            slider.style.transform = `translateX(${offset}px)`;

            const activeDotIndex = Math.floor(currentIndex / slidesPerView);
            const dots = document.querySelectorAll('.slider-dot');
            dots.forEach((dot, idx) => dot.classList.toggle('active', idx === activeDotIndex));

            prevBtn.style.opacity = currentIndex <= 0 ? '0.5' : '1';
            prevBtn.style.cursor = currentIndex <= 0 ? 'not-allowed' : 'pointer';
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
            nextBtn.style.cursor = currentIndex >= maxIndex ? 'not-allowed' : 'pointer';
        }

        function goToSlide(index) {
            currentIndex = Math.min(maxIndex, Math.max(0, index));
            updateSlider();
        }

        prevBtn.addEventListener('click', () => { if (currentIndex > 0) { currentIndex--; updateSlider(); } });
        nextBtn.addEventListener('click', () => { if (currentIndex < maxIndex) { currentIndex++; updateSlider(); } });

        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const newSlidesPerView = getSlidesPerView();
                const newTotalDots = Math.ceil(slidesCount / newSlidesPerView);
                if (newTotalDots !== dotsContainer.children.length) {
                    dotsContainer.innerHTML = '';
                    for (let i = 0; i < newTotalDots; i++) {
                        const dot = document.createElement('div');
                        dot.classList.add('slider-dot');
                        if (i === Math.floor(currentIndex / newSlidesPerView)) dot.classList.add('active');
                        dot.addEventListener('click', () => goToSlide(i * newSlidesPerView));
                        dotsContainer.appendChild(dot);
                    }
                }
                updateSlider();
            }, 200);
        });
        updateSlider();
    }

    // Галерея
    let currentSlide = 0;
    let totalSlides = document.querySelectorAll('.gallery__slide').length;
    let autoPlayInterval;

    function getPosition(index) {
        let diff = index - currentSlide;
        if (diff > totalSlides / 2) diff -= totalSlides;
        if (diff < -totalSlides / 2) diff += totalSlides;
        return diff;
    }

    function updateSlider() {
        const slides = document.querySelectorAll('.gallery__slide');
        const dots = document.querySelectorAll('.gallery__dot');
        slides.forEach((slide, index) => {
            slide.className = 'gallery__slide';
            const pos = getPosition(index);
            switch(pos) {
                case 0: slide.classList.add('gallery__slide--center'); break;
                case 1: case -(totalSlides - 1): slide.classList.add('gallery__slide--right1'); break;
                case 2: case -(totalSlides - 2): slide.classList.add('gallery__slide--right2'); break;
                case -1: case totalSlides - 1: slide.classList.add('gallery__slide--left1'); break;
                case -2: case totalSlides - 2: slide.classList.add('gallery__slide--left2'); break;
                default: slide.classList.add('gallery__slide--hidden');
            }
        });
        dots.forEach((dot, i) => dot.classList.toggle('active', i === currentSlide));
    }

    function nextSlide() { currentSlide = (currentSlide + 1) % totalSlides; updateSlider(); resetAutoPlay(); }
    function prevSlide() { currentSlide = (currentSlide - 1 + totalSlides) % totalSlides; updateSlider(); resetAutoPlay(); }
    function goToSlide(index) { currentSlide = index; updateSlider(); resetAutoPlay(); }
    function resetAutoPlay() { clearInterval(autoPlayInterval); autoPlayInterval = setInterval(nextSlide, 4000); }

    document.querySelectorAll('.gallery__slide').forEach(slide => {
        slide.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            if (index !== currentSlide) goToSlide(index);
        });
    });

    let touchStartX = 0;
    const track = document.querySelector('.gallery__track');
    if (track) {
        track.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; });
        track.addEventListener('touchend', (e) => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) diff > 0 ? nextSlide() : prevSlide();
        });
    }

    updateSlider();
    autoPlayInterval = setInterval(nextSlide, 4000);
    
    document.addEventListener('DOMContentLoaded', initCamerasSlider);
</script>
@endpush
@endsection