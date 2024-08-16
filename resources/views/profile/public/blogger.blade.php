@extends('layout.layout')

@section('title', $title ?? $user->name)

@section('content')
<section class="user-view">
    <div class="user-view__container _container">
        <div class="user-view__body">
            <a href={{url('/profile/?switch-tab=' . request()->get("tab"))}} class="user-view__back">
                <img src="{{asset('img/arrow-alt.svg')}}" alt="">
                <span> Вернуться </span>
            </a>
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
                            @foreach (($user->blogger->platforms ?? []) as $p )
                                @if(!$p->subscriber_quantity)
                                    @continue
                                @endif
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
                                    @if ($p->cost_per_mille)
                                        <div class="item-platforms__stat">
                                            <div class="item-platforms__stat-title">
                                                CPM
                                            </div>
                                            <div class="item-platforms__stat-value">
                                                {{ $p->cost_per_mille ?? 0}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
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
            @if(auth()->user()->role == 'admin')
                <div class="user-view__projects">
                    <div class="profile-projects tab-content active" id="my-projects">
                        <div class="profile-projects__body">
                            <div class="profile-projects__title title">
                                Работы
                            </div>
                            <div class="list-projects__items">
                                @forelse (($user->blogger->works ?? []) as $work)
                                    <div class="list-projects__item project-item">
                                        <div class="owl-carousel project-item__carousel">
                                            <div class="project-item__img" style="background-image:url({{ $work->project->getImageURL(true) }})"></div>
                                        </div>
                                        <div class="project-item__content">
                                            <div class="project-item__title">
                                                {{ $work->project->product_price }}₽
                                            </div>
                                            <div class="project-item__subtitle" title="{{ $work->project->product_name }}">
                                                {{ $work->project->product_name }}
                                            </div>
                                            <div class="project-item__format-tags card__row card__tags">
                                                <div class="card__tags-item">
                                                    <span>{{ $work->projectWork->getProjectWorkName() }}</span>
                                                </div>
                                                <div class="card__tags-item">
                                                    <span>{{ $work->getStatus() }}</span>
                                                </div>
                                            </div>
                                            <a target="_blank" href="{{ route('work-chat', ['work' => $work->id]) }}" class="btn btn-primary">Чат</a>
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

@endsection
