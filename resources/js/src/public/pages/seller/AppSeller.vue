<template>
    <section class="profile" id="seller">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside @switchTab="switchTab"></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <CreateProject></CreateProject>
                        <Dashboard :dashboard="dashboard" @switchTab="switchTab"></Dashboard>
<!--                        <ProjectsList></ProjectsList>-->
                        <MyProjectsList :myProjects="myProjects" v-on:updateMyProjects="updateMyProjects"></MyProjectsList>
<!--                        <div class="profile-projects tab-content" id="all-projects">-->
<!--                            <div class="profile-projects__body">-->
<!--                                <div class="projects-list__header">-->
<!--                                    <div class="list-projects__title title">-->
<!--                                        Все проекты-->
<!--                                    </div>-->
<!--                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">-->
<!--                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="profile-projects__items list-projects__items">-->
<!--&lt;!&ndash;                                    @include('project.all-seller-list', ['all_projects' => $all_projects, 'type' => 'all'])&ndash;&gt;-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="profile-projects__filters">-->
<!--                                <div class="projects-list__filter filter">-->
<!--                                    <div class="filter__body">-->
<!--                                        <div class="filter__top">-->
<!--                                            <p class = "filter__title">-->
<!--                                                Фильтр-->
<!--                                            </p>-->
<!--                                            <a href="#" class="filter__reset">-->
<!--                                                Сбросить-->
<!--                                            </a>-->
<!--                                        </div>-->
<!--                                        <div class="filter__items">-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <input type="text" class="input" name="filter-name" id="" placeholder="Поиск по названию">-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="filter-category">Категория</label>-->
<!--                                                <input type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">-->
<!--                                                <input type="text" id = "filter-category-id" hidden>-->
<!--                                                <div class="filter-tooltip" style="display: none">-->
<!--                                                    <div class="filter-tooltip__items">-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="">Формат рекламы</label>-->
<!--                                                <select name="filter-format" id="filter-format" class = "input">-->
<!--                                                    <option value="" class="">Выберите формат</option>-->
<!--                                                    <option value="feedback" class="">Отзыв на товар</option>-->
<!--                                                    <option value="inst" class="">Интеграция Ins</option>-->
<!--                                                    <option value="youtube" class="">Интеграция YTube</option>-->
<!--                                                    <option value="vk" class="">Интеграция VK</option>-->
<!--                                                    <option value="telegram" class="">Интеграция Telegram</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <div class="filter__btns">-->
<!--                                                <button class="btn btn-primary btn-filter-send">Применить</button>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="profile-blogers tab-content" id="profile-blogers-list">-->
<!--                            <div class="profile-blogers__body">-->
<!--                                <div class="projects-list__header">-->
<!--                                    <div class="list-projects__title title">-->
<!--                                        Список блогеров-->
<!--                                    </div>-->
<!--                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">-->
<!--                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>-->
<!--                                        <button class="btn btn-primary projects-list__choose-btn">Выберите проект</button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="projects-list__row projects-list__current-project current-project" style="display:none">-->
<!--                                    <div class="current-project__col current-project__main">-->
<!--                                        <div class="current-project__row">-->
<!--                                            <div class="current-project__img" style="background-image:url('img/profile-icon.svg')">-->
<!--                                        </div>-->
<!--                                        <div class="current-project__title">-->
<!--                                            <p class="name"><b>Проект не выбран</b></p>-->
<!--                                            <p class="articul">Артикул товара: <span class=""></span></p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="current-project__col current-project__format">-->
<!--                                    <div class="current-project__row">-->
<!--                                        <div class="current-project__title">-->
<!--                                            <p class="name"><b>Формат рекламы</b></p>-->
<!--                                            <p class="articul">Отзыв на товар </p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="current-project__btn">-->
<!--                                    <a href="" class="btn btn-secondary projects-list__choose-btn">Выбрать другой проект</a>-->
<!--                                </div>-->
<!--&lt;!&ndash;                                @include("blogger.list")&ndash;&gt;-->
<!--                                <div class="projects-list__filter filter blogers-list__filter">-->
<!--                                    <div class="filter__body">-->
<!--                                        <div class="filter__top">-->
<!--                                            <p class="filter__title">-->
<!--                                                Фильтр-->
<!--                                            </p>-->
<!--                                            <a href="#" class="filter__reset">-->
<!--                                                Сбросить-->
<!--                                            </a>-->
<!--                                        </div>-->
<!--                                        <div class="filter__items">-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="">Платформа</label>-->
<!--                                                <select name="filter-platform" id="filter-platform" class="input">-->
<!--                                                    <option value="">Выберите платформу</option>-->
<!--                                                    <option-->
<!--                                                        v-for="platform in platforms"-->
<!--                                                        :value="platform.id">-->
<!--                                                        {{ platform.title }}-->
<!--                                                    </option>-->

<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="filter-country">Страна блогера</label>-->
<!--                                                <select name="filter-country" id="filter-country" class="input">-->
<!--                                                    <option value="" class="">Выберите страну</option>-->
<!--                                                    <option value="1" class="">Россия</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="filter-city">Город блогера</label>-->
<!--                                                <input type="text" class="input" name="filter-city" id="filter-city" placeholder="Введите город">-->
<!--                                            </div>-->
<!--                                            <div class="form-group" style="flex-direction: column;">-->
<!--                                                <label for="">Выберите тематику</label>-->
<!--                                                <div class="form-formats">-->
<!--                                                    <div-->
<!--                                                        v-for="theme in themes"-->
<!--                                                        class="form__row form-format">-->
<!--                                                        <input-->
<!--                                                            :id="'theme-' + theme.id"-->
<!--                                                            :value="theme.id"-->
<!--                                                            type="checkbox" name="themes[]" class="form-format__check">-->
<!--                                                        <label :for="'theme-' + theme.id">theme.theme</label>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="form-group filter__item">-->
<!--                                                <label for="">Пол блогера</label>-->
<!--                                                <div class="filter__item&#45;&#45;sex" id = "filter__item&#45;&#45;sex">-->
<!--                                                    <div class="input-checkbox-w">-->
<!--                                                        <input type="checkbox" class="checkbox" id="male">-->
<!--                                                        <label for="male">Мужской</label>-->
<!--                                                    </div>-->
<!--                                                    <div class="input-checkbox-w">-->
<!--                                                        <input type="checkbox" class="checkbox" id="female">-->
<!--                                                        <label for="female">Женский</label>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--&lt;!&ndash;                                            <div class="form-group filter__item">&ndash;&gt;-->
<!--&lt;!&ndash;                                                <label for="">Количество подписчиков</label>&ndash;&gt;-->
<!--&lt;!&ndash;                                                <div class="input-range-w">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <input id="subs-range" name="" type="range" class="input input-range" min="{{ $blogger_platforms->min("subscriber_quantity") ?? 0 }}" max="{{ $blogger_platforms->max("subscriber_quantity") ?? 0 }}">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <div class="input-range-content">&ndash;&gt;-->
<!--&lt;!&ndash;                                                        <input id="subs-min" type="number" class="input input-number" value="{{ $blogger_platforms->min("subscriber_quantity") ?? 0 }}">&ndash;&gt;-->
<!--&lt;!&ndash;                                                        <input id="subs-max" type="number" class="input input-number" value="{{ $blogger_platforms->max("subscriber_quantity") ?? 0 }}">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                            </div>&ndash;&gt;-->
<!--                                            <div class="filter__btns">-->
<!--                                                <button class="btn btn-primary btn-filter-send">Применить</button>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import {ref} from 'vue'
import axios from "axios";

import User from '../../../services/api/User.vue'
import Seller from '../../../services/api/Seller.vue'
import Project from '../../../services/api/Project.vue'

import Loader from '../../../services/AppLoader.vue'
import Meter from '../../services/AppMeter.vue'
import Tabs from '../../../services/AppTabs.vue'

import CreateProject from '../../components/seller/CreateProjectComponent.vue'
import ProjectsList from '../../components/seller/ProjectsList.vue'
import MyProjectsList from '../../components/seller/MyProjectsList.vue'
import Dashboard from '../../components/seller/AppDashboard.vue'
import Aside from '../../components/seller/AppAside.vue'


export default{
    components: {Aside, CreateProject, Dashboard, ProjectsList, MyProjectsList},
    data(){
        return {
            user: ref(null),
            platforms: ref([]),
            themes: ref([]),
            myProjects: ref([]),
            brands: ref([]),
            dashboard: ref({}),
            User, Seller, Project,
            Loader, Meter, Tabs
        }
    },
    async mounted(){
        this.Loader.loaderOn('.wrapper .profile__content-inner');

        this.user = this.User.getCurrent();

        this.dashboard = await this.getSellerStats(this.user.id);

        if(this.dashboard.total_clicks && this.dashboard.total_clicks > 10){
            var coverageGraph = document.getElementById("coverage-graph"),
                data = this.dashboard.statistics;

            var coverage_stats = new Chart(coverageGraph, {
                type: 'scatter',
                data: {
                    labels: data.coverage.map(item => `${item.dt.split("-")[2]} ${month[Number(item.dt.split("-")[1]) - 1]}`),
                    datasets: [
                        {
                            label: "Переходы",
                            data: data.coverage.map(item => item.coverage),
                            backgroundColor: data.coverage.map(() => {
                                return "rgb(152,203,237, 1)"
                            }),
                            order:0,
                            type: "bar",
                        },
                        {
                            label: "Блоггеров завершило работу",
                            data: data.coverage.map(item => item.bloggers),
                            type: "bar",
                            backgroundColor: data.coverage.map(() => {
                                return "rgb(254,94,0, 0.4)"
                            }),
                            order: 1,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    onResize: (chart, size) => {
                        var media = window.matchMedia('(max-width: 500px)');
                        if(media.matches){
                            chart.height = 200;
                        }
                    },
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
                            ticks: {
                                callback: (tick, index, array)=> {
                                    var newTick = '';

                                    if(Math.trunc(tick) === tick){
                                        newTick = tick
                                    }

                                    return tick === 0 ? 0 : newTick;
                                }
                            },
                        }
                    }
                }
            });

            var config = {
                type: "funnel",
                data: {
                    datasets: [{
                        data: [30, 60, 90],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ]
                    }],
                    labels: [
                        "Red",
                        "Blue",
                        "Yellow"
                    ]
                }
            }

            var funnelChart = FunnelChart("funnel-graph", {
                values: [
                    this.dashboard.total_clicks ,
                    Math.round(this.dashboard.total_clicks / (this.sellers.subscribers == 0 ? 1 : this.sellers.subscribers)).toFixed(3),
                    this.sellers.coverage.total_clicks == 0 ? 0 : Math.round(this.sellers.coverage.avg_price / this.sellers.coverage.total_clicks).toFixed(1)
                ],
                sectionColor: ["#98CBED", "#F0C457", "#FD6567"],
                displayPercentageChange: false,
                pSectionHeightPercent: 100,
                font: "Inter, sans-serif",
                labelWidthPercent: 30,
                labelFontColor: "#000",
                labels: [
                    "Переходы",
                    "ER, %",
                    "CPC, Руб.",
                ],
                maxFontSize: 18,
            });
        }

        this.Meter.init(this.dashboard.feedback_ratio || 0);

        setTimeout(()=>{
            this.Loader.loaderOff();
        }, 300)
    },
    methods:{
        async switchTab(tab){
            this.Tabs.tabClick(tab)

            switch (tab){
                case 'dashboard':
                    this.Loader.loaderOn('.wrapper .profile__content-inner');

                    var db = await this.getSellerStats(this.user.id);

                    if(db){
                        this.dashboard = db.data;
                    }

                    setTimeout(()=>{
                        this.Loader.loaderOff();
                    }, 300)

                    break;

                case 'profile-projects':
                    this.Loader.loaderOn('.wrapper .profile__content-inner');

                    this.myProjects = []

                    this.Project.getUsersProjectsList(this.user.id).then(data => {
                        this.myProjects = data || [];

                        setTimeout(()=>{
                            this.Loader.loaderOff();
                        }, 300)
                    })

                    break;
            }
        },
        async updateMyProjects(){
            this.myProjects = await this.Project.getUsersProjectsList(this.user.id);
        },
        getSellerStats(id){
            return new Promise((resolve, reject) => {
                axios({
                    method: 'get',
                    url: 'api/users/' + this.User.getCurrent().id + '/dashboard'
                })
                .then(response => {
                    resolve(response.data);
                })
                .catch((errors) => {
                    console.log(errors);

                    notify('error', {
                        title: 'Внимание!',
                        message: 'Не удалось загрузить статистику, попробуйте зайти позже или обратитесь в поддержку.'
                    })

                    resolve({
                        total_feedbacks_count: 0,
                        avg_feedbacks_value: 0,
                        products_bad_feedbacks: [],
                        products_good_feedbacks: [],
                        products_great_feedbacks: [],
                        products_few_feedbacks_count: [],
                        products_normal_feedbacks_count: [],
                        unanswered_feedbacks_count: 0,
                        total_clicks: 0,
                        statistics: {},
                        is_wb_api_key: false,
                        feedback_ratio: 0
                    })
                })
            })
        },
    }
}
</script>
