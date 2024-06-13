@extends('layout.layout')

@section('content')
<section class="tariff">
    <div class="tariff__container  _container">
        <div class="tariff__body">
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
                        Отзывы
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
                                    <h2>Стартовый</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 10 отзывов на вашу продукцию</div>
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
                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>Оптимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 30 отзывов на вашу продукцию</div>
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
                                    <h2>Максимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 50 отзывов на вашу продукцию</div>
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
                        Интеграции Instagram
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
                                    <h2>Стартовый</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 10 интеграций с блогерами</div>
                            </div>
                            <div class="price" title="">7900₽/<span  >790₽</span>
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
                                    <h2>Оптимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 30 интеграций с блогерами</div>
                            </div>

                            <div class="price"  >20700₽/<span  >690₽</span>
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
                                    <h2>Максимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 50 интеграций с блогерами</div>
                            </div>

                            <div class="price"  >29500₽/<span  >590₽</span>
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
                        Интеграции Youtube
                    </div>
                    <div class="planItem__container">

                        <div class="planItem">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>Стартовый</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 10 интеграций с блогерами</div>
                            </div>
                            <div class="price" title="">9900₽/<span  >990₽</span>
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
                                    <h2>Оптимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 30 интеграций с блогерами</div>
                            </div>

                            <div class="price"  >26700₽/<span  >890₽</span>
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
                                    <h2>Максимальный</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 50 интеграций с блогерами</div>
                            </div>

                            <div class="price"  >39500₽/<span  >790₽</span>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
