<template>
    <section class="profile" id="seller">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside @switchTab="switchTab"></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <CreateProject></CreateProject>
                        <Dashboard :dashboard="dashboard"></Dashboard>
                        <ProjectsList :projects="projects"></ProjectsList>
                        <MyProjectsList :myProjects="myProjects" v-on:updateMyProjects="updateMyProjects"></MyProjectsList>
                        <BloggersList :bloggers="bloggers" :user="user"></BloggersList>
                        <Chat></Chat>
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
import Blogger from '../../../services/api/Blogger.vue'

import Loader from '../../../services/AppLoader.vue'
import Meter from '../../services/AppMeter.vue'
import Tabs from '../../../services/AppTabs.vue'

import CreateProject from '../../components/seller/CreateProjectComponent.vue'
import ProjectsList from '../../components/seller/ProjectsList.vue'
import MyProjectsList from '../../components/seller/MyProjectsList.vue'
import BloggersList from '../../components/seller/BloggersListComponent.vue'
import Dashboard from '../../components/seller/AppDashboard.vue'
import Chat from '../../components/ChatIndex.vue'
import Aside from '../../components/seller/AppAside.vue'


export default{
    components: {
        Aside, CreateProject, Dashboard, ProjectsList,
        MyProjectsList, BloggersList, Chat
    },
    data(){
        return {
            user: ref(null),
            platforms: ref([]),
            themes: ref([]),
            myProjects: ref([]),
            brands: ref([]),
            dashboard: ref({}),
            bloggers: ref([]),
            projects: ref([]),

            User, Seller, Blogger, Project,
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

                case 'profile-blogers-list':
                    this.Loader.loaderOn('.wrapper .profile__content-inner');

                    this.Blogger.getList().then(data => {
                        this.bloggers = (data || []).map(_b => this.findBloggerBiggestPlatform(_b));

                        setTimeout(()=>{
                            this.Loader.loaderOff();
                        }, 300)
                    })

                    break;

                case 'all-projects':
                    this.Loader.loaderOn('.wrapper .profile__content-inner');

                    this.Project.getList().then(data => {
                        this.projects = data || [];

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

        findBloggerBiggestPlatform(blogger){
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
    }
}
</script>
