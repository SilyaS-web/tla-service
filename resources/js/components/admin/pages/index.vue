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
                    <admin-projects-page :projects="projects"></admin-projects-page>

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
                sellers = [
                    {
                        id: 1,
                        user: {
                            name: 'Илья Софронов',
                            email: 'ilya.sofron@mail.ru',
                            phone: '+7(902)122-32-90',
                            image: null,
                        },
                        inn: '11223344556',
                        agent: true,
                        organization_type: 'ИП',
                    },
                    {
                        id: 2,
                        user: {
                            name: 'Алексей Андреев',
                            email: 'andrey.gaga@mail.ru',
                            phone: '+7(903)133-33-90',
                            image: null,
                        },
                        inn: '6554433221',
                        agent: false,
                        organization_type: 'ООО',
                    },
                    {
                        id: 3,
                        user: {
                            name: 'Владислав Савинов',
                            email: 'savin@ebanaya.su',
                            phone: '+7(912)155-44-90',
                            image: null,
                        },
                        inn: '',
                        agent: false,
                        organization_type: '-',
                    },

                ],
                projects = [],
                orders = [],
                isLoading = false;

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
                this.getBloggers(0).then(list => {
                    this.unverifiedBloggers = (list || []).map(_b => this.findBiggerPlatform(_b));;
                })
            ]).then(() => {
                setTimeout(()=>{
                    this.loaderOff();
                }, 500)
            })
        },

        methods: {
            getBloggers(status = false){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/bloggers' + (status !== false ? `?status=${status}` : ''),
                    })
                    .then(data => resolve(data.data))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },
            findBiggerPlatform(blogger){
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
                    this.getBloggers(1).then(list => {
                        this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                    }),
                    this.getBloggers(0).then(list => {
                        this.unverifiedBloggers = (list || []).map(_b => this.findBiggerPlatform(_b));;
                    })
                ])
            },
            changedSellersList(id){
                this.sellers = this.sellers.filter(_s => _s.id != id);
            },
            switchTab(tab){
                switch(tab){
                    case 'moderation':
                        this.loaderOn('#moderation')
                        this.getBloggers(0).then(list => {
                            this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;

                    case 'blogers-list':
                        this.loaderOn('#blogers-list')
                        this.getBloggers(1).then(list => {
                            this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;

                    case 'sellers-list':
                        this.loaderOn('#sellers-list')
                        this.sellers = [
                            {
                                id: 1,
                                user: {
                                    name: 'Илья Софронов',
                                    email: 'ilya.sofron@mail.ru',
                                    phone: '+7(902)122-32-90',
                                    image: null,
                                },
                                inn: '11223344556',
                                agent: true,
                                organization_type: 'ИП',
                            },
                            {
                                id: 2,
                                user: {
                                    name: 'Алексей Андреев',
                                    email: 'andrey.gaga@mail.ru',
                                    phone: '+7(903)133-33-90',
                                    image: null,
                                },
                                inn: '6554433221',
                                agent: false,
                                organization_type: 'ООО',
                            },
                            {
                                id: 3,
                                user: {
                                    name: 'Владислав Савинов',
                                    email: 'savin@ebanaya.su',
                                    phone: '+7(912)155-44-90',
                                    image: null,
                                },
                                inn: '',
                                agent: false,
                                organization_type: '-',
                            },
                        ];

                        setTimeout(()=>{
                            this.loaderOff()
                        }, 500)
                        break;

                    case 'projects-list':
                        this.loaderOn('#projects-list')
                        setTimeout(()=>{
                            this.loaderOff()
                        }, 100)

                    case 'payment-history':
                        this.loaderOn('#payment-history')
                        setTimeout(()=>{
                            this.loaderOff()
                        }, 100)
                }
            }
        }
    }
</script>
