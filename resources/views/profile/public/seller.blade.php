@extends('layout.layout')

@section('title', $title ?? $user->name)

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
            @if(auth()->user()->role == 'admin')
                <div class="user-view__projects">
                    <div class="profile-projects tab-content active" id="my-projects">
                        <div class="profile-projects__body">
                            <div class="profile-projects__title title">
                                Работы
                            </div>
                            <div class="list-projects__items">
                                @forelse ($user->seller->works as $work)
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
