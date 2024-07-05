@extends('layout.layout')

@section('content')
<section class="tariff">
    <div class="tariff__container  _container">
        <div class="tariff__body">
            <div class="tariff__header">
                <div class="tariff__title title">Тарифы</div>
                <div class="tariff__subtitle subtitle">Получайте отзывы на карточки и повышайте их рейтинг. Размещайте рекламу в обмен на товары  и анализируйте результаты интеграций у блогеров — все в одном сервисе.</div>
            </div>
            <div class="tab-content__plans plans">
                <div class="plans__body">
                    {{-- <div class="plans__current">
                        <div class="plans__current-item">
                            <p class="plans__current-title">
                                Ваш текущий тариф: <span> {{ auth()->user()->seller->tariff }}</span>
                            </p>
                        </div>
                        <div class="plans__current-item">
                            <p class="plans__current-title">
                                Заявок осталось: <span>{{ auth()->user()->seller->remaining_tariff }}</span>
                            </p>
                        </div>
                    </div> --}}
                    <div class="tariff__title title">
                        Отзывы на WB, OZON
                        <div class="plans__current-item" style="margin-top: 15px">
                            <p class="plans__current-title">
                                Отзывов осталось: <b style="color:#FE5E00">10</b>
                            </p>
                        </div>
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>СЕЛЛЕР - 10 отзывов</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 10 отзывов на свой товар в течение 30 дней.</div>
                            </div>
                            <div class="price" title="">4900₽/<span>490₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за один отзыв</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem planItem--business">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>БИЗНЕС - 30 отзывов</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 30 отзывов на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price">13500₽/<span>450₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за один отзыв</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>КОМПАНИЯ - 50 отзывов</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 50 отзывов на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >20000₽/<span  >400₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за один отзыв</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="tariff__title title">
                        Интеграции Inst
                        <div class="plans__current-item" style="margin-top: 15px">
                            <p class="plans__current-title">
                                Интеграций осталось: <b style="color:#FE5E00">10</b>
                            </p>
                        </div>
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>СЕЛЛЕР - 10 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.</div>
                            </div>
                            <div class="price" title="">7900₽/<span>790₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem planItem--business">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>БИЗНЕС - 30 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >20700₽/<span  >690₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>КОМПАНИЯ - 50 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >29500₽/<span  >590₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="tariff__title title">
                        Интеграции YouTube
                        <div class="plans__current-item" style="margin-top: 15px">
                            <p class="plans__current-title">
                                Интеграций осталось: <b style="color:#FE5E00">10</b>
                            </p>
                        </div>
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>СЕЛЛЕР - 10 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.</div>
                            </div>
                            <div class="price" title="">9900₽/<span>990₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem planItem--business">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>БИЗНЕС - 30 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >26700₽/<span>890₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>КОМПАНИЯ - 50 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >39500₽/<span  >790₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="tariff__title title">
                        Интеграции VK
                        <div class="plans__current-item" style="margin-top: 15px">
                            <p class="plans__current-title">
                                Интеграций осталось: <b style="color:#FE5E00">10</b>
                            </p>
                        </div>
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>СЕЛЛЕР - 10 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.</div>
                            </div>
                            <div class="price" title="">7900₽/<span>790₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem planItem--business">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>БИЗНЕС - 30 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >20700₽/<span  >690₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>КОМПАНИЯ - 50 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >29500₽/<span  >590₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>

                    <div class="tariff__title title">
                        Интеграции Telegram
                        <div class="plans__current-item" style="margin-top: 15px">
                            <p class="plans__current-title">
                                Интеграций осталось: <b style="color:#FE5E00">10</b>
                            </p>
                        </div>
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>СЕЛЛЕР - 10 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 10 интеграций на свой товар в течение 30 дней.</div>
                            </div>
                            <div class="price" title="">7900₽/<span>790₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem planItem--business">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>БИЗНЕС - 30 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 30 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >20700₽/<span  >690₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>КОМПАНИЯ - 50 интеграций</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф, вы получаете доступ к получению 50 интеграций на свой товар в течение 30 дней.</div>
                            </div>

                            <div class="price"  >29500₽/<span  >590₽</span>
                                <span class="price__desc">
                                    ?
                                    <div class="price__text">
                                        <p>Цена за одну интеграцию</p>
                                    </div>
                                </span>
                            </div>
                            <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="" type="submit">Оплатить</button>
                                </form>
                                {{-- <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-secondary" style="" type="submit">Оплатить на год</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>


                    <div class="tariff__row">
                        <p style="font-weight:500; font-size:18px; color:rgba(0,0,0,0.4)">Все тарифы действуют в течение 30 календарных дней после оплаты. Если вы не использовали свои отзывы и интеграции в течение оплаченного периода, они станут недоступными. Если вы общаетесь с блогерами в рамках открытых рекламных диалогов, то даже после окончания тарифа вы не потеряете доступ к сервису.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://securepay.tinkoff.ru/html/payForm/js/tinkoff_v2.js"></script>
<form class="payform-tinkoff" name="payform-tinkoff" id="payform-tinkoff">
    <input class="payform-tinkoff-row" type="hidden" name="terminalkey" value="1720008275365DEMO">
    <input class="payform-tinkoff-row" type="hidden" name="frame" value="false">
    <input class="payform-tinkoff-row" type="hidden" name="language" value="ru">
    <input class="payform-tinkoff-row" type="hidden" name="receipt" value="">
    <input class="payform-tinkoff-row" type="text" placeholder="Сумма заказа" name="amount" required>
    <input class="payform-tinkoff-row" type="hidden" placeholder="Номер заказа" value="1" name="order">
    <input class="payform-tinkoff-row" type="text" placeholder="Описание заказа" name="description">
    <input class="payform-tinkoff-row" type="text" placeholder="ФИО плательщика" name="name">
    <input class="payform-tinkoff-row" type="email" placeholder="E-mail" name="email">
    <input class="payform-tinkoff-row" type="tel" placeholder="Контактный телефон" name="phone">
    <input class="payform-tinkoff-row payform-tinkoff-btn" type="submit" value="Оплатить">
</form>


<script type="text/javascript">
    const TPF = document.getElementById("payform-tinkoff");

    TPF.addEventListener("submit", function (e) {
        e.preventDefault();
        const {description, amount, email, phone, receipt} = TPF;

        if (receipt) {
            if (!email.value && !phone.value)
                return alert("Поле E-mail или Phone не должно быть пустым");

            TPF.receipt.value = JSON.stringify({
                "EmailCompany": "hello@adswap.ru",
                "Taxation": "patent",
                "FfdVersion": "1.2",
                "Items": [
                    {
                        "Name": description.value || "Оплата",
                        "Price": amount.value + '00',
                        "Quantity": 1.00,
                        "Amount": amount.value + '00',
                        "PaymentMethod": "full_prepayment",
                        "PaymentObject": "service",
                        "Tax": "none",
                        "MeasurementUnit": "pc"
                    }
                ]
            });
        }
        pay(TPF);
    })
</script>
@endsection
