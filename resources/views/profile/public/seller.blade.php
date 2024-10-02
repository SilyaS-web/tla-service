<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/adswap_1_2.svg" type="image/x-icon">

    <link rel="stylesheet" href="/libs/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="/libs/owl/owl.theme.default.css">

    <link rel="stylesheet" href="/libs/meter/style.css">

    <link rel="stylesheet" href="/libs/range-slider/style.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/loader.css">

    <script src="{{ asset('libs/jquery/jquery-3.7.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ asset('libs/chart/chart.js') }}"></script>
    <script src="{{ asset('libs/funnel/funnel-chart.js') }}"></script>
    <script src="{{ asset('libs/owl/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <title>@yield('title')</title>
</head>
<body>
<div class="wrapper" style="background-color: #fff;">
    <section class="user-view">
        <div class="user-view__container _container">
            <div class="user-view__body">
                <div class="user-view__info info-profile">
                    <div class="info-profile__body">
                        <div class="info-profile__row">
                            <div class="info-profile__col info-profile__img">
                                <img src="{{ $user->getImageURL() }}" alt="">
                            </div>
                            <div class="info-profile__col">
                                <div class="info-profile__name">
                                    {{ $user->name }}
                                </div>
                                <div class="info-profile__id">
                                    На площадке с {{ date_format($user->created_at, 'd.m.Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="info-profile__row info-profile__tags">
                            <div class="info-profile__tags-title">
                                Дополнительная информация
                            </div>
                            <div class="info-profile__tags-items">
                                <div class="info-profile__tags-item">
                                    Проверенный селлер
                                </div>
                            </div>
                        </div>
                        <div class="info-profile__row info-profile__desc">
                            <p>{{ $user->seller->description }}</p>
                            <p><a href="{{ $user->seller->platform_link}}"></a></p>
                        </div>
                    </div>
                </div>
                <div class="user-view__projects">
                    <div class="profile-projects tab-content active" id="my-projects">
                        <div class="profile-projects__body">
                            <div class="profile-projects__title title">
                                Список размещённых проектов
                            </div>
                            <div class="list-projects__items">
                                @forelse ($projects as $project)
                                <div class="list-projects__item project-item">
                                    <div class="owl-carousel project-item__carousel">
                                        <div class="project-item__img" style="background-image:url({{ $project->getImageURL(true) }})">
                                            <div class="project-item__status active">
                                                {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
                                            </div>
                                            {{-- <div class="project-item__country">
                                                Россия
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="project-item__content">
                                        <div class="project-item__title">
                                            Цена — {{ $project->product_price }} ₽
                                        </div>
                                        <a class="project-item__participants" title="Гель для душа парфюмированный, 1000 мл.">
                                            {{ $project->seller->user->name }} / {{ $project->product_name }}.
                                        </a>
                                        <div class="project-item__format-tags card__row card__tags">
                                            <div class="card__tags-item">
                                                <span>Рекламный пост</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    Пока что здесь пусто
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('shared.success-message')
</body>
</html>
