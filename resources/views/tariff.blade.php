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
                    @foreach ($tariff_groups as $tariff_group)
                    @php($lost = $tariff_group->getLost());
                        <div class="tariff__title title">
                        {{ $tariff_group->title }}
                            <div class="plans__current-item" style="margin-top: 15px">
                                <p class="plans__current-title">
                                    Осталось: <b style="color:#FE5E00"> {{ $lost }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="planItem__container" style="margin-bottom:50px">
                            @foreach ($tariff_group->tariffs as $tariff)
                                <div class="planItem {{ !$tariff->is_best ?: 'planItem--business'}} {{ $tariff->isActive() ? 'planItem--current' : '' }}">
                                    <div class="card" style="margin-bottom:auto;">
                                        <div class="card__header">
                                            <h2>{{ $tariff->title }}</h2>
                                        </div>
                                        <div class="card__desc">{{ $tariff->description }}</div>
                                    </div>
                                    <div class="price" title="">{{ $tariff->price / 100 }}₽/<span>{{ $tariff->price / 100 }}₽</span>
                                        <span class="price__desc">
                                            ?
                                            <div class="price__text">
                                                <p>Цена за один отзыв</p>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="planItem__row" style="display: flex; flex-wrap:wrap; gap:10px;">
                                        @if ($lost < 1)
                                        <a href="{{ url('/payment/' . $tariff->id . '/init') }}" class="btn btn-primary">Оплатить</a>
                                        @else
                                        {{-- <button class="btn btn-primary" disabled>Тариф уже оплачен</button> --}}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="tariff__row">
                        <p style="font-weight:500; font-size:18px; color:rgba(0,0,0,0.4)">Все тарифы действуют в течение 30 календарных дней после оплаты. Если вы не использовали свои отзывы и интеграции в течение оплаченного периода, они станут недоступными. Если вы общаетесь с блогерами в рамках открытых рекламных диалогов, то даже после окончания тарифа вы не потеряете доступ к сервису.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
