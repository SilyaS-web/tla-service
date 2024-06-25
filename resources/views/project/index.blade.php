<div class="profile-projects__items">
    @forelse ($projects as $project)
        <div class="profile-projects__row profile-projects__item" data-id="{{$project->id}}" data-brand = "axe">
            <div class="profile-projects__col profile-projects__img" style="background-image: url({{ $project->getImageUrl(true) }})">
            </div>
            <div class="profile-projects__col profile-projects__content" style="padding:5px 0px;">
                <div class="profile-projects__row" style="align-items: start">
                    <div class="profile-projects__item-title" title="{{ $project->product_name }}">
                        {{ $project->product_name }}
                    </div>
                    <div class="profile-projects__status active">
                        {{ $project->getStatusName() }}
                    </div>
                </div>
                <div class="profile-projects__row">
                    <p>Артикул товара: <b>{{ $project->product_nm }}</b></p>
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
                            <button class="btn btn-secondary btn-bloggers">Заявки от блогеров {{-- <div class="nav-menu__item-notifs notifs notifs-application" style="">1</div> --}} </button>
                        @else
                            <a href="/apist/projects/{{$project->id}}/activate" class="btn btn-secondary" style="text-align: center">Выложить проект </a>
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
                                    <span>{{ $statCount->reviewRating ?? 0}}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                <div class="card__stats-title">
                                    <span>Отзывы</span>
                                </div>
                                <div class="card__stats-val card__stats-val--feedback">
                                    <span>{{ $statCount->feedbacks ?? 0}}</span>
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
                        <button class="btn btn-secondary btn-bloggers">Заявки от блогеров {{-- <div class="nav-menu__item-notifs notifs notifs-application" style="">1</div> --}}</button>
                        {{-- <a href="/apist/projects/{{$project->id}}/activate" class="btn btn-secondary" style="text-align: center">Выложить проект </a> --}}
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
                                    <div class="card__img">
                                        <img src="{{ $blogger->user->getImageURL() }}" alt="">
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
                                        <div class="card__platform {{ strtolower($platform->name) }}"><img src="{{ $platform->getIconURL() }}" alt=""></div>
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
                                                <span>{{ $blogger->getSubscribers() }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Охваты</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getCoverage() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>ER</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getER() }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getCPM() }}₽</span>
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
                                    <a href="{{ route('blogger-page', $blogger->id) }}" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -10px;">Подробнее</a>
                                </div>
                                <div class="card__row card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                                    <a href="apist/works/{{ $work_application->id }}/start" class="btn btn-primary" data-project-id="">
                                        Принять
                                    </a>
                                    <button class="btn btn-secondary" data-project-id="">
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

            <div class="profile-projects__row profile-projects__blogers projects-blogers projects-blogers--in_work owl-carousel">
                @forelse ($project->getActiveWorks() as $active_work)
                    @php($blogger = $active_work->blogger)
                    <div class="list-blogers__item bloger-item card" data-id="{{ $active_work->id }}">
                        <div class="card__row card__content">
                            <div class="card__col">
                                <div class="card__row card__header">
                                    <div class="card__img">
                                        <img src="{{ $blogger->user->getImageURL() }}" alt="">
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
                                        <div class="card__platform {{ strtolower($platform->name) }}"><img src="{{ $platform->getIconURL() }}" alt=""></div>
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
                                                <span>{{ $blogger->getSubscribers() }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Охваты</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getCoverage() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row">

                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>ER</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getER() }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $blogger->getCPM() }}₽</span>
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
                    Нет блогеров в работе
                    @endforelse
            </div>
            @php($stats = json_decode($project->getStatistics()))
            <div class="profile-projects__row profile-projects__statistics projects-statistics" data-stats="{{ $project->getStatistics() }}">
                <div class="view-project__props view-project__props--desktop">
                    <div class="view-project__props-wrap">
                        <div class="view-project__props-col" style="position: relative">
                            <div class="projects-statistics__title">
                                Статистика по товару (WB)
                            </div>
                            <div class="view-project__props-total">
                                <div class="view-project__props-orders">
                                    Заказы за 30 дн<br>
                                    <span class="count">{{$stats->orders ?? 0}} шт</span>
                                </div>
                                <div class="view-project__props-money">
                                    Выручка за 30 дн<br>
                                    <span class="money">{{$stats->earnings ?? 0}} ₽</span>
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
                        <div class="view-project__props-col">
                            <div class="projects-statistics__title">
                                Общая статистика
                            </div>
                            @php($finish_stats = $project->getFinishStats())
                            @php($clicks_count = $project->getClicksCount())
                            @if ($clicks_count > 1 || $finish_stats['total_subs'] > 1 || $finish_stats['total_views'] > 1)
                                <div class="card__col card__stats-stats" style="flex: 1 1 auto">
                                    <div class="card__row card__stats-row">
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>Количество переходов</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $clicks_count }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                            <div class="card__stats-title">
                                                <span>Охваты</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ $finish_stats['total_views'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__row card__stats-row">
                                        <div class="card__col card__stats-item">
                                            <div class="card__stats-title">
                                                <span>CPM</span>
                                            </div>
                                            <div class="card__stats-val ">
                                                <span>{{ round(($finish_stats['total_views'] / ($project->product_price == 0 ? 1 : $project->product_price)) * 1000, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                            <div class="card__stats-title">
                                                <span>CPC</span>
                                            </div>
                                            <div class="card__stats-val">
                                                <span>{{ round(($project->product_price / ($clicks_count == 0 ? 1 : $clicks_count)), 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                Нет данных
                            @endif
                        </div>
                    </div>
                    <div class="view-project__props-wrap" style="margin-top:30px;">
                        <div class="view-project__props-col">
                            <div class="card__col card__stats-stats" style="width:100%">
                                <div class="projects-statistics__title" style="margin-bottom: 0">
                                    Статистика по завершённым работам
                                </div>
                                @if ($project->works()->has('finishStats')->count() < 1)
                                    Нет данных
                                @else
                                    <div class="card__stats-table table-stats">
                                        <div class="table-stats__header">
                                            <div class="table-stats__row">
                                                <div class="table-stats__col table-stats__blogger-img" style="width: 10%;height:50px;">

                                                </div>
                                                <div class="table-stats__col" style="width: 14%;">
                                                    Nickname
                                                </div>
                                                <div class="table-stats__col" style="width: 12%;">
                                                    Подписчики
                                                </div>
                                                <div class="table-stats__col" style="width: 12%;">
                                                    Охваты
                                                </div>
                                                <div class="table-stats__col" style="width: 12%;">
                                                    Переходы
                                                </div>
                                                <div class="table-stats__col" style="width: 6%;">
                                                    ER
                                                </div>
                                                <div class="table-stats__col" style="width: 11%;">
                                                    CPM
                                                </div>
                                                <div class="table-stats__col" style="width: 11%;">
                                                    CTR
                                                </div>
                                                <div class="table-stats__col" style="width: 16%;">
                                                    Дата завершения
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-stats__body">
                                            @forelse ($project->works as $work)
                                                @if ($work->finishStats)
                                                <div class="table-stats__row">
                                                    <div class="table-stats__col table-stats__blogger-img" style="width: 10%">
                                                        <img src="{{ $work->blogger->user->getImageURL() }}" alt="">
                                                    </div>
                                                    <div class="table-stats__col" style="width: 14%;">
                                                        {{ $work->blogger->user->name }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 12%;">
                                                        {{ $work->finishStats->subs }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 12%;">
                                                        {{ $work->finishStats->views }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 12%;">
                                                        {{ $work->getTotlaClicks() }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 6%;">
                                                        {{ round($work->finishStats->views / ($work->finishStats->subs == 0 ? 1 : $work->finishStats->subs), 2) }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 11%;">
                                                        {{ round($work->finishStats->views / ($project->product_price == 0 ? 1 : $project->product_price), 2)  }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 11%;">
                                                        {{ round($work->getTotlaClicks() / ($work->finishStats->views == 0 ? 1 : $work->finishStats->views), 2)  }}
                                                    </div>
                                                    <div class="table-stats__col" style="width: 16%;">
                                                        {{$work->confirmed_by_seller_at}}
                                                    </div>
                                                </div>
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($project->works->count() < 1)
            <div class="profile-projects__control-btns">
                <div class="profile-projects__dots" title="Опции">
                    <img src="img/dots-icon.svg" alt="">
                </div>
                <div class="profile-projects__opts">
                    <a href="apist/projects/{{$project->id}}/edit" class="profile-projects__opts-item profile-projects__edit">
                        <img src="img/pencil-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Редактировать</div>
                    </a>
                </div>
            </div>
            @endif
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

    $(document).find('.profile-projects__row.projects-statistics').each((i, stat) => {
        var prices_ctx, orders_ctx;

        prices_ctx = $(stat).find('#prices-graph-desktop');
        orders_ctx = $(stat).find('#orders-graph-desktop');

        var data = $(stat).data('stats')
            , lineData = []
            , barData = [];

        console.log(data);

        datasets = [{
                label: 'Выручка'
                , data: data.prices_history.map((item, index) => {
                    return Math.round(item.price * data.orders_history[index].orders)
                })
                , showLine: true
                , type: 'line',
                // bloggers: data.prices_history.map(() => {
                //     return Math.floor(Math.random() * 15)
                // })
                backgroundColor: data.prices_history.map(() => {
                    return 'rgb(255, 99, 132, 0.5)'
                })
                , bloggers: data.prices_history.map(item => item.bloggers)
                , order: 0
            , }
            , {
                label: 'Заказы'
                , data: data.orders_history.map(item => {
                    return Math.round(item.orders)
                })
                , showLine: true
                , type: 'bar',
                // , bloggers: data.orders_history.map(() => {
                //     return Math.floor(Math.random() * 15)
                // })
                backgroundColor: data.orders_history.map(() => {
                    return 'rgb(54, 162, 235, 0.5)'
                })
                , bloggers: data.orders_history.map(item => item.bloggers)
                , order: 1
                , tension: 0.1
            }
            , {
                label: 'Блоггеров завершило работу'
                , data: data.orders_history.map(item => item.bloggers),
                // data: data.orders_history.map(() => {
                //     return 1
                // }),
                showLine: true
                , type: 'bar'
                , backgroundColor: data.orders_history.map(() => {
                    return 'rgb(254,94,0, 0.4)'
                })
                , order: 2
            }
        , ]

        var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        var prodsStatistics = new Chart(orders_ctx, {
            type: 'scatter'
            , data: {
                labels: data.prices_history.map(item => {
                    return `${item.dt.split('-')[2]} ${month[Number(item.dt.split('-')[1]) - 1]}`
                })
                , datasets: datasets
            }
            , options: {
                plugins: {
                    tooltip: {
                        mode: 'index'
                        , intersect: false
                        , callbacks: {
                            title: (item, data) => {
                                var cItem = item[0]
                                    , cLabel = prodsStatistics.data.labels[cItem.dataIndex];

                                if (cItem.dataset.bloggers[cItem.dataIndex] > 0) {
                                    return cLabel + ', Блогер(ов) завершило работу: ' + cItem.dataset.bloggers[cItem.dataIndex]
                                }
                            },

                        }
                    }
                , }
                , hover: {
                    mode: 'nearest'
                    , intersect: true
                }
                , scales: {
                    y: {
                        beginAtZero: true,
                        type: 'logarithmic',
                        // ticks: {
                        //     callback: (tick, index, array)=> {
                        //         var newTick = '';

                        //         if(Math.trunc(tick) === tick){
                        //             newTick = tick
                        //         }

                        //         return tick === 0 ? 0 : newTick;
                        //     }
                        // },
                    },
                }
            , }
        });

        var dataset = prodsStatistics.data.datasets[1];
        var colors = {};

        // Loop through data values
        dataset.bloggers.forEach(function(value, index) {
            if (value > 0) {
                colors[index] = '#FE5E00'
            }
        });

        var dataset = prodsStatistics.data.datasets[1];

        for (var i = 0; i < dataset.data.length; i++) {
            if (colors[i]) {
                dataset.backgroundColor[i] = 'rgba(254,94,0, 0.5)';
            }
        }

        prodsStatistics.update();

        window
            .matchMedia('(orientation: portrait)')
            .addListener(function (m) {
                if (m.matches) {
                } else {
                    prodsStatistics.resize()
                }
            })

        // window.addEventListener('resize', function () {
        //     prodsStatistics.resize()
        //     console.log(prodsStatistics);
        // })
    })

</script>
<script>
    $(window).on('load', function(){
        $('.projects-blogers--in_work .btn-to-chat').on('click', (e)=>{
            var id = $(e.target).closest('.btn-to-chat').data('work-id');

            $(document).find('.chat-link').click();
            $(document).find(`.item-chat[data-id="${id}"]`).click();
            $([document.documentElement, document.body]).animate({
                scrollTop: $(document).find(`.item-chat[data-id="${id}"]`).offset().top
            }, 2000);
            console.log();
        })
    })
</script>
