<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/adswap_1_2.svg') }}" type="image/x-icon">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <title>@yield('title')</title>
</head>
<body>
    <div class="wrapper" style="background-color: #fff;">
        @yield('content')

{{--        <div class="popup" id="contact-form">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Оставьте свой номер--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Укажите свои контактные данные и наш менеджер свяжется с вами в течении 15 минут--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Ваше имя</label>--}}
{{--                            <input id="name" name="name" type="text" class="input">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="phone">Ваш номер</label>--}}
{{--                            <input id="phone" name="phone" type="phone" class="input" placeholder = "+7(900)800-00-00">--}}
{{--                        </div>--}}
{{--                        <script>--}}
{{--                            $(function() {--}}
{{--                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"--}}
{{--                                $("#contact-form #phone").mask('+7 (h99) 999-99-99');--}}
{{--                                console.log($("#auth #phone"));--}}
{{--                            });--}}
{{--                        </script>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="comment">Комментарий</label>--}}
{{--                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>--}}
{{--                        </div>--}}
{{--                        <p class="form-addit">--}}
{{--                            Оставляя свои данные, вы даёте на это согласие <br>--}}
{{--                            и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>--}}
{{--                        </p>--}}
{{--                        <button class="btn btn-primary send-data">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="popup" id="change-password">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Введите номер--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Отправьте нам свой номер и наш телеграм-бот пришлёт вам новый пароль, который потом можно поменять в настройках профиля--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="phone">Ваш номер</label>--}}
{{--                            <input id="phone" name="phone" type="phone" class="input">--}}
{{--                        </div>--}}
{{--                        <script>--}}
{{--                            $(function() {--}}
{{--                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"--}}
{{--                                $("#change-password #phone").mask('+7 (h99) 999-99-99');--}}
{{--                            });--}}

{{--                        </script>--}}
{{--                        <p class="form-addit">--}}
{{--                            Оставляя свои данные, вы даёте на это согласие <br>--}}
{{--                            и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>--}}
{{--                        </p>--}}
{{--                        <button class="btn btn-primary send-data">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="popup" id="confirm-completion" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Заполните данные--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Выберите оценку, не забудьте добавить комментарий, это очень важно для развития площадки и улучшения сообщества--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="mark">Ваша оценка</label>--}}
{{--                            <div class="mark-items">--}}
{{--                                <div class="mark-items__star">--}}
{{--                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="mark-items__star">--}}
{{--                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="mark-items__star">--}}
{{--                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="mark-items__star">--}}
{{--                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="mark-items__star">--}}
{{--                                    <img src="{{ asset('/img/star-icon.svg') }}" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="comment">Комментарий</label>--}}
{{--                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-primary send-data">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="blogger-send-offer" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Заполните данные--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="message">Комментарий</label>--}}
{{--                            <textarea name="message" id="message" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-primary send-data">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="confirm-completion-blogger" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Заполните комментарий--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="comment">Комментарий</label>--}}
{{--                            <textarea name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-primary send-data">--}}
{{--                            Отправить--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="choose-projects-adv-format" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Выберите формат рекламы--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="popup__formats">--}}

{{--                        </div>--}}
{{--                        <button class="btn btn-primary btn-confirm">--}}
{{--                            Выбрать--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="chat-img" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body" style="max-width:790px">--}}
{{--                    <div class="chat-img__w">--}}
{{--                        <img src="" alt="" class="chat-img" style="width:100%">--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="confirm-publication" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Подтвердите действие--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle subtitle">--}}
{{--                            После публикации проект нельзя будет отредактировать--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="popup__form-btns">--}}
{{--                            <button class="btn btn-primary send-data">--}}
{{--                                Подтвердить--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-secondary close-popup-btn">--}}
{{--                                Отмена--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="confirm-deleting" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Подтвердите действие--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle subtitle">--}}
{{--                            После подтверждения действия проект восстановить нельзя--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="popup__form-btns">--}}
{{--                            <button class="btn btn-primary send-data">--}}
{{--                                Подтвердить--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-secondary close-popup-btn">--}}
{{--                                Отмена--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup" id="choose-projects-adv-format-blogger" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Выберите формат рекламы--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="popup__form">--}}
{{--                        <div class="popup__formats">--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-primary btn-confirm">--}}
{{--                            Выбрать--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="popup popup-tariffs" id="tariff-popup" style="">--}}
{{--            <div class="popup__container _container">--}}
{{--                <div class="popup__body">--}}
{{--                    <div class="popup__header">--}}
{{--                        <div class="popup__title title">--}}
{{--                            Тарифы--}}
{{--                        </div>--}}
{{--                        <div class="popup__subtitle">--}}
{{--                            Получайте отзывы на карточки и повышайте их рейтинг. Размещайте рекламу в обмен на товары  и анализируйте результаты интеграций у блогеров — все в одном сервисе.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tariff__items" style="margin-bottom:40px;">--}}
{{--                    <div class="tariff__items">--}}
{{--                        <div class="tariff__col tariff-card">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Индивидуальные условия--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__subtitle">--}}
{{--                                    Действует по договоренности--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__text">--}}
{{--                                <br>--}}
{{--                                <b>Рассматривается только от 100 заявок.</b>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-callus">Оставить заявку</button>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-callus">Подробности</button>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__star">--}}
{{--                                <img src="{{ asset('img/star-icon.svg') }}" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tariff__col tariff-card tariff-card--start" data-id="16">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Стартовый--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__subtitle">--}}
{{--                                    7 дней бесплатно--}}
{{--                        <div class="tariff__col tariff-card">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Селлер--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__subtitle">--}}
{{--                                    Действует 30 дней--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__prices">--}}
{{--                                <div class="tariff-card__total">--}}
{{--                                    0 руб--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    1 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                                <div class="quantity-minus disabled">--}}
{{--                                    <img src="img/minus-icon.svg" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-input">--}}
{{--                                    <input type="number" class="input disabled" value="1" name="start-quantity">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-plus disabled">--}}
{{--                                    <img src="img/plus-icon.svg" alt="">--}}
{{--                                </div>--}}
{{--                                    4900 руб--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    / 490 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__select form-group">--}}
{{--                                <select name="" id="" class = "select">--}}
{{--                                    <option value="2">Отзывы на WB, OZON - 10</option>--}}
{{--                                    <option value="5">Интеграции Ins - 10</option>--}}
{{--                                    <option value="11">Интеграции VK - 10</option>--}}
{{--                                    <option value="14">Интеграции Telegram - 10</option>--}}
{{--                                    <option value="8">Интеграции YTube - 10</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__count">--}}
{{--                                01--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tariff__col tariff-card tariff-card--feedback" data-id="17">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Отзывы--}}
{{--                        <div class="tariff__col tariff-card">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Бизнес--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__subtitle">--}}
{{--                                    Действует 30 дней--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__prices">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="tariff-card__total">--}}
{{--                                        <span class="tariff-card__total--price">1000</span> руб--}}
{{--                                    </div>--}}
{{--                                    <div class="tariff-card__total tariff-card__total--old" style="display: none">--}}
{{--                                        <span class="tariff-card__total--price">1000</span> руб--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    от 10 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                                <div class="quantity-minus">--}}
{{--                                    <img src="img/minus-icon.svg" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-input">--}}
{{--                                    <input type="number" class="input" value="10" min="10" max="100" name="feedback-quantity">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-plus">--}}
{{--                                    <img src="img/plus-icon.svg" alt="">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-payment" style="margin-top: 15px">Оплатить</button>--}}
{{--                                <div class="tariff-card__total">--}}
{{--                                    13500 руб--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    / 490 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__select form-group">--}}
{{--                                <select name="" id="" class = "select">--}}
{{--                                    <option value="3">Отзывы на WB, OZON - 30</option>--}}
{{--                                    <option value="6">Интеграции Ins - 30</option>--}}
{{--                                    <option value="12">Интеграции VK - 30</option>--}}
{{--                                    <option value="15">Интеграции Telegram - 30</option>--}}
{{--                                    <option value="9">Интеграции YTube - 30</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__count">--}}
{{--                                02--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tariff__col tariff-card tariff-card--integration" data-id="18">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Интеграция--}}
{{--                        <div class="tariff__col tariff-card">--}}
{{--                            <div class="tariff-card__header">--}}
{{--                                <div class="tariff-card__title">--}}
{{--                                    Компания--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__subtitle">--}}
{{--                                    Действует 30 дней--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__prices">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="tariff-card__total">--}}
{{--                                        <span class="tariff-card__total--price">2000</span> руб--}}
{{--                                    </div>--}}
{{--                                    <div class="tariff-card__total tariff-card__total--old" style="display: none">--}}
{{--                                        <span class="tariff-card__total--price">2000</span> руб--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    от 10 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group quantity-w" data-max="100" data-min="10">--}}
{{--                                <div class="quantity-minus">--}}
{{--                                    <img src="img/minus-icon.svg" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-input">--}}
{{--                                    <input type="number" class="input" value="10" min="10" max="100" name="integration-quantity">--}}
{{--                                </div>--}}
{{--                                <div class="quantity-plus">--}}
{{--                                    <img src="img/plus-icon.svg" alt="">--}}
{{--                                <div class="tariff-card__total">--}}
{{--                                    20000 руб--}}
{{--                                </div>--}}
{{--                                <div class="tariff-card__single">--}}
{{--                                    / 490 шт--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__select form-group">--}}
{{--                                <select name="" id="" class = "select">--}}
{{--                                    <option value="4">Отзывы на WB, OZON - 50</option>--}}
{{--                                    <option value="7">Интеграции Ins - 50</option>--}}
{{--                                    <option value="13">Интеграции VK - 50</option>--}}
{{--                                    <option value="16">Интеграции Telegram - 50</option>--}}
{{--                                    <option value="10">Интеграции YTube - 50</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__btns">--}}
{{--                                <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>--}}
{{--                            </div>--}}
{{--                            <div class="tariff-card__count">--}}
{{--                                03--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="close-popup">--}}
{{--                        <img src="{{ asset('img/close-icon.svg') }}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @include('shared.success-message')
    </div>
</body>
<script src="{{ asset("js/app.js") }}"></script>
@yield('scripts')

</html>
