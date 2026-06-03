{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ГОРЫ - Горнолыжный курорт</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('images/logo_fav.svg') }}" type="image/x-icon">
    <style>
        /* ==================================================================
           МОБИЛЬНОЕ МЕНЮ (выезжает справа) - ДЛЯ ЭКРАНОВ 500px И МЕНЬШЕ
        ================================================================== */
        @media (max-width: 500px) {
            /* Скрываем обычную навигацию */
            .header__nav {
                display: none !important;
            }
            
            /* Кнопка бургера */
            .header__menu-toggle {
                display: block !important;
                background: none;
                border: none;
                color: white;
                font-size: 24px;
                cursor: pointer;
                padding: 8px;
                z-index: 10001;
            }
            
            /* Оверлей (затемнение фона) */
            .mobile-menu-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;

                backdrop-filter: blur(4px);
                z-index: 10000;
                transition: all 0.3s ease;
            }
            
            .mobile-menu-overlay.active {
                display: block;
            }
            
            /* Мобильное меню (выезжает СПРАВА) */
            .mobile-menu {
                position: fixed;
                top: 0;
                right: -320px;
                width: 320px;
                height: 100%;
                    background: #00000036;
    backdrop-filter: blur(20px);
                z-index: 10001;
                transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
                overflow-y: auto;

            }
            
            .mobile-menu.active {
                right: 0;
            }
            
            /* Шапка мобильного меню */
            .mobile-menu-header {
                padding: 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: rgba(0, 0, 0, 0.1);
            }
            
            .mobile-menu-logo {
                display: flex;
                align-items: center;
                flex-direction: column;
                text-decoration: none;
            }
            
            .mobile-menu-logo img {
                width: 55px;
                height: auto;
            }
            
            .mobile-menu-logo p {
                font-family: R;
                font-size: 16px;
                color: white;
                margin-top: -4px;
            }
            
            .mobile-menu-close {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: white;
                font-size: 20px;
                cursor: pointer;
                padding: 10px;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s;
            }
            
            .mobile-menu-close:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }
            
            /* Поиск в мобильном меню */
            .mobile-search {
                padding: 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .mobile-search-input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 30px;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                font-size: 14px;
                font-family: M;
                transition: all 0.3s;
            }
            
            .mobile-search-input:focus {
                outline: none;
                border-color: var(--accent);
                background: rgba(255, 255, 255, 0.15);
            }
            
            .mobile-search-input::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }
            
            /* Навигация мобильного меню */
            .mobile-menu-nav {
                padding: 20px;
            }
            
            .mobile-menu-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            
            .mobile-menu-item {
                margin-bottom: 8px;
            }
            
            .mobile-menu-link {
                display: flex;
                align-items: center;
                justify-content: space-between;
                color: white;
                text-decoration: none;
                font-size: 16px;
                font-weight: 500;
                padding: 14px 12px;
                border-radius: 12px;
                transition: all 0.3s;
            }
            
            .mobile-menu-link:hover {
                background: rgba(255, 255, 255, 0.1);
            }
            
            .mobile-menu-link i {
                font-size: 12px;
                transition: transform 0.3s;
            }
            
            .mobile-menu-link.active i {
                transform: rotate(180deg);
            }
            
            /* Подменю */
            .mobile-submenu {
                display: none;
                padding-left: 20px;
                margin-top: 4px;
                margin-bottom: 8px;
            }
            
            .mobile-submenu.active {
                display: block;
                animation: fadeIn 0.3s ease;
            }
            
            .mobile-submenu-link {
                display: flex;
                align-items: center;
                gap: 10px;
                color: rgba(255, 255, 255, 0.75);
                text-decoration: none;
                font-size: 14px;
                padding: 10px 12px;
                border-radius: 10px;
                transition: all 0.3s;
            }
            
            .mobile-submenu-link:hover {
                background: rgba(255, 255, 255, 0.08);
                color: var(--accent);
                padding-left: 16px;
            }
            
            .mobile-submenu-link .dot {
                width: 10px;
                height: 10px;
            }
            
            /* Блок авторизации */
            .mobile-auth {
                padding: 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 20px;
            }
            
            .mobile-user-info {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px;
                background: rgba(255, 255, 255, 0.08);
                border-radius: 14px;
                margin-bottom: 16px;
            }
            
            .mobile-user-avatar {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                background: var(--accent);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                font-weight: 700;
                color: #fff;
                flex-shrink: 0;
            }
            
            .mobile-user-name {
                color: white;
                font-weight: 600;
                font-size: 15px;
            }
            
            .mobile-user-email {
                color: rgba(255, 255, 255, 0.6);
                font-size: 12px;
            }
            
            .mobile-auth .btn {
                display: block;
                width: 100%;
                text-align: center;
                padding: 12px;
                font-size: 14px;
                margin-bottom: 10px;
            }
            
            .mobile-auth .btn:last-child {
                margin-bottom: 0;
            }
            
            /* Анимации */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Полоса прокрутки */
            .mobile-menu::-webkit-scrollbar {
                width: 4px;
            }
            
            .mobile-menu::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
            }
            
            .mobile-menu::-webkit-scrollbar-thumb {
                background: var(--accent);
                border-radius: 4px;
            }
        }
        
        /* Десктоп (больше 500px) */
        @media (min-width: 501px) {
            .header__menu-toggle {
                display: none !important;
            }
            
            .mobile-menu,
            .mobile-menu-overlay {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <header class="header {{ $headerClass ?? '' }}">
        <div class="header__container">
            <a href="{{ route('home') }}" class="header__logo">
                <img src="{{ asset('images/logo.svg') }}" alt="">
                <p>ГОРЫ</p>
            </a>

            <!-- Обычное меню для десктопа -->
            <nav class="header__nav">
                <ul class="header__menu">
                    <li><a href="{{ route('home') }}" class="header__menu-link">Главная</a></li>

                    <li class="header__menu-item mega-dropdown">
                        <a href="#" class="header__menu-link">О курорте <i class="fas fa-chevron-down"></i></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner">
                                <div class="mega-menu__col">
                                    <div class="mega-menu__label">Информация</div>
                                    <a href="{{ route('about') }}" class="mega-menu__link">О курорте</a>
                                    <a href="{{ route('rules') }}" class="mega-menu__link">Правила катания</a>
                                    <a href="{{ route('getto') }}" class="mega-menu__link">Как добраться</a>
                                </div>
                                <div class="mega-menu__col">
                                    <div class="mega-menu__label">Новости</div>
                                    <a href="{{ route('news') }}" class="mega-menu__link">Все новости</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="header__menu-item mega-dropdown">
                        <a href="#" class="header__menu-link">Посетителям <i class="fas fa-chevron-down"></i></a>
                        <div class="mega-menu">
                            <div class="mega-menu__inner">
                                <div class="mega-menu__col">
                                    <div class="mega-menu__label">Катание</div>
                                    <a href="{{ route('slopes') }}" class="mega-menu__link">Все трассы</a>
                                    <a href="{{ route('slopes') }}?difficulty=beginner" class="mega-menu__link"><span class="dot dot--green"></span> Начинающие</a>
                                    <a href="{{ route('slopes') }}?difficulty=intermediate" class="mega-menu__link"><span class="dot dot--blue"></span> Средние</a>
                                    <a href="{{ route('slopes') }}?difficulty=advanced" class="mega-menu__link"><span class="dot dot--red"></span> Продвинутые</a>
                                    <a href="{{ route('slopes') }}?difficulty=expert" class="mega-menu__link"><span class="dot dot--black"></span> Экспертные</a>
                                </div>
                                <div class="mega-menu__col">
                                    <div class="mega-menu__label">Услуги</div>
                                    <a href="{{ route('instructors') }}" class="mega-menu__link">Инструкторы</a>
                                    <a href="{{ route('hotels') }}" class="mega-menu__link">Отели</a>
                                    <a href="{{ route('tariffs') }}" class="mega-menu__link">Тарифы</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li><a href="#footer" onclick="document.getElementById('footer').scrollIntoView({behavior:'smooth'});return false;" class="header__menu-link">Контакты</a></li>
                </ul>

                <div class="header__search">
                    <input type="text" class="header__search-input" placeholder="Поиск...">
                    <button class="header__search-btn"><img src="{{ asset('images/search.svg') }}" alt=""></button>
                </div>

                @auth
                    <div class="header__menu-item mega-dropdown" style="position:relative;">
                        <a href="#" class="btn btn--outline" style="display:flex;align-items:center;gap:8px;padding-right:16px;">
                            <span style="width:26px;height:26px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0;">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                            {{ Auth::user()->name }} <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                        </a>
                        <div class="mega-menu" style="min-width:300px;left:auto;right:-150px;top:calc(100% + 8px);">
                            <div class="mega-menu__inner" style="flex-direction:column;gap:2px;">
                                <a href="{{ route('profile') }}" class="mega-menu__link">Личный кабинет</a>
                                <a href="{{ route('bookings') }}" class="mega-menu__link">Мои бронирования</a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="mega-menu__link">Админ-панель</a>
                                @endif
                                <hr style="border:none;border-top:1px solid #eee;margin:6px 0;">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none;border:none;color:#e74c3c;cursor:pointer;padding:10px 12px;width:100%;text-align:left;font-size:14px;display:flex;align-items:center;gap:10px;border-radius:10px;">Выйти</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn--outline">Войти</a>
                @endauth
            </nav>

            <!-- Кнопка бургера для мобильных -->
            <button class="header__menu-toggle" id="burgerBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Мобильное меню (выезжает СПРАВА) -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <a href="{{ route('home') }}" class="mobile-menu-logo">
                <img src="{{ asset('images/logo.svg') }}" alt="">
                <p>ГОРЫ</p>
            </a>
            <button class="mobile-menu-close" id="closeMobileMenuBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-search">
            <input type="text" class="mobile-search-input" id="mobileSearchInput" placeholder="Поиск...">
        </div>
        
        <div class="mobile-menu-nav">
            <ul class="mobile-menu-list">
                <li class="mobile-menu-item">
                    <a href="{{ route('home') }}" class="mobile-menu-link">Главная</a>
                </li>
                
                <li class="mobile-menu-item">
                    <a href="#" class="mobile-menu-link" data-submenu="submenu-about">
                        О курорте <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="mobile-submenu" id="submenu-about">
                        <a href="{{ route('about') }}" class="mobile-submenu-link">О курорте</a>
                        <a href="{{ route('rules') }}" class="mobile-submenu-link">Правила катания</a>
                        <a href="{{ route('getto') }}" class="mobile-submenu-link">Как добраться</a>
                        <a href="{{ route('news') }}" class="mobile-submenu-link">Новости</a>
                    </div>
                </li>
                
                <li class="mobile-menu-item">
                    <a href="#" class="mobile-menu-link" data-submenu="submenu-visitors">
                        Посетителям <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="mobile-submenu" id="submenu-visitors">
                        <a href="{{ route('slopes') }}" class="mobile-submenu-link">Все трассы</a>
                        <a href="{{ route('slopes') }}?difficulty=beginner" class="mobile-submenu-link"><span class="dot dot--green"></span> Начинающие</a>
                        <a href="{{ route('slopes') }}?difficulty=intermediate" class="mobile-submenu-link"><span class="dot dot--blue"></span> Средние</a>
                        <a href="{{ route('slopes') }}?difficulty=advanced" class="mobile-submenu-link"><span class="dot dot--red"></span> Продвинутые</a>
                        <a href="{{ route('slopes') }}?difficulty=expert" class="mobile-submenu-link"><span class="dot dot--black"></span> Экспертные</a>
                        <a href="{{ route('instructors') }}" class="mobile-submenu-link">Инструкторы</a>
                        <a href="{{ route('hotels') }}" class="mobile-submenu-link">Отели</a>
                        <a href="{{ route('tariffs') }}" class="mobile-submenu-link">Тарифы</a>
                    </div>
                </li>
                
                <li class="mobile-menu-item">
                    <a href="#footer" class="mobile-menu-link" id="mobileContactsLink">Контакты</a>
                </li>
            </ul>
        </div>
        
        <div class="mobile-auth">
            @auth
                <div class="mobile-user-info">
                    <div class="mobile-user-avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</div>
                    <div>
                        <div class="mobile-user-name">{{ Auth::user()->name }}</div>
                        <div class="mobile-user-email">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <a href="{{ route('profile') }}" class="btn btn--outline">Личный кабинет</a>
                <a href="{{ route('bookings') }}" class="btn btn--outline">Мои бронирования</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn--outline">Админ-панель</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn--danger">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn--primary">Войти</a>
                <a href="{{ route('register') }}" class="btn btn--outline">Регистрация</a>
            @endauth
        </div>
    </div>

    <main>@yield('content')</main>

    <footer class="footer" id="footer">
        <div class="footer_img"></div>
        <div class="footer1">
            <div class="footer__container">
                <div class="one">
                    <a href="{{ route('home') }}" class="header__logo"><img src="{{ asset('images/logo.svg') }}" alt="">
                        <p>ГОРЫ</p>
                    </a>
                </div>
                <div>
                    <h3 class="footer__title">О курорте</h3>
                    <ul class="footer__links">
                        <li><a href="{{ route('about') }}" class="footer__link">О нас</a></li>
                        <li><a href="{{ route('rules') }}" class="footer__link">Правила</a></li>
                        <li><a href="{{ route('getto') }}" class="footer__link">Как добраться</a></li>
                        <li><a href="{{ route('news') }}" class="footer__link">Новости</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Посетителям</h3>
                    <ul class="footer__links">
                        <li><a href="{{ route('slopes') }}" class="footer__link">Трассы</a></li>
                        <li><a href="{{ route('instructors') }}" class="footer__link">Инструкторы</a></li>
                        <li><a href="{{ route('hotels') }}" class="footer__link">Отели</a></li>
                        <li><a href="{{ route('tariffs') }}" class="footer__link">Тарифы</a></li>
                    </ul>
                </div>
                <div class="footer_col">
                    <h3 class="footer__title">Соцсети</h3>
                    <a href="tel:+79027399469">+79027399469</a>
                    <a href="mailto:gory@gmail.com">gory@gmail.com</a>
                    <div style="display:flex;gap:15px;font-size:24px;" id=contact>
                        <a href="#" class="footer__link"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="footer__link"><i class="fab fa-vk"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // ========== МОБИЛЬНОЕ МЕНЮ (ВЫЕЗЖАЕТ СПРАВА) ==========
        document.addEventListener('DOMContentLoaded', function() {
            const burgerBtn = document.getElementById('burgerBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileMenuOverlay');
            const closeBtn = document.getElementById('closeMobileMenuBtn');
            const mobileContactsLink = document.getElementById('mobileContactsLink');
            
            // Открытие меню
            function openMobileMenu() {
                mobileMenu.classList.add('active');
                mobileOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            
            // Закрытие меню
            function closeMobileMenu() {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            // Кнопка бургера
            if (burgerBtn) {
                burgerBtn.addEventListener('click', openMobileMenu);
            }
            
            // Крестик
            if (closeBtn) {
                closeBtn.addEventListener('click', closeMobileMenu);
            }
            
            // Оверлей
            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', closeMobileMenu);
            }
            
            // Контакты - закрываем и плавно скроллим
            if (mobileContactsLink) {
                mobileContactsLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileMenu();
                    setTimeout(() => {
                        const footer = document.getElementById('footer');
                        if (footer) footer.scrollIntoView({ behavior: 'smooth' });
                    }, 300);
                });
            }
            
            // Раскрытие подменю
            const submenuToggles = document.querySelectorAll('.mobile-menu-link[data-submenu]');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submenuId = this.getAttribute('data-submenu');
                    const submenu = document.getElementById(submenuId);
                    if (submenu) {
                        submenu.classList.toggle('active');
                        this.classList.toggle('active');
                    }
                });
            });
            
            // Закрытие при клике на ссылки подменю и обычные ссылки
            const closeOnClickLinks = document.querySelectorAll('.mobile-submenu-link, .mobile-menu-list > .mobile-menu-item > .mobile-menu-link:not([data-submenu])');
            closeOnClickLinks.forEach(link => {
                link.addEventListener('click', () => {
                    setTimeout(closeMobileMenu, 200);
                });
            });
            
            // Поиск в мобильном меню
            const mobileSearchInput = document.getElementById('mobileSearchInput');
            if (mobileSearchInput) {
                mobileSearchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && this.value.trim()) {
                        window.location.href = '{{ route("home") }}?search=' + encodeURIComponent(this.value.trim());
                    }
                });
            }
            
            // Десктопный поиск
            const desktopSearchInput = document.querySelector('.header__search-input');
            const desktopSearchBtn = document.querySelector('.header__search-btn');
            function performDesktopSearch() {
                if (desktopSearchInput && desktopSearchInput.value.trim()) {
                    window.location.href = '{{ route("home") }}?search=' + encodeURIComponent(desktopSearchInput.value.trim());
                }
            }
            if (desktopSearchBtn) desktopSearchBtn.addEventListener('click', performDesktopSearch);
            if (desktopSearchInput) {
                desktopSearchInput.addEventListener('keypress', (e) => { if (e.key === 'Enter') performDesktopSearch(); });
            }
        });
    </script>
    
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>