<div class="profile-projects__items">
    @forelse ($projects as $project)
        <div class="profile-projects__row profile-projects__item" data-id="{{$project->id}}" data-brand = "{{ $project->marketplace_brand }}">
            <div class="profile-projects__col profile-projects__img profile-projects--carousel owl-carousel">
                @foreach ($project->getImageURL() as $image)
                    <div class="project-item__img" style="background-image:url({{ $image }})"></div>
                @endforeach
            </div>
            {{-- <div class="profile-projects__col profile-projects__img" style="background-image: url({{ $project->getImageUrl(true) }})">
            </div> --}}
            <div class="profile-projects__col profile-projects__content" style="padding:5px 0px;">
                <div class="profile-projects__row" style="align-items: start">
                    <div class="profile-projects__item-title" title="{{ $project->product_name }}">
                        {{ $project->product_name }}
                    </div>
                    <div class="profile-projects__status {{ $project->getStatusClass() }}">
                        {{ $project->getStatusName() }}
                    </div>
                </div>
                <div class="profile-projects__row" style="flex-wrap:wrap; gap:5px;">
                    <p style="text-wrap: nowrap">Артикул товара: <b>{{ $project->product_nm }}</b></p>
                    <p style="text-wrap: nowrap">Цена товара: <b>{{ number_format($project->product_price, 0, '', ' ')  }}₽</b></p>
                </div>
                <div class="profile-projects__row">
                    <div class="profile-projects__formats">
                        @foreach ($project->getProjectWorkNamesWithQuantity() as $format)
                        <div class="profile-projects__format">
                            {{ $format['name'] }} — {{ $format['lost_quantity'] }}/{{ $format['total_quantity'] }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="profile-projects__row card-btns-desktop" style="margin-top:auto">
                    <div class="profile-projects__btns" style="margin-top:0;">
                        @if($project->is_blogger_access)
                            <button class="btn btn-secondary btn-bloggers">Заявки от блогеров <div class="nav-menu__item-notifs notifs notifs-application" style="display:none">1</div> </button>
                        @else
                            <a href="#" data-href="/apist/projects/{{$project->id}}/activate" class="btn btn-primary btn-public" style="text-align: center">Опубликовать</a>
                        @endif
                        <button class="btn btn-secondary btn-statistics">Статистика</button>
                    </div>
                </div>
            </div>
            <div class="profile-projects__col profile-projects__content profile-projects__info" style="padding:5px 0px;">
                <div class="card__col card__stats" style="flex: 1 1 auto">
                    <div class="card__col card__stats-stats" style="flex: 1 1 auto">
                        <div class="card__row card__stats-row">
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>Блогеров в работе</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ $project->works()->where('status', '<>', null)->count() }}</span>
                                    <span class="card__stats-val--total">
                                        ?
                                        <div class="card__stats-val--total-list">
                                            <p>Заявок отправлено — {{ $project->works()->where('status', null)->where('created_by', auth()->user()->id)->count() }}</p>
                                            <p>На согласовании — {{ $project->works()->where('status', 'pending')->count() }}</p>
                                            <p>В работе — {{ $project->works()->where('status', 'progress')->count() }}</p>
                                            <p>Выполнило работу — {{ $project->works()->where('status', 'completed')->count() }}</p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                <div class="card__stats-title">
                                    <span>Дата создания</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ date_format($project->created_at, 'd.m.Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__row card__stats-row">
                            @php( $statCount = $project->getCountStatistics() )
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>Рейтинг</span>
                                </div>
                                <div class="card__stats-val card__stats-val--rait">
                                    <span>{{ $statCount->reviewRating ?? 0 }}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                <div class="card__stats-title">
                                    <span>Отзывы</span>
                                </div>
                                <div class="card__stats-val card__stats-val--feedback">
                                    <span>{{ number_format($statCount->feedbacks ?? 0, 0, '', ' ') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__row card__stats-row card-btns-desktop" style="margin-top:auto">
                            <button class="btn btn-secondary btn-bloggers-in_work">Блогеры в работе</button>
                        </div>
                    </div>
                    <div class="card__row card__stats-row card-btns-mobile" style="margin-top:auto">
                        <button class="btn btn-secondary btn-bloggers-in_work">Блогеры в работе</button>
                        <button class="btn btn-secondary btn-statistics">Статистика</button>
                        @if($project->is_blogger_access)
                            <button class="btn btn-secondary btn-bloggers">Заявки от блогеров <div class="nav-menu__item-notifs notifs notifs-application" style="display:none">1</div></button>
                        @else
                            <a href="#" data-href="/apist/projects/{{$project->id}}/activate" class="btn btn-primary btn-public" style="text-align: center">Опубликовать</a>
                        @endif
                    </div>
                </div>
                {{-- <div class="profile-projects__row profile-projects__btns" style="margin-top:auto">
                    <button class="btn btn-primary btn-bloggers tablet">Заявки от блогеров</button>
                </div> --}}
            </div>
            <div class="profile-projects__row profile-projects__blogers projects-blogers projects-blogers--leads owl-carousel">
                @forelse ($project->works()->where('created_by', '<>', $project->seller_id)->where('status', null)->get() as $work_application)
                    @php($blogger = $work_application->blogger)
                    <div class="list-blogers__item bloger-item card" data-id="{{ $work_application->id }}">
                        <div class="card__row card__content">
                            <div class="card__col">
                                <div class="card__row card__header">
                                    <div class="card__img" style="background-image:url('{{ $blogger->user->getImageURL() }}')">
                                        @if ($blogger->is_achievement)
                                        <div class="card__achive">
                                            <img src="{{ asset('img/achive-icon.svg') }}" alt="">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card__name">
                                        <p class="card__name-name">
                                            {{ $blogger->user->name }}
                                        </p>
                                        <p style="font-size: 12px">
                                            {{ $blogger->country->name }}, {{ $blogger->city }}
                                        </p>
                                    </div>
                                    <div class="card__platforms">
                                        @foreach ($blogger->platforms as $platform)
                                            <a target="_blank" href="{{ $platform->link }}" class="card__platform {{ strtolower($platform->name) }}"><img src="{{ $platform->getIconURL() }}" alt=""></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card__row card__tags">
                                    {{-- <div class="card__tags-item">
                                        <span>Животные и Природа</span>
                                    </div>
                                    <div class="card__tags-item">
                                        <span>Развлечения и Юмор</span>
                                    </div>
                                    <div class="card__tags-item">
                                        <span>Другое</span>
                                    </div> --}}
                                </div>
                                <div class="card__row card__desc-title">
                                    <p style="font-weight: 500; font-size: 18px;">
                                        Сообщение от блогера
                                    </p>
                                </div>
                                <div class="card__row card__desc">
                                    <p>
                                        {{ $work_application->message }}
                                    </p>
                                </div>
                            </div>
                            <div class="card__col card__stats">
                                <div class="card__col card__stats-stats">
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Подписчики</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getSubscribers(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Просмотры</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getCoverage(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>ER %</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getER(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format(round(($project->product_price / ($blogger->getCoverage() == 0 ? 1 : $blogger->getCoverage())) * 1000, 2), 2, ',', ' ') }} ₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__col card__column--gender">
                                    <div class="card__stats-title">
                                        <span>Пол аудитории</span>
                                    </div>
                                    <div class="card__row" style="align-items: center; gap:5px">
                                        <div class="card__diagram-icon"><img src="img/blogers-list/male-icon.svg" alt=""></div>
                                        <div class="card__diagram-line"><span style="width:{{ $blogger->gender_ratio }}%;"></span></div>
                                        <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                                    </div>
                                </div>
                                <div class="card__row" style="text-align: center;">
                                    <a href="{{ route('blogger-page', $blogger->id) . '?tab=profile-projects' }}" class="" style="width: 100%; color: #FE5E00; font-size:16px; font-weight:500; text-decoration:underline; margin-top: -10px;">Подробнее</a>
                                </div>
                                <div class="card__row bloger-item--btns" style="gap:12px; width:100%; flex-wrap: wrap; justify-content: center">
                                    <button class="btn btn-primary" onclick="acceptWork(this, {{ $work_application->id }}, {{ $project->id}})" data-work-id="{{ $work_application->id }}">
                                        Принять
                                    </button>
                                    <button class="btn btn-secondary" onclick="denyWork(this, {{ $work_application->id }})">
                                        Отклонить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    Нет заявок
                    @endforelse
            </div>

            <div class="profile-projects__row profile-projects__blogers projects-blogers projects-blogers--in_work owl-carousel" data-el="active-work-list-{{$project->id}}">
                @forelse ($project->getActiveWorks() as $active_work)
                    @php($blogger = $active_work->blogger)
                    <div class="list-blogers__item bloger-item card" data-id="{{ $active_work->id }}">
                        <div class="card__row card__content">
                            <div class="card__col">
                                <div class="card__row card__header">
                                    <div class="card__img" style="background-image:url('{{ $blogger->user->getImageURL() }}')">
                                        <div class="card__achive tooltip">
                                            <img src="{{ asset('img/achive-icon.svg') }}" alt="">
                                            <div class="tooltip__text">
                                                <p>Проверенный блогер</p>
                                            </div>
                                        </div>
                                        @if ($blogger->is_achievement)
                                            <div class="card__achive tooltip">
                                                <img src="{{ asset('img/achive-icon.svg') }}" alt="">
                                                <div class="tooltip__text">
                                                    <p>Проверенный блогер</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card__name">
                                        <p class="card__name-name">
                                            {{ $blogger->user->name }}
                                        </p>
                                        <p style="font-size: 12px">
                                            {{ $blogger->country->name }}, {{ $blogger->city }}
                                        </p>
                                    </div>
                                    <div class="card__platforms">
                                        @foreach ($blogger->platforms as $platform)
                                            <a target="_blank" href="{{ $platform->link }}" class="card__platform {{ strtolower($platform->name) }}"><img src="{{ $platform->getIconURL() }}" alt=""></a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card__row card__tags">
                                    {{-- <div class="card__tags-item">
                                        <span>Животные и Природа</span>
                                    </div>
                                    <div class="card__tags-item">
                                        <span>Развлечения и Юмор</span>
                                    </div>
                                    <div class="card__tags-item">
                                        <span>Другое</span>
                                    </div> --}}
                                </div>
                                <div class="card__row card__desc-title">
                                    <p style="font-weight: 500; font-size: 18px;">
                                        Описание канала
                                    </p>
                                </div>
                                <div class="card__row card__desc">
                                    <p>
                                        {{ $blogger->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="card__col card__stats">
                                <div class="card__col card__stats-stats">
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Подписчики</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getSubscribers(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Просмотры</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getCoverage(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>ER %</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($blogger->getER(), 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format(round(($project->product_price / ($blogger->getCoverage() == 0 ? 1 : $blogger->getCoverage())) * 1000, 2), 2, ',', ' ') }} ₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__col card__column--gender">
                                    <div class="card__stats-title">
                                        <span>Пол аудитории</span>
                                    </div>
                                    <div class="card__row" style="align-items: center; gap:5px">
                                        <div class="card__diagram-icon"><img src="img/blogers-list/male-icon.svg" alt=""></div>
                                        <div class="card__diagram-line"><span style="width:{{ $blogger->gender_ratio }}%;"></span></div>
                                        <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                                    </div>
                                </div>
                                <div class="card__row card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                                    @if ($active_work->status == null)
                                    <button class="btn btn-secondary" data-project-id="{{ $project->id }}" onclick="(function(){ $(document).find('.chat-link').click(); $(document).find( '.item-chat[ data-id={{ $active_work->id }} ]' ).click() })()">
                                        Заявка отправлена
                                    </button>
                                    @else
                                    <button class="btn btn-primary btn-to-chat" data-work-id="{{ $active_work->id }}">
                                        Перейти в диалог
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <span class="empty-bloggers">
                        Нет блогеров в работе
                    </span>
                    @endforelse
            </div>

            @php($stats = json_decode($project->getStatistics(Auth()->user()->seller->ozon_client_id, Auth()->user()->seller->ozon_api_key)))
            <div class="profile-projects__row profile-projects__statistics projects-statistics" data-stats="{{ json_encode($stats) }}">
                <div class="view-project__props view-project__props--desktop">
                    <div class="view-project__props-wrap">
                        <div class="view-project__props-col">
                            <div class="projects-statistics__title">
                                Общая статистика
                            </div>
                            @php($finish_stats = $project->getFinishStats())
                            @php($clicks_count = $project->getClicksCount())
                            @if ($clicks_count > 1 || $finish_stats['total_subs'] > 1 || $finish_stats['total_views'] > 1)
                                <div class="card__col card__stats-stats card__stats-stats--total" style="width:100%; flex-direction:row; flex-wrap:wrap; gap: 8px">
                                    <div class="card__row card__stats-row" style="width:calc(100% / 2 - 4px); margin-right:0!important">
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Количество<br> переходов</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($clicks_count, 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                            <div class="card__stats-title">
                                                <span>Охваты</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format($finish_stats['total_views'], 0, '', ' ') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row" style="width:calc(100% / 2 - 4px)">
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val ">
                                                @php($total_cpm = round($project->product_price / ($finish_stats['total_views'] == 0 ? 1 : $finish_stats['total_views']) * 1000, 2))
                                                <span>{{ number_format($total_cpm, 2, ',', ' ')  }} ₽</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                            <div class="card__stats-title">
                                                <span>CPC</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ number_format(round(($project->product_price / ($clicks_count == 0 ? 1 : $clicks_count)), 2), 0, '', ' ') }} ₽</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                Нет данных
                            @endif
                        </div>
                    </div>
                    <div class="view-project__props-wrap" style="margin-top:45px;">
                        <div class="view-project__props-col" style="position: relative">
                            <div class="projects-statistics__title">
                                Статистика по товару
                                <div class="projects-statistics__title-tooltip tooltip">
                                    ?
                                    <div class="tooltip__text">
                                        <p>В случае отсутствия отображения статистики, необходимо ввести API-ключ в разделе 'Личные данные'.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view-project__props-total">
                                <div class="view-project__props-orders">
                                    Заказы за 30 дн<br>
                                    <span class="count">{{ number_format($stats->orders ?? 0, 0, '', ' ') }} шт</span>
                                </div>
                                <div class="view-project__props-money">
                                    Выручка за 30 дн<br>
                                    <span class="money">{{ number_format($stats->earnings ?? 0, 0, '', ' ') ?? 0  }} ₽</span>
                                </div>
                            </div>
                            <div class="view-project__props-graph">
                                <canvas id="orders-graph-desktop" class=""></canvas>
                            </div>
                            <div class="dashboard__placeholder" style="z-index: 1; top:0; left:0;">
                                <div class="dashboard__placeholder-text">
                                    Переверните экран, чтобы посмотреть статистику
                                </div>
                                <div class="dashboard__placeholder-overflow">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-project__props-wrap" style="margin-top:45px;">
                        <div class="view-project__props-col">
                            <div class="card__col card__stats-stats" style="width:100%">
                                <div class="projects-statistics__title" style="margin-bottom: 0">
                                    Статистика по завершённым работам
                                </div>
                                @if ($project->works()->where('status', 'completed')->count() < 1)
                                    Нет данных
                                @else
                                    <div class="card__stats-table table-stats">
                                        <div class="table-stats__header">
                                            <div class="table-stats__row">
                                                <div class="table-stats__col table-stats__blogger-img" style="width: 10%;height:50px;">

                                                </div>
                                                <div class="table-stats__col" style="width: 13%;">
                                                    Имя
                                                </div>
                                                <div class="table-stats__col" style="width: 11%;">
                                                    Подписчики
                                                </div>
                                                <div class="table-stats__col" style="width: 11%;">
                                                    Охваты
                                                </div>
                                                <div class="table-stats__col" style="width: 11%;">
                                                    Переходы
                                                </div>
                                                <div class="table-stats__col" style="width: 6%;">
                                                    ER %
                                                </div>
                                                <div class="table-stats__col" style="width: 9%;">
                                                    CPM
                                                </div>
                                                <div class="table-stats__col" style="width: 9%;">
                                                    CTR %
                                                </div>
                                                <div class="table-stats__col" style="width: 14%;">
                                                    Дата завершения
                                                </div>
                                                <div class="table-stats__col" style="width: 6%;">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-stats__body">
                                            @forelse ($project->works()->where('status', 'completed')->get() as $work)
                                                <div class="table-stats__row" data-work-id = "{{ $work->id }}">
                                                    <div class="table-stats__col table-stats__blogger-img" style="width: 10%">
                                                        <img src="{{ $work->blogger->user->getImageURL() }}" alt="">
                                                    </div>
                                                    <div class="table-stats__col" style="width: 13%;">
                                                        {{ $work->blogger->user->name }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 11%;">
                                                        {{ number_format($work->blogger->getSubscribers(), 0, '', ' ') }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 11%;">
                                                        @if(!$work->finishStats)
                                                            <span class="table-stats__quest">
                                                                ?
                                                                <div class="table-stats__quest-text">
                                                                    <p>Запросите статистику у блогера</p>
                                                                </div>
                                                            </span>
                                                        @else
                                                            {{ number_format($work->finishStats->views, 0, '', ' ') }}
                                                        @endif
                                                    </div>
                                                    <div class="table-stats__col" style="width: 11%;">
                                                        {{ number_format($work->getTotlaClicks(), 0, '', ' ') }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 6%;">
                                                        @if(!$work->finishStats)
                                                            <span class="table-stats__quest">
                                                                ?
                                                                <div class="table-stats__quest-text">
                                                                    <p>Запросите статистику у блогера</p>
                                                                </div>
                                                            </span>
                                                        @else
                                                            @php($er = floor($work->finishStats->views / ($work->blogger->getSubscribers() == 0 ? 1 : $work->blogger->getSubscribers()) * 100) )
                                                            {{ number_format($er, 2, ',', ' ')  }}
                                                        @endif
                                                    </div>
                                                    <div class="table-stats__col" style="width: 9%;">
                                                        @if(!$work->finishStats)
                                                            <span class="table-stats__quest">
                                                                ?
                                                                <div class="table-stats__quest-text">
                                                                    <p>Запросите статистику у блогера</p>
                                                                </div>
                                                            </span>
                                                        @else
                                                            {{ number_format(round($project->product_price / ($work->finishStats->views == 0 ? 1 : $work->finishStats->views) * 1000, 2), 0, '', ' ') }} ₽
                                                        @endif
                                                    </div>
                                                    <div class="table-stats__col" style="width: 9%;">
                                                        @if(!$work->finishStats)
                                                            <span class="table-stats__quest">
                                                                ?
                                                                <div class="table-stats__quest-text">
                                                                    <p>Запросите статистику у блогера</p>
                                                                </div>
                                                            </span>
                                                        @else
                                                            @php($cpr = round($work->getTotlaClicks() / ($work->finishStats->views == 0 ? 1 : $work->finishStats->views) * 100, 2))
                                                            {{ number_format($cpr, 2, ',', ' ')  }}
                                                        @endif
                                                    </div>
                                                    <div class="table-stats__col" style="width: 14%;">
                                                        {{$work->confirmed_by_seller_at}}
                                                    </div>
                                                    <div class="table-stats__col table-stats__col--chat" style="width: 6%; cursor:pointer">
                                                        <img src="{{ asset('img/chat-black-icon.svg') }}" alt="">
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                            <script>
                                                $(document).on('click', '.table-stats__row .table-stats__col--chat ', function(e){
                                                    var id = $(e.target).closest('.table-stats__row').data('work-id');

                                                    $('.chat-link').click();
                                                    $(`.item-chat[data-id="${id}"]`).click();
                                                })
                                                $(document).on('click', '.table-stats__row .table-stats__quest', function(e){
                                                    e.stopPropagation();
                                                })
                                            </script>
                                        </div>
                                    </div>
                                @endif
                                <div class="dashboard__placeholder" style="z-index: 1; top:0; left:0;">
                                    <div class="dashboard__placeholder-text">
                                        Переверните экран, чтобы посмотреть статистику
                                    </div>
                                    <div class="dashboard__placeholder-overflow">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-projects__control-btns">
                <div class="profile-projects__dots" title="Опции">
                    <img src="img/dots-icon.svg" alt="">
                </div>
                <div class="profile-projects__opts">
                    @if($project->works->count() < 1 && !$project->is_blogger_access)
                        <a href="apist/projects/{{$project->id}}/edit" class="profile-projects__opts-item profile-projects__edit">
                            <img src="img/pencil-icon.svg" alt="">
                            <div class="profile-projects__opts-name">Редактировать</div>
                        </a>
                    @endif

                    {{-- если не скрыт --}}
                    @if($project->status != $project::STOPPED)
                        <a href="apist/projects/{{$project->id}}/stop" class="profile-projects__opts-item profile-projects__hide">
                            <img src="img/hide-icon.svg" alt="">
                            <div class="profile-projects__opts-name">Скрыть</div>
                        </a>
                    @else
                        <a href="apist/projects/{{$project->id}}/start" class="profile-projects__opts-item profile-projects__show">
                            <img src="img/show-icon.svg" alt="">
                            <div class="profile-projects__opts-name">Показывать</div>
                        </a>
                    @endif

                    <a href="#" data-href="apist/projects/{{$project->id}}/delete" class="profile-projects__opts-item profile-projects__delete">
                        <img src="img/delete-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Удалить</div>
                    </a>
                </div>
            </div>
        </div>
    @empty
    Нет проектов
    @endforelse
</div>

<script>
    $(document).on('click', '.profile-projects__control-btns', function(e){
        $(e.target).closest('.profile-projects__control-btns').toggleClass('active')
    })

    var mediaQuery = window.matchMedia('(max-width: 911px)');
    var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

    $(document).find('.profile-projects__row.projects-statistics').each((i, stat) => {
        var prices_ctx, orders_ctx;

        prices_ctx = $(stat).find('#prices-graph-desktop');
        orders_ctx = $(stat).find('#orders-graph-desktop');

        var data = $(stat).data('stats')
            , lineData = []
            , barData = [];

        datasets = [{
                label: 'Выручка',
                data: data.prices_history.map((item, index) => {
                    if (item["earnings"] !== undefined) {
                        return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: Math.round(item.earnings)};

                    } else {
                        return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: Math.round(item.price * data.orders_history[index].orders)};
                    }
                }),
                showLine: true,
                type: 'line',
                backgroundColor: data.prices_history.map(() => {
                    return 'rgb(255, 99, 132, 0.5)'
                }),
                order: 0,
            },
            {
                label: 'Заказы',
                data: data.orders_history.map(item => {
                    return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: Math.round(item.orders)};

                }),
                showLine: true,
                type: 'bar',
                backgroundColor: data.orders_history.map(() => {
                    return 'rgb(54, 162, 235, 0.5)'
                }),
                order: 1,
                tension: 0.1
            },
            {
                label: 'Блоггеров завершило работу',
                data: data.bloggers_history.map(item => {
                    return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: item.bloggers};
                }),
                showLine: true,
                type: 'bar',
                backgroundColor: data.bloggers_history.map(() => {
                    return 'rgb(254,94,0, 0.4)'
                }),
                order: 2
            },
        ];

        var prodsStatistics = new Chart(orders_ctx, {
            type: 'scatter',
            data: {
                labels: data.prices_history.map(item => {
                    return `${item.dt.split('-')[2]} ${month[Number(item.dt.split('-')[1]) - 1]}`
                }),
                datasets: datasets
            },
            options: {
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        type: 'logarithmic',
                    },
                },
            }
        });

        prodsStatistics.update();

        window
            .matchMedia('(orientation: portrait)')
            .addListener(function (m) {
                if (m.matches) {
                } else {
                    prodsStatistics.resize()
                }
            })
    })

</script>
<script>
    $(window).on('load', function(){
        $('.projects-blogers--in_work .btn-to-chat').on('click', (e)=>{
            var id = $(e.target).closest('.btn-to-chat').data('work-id');
            if($(document).find(`.item-chat[data-id="${id}"]`).length > 0){
                $(document).find('.chat-link').click();
                $(document).find(`.item-chat[data-id="${id}"]`).click();
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(document).find(`.item-chat[data-id="${id}"]`).offset().top
                }, 2000);
            }
        })
    })
</script>

