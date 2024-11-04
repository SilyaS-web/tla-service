<template>
    <div
        v-if="project"
        :data-id="project.id"
        :data-brand = "project.marketplace_brand"
        :class="'profile-projects__row profile-projects__item ' + (project.currentProject ? 'hovered' : '')">
            <div class="profile-projects__col profile-projects__img profile-projects--carousel owl-carousel">
                <div
                    v-for="image in project.project_files"
                    :style="'background-image:url(' + image.link + ')'"
                    class="project-item__img"></div>
            </div>
            <div class="profile-projects__col profile-projects__content" style="padding:5px 0px;">
                <div class="profile-projects__row" style="align-items: start">
                    <div
                        :title="project.product_name"
                        class="profile-projects__item-title">
                        {{ project.product_name }}
                    </div>
                    <div :class="'profile-projects__status ' + (!project.is_blogger_access || project.status == -3 ? 'disactive' : 'active')">
                        {{ project.status_name }}
                    </div>
                </div>
                <div class="profile-projects__row" style="flex-wrap:wrap; gap:5px;">
                    <p style="text-wrap: nowrap">Артикул товара: <b>{{ project.product_nm }}</b></p>
                    <p style="text-wrap: nowrap">Цена товара: <b>{{ project.product_price  }}₽</b></p>
                </div>
                <div class="profile-projects__row">
                    <div class="profile-projects__formats">
                        <div
                            v-for="format in project.project_works"
                            class="profile-projects__format">
                            {{ format.name }}
                        </div>
                    </div>
                </div>
                <div class="profile-projects__row card-btns-desktop" style="margin-top:auto">
                    <div class="profile-projects__btns" style="margin-top:0;">
                        <button
                            v-if="project.is_blogger_access"
                            @click="getBloggersLeads"
                            class="btn btn-secondary btn-bloggers">Заявки от блогеров
                            <div class="nav-menu__item-notifs notifs notifs-application" style="display:none">{{ bloggers_leads.length }}</div>
                        </button>
                        <a
                            v-else
                            @click="activate"
                            href="#" class="btn btn-primary" style="text-align: center">Опубликовать</a>

                        <button
                            @click="getProjectStatistics"
                            class="btn btn-secondary btn-statistics">Статистика</button>
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
                                    <span>{{ project.in_work_bloggers_count }}</span>
                                    <span class="card__stats-val--total">
                                        ?
                                        <div class="card__stats-val--total-list">
                                            <p>Заявок отправлено — {{ project.applications_sent_count }}</p>
                                            <p>На согласовании — {{ project.pending_bloggers_count }}</p>
                                            <p>В работе — {{ project.in_work_bloggers_count }}</p>
                                            <p>Выполнило работу — {{ project.completed_bloggers_count }}</p>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                <div class="card__stats-title">
                                    <span>Дата создания</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ project.created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__row card__stats-row">
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>Рейтинг</span>
                                </div>
                                <div class="card__stats-val card__stats-val--rait">
                                    <span>{{ project.marketplace_rate || 0 }}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                <div class="card__stats-title">
                                    <span>Отзывы</span>
                                </div>
                                <div class="card__stats-val card__stats-val--feedback">
                                    <span>{{ project.product_feedbacks_count || 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__row card__stats-row card-btns-desktop" style="margin-top:auto">
                            <button
                                @click="getBloggersInWork"
                                class="btn btn-secondary btn-bloggers-in_work">Блогеры в работе</button>
                        </div>
                    </div>
                    <div class="card__row card__stats-row card-btns-mobile" style="margin-top:auto">
                        <button
                            @click="getBloggersInWork"
                            class="btn btn-secondary btn-bloggers-in_work">Блогеры в работе</button>
                        <button
                            @click="getProjectStatistics"
                            class="btn btn-secondary btn-statistics">Статистика</button>

                        <button
                            v-if="project.is_blogger_access"
                            @click="getBloggersLeads"
                            class="btn btn-secondary btn-bloggers">Заявки от блогеров
                            <div class="nav-menu__item-notifs notifs notifs-application" style="display:none">1</div>
                        </button>
                        <a
                            v-else
                            @click="activate"
                            href="#" class="btn btn-primary" style="text-align: center">Опубликовать</a>
                    </div>
                </div>
            </div>
            <div class="profile-projects__row profile-projects__blogers projects-blogers projects-blogers--leads owl-carousel">
                <div
                    v-for="work in bloggers_leads"
                    :data-id="work.blogger.id"
                    class="list-blogers__item bloger-item card">
                    <div class="card__row card__content">
                        <div class="card__col">
                            <div class="card__row card__header">
                                <div
                                    :style="'background-image:url(' + (work.blogger.user.image || '/img/profile-icon.svg') + ')'"
                                    class="card__img">
                                    <div v-if="work.blogger.is_achivement" class="card__achive">
                                        <img src="img/achive-icon.svg" alt="">
                                    </div>
                                </div>
                                <div class="card__name">
                                    <p class="card__name-name">
                                        {{ work.blogger.user.name }}
                                    </p>
                                    <p style="font-size: 12px">
                                        {{ work.blogger.country.name }}, {{ work.blogger.city }}
                                    </p>
                                </div>
                                <div class="card__platforms">
                                    <a
                                        v-for="platform in work.blogger.platforms"
                                        :href="platform.link"
                                        :class="'card__platform ' + platform.title + ')'"
                                        target="_blank">
                                        <img :src="platform.image" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="card__row card__desc-title">
                                <p style="font-weight: 500; font-size: 18px;">
                                    Сообщение от блогера
                                </p>
                            </div>
                            <div class="card__row card__desc">
                                <p>
                                    {{ work.message }}
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
                                            <span>{{ work.blogger.summaryPlatform.subscriber_quantity }}</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>Просмотры</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ work.blogger.summaryPlatform.coverage }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__row card__stats-row">

                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>ER %</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ work.blogger.summaryPlatform.engagement_rate }}</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>CPM</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span> {{ (project.product_price / (work.blogger.summaryPlatform.coverage == 0 ? 1 : work.blogger.summaryPlatform.coverage) * 1000).toFixed(2)  }} ₽</span>
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
                                    <div class="card__diagram-line">
                                        <span :style="'width:' + work.blogger.gender_ratio + '%;'"></span>
                                    </div>
                                    <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="card__row" style="text-align: center;">
                                <a :href="'/bloggers/' + work.blogger.id" class="" style="width: 100%; color: #FE5E00; font-size:16px; font-weight:500; text-decoration:underline; margin-top: -10px;">Подробнее</a>
                            </div>
                            <div class="card__row bloger-item--btns" style="gap:12px; width:100%; flex-wrap: wrap; justify-content: center">
                                <button class="btn btn-primary" @click="acceptWork(work)">
                                    Принять
                                </button>
                                <button class="btn btn-secondary" @click="denyWork(work)">
                                    Отклонить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-projects__row profile-projects__blogers projects-blogers projects-blogers--in_work owl-carousel" >
                <div
                    v-if="bloggers_active && bloggers_active.length > 0"
                    v-for="work in bloggers_active"
                    :data-id="work.id"
                    class="list-blogers__item bloger-item card">
                    <div class="card__row card__content">
                        <div class="card__col">
                            <div class="card__row card__header">
                                <div
                                    style="'background-image:url(' + work.blogger.user.image + ')'"
                                    class="card__img">
                                    <div
                                        v-if="work.blogger.is_achievement"
                                        class="card__achive tooltip">
                                        <img src="img/achive-icon.svg" alt="">
                                        <div class="tooltip__text">
                                            <p>Проверенный блогер</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__name">
                                    <p class="card__name-name">
                                        {{ work.blogger.user.name }}
                                    </p>
                                    <p style="font-size: 12px">
                                        {{ work.blogger.country.name }}, {{ work.blogger.city }}
                                    </p>
                                </div>
                                <div class="card__platforms">
                                    <a
                                        v-for="platform in work.blogger.platforms"
                                        :href="platform.link"
                                        :class="'card__platform ' + (platform.title ? platform.title.toLowerCase() : '')"
                                        target="_blank"><img :src="platform.image" alt=""></a>
                                </div>
                            </div>
                            <div class="card__row card__desc-title">
                                <p style="font-weight: 500; font-size: 18px;">
                                    Описание канала
                                </p>
                            </div>
                            <div class="card__row card__desc">
                                <p>
                                    {{ work.blogger.description }}
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
                                            <span>{{ work.blogger.summaryPlatform.subscriber_quantity }}</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>Просмотры</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ work.blogger.summaryPlatform.coverage }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__row card__stats-row">

                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>ER %</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ work.blogger.summaryPlatform.engagement_rate }}</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>CPM</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ (project.product_price / (work.blogger.summaryPlatform.coverage == 0 ? 1 : work.blogger.summaryPlatform.coverage) * 1000).toFixed(2) }} ₽</span>
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
                                    <div class="card__diagram-line">
                                        <span :style="'width:' + work.blogger.gender_ratio + '%;'"></span>
                                    </div>
                                    <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="card__row card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                                <button
                                    v-if="work.status == null"
                                    :data-project-id="project.id"
                                    class="btn btn-secondary">
                                    Заявка отправлена
                                </button>
                                <button
                                    v-else
                                    :data-work-id="work.id"
                                    @click="goToChat(work)"
                                    class="btn btn-primary">
                                    Перейти в диалог
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <span v-else class="empty-bloggers">
                    Нет блогеров в работе
                </span>
            </div>

            <div class="profile-projects__row profile-projects__statistics projects-statistics">
                <div class="view-project__props view-project__props--desktop">
                    <div class="view-project__props-wrap">
                        <div class="view-project__props-col">
                            <div class="projects-statistics__title">
                                Общая статистика
                            </div>
                            <div
                                v-if="project.clicks_count > 1 || (completed_works_statistics && completed_works_statistics.total_subs > 1) || (completed_works_statistics && completed_works_statistics.total_views)"
                                class="card__col card__stats-stats card__stats-stats--total" style="width:100%; flex-direction:row; flex-wrap:wrap; gap: 8px">
                                <div class="card__row card__stats-row" style="width:calc(100% / 2 - 4px); margin-right:0!important">
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>Количество<br> переходов</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ project.clicks_count }}</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item" style="flex: 1: width: auto">
                                        <div class="card__stats-title">
                                            <span>Охваты</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ completed_works_statistics ? completed_works_statistics.total_subs : '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card__row card__stats-row" style="width:calc(100% / 2 - 4px)">
                                    <div class="card__col card__stats-item">
                                        <div class="card__stats-title">
                                            <span>CPM</span>
                                        </div>
                                        <div class="card__stats-val ">
                                            <span>{{ (project.product_price / (((completed_works_statistics && completed_works_statistics.total_views == 0) || completed_works_statistics && !completed_works_statistics.total_views ? 1 : (completed_works_statistics ? completed_works_statistics.total_views : 1)) * 1000)).toFixed(2) }} ₽</span>
                                        </div>
                                    </div>
                                    <div class="card__col card__stats-item" style="flex: 1; width: auto">
                                        <div class="card__stats-title">
                                            <span>CPC</span>
                                        </div>
                                        <div class="card__stats-val">
                                            <span>{{ (project.product_price / (project.clicks_count == 0 ? 1 : project.clicks_count)).toFixed(2) }} ₽</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span v-else> Нет данных </span>
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
                                    <span class="count">{{ marketplace_statistics && marketplace_statistics.orders }} шт</span>
                                </div>
                                <div class="view-project__props-money">
                                    Выручка за 30 дн<br>
                                    <span class="money">{{ marketplace_statistics && marketplace_statistics.earnings  }} ₽</span>
                                </div>
                            </div>
                            <div class="view-project__props-graph">
                                <canvas :id="'orders-graph-desktop_' + project.id" class=""></canvas>
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
                                <div
                                    v-if="completed_works.length > 0"
                                    class="card__stats-table table-stats">
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
                                        <div
                                            v-for="work in completed_works"
                                            :data-work-id = "work.id"
                                            class="table-stats__row">
                                            <div
                                                class="table-stats__col table-stats__blogger-img"
                                                :style="'width: 10%; background-image:' + work.blogger.user.image + ''">

                                            </div>
                                            <div class="table-stats__col" style="width: 13%;">
                                                {{ work.blogger.user.name }}
                                            </div>
                                            <div class="table-stats__col" style="width: 11%;">
                                                {{ work.blogger.subscribers }}
                                            </div>
                                            <div class="table-stats__col" style="width: 11%;">
                                                <span
                                                    v-if="!work.statistics"
                                                    @click="function(event){ event.stopPropagation() }"
                                                    class="table-stats__quest">
                                                        ?
                                                        <div class="table-stats__quest-text">
                                                            <p>Запросите статистику у блогера</p>
                                                        </div>
                                                    </span>
                                                <span v-else>
                                                    {{ work.statistics.views }}
                                                </span>
                                            </div>
                                            <div class="table-stats__col" style="width: 11%;">
                                                {{ work.statistics ? work.statistics.views : '...' }}
                                            </div>
                                            <div class="table-stats__col" style="width: 6%;">
                                                <span
                                                    v-if="!work.statistics"
                                                    @click="function(event){ event.stopPropagation() }"
                                                    class="table-stats__quest">
                                                    ?
                                                    <div class="table-stats__quest-text">
                                                        <p>Запросите статистику у блогера</p>
                                                    </div>
                                                </span>
                                                <span v-else>
                                                    {{ Math.round(work.statistics.views / (findBiggestPlatform(work.blogger).summaryPlatform.subscriber_quantity == 0 ? 1 : findBiggestPlatform(work.blogger).summaryPlatform.subscriber_quantity) * 100) }}
                                                </span>
                                            </div>
                                            <div class="table-stats__col" style="width: 9%;">
                                               <span
                                                    v-if="!work.statistics"
                                                    @click="function(event){ event.stopPropagation() }"
                                                    class="table-stats__quest">
                                                    ?
                                                    <div class="table-stats__quest-text">
                                                        <p>Запросите статистику у блогера</p>
                                                    </div>
                                                </span>
                                                <span v-else>
                                                    {{ Math.round(project.product_price / (work.statistics.views == 0 ? 1 : work.statistics.views) * 1000).toFixed(2) }}
                                                </span>
                                            </div>
                                            <div class="table-stats__col" style="width: 9%;">
                                                <span
                                                    v-if="!work.statistics"
                                                    @click="function(event){ event.stopPropagation() }"
                                                    class="table-stats__quest">
                                                    ?
                                                    <div class="table-stats__quest-text">
                                                        <p>Запросите статистику у блогера</p>
                                                    </div>
                                                </span>
                                                <span v-else>{{ Math.round(project.clicks_count / (work.statistics.views == 0 ? 1 : work.statistics.views) * 100) }}</span>
                                            </div>
                                            <div class="table-stats__col" style="width: 14%;">
                                                {{ work.confirmed_by_seller_at }}
                                            </div>
                                            <div
                                                @click="goToChat(work)"
                                                class="table-stats__col table-stats__col--chat" style="width: 6%; cursor:pointer">
                                                <img src="img/chat-black-icon.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    v-if="completed_works.length > 0"
                                    class="dashboard__placeholder" style="z-index: 1; top:0; left:0;">
                                    <div class="dashboard__placeholder-text">
                                        Переверните экран, чтобы посмотреть статистику
                                    </div>
                                    <div class="dashboard__placeholder-overflow">

                                    </div>
                                </div>
                                <div v-else>Статистика пустая</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                @click="isProjectOptsOpen = !isProjectOptsOpen"
                :class="'profile-projects__control-btns ' + (isProjectOptsOpen && 'active')">
                <div class="profile-projects__dots" title="Опции">
                    <img src="img/dots-icon.svg" alt="">
                </div>
                <div class="profile-projects__opts">
                    <a
                        @click="editProject(project)"
                        class="profile-projects__opts-item">
                        <img src="img/pencil-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Редактировать</div>
                    </a>

                    <a
                        v-if="project.status != -3"
                        href="#"
                        @click="stop"
                        class="profile-projects__opts-item">
                        <img src="img/hide-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Скрыть</div>
                    </a>
                    <a
                        v-else
                        href="#"
                        @click="start"
                        class="profile-projects__opts-item">
                        <img src="img/show-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Показывать</div>
                    </a>

                    <a
                        @click="deleteProject"
                        href="#" class="profile-projects__opts-item">
                        <img src="img/delete-icon.svg" alt="">
                        <div class="profile-projects__opts-name">Удалить</div>
                    </a>
                </div>
            </div>
        </div>
    <confirm-popup ref="confirmPopup"></confirm-popup>
</template>
<script>
import {ref, shallowRef} from 'vue'

    import Project from "../../../services/api/Project.vue";
    import Work from "../../../services/api/Work.vue";

    import Loader from "../../../services/AppLoader.vue";

    import ConfirmPopup from '../../../ui/ConfirmationPopup.vue';
    import axios from "axios";

    export default{
        props:['project', 'currentItem'],
        components: {ConfirmPopup},
        data(){
            return {
                bloggers_leads: ref([]),
                bloggers_active: ref([]),

                currentProject: ref(null),

                marketplace_statistics: ref(null),
                completed_works_statistics: ref(null),
                completed_works: ref([]),
                prodsStatisticsChart: null,
                prodsStatisticsChartData: ref(null),

                isProjectOptsOpen: ref(false),
                Project, Work,
                Loader
            }
        },
        mounted(){
            $(document).on('click', '.profile-projects__control-btns', function(e){
                $(e.currentTarget).toggleClass('active')
            })

            var mediaQuery = window.matchMedia('(max-width: 911px)');

            window
                .matchMedia('(orientation: portrait)')
                .addListener(function (m) {
                    if (m.matches) {
                    }
                    else {
                        prodsStatistics.resize()
                    }
                })

            var imgsCurousel = $(`.profile-projects__item[data-id="${this.project.id}"]`).find('.profile-projects--carousel').owlCarousel({
                margin: 5,
                nav: false,
                dots: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:1
                    }
                }
            });

            $(`.profile-projects__item[data-id="${this.project.id}"]`).find('.projects-blogers--in_work').owlCarousel({
                margin: 5,
                nav: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });
            $(`.profile-projects__item[data-id="${this.project.id}"]`).find('.projects-blogers--leads').owlCarousel({
                margin: 5,
                nav: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });

            if(this.project.currentProject){
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(document).find(`.profile-projects__item[data-id="${this.project.id}"]`).offset().top
                }, 1000);
            }

            var orders_ctx = $(`.profile-projects__item[data-id="${this.project.id}"]`).find('#orders-graph-desktop_' + this.project.id);

            this.prodsStatisticsChart = shallowRef(new Chart(orders_ctx, {
                type: 'scatter',
                data: this.prodsStatisticsChartData,
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
            }));
        },
        updated(){
            $(`.profile-projects__item[data-id="${this.project.id}"]`).find('.projects-blogers--in_work').owlCarousel({
                margin: 5,
                nav: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });
            $(`.profile-projects__item[data-id="${this.project.id}"]`).find('.projects-blogers--leads').owlCarousel({
                margin: 5,
                nav: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });
        },
        methods:{
            editProject(project){
                this.$emit('edit', project)
            },
            goToChat(work){
                this.$emit('switchTab', work.id)
            },

            getBloggersInWork(){
                return new Promise((resolve, reject) => {
                    this.Loader.loaderOn(`.profile-projects__item[data-id="${this.project.id}"] .projects-blogers--in_work`)

                    $(`.profile-projects__item[data-id="${this.project.id}"]`)
                        .find('.projects-blogers--in_work').owlCarousel('destroy')

                    this.Work.getProjectsList(this.project, 'active').then(data => {

                        if(data){
                            this.bloggers_active = (data || []).map(_w => {
                                _w.blogger = this.findBiggestPlatform(_w.blogger);

                                return _w;
                            })
                        }

                        this.Loader.loaderOff()

                        resolve(true)
                    })
                })
            },
            getBloggersLeads(){
                return new Promise((resolve, reject) => {
                    this.Loader.loaderOn(`.profile-projects__item[data-id="${this.project.id}"] .projects-blogers--leads`)

                    $(`.profile-projects__item[data-id="${this.project.id}"]`)
                        .find('.projects-blogers--leads').owlCarousel('destroy')

                    this.Work.getProjectsList(this.project, 'pending').then(data => {
                        if(data){
                            this.bloggers_leads = (data || []).map(_w => {
                                _w.blogger = this.findBiggestPlatform(_w.blogger);

                                return _w;
                            })
                        }

                        this.Loader.loaderOff()

                        resolve(true)
                    })
                })
            },
            findBiggestPlatform(blogger){
                if(!blogger){
                    return { subscriber_quantity: 0 };
                }

                var summaryPlatform = { subscriber_quantity: 0 };

                if(blogger.platforms){
                    blogger.platforms.forEach(_p => {
                        if(summaryPlatform.subscriber_quantity < _p.subscriber_quantity)
                            summaryPlatform = _p
                    });
                }

                blogger.summaryPlatform = summaryPlatform;

                return blogger;
            },
            getProjectStatistics(){
                this.Loader.loaderOn(`.profile-projects__item[data-id="${this.project.id}"] .projects-statistics`)

                axios({
                    method: 'get',
                    url: '/api/projects/' + this.project.id + '/statistics',
                })
                .then(result => {
                    if(result.data.statistics.completed_works)
                        this.completed_works = result.data.statistics.completed_works;

                    if(result.data.statistics.completed_works_statistics)
                        this.completed_works_statistics = result.data.statistics.completed_works_statistics;

                    if(result.data.statistics.marketplace_statistics)
                        this.marketplace_statistics = JSON.parse(result.data.statistics.marketplace_statistics);

                    this.updateProductStatistics()

                    this.Loader.loaderOff()
                    resolve(result.data)
                })
                .catch(error => {
                    resolve([])
                })
            },
            updateProductStatistics(){
                this.prodsStatisticsChart.destroy()

                var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

                var data = this.marketplace_statistics ? this.marketplace_statistics : {
                        orders: 0,
                        earnings: 0,
                        bloggers_history: 0,
                        prices_history: [],
                        orders_history: [],
                    };

                var datasets = [
                    {
                        label: 'Выручка',
                        data: (data.prices_history || []).map((item, index) => {
                            if (item["earnings"] !== undefined) {
                                return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: Math.round(item.earnings)};

                            } else {
                                return {x: (item.dt.split('-')[2] + ' ' + month[Number(item.dt.split('-')[1]) - 1]), y: Math.round(item.price * data.orders_history[index].orders)};
                            }
                        }),
                        showLine: true,
                        type: 'line',
                        backgroundColor: (data.prices_history || []).map(() => {
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

                this.prodsStatisticsChartData = {
                    'labels' : data.prices_history.map(item => {
                        return `${item.dt.split('-')[2]} ${month[Number(item.dt.split('-')[1]) - 1]}`
                    }),
                    'datasets' : datasets
                }

                var orders_ctx = $(`.profile-projects__item[data-id="${this.project.id}"]`).find('#orders-graph-desktop_' + this.project.id);

                this.prodsStatisticsChart = shallowRef(new Chart(orders_ctx, {
                    type: 'scatter',
                    data: this.prodsStatisticsChartData,
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
                }));
            },
            async deleteProject(event){
                event.preventDefault();

                const isConfirmed = await this.$refs.confirmPopup.show({
                    title: 'Подтвердите действие',
                    subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                });

                if (isConfirmed) {
                    this.Project.delete(this.project.id).then((res) => {
                        if(res){
                            $(`.profile-projects__item[data-id="${this.project.id}"]`).remove();
                        }
                    })
                }
            },
            stop(event){
                event.preventDefault()

                this.Project.stop(this.project.id).then((res) => {
                    if(res){
                        this.project.status = -3;

                        var statusName = 'Приостановлено';

                        if(!this.project.is_blogger_access){
                            statusName = 'Не опубликовано'
                        }

                        this.project.status_name = statusName;
                    }
                })
            },
            start(event){
                event.preventDefault()

                this.Project.start(this.project.id).then((res) => {
                    if(res){
                        this.project.status = 0;

                        var statusName = 'Активно';

                        if(!this.project.is_blogger_access){
                            statusName = 'Не опубликовано'
                        }

                        this.project.status_name = statusName
                    }
                })
            },
            async activate(event){
                event.preventDefault()

                const isConfirmed = await this.$refs.confirmPopup.show({
                    title: 'Подтвердите действие',
                    subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                });

                if(isConfirmed){
                    this.Project.activate(this.project.id).then((res) => {
                        if(res){
                            this.project.is_blogger_access = 1
                            this.project.status_name = 'Опубликовано'
                        }
                    })
                }
            },

            denyWork(work){
                this.Work.deny(work.id).then(data => {
                    if(data){
                        Promise.all([
                            this.getBloggersLeads()
                        ]).then(() => {
                        })
                    }
                })
            },

            acceptWork(work){
                this.Work.accept(work.id).then(data => {
                    if(data){
                        Promise.all([
                            this.getBloggersLeads()
                        ]).then(() => {
                        })
                    }
                })
            }
        }
    }
</script>
