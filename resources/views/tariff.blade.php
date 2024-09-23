@extends('layout.layout')

@section('title', $title ?? 'Тарифы')

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
                            Индивидуальное сопровождение
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует по договоренности. <br>
                            Наши менеджеры возьмут на себя заботу о вашем бренде и обеспечат ему профессиональное сопровождение.
                        </div>
                    </div>
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-callus">Оставить заявку</button>
                    </div>
                    <div class="tariff-card__star">
                        <img src="{{ asset('img/star-icon.svg') }}" alt="">
                    </div>
                </div>
                <div class="tariff__col tariff-card tariff-card--start" data-id="19">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Пробный
                        </div>
                        <div class="tariff-card__subtitle">
                            7 дней бесплатно
                        </div>
                    </div>
                    <div class="tariff-card__prices">
                        <div class="tariff-card__total">
                            0 руб
                        </div>
                        <div class="tariff-card__single">
                            5 бартеров
                        </div>
                    </div>
{{--                    <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                        <div class="quantity-minus disabled">--}}
{{--                            <img src="img/minus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-input">--}}
{{--                            <input type="number" class="input disabled" value="1" name="start-quantity">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-plus disabled">--}}
{{--                            <img src="img/plus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                    </div>
                    <div class="tariff-card__count">
                        01
                    </div>
                </div>
                <div class="tariff__col tariff-card tariff-card--feedback" data-id="20">
                    <div class="tariff-card__header">
                        <div class="tariff-card__title">
                            Безлимит
                        </div>
                        <div class="tariff-card__subtitle">
                            Действует 30 дней
                        </div>
                    </div>
                    <div class="tariff-card__prices">
                        <div class="tariff-card__total">
                            4990 руб
                        </div>
                        <div class="tariff-card__single">
                            ꝏ бартеров
                        </div>
                    </div>
{{--                    <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                        <div class="quantity-minus">--}}
{{--                            <img src="img/minus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-input">--}}
{{--                            <input type="number" class="input" value="10" min="10" max="100" name="feedback-quantity">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-plus">--}}
{{--                            <img src="img/plus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="tariff-card__btns">
                        <button class="btn btn-primary btn-tariffs-payment" style="margin-top: 15px">Оплатить</button>
                    </div>
                    <div class="tariff-card__count">
                        02
                    </div>
                </div>
{{--                <div class="tariff__col tariff-card tariff-card--integration" data-id="18">--}}
{{--                    <div class="tariff-card__header">--}}
{{--                        <div class="tariff-card__title">--}}
{{--                            Интеграция--}}
{{--                        </div>--}}
{{--                        <div class="tariff-card__subtitle">--}}
{{--                            Действует 30 дней--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tariff-card__prices">--}}
{{--                        <div class="col">--}}
{{--                            <div class="tariff-card__total">--}}
{{--                                <span class="tariff-card__total--price">2000</span> руб--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__total tariff-card__total--old" style="display: none">--}}
{{--                                <span class="tariff-card__total--price">2000</span> руб--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tariff-card__single">--}}
{{--                            200 р. за шт--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                        <div class="quantity-minus">--}}
{{--                            <img src="img/minus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-input">--}}
{{--                            <input type="number" class="input" value="10" min="10" max="100" name="integration-quantity">--}}
{{--                        </div>--}}
{{--                        <div class="quantity-plus">--}}
{{--                            <img src="img/plus-icon.svg" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tariff-card__btns">--}}
{{--                        <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>--}}
{{--                    </div>--}}
{{--                    <div class="tariff-card__count">--}}
{{--                        03--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="tariff__row">
                <p style="font-weight:500; font-size:18px; color:rgba(0,0,0,0.4)">Все тарифы действуют в течение 30 календарных дней после оплаты. Если вы не использовали свои отзывы и интеграции в течение оплаченного периода, они станут недоступными. Если вы общаетесь с блогерами в рамках открытых рекламных диалогов, то даже после окончания тарифа вы не потеряете доступ к сервису.</p>
            </div>
        </div>
    </div>
</section>
@endsection
