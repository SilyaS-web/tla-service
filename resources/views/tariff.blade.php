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
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>Стартовый</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 10 отзывов на вашу продукцию</div>
                                <div class="card__desc">Отзывов осталось: <b style="color:#FE5E00">10</b></div> <!--Отображать только у текущего-->
                            </div>
                            <div class="price" title="">4900₽/<span title="Цена за один отзыв">490₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">13500₽/<span title="Цена за один отзыв">450₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">20000₽/<span title="Цена за один отзыв">400₽</span></div>
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
                    </div>
                    <div class="planItem__container" style="margin-bottom:50px">

                        <div class="planItem planItem--current">
                            <div class="card" style="margin-bottom:auto;">
                                <div class="card__header">
                                    <h2>Стартовый</h2>
                                </div>
                                <div class="card__desc">Оплатив этот тариф вы получите возможность создавать 10 интеграций с блогерами</div>
                                <div class="card__desc">Интеграций осталось: <b style="color:#FE5E00">10</b></div> <!--Отображать только у текущего-->
                            </div>
                            <div class="price" title="">7900₽/<span title="Цена за один отзыв">790₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">20700₽/<span title="Цена за один отзыв">690₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">29500₽/<span title="Цена за один отзыв">590₽</span></div>
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
                            <div class="price" title="">9900₽/<span title="Цена за один отзыв">990₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">26700₽/<span title="Цена за один отзыв">890₽</span></div>
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

                            <div class="price" title="Плата за месяц/плата за год">39500₽/<span title="Цена за один отзыв">790₽</span></div>
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
