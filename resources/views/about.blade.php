@extends('layouts.app')
@section('content')


<section class="about1">
    <h2>О КУРОРТЕ</h2>
    <div class="about1_container">
        <img src="{{ asset('images/about1.svg') }}" alt="">
        <div class="about1_right">
            <div class="about_text">
                <p>ГОРЫ — это современный горнолыжный курорт европейского уровня, расположенный в сердце Кавказа.</p>
                <p>Здесь 40 километров трасс для любого уровня подготовки, современные подъемники без очередей, уютные шале и рестораны с панорамным видом. Но главное — здесь живут эмоции, ради которых стоит приезжать снова и снова.</p>
                <p>Мы постоянно развиваем инфраструктуру, внедряем новые технологии и следим за каждым гостем. Наша цель — сделать отдых в «ГОРАХ» комфортным, безопасным и незабываемым для каждого, независимо от уровня подготовки и возраста.</p>
            </div>
            <div class="about_info">
                <div><span>15</span><p>современных подъемников</p></div>
                <div><span>3030</span><p>метров макс высоты</p></div>
                <div><span>16</span><p>различных трасс</p></div>
                <div><span>12</span><p>объектов размещения</p></div>
            </div>
        </div>
    </div>
</section>

<section class="about2">
    <h2>КАРТА ТРАСС</h2>
    <img src="{{ asset('images/about2.png') }}" alt="">
    <a href="{{ route('slopes') }}" class="btn-news">ТРАССЫ</a>
</section>

{{-- КОНТАКТЫ --}}
<section class="location-section">
    <h2>КОНТАКТЫ</h2>
    
    <div class="contacts-grid">
        <div class="contact-card">
            <div class="contact-card__icon"><img src="{{ asset('images/Map_Pin.svg') }}" alt=""></div>
            <div class="contact-card__label">Адрес</div>
            <div class="contact-card__value">Горнолыжный курорт<br>«ГОРЫ»</div>
        </div>
        <div class="contact-card">
            <div class="contact-card__icon"><img src="{{ asset('images/Phone.svg') }}" alt=""></div>
            <div class="contact-card__label">Телефон</div>
            <div class="contact-card__value">
                <a href="tel:+79991234567" class="contact-card__link">+7 (999) 123-45-67</a>
            </div>
        </div>
        <div class="contact-card">
            <div class="contact-card__icon"><img src="{{ asset('images/Mail.svg') }}" alt=""></div>
            <div class="contact-card__label">Email</div>
            <div class="contact-card__value">
                <a href="mailto:info@gory.ru" class="contact-card__link">info@gory.ru</a>
            </div>
        </div>
        <div class="contact-card">
            <div class="contact-card__icon"><img src="{{ asset('images/Clock.svg') }}" alt=""></div>
            <div class="contact-card__label">Режим работы</div>
            <div class="contact-card__value">Ежедневно<br>08:00 – 22:00</div>
        </div>
    </div>
    
    <div class="map-wrapper">
        <div class="map-container">
            <iframe src="https://yandex.ru/map-widget/v1/?ll=87.9900%2C52.9200&z=12&pt=87.9900,52.9200,pm2rdl&l=map" allowfullscreen></iframe>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 24px;">
        <a href="{{ route('getto') }}" class="btn-news">КАК ДОБРАТЬСЯ</a>
    </div>
</section>
@endsection