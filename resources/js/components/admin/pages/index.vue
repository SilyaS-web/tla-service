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
                    <!-- <div class="admin-view__content admin-blogers tab-content active" id="moderation">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Модерация блогеров • {{ $unverified_users->count() }}
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                                </div>
                            </div>

                            @include('shared.admin.unverified-users-list')
                        </div>
                    </div> -->
                    <!-- <div class="admin-view__content blogers-list tab-content" id="sellers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список селлеров • 1
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div>
                            </div>
                            @include('shared.admin.sellers-list')
                        </div>
                    </div> -->
                    <div class="admin-view__content projects-list tab-content" id="projects-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список проектов • 1
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> -->
                            </div>
                            <!-- @include('project.admin-list') -->
                        </div>
                    </div>
                    <div class="admin-view__content payment-history tab-content" id="payment-history">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    История заказов • 1
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Поиск">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> -->
                            </div>
                            <div class="payment-history__body admin-view__content-wrap">
                                <div class="payment-history__items">
                                    <div class="payment-history__row">
                                        <div href="" class="payment-history__row-title">
                                            <span>Заказ № 12</span>
                                            от 21.12.02
                                        </div>
                                        <div class="payment-history__row-status">
                                            <span>Статус</span>
                                            <strong>REJECTED</strong>
                                        </div>
                                        <div class="payment-history__row-summary">
                                            <span>Сумма</span>
                                            <strong>1234 <b class="rub">₽</b></strong>
                                        </div>
                                        <div class="payment-history__row-user">
                                            <span>Пользователь</span>
                                            <strong><a href="">ID </a></strong>
                                        </div>
                                        <div class="payment-history__row-tariff">
                                            <span>Тариф</span>
                                            <strong>123 — 123</strong>
                                        </div>
                                        <div class="payment-history__row-bank_id">
                                            <span>ID оплаты</span>
                                            <strong>1111</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loader" v-if="isLoading">
                <img src="/img/loading.gif" alt="">
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

    export default{
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
                isLoading = false;

            return {
                unverifiedBloggers: ref(unverifiedBloggers),
                bloggers: ref(bloggers),
                sellers: ref(sellers),
                isLoading: ref(isLoading),
            }
        },

        async mounted(){
            this.isLoading = true;

            Promise.all([
                this.getBloggers(1).then(list => {
                    this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                }),
                this.getBloggers(0).then(list => {
                    this.unverifiedBloggers = (list || []).map(_b => this.findBiggerPlatform(_b));;
                })
            ]).then(() => {
                setTimeout(()=>{
                    this.isLoading = false;
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
                this.isLoading = true;

                switch(tab){
                    case 'moderation':
                        this.getBloggers(0).then(list => {
                            this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                            setTimeout(()=>{
                                this.isLoading = false;
                            }, 500)
                        })
                        break;

                    case 'blogers-list':
                        this.getBloggers(1).then(list => {
                            this.bloggers = (list || []).map(_b => this.findBiggerPlatform(_b));
                            setTimeout(()=>{
                                this.isLoading = false;
                            }, 500)
                        })
                        break;

                    case 'sellers-list':
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
                            this.isLoading = false;
                        }, 500)
                        break;

                }
            }
        }
    }
</script>
