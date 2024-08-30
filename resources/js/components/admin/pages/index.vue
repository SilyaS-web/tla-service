<template>
    <div class="burger-menu">
            <div class="admin-menu__body">
                <div class="admin-menu__title">
                    Выберите раздел
                </div>
                <nav class="nav admin-menu__nav">
                    <div class="nav__items">
                        <a href="" class="nav__link">
                            Модерация блогеров
                        </a>
                    </div>
                </nav>
                <a href="#" class="admin-menu__leave">Выйти</a>
            </div>
        </div>

        <admin-header></admin-header>

        <section class="admin-view">
            <div class="admin-view__container _container active-menu">
                <div class="admin-view__body">
                    <!-- Левое меню -->
                    <admin-aside v-on:switchTab="switchTab" :isAdmin></admin-aside>

                    <!-- Модерация -->
                    <admin-bloggers-moderation-page :bloggers="unverifiedBloggers"  v-on:updateBloggers="updateBloggers"></admin-bloggers-moderation-page>

                    <!-- Список блогеров -->
                    <admin-bloggers-page :bloggers="bloggers" v-on:updateBloggers="updateBloggers"></admin-bloggers-page>

                    <!-- Список селлеров -->
                    <admin-sellers-page v-if="isAdmin == 1" :sellers="sellers" v-on:updateSellers="updateSellers"></admin-sellers-page>

                    <!-- Список проектов -->
                    <admin-projects-page v-if="isAdmin == 1" :projects="projects" v-on:statusManagement="statusManagement"></admin-projects-page>

                    <!-- Список заказов -->
                    <admin-orders-page v-if="isAdmin == 1" :orders="orders"></admin-orders-page>

                    <!-- Список пользователей по реферальной ссылке -->
                    <admin-referal-data-page v-if="isAdmin == 1" :ref_data="referals_data"></admin-referal-data-page>
                </div>
            </div>
        </section>

        <div class="notification" style="display: none;">
            <div class="notification__body">
                <div class="notification__title">Внимание!</div>
                <div class="notification__text">
                    Проект успешно создан
                </div>
            </div>
        </div>
</template>
<script>
    import {reactive, ref} from 'vue'
    import axios from 'axios'
    import Loader from '../../services/AppLoader.vue'

    export default{
        data(){
            return Loader
        },
        setup() {
            return {
                unverifiedBloggers: ref([]),
                bloggers: ref([]),
                sellers: ref([]),
                projects: ref([]),
                orders: ref([]),
                referals_data: ref({
                    company:{
                        id: 0,
                        summary:{
                            total_sellers: 0,
                            total_bloggers: 0,
                            total_received: 0,
                            total_register: 0,
                        },
                        list: {
                            users: [],
                            payments: [],
                        }
                    },
                    managers: {
                        id: 0,
                        summary:{
                            total_register: 0,
                        },
                        list: {
                            users: [],
                        }
                    }
                }),
                isAdmin: ref(false)
            }
        },

        async created(){
            this.loaderOn('.wrapper');

            Promise.all([
                this.getBloggers([0]).then(list => {
                    this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                })
            ]).then(() => {
                setTimeout(()=>{

                    this.loaderOff();
                }, 500)
            })
            this.isAdmin = parseInt($('.wrapper').data('is-admin'));
        },

        methods: {
            getBloggers(status = []){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/bloggers',
                        params: {
                            statuses: status || []
                        }
                    })
                    .then(result => resolve(result.data.bloggers))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },
            getSellers(){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/sellers',
                    })
                    .then(result => resolve(result.data.sellers))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },
            getProjects(){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/projects',
                    })
                    .then(result => resolve(result.data.projects))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },
            getOrders(){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/payments',
                    })
                    .then(result => resolve(result.data.payments))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },
            getReferalsData(){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/referrals',
                    })
                    .then(result => {
                        var data = result.data.referral_codes || [],
                            managers = (data.find(_r => _r.name == 'managers') || {}),
                            company = (data.find(_r => _r.name == 'company') || {});

                        //company summary
                        let total_sellers = company.referral_users.filter(_u => _u.role == "seller").length,
                            total_bloggers = company.referral_users.filter(_u => _u.role == "blogger").length;

                        let total_received = company.referral_users.map(_u => _u.received ? parseFloat(_u.received) : 0)
                                                                    .reduce((a, b) => a + b);

                        let company_data = {
                            id: company.id,
                            summary:{
                                total_sellers: total_sellers,
                                total_bloggers: total_bloggers,
                                total_received: total_received,
                                total_register: company.referral_users.length || 0,
                            },
                            list: {
                                users: company.referral_users || [],
                                payments: company.referral_users_with_payments || [],
                            }
                        }

                        //managers summary
                        let managers_data = {
                            id: managers.id,
                            summary:{
                                total_register: managers.referral_users.length
                            },
                            list: {
                                users: managers.referral_users || [],
                            }
                        }

                        this.referals_data = {
                            company: company_data,
                            managers: managers_data
                        }

                        console.log(this.referals_data)

                        resolve(true)
                    })
                    .catch(error => {
                        console.log(error)
                        resolve(false)
                    })
                })
            },
            findBiggestPlatform(blogger){
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
            updateBloggers(){
                Promise.all([
                    this.getBloggers([1, -1]).then(list => {
                        this.bloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                    }),
                    this.getBloggers([0]).then(list => {
                        this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));;
                    })
                ])
            },
            updateSellers(){
                this.loaderOn('#sellers-list')
                this.getSellers().then((list) => {
                    this.sellers = list || [];

                    setTimeout(()=>{
                        this.loaderOff()
                    }, 500)
                })
            },
            statusManagement(){
                this.loaderOn('#projects-list')
                this.getProjects().then((list) => {
                    this.projects = list || [];

                    setTimeout(()=>{
                        this.loaderOff()
                    }, 500)
                })
            },
            switchTab(tab){
                switch(tab){
                    case 'moderation':
                        this.loaderOn('#moderation')
                        this.getBloggers([0]).then(list => {
                            this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;

                    case 'blogers-list':
                        this.loaderOn('#blogers-list')
                        this.getBloggers([1, -1]).then(list => {
                            this.bloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;

                    case 'sellers-list':
                        this.loaderOn('#sellers-list')
                        this.getSellers().then((list) => {
                            this.sellers = list || [];
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;

                    case 'projects-list':
                        this.loaderOn('#projects-list')
                        this.getProjects().then((list) => {
                            this.projects = list || [];
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break

                    case 'payment-history':
                        this.loaderOn('#payment-history')
                        this.getOrders().then((list) => {
                            this.orders = list || [];
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break

                    case 'referral':
                        this.loaderOn('#referral')
                        this.getReferalsData().then((data) => {
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break
                }
            }
        }
    }
</script>
