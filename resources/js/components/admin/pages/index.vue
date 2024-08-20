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
                    <admin-aside v-on:switchTab="switchTab"></admin-aside>

                    <!-- Модерация -->
                    <admin-bloggers-moderation-page :bloggers="unverifiedBloggers" v-on:changedBloggersList="changedBloggersList"></admin-bloggers-moderation-page>

                    <!-- Список блогеров -->
                    <admin-bloggers-page :bloggers="bloggers" v-on:changedBloggersList="changedBloggersList"></admin-bloggers-page>

                    <!-- Список селлеров -->
                    <admin-sellers-page :sellers="sellers" v-on:changedSellersList="changedSellersList"></admin-sellers-page>

                    <!-- Список проектов -->
                    <admin-projects-page :projects="projects" v-on:statusManagement="statusManagement"></admin-projects-page>

                    <!-- Список заказов -->
                    <admin-orders-page :orders="orders"></admin-orders-page>
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
    import { ref } from 'vue'
    import axios from 'axios'
    import Loader from '../../services/AppLoader.vue'

    export default{
        data(){
            return Loader
        },
        setup() {
            let unverifiedBloggers = [],
                bloggers = [],
                sellers = [],
                projects = [],
                orders = [];

            return {
                unverifiedBloggers: ref(unverifiedBloggers),
                bloggers: ref(bloggers),
                sellers: ref(sellers),
                projects: ref(projects),
                orders: ref(orders),
            }
        },

        async mounted(){
            this.loaderOn('.wrapper');

            Promise.all([
                this.getBloggers([0]).then(list => {
                    this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));;
                })
            ]).then(() => {
                setTimeout(()=>{
                    this.loaderOff();
                }, 500)
            })
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
            changedBloggersList(){
                Promise.all([
                    this.getBloggers([1, -1]).then(list => {
                        this.bloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                    }),
                    this.getBloggers([0]).then(list => {
                        this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));;
                    })
                ])
            },
            changedSellersList(){
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
                            this.bloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
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

                    case 'payment-history':
                        this.loaderOn('#payment-history')
                        this.getOrders().then((list) => {
                            this.orders = list || [];
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                }
            }
        }
    }
</script>
