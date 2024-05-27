@extends('layout.layout')

@section('content')
<section class="user-view">
    <div class="user-view__container _container">
        <div class="user-view__body">
            <div class="user-view__info info-profile">
                <div class="info-profile__body">
                    <div class="info-profile__row">
                        <div class="info-profile__col info-profile__img">
                            <img src="img/profile-icon.svg" alt="">
                        </div>
                        <div class="info-profile__col">
                            <div class="info-profile__name">
                                Чертовски мило
                            </div>
                            <div class="info-profile__id">
                                На площадке с 20.12.23
                            </div>
                        </div>
                    </div>
                    <div class="info-profile__row info-profile__tags">
                        <div class="info-profile__tags-title">
                            Дополнительная информация
                        </div>
                        <div class="info-profile__tags-items">
                            <div class="info-profile__tags-item">
                                Проверенный блогер
                            </div>
                        </div>
                        <div class="info-profile__tags-items">
                            <div class="info-profile__tags-item">
                                YouTube
                            </div>
                            <div class="info-profile__tags-item">
                                Instgram
                            </div>
                            <div class="info-profile__tags-item">
                                Telegram
                            </div>
                        </div>
                    </div>
                    <div class="info-profile__row info-profile__desc">
                        <p>Мы любим животных и стараемся поддерживать тех из них, кому не посчастливилось иметь ласковых хозяев и тёплый кров. </p>
                    </div>
                </div>
            </div>
            <div class="user-view__projects">
                <div class="profile-projects tab-content active" id = "my-projects">
                    <div class="profile-projects__body">
                        <div class="profile-projects__title title">
                            Список выполненных интеграций
                        </div>
                        <div class="list-projects__items">
                            <div class="list-projects__item project-item">
                                <div class="owl-carousel project-item__carousel">
                                    <div class="project-item__img">
                                        <img src="img/projects-list/1.webp" alt="">
                                        <div class="project-item__status active">
                                            Активно
                                        </div>
                                        <div class="project-item__country">
                                            Россия
                                        </div>
                                    </div>
                                    <div class="project-item__img">
                                        <img src="img/projects-list/1.webp" alt="">
                                        <div class="project-item__status active">
                                            Активно
                                        </div>
                                        <div class="project-item__country">
                                            Россия
                                        </div>
                                    </div>
                                    <div class="project-item__img">
                                        <img src="img/projects-list/1.webp" alt="">
                                        <div class="project-item__status active">
                                            Активно
                                        </div>
                                        <div class="project-item__country">
                                            Россия
                                        </div>
                                    </div>
                                </div>
                                <div class="project-item__content">
                                    <div class="project-item__title">
                                        Цена — 1120 ₽
                                    </div>
                                    <a class="project-item__participants" title="Гель для душа парфюмированный, 1000 мл.">
                                        Dk-studio / Гель для душа парфюмированный, 1000 мл.
                                    </a>
                                    <div class="project-item__format-tags card__row card__tags">
                                        <div class="card__tags-item">
                                            <span>Рекламный пост</span>
                                        </div>
                                        <div class="card__tags-item">
                                            <span>Обзор на канале</span>
                                        </div>
                                        <div class="card__tags-item">
                                            <span>Другое</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('scripts')
@endsection
