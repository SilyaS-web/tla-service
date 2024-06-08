@extends('layout.layout')

@section('content')

<section class="project-view">
    <div class="project-view__container _container">
        <div class="project-view__body">
            <!-- <div class="project-view__title title">
                        Реклама товара
                    </div> -->
            <div class="project-view__project view-project">
                <div class="view-project__img _ibg">
                    <img src="{{ $project->getImageURL() }}" alt="">
                </div>
                <div class="view-project__content">
                    <div class="view-project__header">
                        <div class="view-project__title">
                            {{ $project->product_name }}
                        </div>
                        <div class="view-project__status active">
                            {{ $project->status == 0 ? 'Активно' : 'Завершено' }}
                        </div>

                    </div>
                    <div class="view-project__body">
                        <div class="view-project__format">
                            <div class="view-project__format-item">
                                Рекламный пост
                            </div>
                        </div>
                        <div class="view-project__link">
                            <p>Ссылка на товар:</p>
                            <a href="#" class="">{{ $project->product_link }}</a>
                        </div>
                        <div class="view-project__props view-project__props--desktop">
                            <div class="view-project__props-wrap">
                                <div class="view-project__props-total">
                                    <div class="view-project__props-orders">
                                        Заказы за 30 дн<br>
                                        <span class="count">2 637 шт</span>
                                    </div>
                                    <div class="view-project__props-money">
                                        Выручка за 30 дн<br>
                                        <span class="money">4 750 732 ₽</span>
                                    </div>
                                </div>
                                <div class="view-project__props-graph">
                                    <canvas id="orders-graph-desktop" class=""></canvas>
                                    <canvas id="prices-graph-desktop" class=""></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="view-project__props view-project__props--mobile">
                            <div class="view-project__props-wrap">
                                <div class="view-project__props-orders">
                                    Заказы за 30 дн<br>
                                    <span class="count">2 637 шт</span>
                                </div>
                                <canvas id="orders-graph-mobile" class=""></canvas>
                            </div>
                            <div class="view-project__props-wrap">
                                <div class="view-project__props-money">
                                    Выручка за 30 дн<br>
                                    <span class="money">4 750 732 ₽</span>
                                </div>
                                <canvas id="prices-graph-mobile" class=""></canvas>
                            </div>
                        </div>
                        <div class="view-project__btns">
                            <button class="btn btn-secondary">
                                Удалить
                            </button>
                            <!-- <button class="btn btn-primary">
                                        Редактировать
                                    </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
