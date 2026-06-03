{{-- resources/views/how-to-get.blade.php --}}
@extends('layouts.app', ['headerClass' => 'header--transparent'])

@section('content')
<div class="transport-page">
    <section class="transport-hero">
        <div>
            <h1>Как добраться</h1>
            <p>Выберите удобный способ и отправляйтесь в «ГОРЫ»</p>
        </div>
    </section>

    <div class="transport-tabs">
        <button class="transport-tab active" onclick="switchTransport('auto')">На авто</button>
        <button class="transport-tab" onclick="switchTransport('train')">На поезде</button>
        <button class="transport-tab" onclick="switchTransport('plane')">На самолёте</button>
        <button class="transport-tab" onclick="switchTransport('bus')">Автобус</button>
        <button class="transport-tab" onclick="switchTransport('transfer')">Трансфер</button>
    </div>

    <div class="transport-content">
        
        {{-- На авто --}}
        <div class="transport-panel active" id="panel-auto">
            <div class="route-card">
                <h3 class="route-card__title">На автомобиле</h3>
                <p class="route-card__subtitle">Свобода передвижения и живописные маршруты</p>
                <div class="route-card__body">
                    <div class="route-detail">
                        <div class="route-detail__label">Расстояние</div>
                        <div class="route-detail__value">~350 км от города</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Время в пути</div>
                        <div class="route-detail__value">4–5 часов</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Дорога</div>
                        <div class="route-detail__value">Федеральная трасса М-52</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Парковка</div>
                        <div class="route-detail__value">Бесплатная охраняемая</div>
                    </div>
                </div>
                <div class="route-card__footer">
                    <a href="https://yandex.ru/maps/?ll=87.9900%2C52.9200&z=12&mode=routes&rtext=~52.9200,87.9900" target="_blank" class="route-btn">Построить маршрут</a>
                    <a href="tel:+79991234567" class="route-btn route-btn--outline">Заказать трансфер</a>
                </div>
                <div class="route-note">
                    Зимой рекомендуем использовать зимнюю резину и иметь при себе цепи противоскольжения. Координаты для навигатора: <strong>52.9200, 87.9900</strong>
                </div>
            </div>
        </div>

        {{-- На поезде --}}
        <div class="transport-panel" id="panel-train">
            <div class="route-card">
                <h3 class="route-card__title">На поезде</h3>
                <p class="route-card__subtitle">Комфортное путешествие без пробок</p>
                <div class="route-card__body">
                    <div class="route-detail">
                        <div class="route-detail__label">Станция прибытия</div>
                        <div class="route-detail__value">Горная (50 км от курорта)</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Время в пути</div>
                        <div class="route-detail__value">от 8 часов (из Москвы)</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Трансфер от вокзала</div>
                        <div class="route-detail__value">Каждые 2 часа</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Стоимость трансфера</div>
                        <div class="route-detail__value">от 500 ₽</div>
                    </div>
                </div>
                <div class="route-card__footer">
                    <a href="https://rzd.ru" target="_blank" class="route-btn">Купить билет на поезд</a>
                    <a href="tel:+79991234567" class="route-btn route-btn--outline">Заказать трансфер</a>
                </div>
                <div class="route-note">
                    Бронируйте билеты заранее, особенно в высокий сезон (декабрь–февраль). Трансфер от станции можно заказать по телефону или на стойке информации вокзала.
                </div>
            </div>
        </div>

        {{-- На самолёте --}}
        <div class="transport-panel" id="panel-plane">
            <div class="route-card">
                <h3 class="route-card__title">На самолёте</h3>
                <p class="route-card__subtitle">Самый быстрый способ добраться</p>
                <div class="route-card__body">
                    <div class="route-detail">
                        <div class="route-detail__label">Аэропорт</div>
                        <div class="route-detail__value">Международный (120 км)</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Время полёта</div>
                        <div class="route-detail__value">~3 часа (из Москвы)</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Трансфер до курорта</div>
                        <div class="route-detail__value">1,5–2 часа</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Стоимость трансфера</div>
                        <div class="route-detail__value">от 1 500 ₽</div>
                    </div>
                </div>
                <div class="route-card__footer">
                    <a href="https://aviasales.ru" target="_blank" class="route-btn">Найти авиабилеты</a>
                    <a href="tel:+79991234567" class="route-btn route-btn--outline">Заказать трансфер</a>
                </div>
                <div class="route-note">
                    Рекомендуем бронировать билеты за 2–3 недели до поездки — так выгоднее. Индивидуальный трансфер встречает с табличкой в зоне прилёта.
                </div>
            </div>
        </div>

        {{-- Автобус --}}
        <div class="transport-panel" id="panel-bus">
            <div class="route-card">
                <h3 class="route-card__title">Автобус</h3>
                <p class="route-card__subtitle">Бюджетный и удобный вариант</p>
                <div class="route-card__body">
                    <div class="route-detail">
                        <div class="route-detail__label">Отправление</div>
                        <div class="route-detail__value">Центральный автовокзал</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Время в пути</div>
                        <div class="route-detail__value">5–6 часов</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Рейсы</div>
                        <div class="route-detail__value">Ежедневно, 3 раза в день</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Стоимость билета</div>
                        <div class="route-detail__value">от 800 ₽</div>
                    </div>
                </div>
                <div class="route-card__footer">
                    <a href="#" class="route-btn">Купить билет онлайн</a>
                    <a href="tel:+79991234567" class="route-btn route-btn--outline">Справки по телефону</a>
                </div>
                <div class="route-note">
                    Билеты можно приобрести в кассе автовокзала или онлайн. В высокий сезон рекомендуем бронировать за 2–3 дня. Автобусы комфортабельные, с кондиционером.
                </div>
            </div>
        </div>

        {{-- Трансфер --}}
        <div class="transport-panel" id="panel-transfer">
            <div class="route-card">
                <h3 class="route-card__title">Трансфер</h3>
                <p class="route-card__subtitle">Встретим и доставим с комфортом</p>
                <div class="route-card__body">
                    <div class="route-detail">
                        <div class="route-detail__label">Индивидуальный</div>
                        <div class="route-detail__value">от 1 500 ₽</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Групповой (до 8 чел)</div>
                        <div class="route-detail__value">от 3 000 ₽</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Бронирование</div>
                        <div class="route-detail__value">По телефону или на сайте</div>
                    </div>
                    <div class="route-detail">
                        <div class="route-detail__label">Время подачи</div>
                        <div class="route-detail__value">Круглосуточно</div>
                    </div>
                </div>
                <div class="route-card__footer">
                    <a href="tel:+79991234567" class="route-btn">Заказать трансфер</a>
                    <a href="mailto:gory@gmail.com" class="route-btn route-btn--outline">Написать на почту</a>
                </div>
                <div class="route-note">
                    При заказе трансфера сообщите номер рейса/поезда и время прибытия. Водитель встретит вас с табличкой «ГОРЫ» в зоне прилёта или на перроне вокзала.
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function switchTransport(type) {
    document.querySelectorAll('.transport-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.transport-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('panel-' + type).classList.add('active');
    event.target.closest('.transport-tab').classList.add('active');
}
</script>
@endsection