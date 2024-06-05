<div class="profile-projects__items 12312312313">
    @forelse ($projects as $project)
    <div class="profile-projects__row profile-projects__item">
        <div class="profile-projects__col profile-projects__img">
            <img src="{{ $project->getImageUrl(true) }}" alt="">
        </div>
        <div class="profile-projects__col profile-projects__content" style="padding:15px 0px;">
            <div class="profile-projects__row" style="align-items: start">
                <div class="profile-projects__item-title" title="{{ $project->project_name }}">
                    {{ $project->project_name }}
                </div>
                <div class="profile-projects__status active">
                    {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
                </div>
            </div>
            <div class="profile-projects__row">
                <div class="profile-projects__formats">
                    <div class="profile-projects__format">
                        Рекламные посты
                    </div>
                </div>
            </div>
            <div class="profile-projects__row" style="margin-top:auto">
                <div class="profile-projects__btns">
                    <button class="btn btn-secondary btn-bloggers">Заявки от блогеров</button>
                    <button class="btn btn-secondary btn-statistics">Статистика</button>
                </div>
            </div>
        </div>
        <div class="profile-projects__col profile-projects__content profile-projects__info" style="padding:15px 0px;">
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Блогеров в работе</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $project->works_count }}</span>
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
                </div>
            </div>

            {{-- <div class="profile-projects__row profile-projects__btns" style="margin-top:auto">
                <button class="btn btn-primary btn-bloggers tablet">Заявки от блогеров</button>
            </div> --}}
        </div>
        <div class="profile-projects__row profile-projects__blogers projects-blogers owl-carousel">
            <div class="list-blogers__item bloger-item card" data-id="1">
                <div class="card__row card__content">
                    <div class="card__col">
                        <div class="card__row card__header">
                            <div class="card__img">
                                <img src="img/profile-icon.svg" alt="">
                                <div class="card__achive">
                                    <img src="img/achive-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card__name">
                                <p class="card__name-name">
                                    Чертовски мило
                                </p>
                            </div>
                            <div class="card__platform">
                                <img src="img/inst-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="card__row card__tags">
                            <div class="card__tags-item">
                                <span>Животные и Природа</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Развлечения и Юмор</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Другое</span>
                            </div>
                        </div>
                        <div class="card__row card__desc-title">
                            <p style="font-weight: 500; font-size: 18px;">
                                Сообщение от блогера
                            </p>
                        </div>
                        <div class="card__row card__desc">
                            <p>
                                Коллекция позитивных, светлых и чертовски милых видео!
                                Платёжеспособная женская аудитория от 25 лет
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
                                        <span>108 729</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>Просмотры</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>800</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card__row card__stats-row">

                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>ER</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>51%</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>CPM</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>263₽</span>
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
                                <div class="card__diagram-line"><span style="width:50%;"></span></div>
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
            <div class="list-blogers__item bloger-item card" data-id="1">
                <div class="card__row card__content">
                    <div class="card__col">
                        <div class="card__row card__header">
                            <div class="card__img">
                                <img src="img/profile-icon.svg" alt="">
                                <div class="card__achive">
                                    <img src="img/achive-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card__name">
                                <p class="card__name-name">
                                    Чертовски мило
                                </p>
                            </div>
                            <div class="card__platform">
                                <img src="img/inst-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="card__row card__tags">
                            <div class="card__tags-item">
                                <span>Животные и Природа</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Развлечения и Юмор</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Другое</span>
                            </div>
                        </div>
                        <div class="card__row card__desc-title">
                            <p style="font-weight: 500; font-size: 18px;">
                                Сообщение от блогера
                            </p>
                        </div>
                        <div class="card__row card__desc">
                            <p>
                                Коллекция позитивных, светлых и чертовски милых видео!
                                Платёжеспособная женская аудитория от 25 лет
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
                                        <span>108 729</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>Просмотры</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>800</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card__row card__stats-row">

                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>ER</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>51%</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>CPM</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>263₽</span>
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
                                <div class="card__diagram-line"><span style="width:50%;"></span></div>
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
            <div class="list-blogers__item bloger-item card" data-id="1">
                <div class="card__row card__content">
                    <div class="card__col">
                        <div class="card__row card__header">
                            <div class="card__img">
                                <img src="img/profile-icon.svg" alt="">
                                <div class="card__achive">
                                    <img src="img/achive-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card__name">
                                <p class="card__name-name">
                                    Чертовски мило
                                </p>
                            </div>
                            <div class="card__platform">
                                <img src="img/inst-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="card__row card__tags">
                            <div class="card__tags-item">
                                <span>Животные и Природа</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Развлечения и Юмор</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Другое</span>
                            </div>
                        </div>
                        <div class="card__row card__desc-title">
                            <p style="font-weight: 500; font-size: 18px;">
                                Сообщение от блогера
                            </p>
                        </div>
                        <div class="card__row card__desc">
                            <p>
                                Коллекция позитивных, светлых и чертовски милых видео!
                                Платёжеспособная женская аудитория от 25 лет
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
                                        <span>108 729</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>Просмотры</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>800</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card__row card__stats-row">

                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>ER</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>51%</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>CPM</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>263₽</span>
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
                                <div class="card__diagram-line"><span style="width:50%;"></span></div>
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
            <div class="list-blogers__item bloger-item card" data-id="1">
                <div class="card__row card__content">
                    <div class="card__col">
                        <div class="card__row card__header">
                            <div class="card__img">
                                <img src="img/profile-icon.svg" alt="">
                                <div class="card__achive">
                                    <img src="img/achive-icon.svg" alt="">
                                </div>
                            </div>
                            <div class="card__name">
                                <p class="card__name-name">
                                    Чертовски мило
                                </p>
                            </div>
                            <div class="card__platform">
                                <img src="img/inst-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="card__row card__tags">
                            <div class="card__tags-item">
                                <span>Животные и Природа</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Развлечения и Юмор</span>
                            </div>
                            <div class="card__tags-item">
                                <span>Другое</span>
                            </div>
                        </div>
                        <div class="card__row card__desc-title">
                            <p style="font-weight: 500; font-size: 18px;">
                                Сообщение от блогера
                            </p>
                        </div>
                        <div class="card__row card__desc">
                            <p>
                                Коллекция позитивных, светлых и чертовски милых видео!
                                Платёжеспособная женская аудитория от 25 лет
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
                                        <span>108 729</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>Просмотры</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>800</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card__row card__stats-row">

                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>ER</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>51%</span>
                                    </div>
                                </div>
                                <div class="card__col card__stats-item">
                                    <div class="card__stats-title">
                                        <span>CPM</span>
                                    </div>
                                    <div class="card__stats-val">
                                        <span>263₽</span>
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
                                <div class="card__diagram-line"><span style="width:50%;"></span></div>
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
                        <div class="projects-statistics__title">
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
                        </div>
                        <div class="view-project__props-ph">
                            <div class="view-project__props-ph_title">
                                Раздел находится в разработке
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
    Нет проетков
    @endforelse
</div>

<script>
    var mediaQuery = window.matchMedia('(max-width: 911px)');

    $(document).find('.profile-projects__row.projects-statistics').each((i, stat) => {
        var prices_ctx, orders_ctx;

        prices_ctx = $(stat).find('#prices-graph-desktop');
        orders_ctx = $(stat).find('#orders-graph-desktop');

        var data = $(stat).data('stats')

        new Chart(orders_ctx, {
            data: {
                labels: data.prices_history.map(item => `${item.dt.split('-')[2]} мая`)
                , datasets: [{
                        label: 'Заказы'
                        , data: data.orders_history.map(item => item.orders)
                        , order: 0
                        , type: 'bar'
                    , }
                    , {
                        label: 'Выручка'
                        , data: data.prices_history.map(item => item.price)
                        , type: 'line'
                        , order: 1
                        , tension: 0.1
                    }
                , ]
            , }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                        , type: 'logarithmic'
                    }
                }
                , plugins: {
                    legend: {
                        position: 'top'
                    , }
                , }
            }
        });
        new Chart(prices_ctx, {
            data: {
                labels: data.prices_history.map(item => `${item.dt.split('-')[2]} мая`)
                , datasets: [{
                        label: 'Заказы'
                        , data: data.orders_history.map(item => item.orders)
                        , order: 0
                        , type: 'bar'
                    , }
                    , {
                        label: 'Выручка'
                        , data: data.prices_history.map(item => item.price)
                        , type: 'line'
                        , order: 1
                        , tension: 0.1
                    }
                , ]
            , }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                        , type: 'logarithmic'
                    }
                }
                , plugins: {
                    legend: {
                        position: 'top'
                    , }
                , }
            }
        });
    })

</script>
