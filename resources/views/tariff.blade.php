@extends('layout.layout')

@section('content')
<section class="tariff">
    <div class="tariff__container  _container">
        <div class="tariff__body">
            <div class="tariff__header">
                <div class="tariff__title title">Тарифы</div>
                <div class="tariff__subtitle subtitle">Получайте отзывы на карточки и повышайте их рейтинг. Размещайте рекламу в обмен на товары  и анализируйте результаты интеграций у блогеров — все в одном сервисе.</div>
            </div>
            <div class="tariff__items" style="margin-bottom:40px;">
                <div class="tariff__col tariff-card">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Индивидуальные условия
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует по договоренности
                        </div>
                    </div>
                    <div class="tariff-card__text">
                        Индивидуальный тариф позволяет клиентам свободно выбирать количество интеграций и отзывов в своем плане.
                        <br>
                        <b>Рассматривается только от 100 заявок.</b>
                    </div>
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-callus">Оставить заявку</button>
                    </div>
                    <div class="tariff-card__star">
                        <img src="{{ asset('img/star-icon.svg') }}" alt="">
                    </div>
                </div>
                <div class="tariff__col tariff-card">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Селлер
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует 30 дней
                        </div>
                    </div>
                    <div class="tariff-card__prices">
                        <div class="tariff-card__total">
                            4900 руб
                        </div>
                        <div class="tariff-card__single">
                            / 490 шт
                        </div>
                    </div>
                    <div class="tariff-card__select form-group">
                        <select name="" id="" class = "select">
                            <option value="2">Отзывы на WB, OZON - 10</option>
                            <option value="5">Интеграции Inst - 10</option>
                            <option value="11">Интеграции VK - 10</option>
                            <option value="14">Интеграции Telegram - 10</option>
                            <option value="8">Интеграции YouTube - 10</option>
                        </select>
                    </div>
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                    </div>
                    <div class="tariff-card__count">
                        01
                    </div>
                </div>
                <div class="tariff__col tariff-card">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Бизнес
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует 30 дней
                        </div>
                    </div>
                    <div class="tariff-card__prices">
                        <div class="tariff-card__total">
                            13500 руб
                        </div>
                        <div class="tariff-card__single">
                            / 490 шт
                        </div>
                    </div>
                    <div class="tariff-card__select form-group">
                        <select name="" id="" class = "select">
                            <option value="3">Отзывы на WB, OZON - 30</option>
                            <option value="6">Интеграции Inst - 30</option>
                            <option value="12">Интеграции VK - 30</option>
                            <option value="15">Интеграции Telegram - 30</option>
                            <option value="9">Интеграции YouTube - 30</option>
                        </select>
                    </div>
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                    </div>
                    <div class="tariff-card__count">
                        02
                    </div>
                </div>
                <div class="tariff__col tariff-card">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Компания
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует 30 дней
                        </div>
                    </div>
                    <div class="tariff-card__prices">
                        <div class="tariff-card__total">
                            20000 руб
                        </div>
                        <div class="tariff-card__single">
                            / 490 шт
                        </div>
                    </div>
                    <div class="tariff-card__select form-group">
                        <select name="" id="" class = "select">
                            <option value="4">Отзывы на WB, OZON - 50</option>
                            <option value="7">Интеграции Inst - 50</option>
                            <option value="13">Интеграции VK - 50</option>
                            <option value="16">Интеграции Telegram - 50</option>
                            <option value="10">Интеграции YouTube - 50</option>
                        </select>
                    </div>
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                    </div>
                    <div class="tariff-card__count">
                        03
                    </div>
                </div>
            </div>
            <div class="tariff__row">
                <p style="font-weight:500; font-size:18px; color:rgba(0,0,0,0.4)">Все тарифы действуют в течение 30 календарных дней после оплаты. Если вы не использовали свои отзывы и интеграции в течение оплаченного периода, они станут недоступными. Если вы общаетесь с блогерами в рамках открытых рекламных диалогов, то даже после окончания тарифа вы не потеряете доступ к сервису.</p>
            </div>
        </div>
    </div>
</section>
@endsection
