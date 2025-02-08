<template>
    <div
        v-if="project"
        :data-id="project.id"
        :data-brand = "project.marketplace_brand"
        :class="'profile-projects__row profile-projects__item ' + (project.currentProject ? 'hovered' : '')"
    >

        <!-- карусель изображений проекта-->
        <Carousel
            :carouselID="'project-item__imgs-carousel-' + project.id"
            :listClassList="['profile-projects__col', 'profile-projects__img', 'profile-projects--carousel']"
            :itemsClassList="['project-item__img']"
            :itemsList="project.project_files"
            :props="{
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
            }"
        >
        </Carousel>

        <!-- информация о проекте-->
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

        <!-- дополнительная информация о проекте-->
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

        <!-- карусель заявок от блогеров-->
        <BloggersCarousel
            :project="project"
            :carouselID="'bloggers-leads-' + project.id"
            :works="bloggers_leads"
            :cardsType="'leads'"
            :carouselClassList="['projects-blogers--leads']"
            v-on:acceptWork="acceptWork"
            v-on:denyWork="denyWork"
            v-on:goToChat="goToChat"
        ></BloggersCarousel>

        <!-- карусель блогеров в работе-->
        <BloggersCarousel
            :project="project"
            :carouselID="'bloggers-in_work-' + project.id"
            :works="bloggers_active"
            :cardsType="'in_work'"
            :carouselClassList="['projects-blogers--in_work']"
            v-on:acceptWork="acceptWork"
            v-on:denyWork="denyWork"
            v-on:goToChat="goToChat"
        ></BloggersCarousel>

        <!-- статистика по заявкам/работе, статистика товара на маркетплейсах-->
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
                                <div class="card__col card__stats-item" style="">
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
                                <div class="card__col card__stats-item" style="">
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

        <!-- опции взаимодействия с проектом-->
        <div
            @click="isProjectOptsOpen = !isProjectOptsOpen"
            :class="'profile-projects__control-btns ' + (isProjectOptsOpen && 'active')">
            <div class="profile-projects__dots" title="Опции">
                <img src="img/dots-icon.svg" alt="">
            </div>
            <ProjectOptions
                :status="project.status"
                v-on:editProject="editProject"
                v-on:deleteProject="deleteProject"
                v-on:showProject="start"
                v-on:hideProject="stop"
            ></ProjectOptions>
        </div>
    </div>

    <confirm-popup ref="confirmPopup"></confirm-popup>
</template>
<script>
import axios from "axios";
import {ref, shallowRef} from 'vue'

import Project from "../../../../core/services/api/Project.vue";
import Work from "../../../../core/services/api/Work.vue";

import Loader from "../../../../core/components/AppLoader.vue";
import Carousel from "../../../../core/components/AppCarousel";
import ProjectOptions from './ProjectOptionsComponent'
import BloggersCarousel from './BloggersCarouselComponent'

import ConfirmPopup from '../../../../core/components/popups/confirmation-popup/ConfirmationPopup.vue';

export default{
    props:['project', 'currentItem'],
    components: { Carousel, ConfirmPopup, ProjectOptions, BloggersCarousel},
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
        var mediaQuery = window.matchMedia('(max-width: 911px)');

        window
            .matchMedia('(orientation: portrait)')
            .addListener(function (m) {
                if (!m.matches) {
                    //this.prodsStatisticsChart.resize()
                }
            })

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
    },
    methods:{
        editProject(){
            this.$emit('edit', this.project)
        },
        deleteProject(){
            this.$refs.confirmPopup.show({
                title: 'Подтвердите действие',
                subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
            }).then((isConfirmed) => {
                if (isConfirmed) {
                    this.Project.delete(this.project.id).then((res) => {
                        if(res){
                            $(`.profile-projects__item[data-id="${this.project.id}"]`).remove();
                        }
                    })
                }
            })
        },
        stop(){
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
        start(){
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
        activate(){
            this.$refs.confirmPopup.show({
                title: 'Подтвердите действие',
                subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
            }).then((isConfirmed) => {
                if(isConfirmed){
                    this.Project.activate(this.project.id).then((res) => {
                        if(res){
                            this.project.is_blogger_access = 1
                            this.project.status_name = 'Опубликовано'
                        }
                    })
                }
            })
        },

        goToChat(work){
            this.$emit('switchTab', work.id)
        },

        getBloggersInWork(){
            return new Promise((resolve, reject) => {
                this.Loader.loaderOn(`.profile-projects__item[data-id="${this.project.id}"] .projects-blogers--in_work`)

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
            })
            .catch(error => {
                this.Loader.loaderOff()
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
