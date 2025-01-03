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
{{--                <a href={{url('/profile/?switch-tab=' . request()->get("tab"))}} class="user-view__back">--}}
{{--                    <img src="{{asset('img/arrow-alt.svg')}}" alt="">--}}
{{--                    <span> Вернуться </span>--}}
{{--                </a>--}}
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
                                    <p style="font-size: 12px">
                                        {{ $user->blogger->country->name ?? 'Имя не указано'}}, {{ $user->blogger->city ?? 'Город не выбран' }}<br>
                                        На площадке с {{ date_format($user->created_at, 'd.m.Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="info-profile__row info-profile__tags">
                            <div class="info-profile__tags-title">
                                Дополнительная информация
                            </div>
                            <div class="info-profile__tags-items">
                                @if(isset($user->blogger) && $user->blogger->is_achievement)
                                <div class="info-profile__tags-item">
                                    Проверенный блогер
                                </div>
                                @endif
                            </div>
                            <div class="info-profile__platrfoms blogger-platforms">
                                @php($types = [
                                        'telegram' => 'tg',
                                        'instagram' => 'inst',
                                        'vk' => 'vk',
                                        'youtube' => 'yt',
                                        'dzen' => 'dzen',
                                        'ok' => 'ok',
                                        'yappy' => 'yappy',
                                        'rutube' => 'rutube',
                                ])
                                @foreach (($user->blogger->platforms ?? []) as $blogger_platform )
                                    @if(!$blogger_platform->subscriber_quantity)
                                        @continue
                                    @endif
                                    <div class="blogger-platforms__item item-platforms">
                                        <?php
                                            $link = $blogger_platform->link ?? '';
                                            $is = trim($blogger_platform->link)[0] == '@';

                                            if($is){
                                                if($blogger_platform->platform->title == 'Telegram'){
                                                    $link = 'https://t.me/' . substr($link, 1);
                                                }
                                                else if($blogger_platform->platform->title == 'Instagram'){
                                                    $link = 'https://www.instagram.com/' .  substr($link, 1);
                                                }
                                            }
                                        ?>
                                        <a target="_blank" href="{{ $link }}" class="item-platforms__title item-platforms__title--{{ $types[strtolower($blogger_platform->platform->title)] }}">
                                            {{ strtoupper($blogger_platform->platform->title) == 'VK' ? strtoupper($blogger_platform->platform->title) : ucfirst($blogger_platform->platform->title) }}
                                        </a>

                                        @switch(strtolower($blogger_platform->platform->title))
                                            @case('youtube')
                                                @if(($blogger_platform->coverage && $blogger_platform->coverage > 0) || ($blogger_platform->additional_coverage && $blogger_platform->additional_coverage > 0))
                                                    <div class="item-platforms__stats">
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Подписчики
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->subscriber_quantity ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if($blogger_platform->coverage && $blogger_platform->coverage > 0)
                                                            <div class = "item-platforms__stats-row">
                                                                <div class="item-platforms__stat">
                                                                    <div class="item-platforms__stat-title">
                                                                        Просмотры выпусков
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->coverage ?? 0 }}
                                                                    </div>
                                                                </div>
                                                                <div class="item-platforms__stat er">
                                                                    <div class="item-platforms__stat-title">
                                                                        ER %
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->engagement_rate ?? 0 }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($blogger_platform->additional_coverage && $blogger_platform->additional_coverage > 0)
                                                            <div class = "item-platforms__stats-row">
                                                                <div class="item-platforms__stat">
                                                                    <div class="item-platforms__stat-title">
                                                                        Просмотры shorts
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->additional_coverage ?? 0 }}
                                                                    </div>
                                                                </div>
                                                                <div class="item-platforms__stat er">
                                                                    <div class="item-platforms__stat-title">
                                                                        ER %
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->additional_engagement_rate ?? 0 }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @break

                                            @case('instagram')
                                                @if(($blogger_platform->coverage && $blogger_platform->coverage > 0))
                                                    <div class="item-platforms__stats">
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Подписчики
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->subscriber_quantity ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Просмотры reels
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->coverage ?? 0 }}
                                                                </div>
                                                            </div>
                                                            <div class="item-platforms__stat er">
                                                                <div class="item-platforms__stat-title">
                                                                    ER %
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->engagement_rate ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @break

                                            @case('vk')
                                                @if(($blogger_platform->coverage && $blogger_platform->coverage > 0) || ($blogger_platform->additional_coverage && $blogger_platform->additional_coverage > 0))
                                                    <div class="item-platforms__stats">
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Подписчики
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->subscriber_quantity ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if($blogger_platform->coverage && $blogger_platform->coverage > 0)
                                                            <div class = "item-platforms__stats-row">
                                                                <div class="item-platforms__stat">
                                                                    <div class="item-platforms__stat-title">
                                                                        Просмотры постов
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->coverage ?? 0 }}
                                                                    </div>
                                                                </div>
                                                                <div class="item-platforms__stat er">
                                                                    <div class="item-platforms__stat-title">
                                                                        ER %
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->engagement_rate ?? 0 }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($blogger_platform->additional_coverage && $blogger_platform->additional_coverage > 0)
                                                            <div class = "item-platforms__stats-row">
                                                                <div class="item-platforms__stat">
                                                                    <div class="item-platforms__stat-title">
                                                                        Просмотры клипов
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->additional_coverage ?? 0 }}
                                                                    </div>
                                                                </div>
                                                                <div class="item-platforms__stat er">
                                                                    <div class="item-platforms__stat-title">
                                                                        ER %
                                                                    </div>
                                                                    <div class="item-platforms__stat-value">
                                                                        {{ $blogger_platform->additional_engagement_rate ?? 0 }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @break

                                            @case('telegram')
                                                @if(($blogger_platform->coverage && $blogger_platform->coverage > 0))
                                                    <div class="item-platforms__stats">
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Подписчики
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->subscriber_quantity ?? 0 }}
                                                                </div>
                                                            </div>
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Просмотры
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->coverage ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat er">
                                                                <div class="item-platforms__stat-title">
                                                                    ER %
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->engagement_rate ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @break

                                            @default
                                                @if(($blogger_platform->coverage && $blogger_platform->coverage > 0))
                                                    <div class="item-platforms__stats">
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Подписчики
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->subscriber_quantity ?? 0 }}
                                                                </div>
                                                            </div>
                                                            <div class="item-platforms__stat">
                                                                <div class="item-platforms__stat-title">
                                                                    Просмотры
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->coverage ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "item-platforms__stats-row">
                                                            <div class="item-platforms__stat er">
                                                                <div class="item-platforms__stat-title">
                                                                    ER %
                                                                </div>
                                                                <div class="item-platforms__stat-value">
                                                                    {{ $blogger_platform->engagement_rate ?? 0 }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @break

                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="info-profile__row info-profile__desc">
                            <p>{{ $user->blogger->description ?? 'Нет описания' }}</p>
                        </div>
                    </div>
                </div>
                @if(count($projects) > 0)
                    <div class="user-view__projects">
                        <div class="profile-projects tab-content active" id="my-projects">
                            <div class="profile-projects__body">
                                <div class="profile-projects__title title">
                                    Список выполненных проектов
                                </div>
                                <div class="list-projects__items">
                                    @forelse ($projects as $project)
                                        <div class="list-projects__item project-item">
                                            <div class="owl-carousel project-item__carousel">
                                                <div class="project-item__img" style="background-image:url({{ $project->getImageURL(true) }})"></div>
                                            </div>
                                            <div class="project-item__content">
                                                <div class="project-item__title">
                                                    {{ $project->product_price }}₽
                                                </div>
                                                <div class="project-item__subtitle" title="{{ $project->product_name }}">
                                                    {{ $project->product_name }}
                                                </div>
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
                @endif
            </div>
        </div>
    </section>
</div>
@include('shared.success-message')
</body>
</html>
