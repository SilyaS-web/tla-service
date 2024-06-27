@extends('layout.layout')

@section('content')
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
                                <p style="font-size: 12px">
                                    {{ $user->blogger->country->name }}, {{ $user->blogger->city }}<br>
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
                            @if($user->blogger->is_achievement)
                            <div class="info-profile__tags-item">
                                Проверенный блогер
                            </div>
                            @endif
                        </div>
                        <div class="info-profile__platrfoms blogger-platforms">
                            @foreach ($user->blogger->platforms as $p )
                            <?
                                $types = [
                                    'Telegram' => 'tg',
                                    'Instagram' => 'inst',
                                    'VK' => 'vk',
                                    'Youtube' => 'yt'
                                ]
                            ?>
                            <div class="blogger-platforms__item item-platforms">
                                <div class="item-platforms__title item-platforms__title--{{ $types[$p->name] }}">
                                    {{ $p->name }}
                                </div>
                                <div class="item-platforms__stats">
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Подписчики
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            {{ $p->subscriber_quantity ?? 0 }}
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Охваты
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            {{ $p->coverage ?? 0 }}
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            ER %
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            {{ $p->engagement_rate ?? 0 }}
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            CPM
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            {{ $p->cost_per_mille ?? 0}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="blogger-platforms__item item-platforms">
                                <div class="item-platforms__title item-platforms__title--tg">
                                    Telegram
                                </div>
                                <div class="item-platforms__stats">
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Просмотры
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            850
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Охваты
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            120
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            ER %
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            860
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            CPM
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            428₽
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blogger-platforms__item item-platforms">
                                <div class="item-platforms__title item-platforms__title--inst">
                                    Instagram
                                </div>
                                <div class="item-platforms__stats">
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Просмотры
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            1200
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            Охваты
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            400
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            ER %
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            1200
                                        </div>
                                    </div>
                                    <div class="item-platforms__stat">
                                        <div class="item-platforms__stat-title">
                                            CPM
                                        </div>
                                        <div class="item-platforms__stat-value">
                                            724₽
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="info-profile__row info-profile__desc">
                        <p>{{ $user->blogger->description }}</p>
                    </div>
                </div>
            </div>
            <? if(count($projects) > 0): ?>
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
                                    <div class="project-item__img" style="background-image:url({{ $project->getImageURL(true) }})">
                                        {{-- <div class="project-item__status active">
                                                    {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
                                    </div> --}}
                                    {{-- <div class="project-item__country">
                                                    Россия
                                                </div> --}}
                                </div>
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
                        Пока что здесь пусть
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
        <? endif ?>
    </div>
    </div>
</section>

@endsection
