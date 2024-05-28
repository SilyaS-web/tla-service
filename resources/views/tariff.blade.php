@extends('layout.layout')

@section('content')
<section class="tariff">
    <div class="tariff__container  _container">
        <div class="tariff__body">
            <div class="tariff__title title">
                Тарифы
            </div>
            <div class="profile-tabs__content-item">
                <div class="tab-content__plans plans">
                    <div class="plans__body">
                        <div class="plans__current">
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
                        </div>
                        <div class="planItem__container">
                            <div class="planItem planItem--free">
                                <div class="card">
                                    <div class="card__header">
                                        <h2>Начальный</h2>
                                    </div>
                                    <div class="card__desc">Оплатив этот тариф вы получите возможность создавать интеграции</div>
                                </div>

                                <div class="price">2500 ₽<span>/ месяц</span></div>

                                <ul class="featureList">
                                    <li>Поддержка чата</li>
                                    <li>Возможность создавать 500 интеграций в месяц</li>
                                </ul>
                                <form method="POST" action="{{ route('tariff') }}">
                                    <input hidden name="tariff" value="start" />
                                    <button class="btn btn-primary" style="max-width:160px" type="submit">Оплатить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
