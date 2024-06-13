<div class="profile-projects__items">
    @forelse ($projects as $project)
    <div class="profile-projects__row profile-projects__item" data-id="{{$project->id}}">
        <div class="profile-projects__col profile-projects__img" style="background-image: url({{ $project->getImageUrl(true) }})">
            {{-- <img src="{{ $project->getImageUrl(true) }}" alt=""> --}}
        </div>
        <div class="profile-projects__col profile-projects__content" style="padding:5px 0px;">
            <div class="profile-projects__row" style="align-items: start">
                <div class="profile-projects__item-title" title="{{ $project->product_name }}">
                    {{ $project->product_name }}
                </div>
                <div class="profile-projects__status active">
                    {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
                </div>
            </div>
            <div class="profile-projects__row">
                <p>Артикул товара: <b>{{ $project->product_nm }}</b></p>
            </div>
            <div class="profile-projects__row">
                <div class="profile-projects__formats">
                    @foreach ($project->getProjectWorkNames() as $format)
                    <div class="profile-projects__format">
                        {{ $format }}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="profile-projects__row" style="margin-top:auto">
                <div class="profile-projects__btns" style="margin-top:0;">
                    <button class="btn btn-secondary btn-bloggers">Заявки от блогеров</button>
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
                                <span class = "card__stats-val--total">
                                    ?
                                    <div class="card__stats-val--total-list">
                                        <p>Всего в зайдействовано — 12</p>
                                        <p>Всего в работе — 8</p>
                                        <p>Всего выполнило работу — 4</p>
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
                    <div class="card__row card__stats-row" style="margin-top:auto">
                        <button class="btn btn-secondary btn-bloggers-in_work">Блогеры в работе</button>
                    </div>
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
                            <div class="card__row card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                                <button class="btn btn-primary" data-project-id="">
                                    Принять
                                </button>
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
            @forelse ($project->works()->where('created_by', $project->seller_id)->orWhere('status', '<>', null)->get() as $active_work)
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
                                <button class="btn btn-primary" data-project-id="{{ $project->id }}" onclick="(function(){ $(document).find('.chat-link').click(); $(document).find( '.item-chat[ data-id={{ $active_work->id }} ]' ).click() })()">
                                    Перейти в диалог
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                Нет блогеров в работе
                @endforelse
        </div>
        <?
            $stats = json_decode($project->getStatistics());
        ?>
        <div class="profile-projects__row profile-projects__statistics projects-statistics" data-stats="{{ $project->getStatistics() }}">
            <div class="view-project__props view-project__props--desktop">
                <div class="view-project__props-wrap">
                    <div class="view-project__props-col">
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
                    </div>
                    <div class="view-project__props-col">
                        {{-- <div class="projects-statistics__title">
                            Статистика по товару (OZON)
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
                    <canvas id="prices-graph-desktop" class=""></canvas>
                </div> --}}
                {{-- <div class="view-project__props-ph">
                            <div class="view-project__props-ph_title" style="text-align: center">
                                Статистика по товару (OZON)<br>
                                Раздел находится в разработке
                            </div>
                        </div>
                        <div class="view-project__props-overflow" style="background-image: url('{{ asset('img/Remove-bg 1.png') }}'); background-size:contain; background-position:center; background-repeat:no-repeat;">
            </div> --}}
            @php($clicks_count = $project->getClicksCount())
            <div class="card__col card__stats-stats">
                <div class="projects-statistics__title" style="margin-bottom: 0">
                    Статистика по интеграциям
                </div>
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Охватов</span>
                        </div>
                        <div class="card__stats-val">
                            <span>120</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Переходов</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $clicks_count }}</span>
                        </div>
                    </div>
                </div>
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>ER</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $clicks_count }}</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>CPM</span>
                        </div>
                        <div class="card__stats-val">
                            <span>4200₽</span>
                        </div>
                    </div>
                </div>
            </div>
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
</div>
{{-- <div class="profile-projects__control-btns">
            <div class="profile-projects__edit">
                <img src="img/pencil-icon.svg" alt="">
            </div>
            <div class="profile-projects__hide">
                <img src="img/eye-icon.svg" alt="">
            </div>
            <div class="profile-projects__delete">
                <img src="img/delete-icon.svg" alt="">
            </div>
        </div> --}}
</div>
@empty
Нет проектов
@endforelse
</div>

<script>
    var mediaQuery = window.matchMedia('(max-width: 911px)');

    $(document).find('.profile-projects__row.projects-statistics').each((i, stat) => {
        var prices_ctx, orders_ctx;

        prices_ctx = $(stat).find('#prices-graph-desktop');
        orders_ctx = $(stat).find('#orders-graph-desktop');

        var data = $(stat).data('stats'), lineData = [], barData = [];

        datasets = [{
                label: 'Выручка',
                data: data.prices_history.map((item, index) =>{ return item.price * data.orders_history[index].orders } ),
                showLine: true,
                type: 'line',
                // bloggers: data.prices_history.map(() => {
                //     return Math.floor(Math.random() * 15)
                // })
                backgroundColor: data.prices_history.map(() => {
                    return 'rgb(255, 99, 132, 0.5)'
                }),
                bloggers: data.prices_history.map(item => item.bloggers),
                order: 0,
            }
            , {
                label: 'Заказы',
                data: data.orders_history.map(item => item.orders),
                showLine: true,
                type: 'bar',
                // , bloggers: data.orders_history.map(() => {
                //     return Math.floor(Math.random() * 15)
                // })
                backgroundColor: data.orders_history.map(() => {
                    return 'rgb(54, 162, 235, 0.5)'
                }),
                bloggers: data.orders_history.map(item => item.bloggers),
                order: 1,
                tension: 0.1
            }
            , {
                label: 'Блоггеров завершило работу',
                data: data.orders_history.map(item => item.bloggers),
                // data: data.orders_history.map(() => {
                //     return 1
                // }),
                showLine: true,
                type: 'bar',
                backgroundColor: data.orders_history.map(() => {
                    return 'rgb(254,94,0, 0.4)'
                }),
                order: 2
            }
        , ]

        var prodsStatistics = new Chart(orders_ctx, {
            type: 'scatter'
            , data: {
                labels: data.prices_history.map(item => {
                    return `${item.dt.split('-')[2]} мая`
                })
                , datasets: datasets
            }
            , options: {
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            title: (item, data) => {
                                var cItem = item[0]
                                    , cLabel = prodsStatistics.data.labels[cItem.dataIndex];

                                if (cItem.dataset.bloggers[cItem.dataIndex] > 0) {
                                    return cLabel + ', Блогер(ов) завершило работу: ' + cItem.dataset.bloggers[cItem.dataIndex]
                                }
                            },

                        }
                    },
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        type: 'logarithmic'
                    }
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
    })

</script>
