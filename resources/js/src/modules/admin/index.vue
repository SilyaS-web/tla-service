<template>
    <AdminHeader></AdminHeader>

    <section class="admin-view">
        <div class="admin-view__container _container active-menu">
            <div class="admin-view__body">
                <!-- Левое меню -->
                <AdminAside v-on:switchTab="switchTab" :isAdmin></AdminAside>

                <!-- Модерация -->
                <AdminModerationPage :bloggers="unverifiedBloggers"  v-on:updateBloggers="updateBloggers"></AdminModerationPage>

                <!-- Список блогеров -->
                <AdminBloggersPage :bloggers="bloggers" v-on:updateBloggers="updateBloggers"></AdminBloggersPage>

                <!-- Список селлеров -->
                <AdminSellersPage v-if="isAdmin" :sellers="sellers" v-on:updateSellers="updateSellers"></AdminSellersPage>

                <!-- Список проектов -->
                <AdminProjectsPage v-if="isAdmin" :projects="projects" v-on:statusManagement="statusManagement"></AdminProjectsPage>

                <!-- Список заказов -->
                <AdminOrdersPage v-if="isAdmin" :orders="orders"></AdminOrdersPage>

                <!-- Список пользователей по реферальной ссылке -->
                <AdminReferalDataPage v-if="isAdmin" :ref_data="referals_data"></AdminReferalDataPage>
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
import Loader from '../../core/services/AppLoader.vue'
import AdminHeader from '../../core/components/layout/admin/AppHeader'
import AdminAside from '../../core/components/layout/admin/AppAside'
import AdminModerationPage from './bloggers-moderation/index'
import AdminBloggersPage from './bloggers-list/index'
import AdminSellersPage from './sellers-list/index'
import AdminProjectsPage from './projects-moderation/index'
import AdminOrdersPage from './payments/index'
import AdminReferalDataPage from './referrals/index'
import User from '../../core/services/api/User'

export default{
    components:{
        AdminHeader, AdminAside, AdminModerationPage,
        AdminBloggersPage, AdminSellersPage, AdminProjectsPage,
        AdminOrdersPage, AdminReferalDataPage
    },
    data(){
        return {
            user: ref(null),
            Loader,
            unverifiedBloggers: ref([]),
            bloggers: ref([]),
            sellers: ref([]),
            projects: ref([]),
            orders: ref([]),
            referals_data: ref({
                company:{
                    id: 0,
                    code: null,
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
                    code: null,
                    summary:{
                        total_register: 0,
                    },
                    list: {
                        users: [],
                    }
                }
            }),
            isAdmin: ref(false),
            User
        }
    },

    async mounted(){
        this.user = this.User.getCurrent();

        const isAuthenticated = localStorage.getItem('session_token');

        if(isAuthenticated){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');
        }

        if(!this.user || this.user.role !== 'admin'){
            window.location.href = '/'
        }

        this.isAdmin = this.user.is_admin;

        this.Loader.loaderOn('.wrapper');

        this.getBloggers([0]).then(list => {
            this.unverifiedBloggers = (list || []).filter(b => b.user && b.user.is_blogger_on_moderation).map(_b => this.findBiggestPlatform(_b));

            setTimeout(()=>{
                this.Loader.loaderOff();
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
                            .reduce((a, b) => a + b, 0);

                        let company_data = {
                            id: company.id,
                            code: company.code,
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
                            code: managers.code,
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

                        resolve(true)
                    })
                    .catch(error => {
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
                    this.unverifiedBloggers = (list || []).filter(b => b.user && b.user.is_blogger_on_moderation).map(_b => this.findBiggestPlatform(_b));;
                })
            ])
        },
        updateSellers(){
            this.Loader.loaderOn('#sellers-list')
            this.getSellers().then((list) => {
                this.sellers = list || [];

                setTimeout(()=>{
                    this.Loader.loaderOff()
                }, 500)
            })
        },
        statusManagement(){
            this.Loader.loaderOn('#projects-list')
            this.getProjects().then((list) => {
                this.projects = list || [];

                setTimeout(()=>{
                    this.Loader.loaderOff()
                }, 500)
            })
        },
        switchTab(tab){
            switch(tab){
                case 'moderation':
                    this.Loader.loaderOn('#moderation')
                    this.getBloggers([0]).then(list => {
                        this.unverifiedBloggers = (list || []).filter(b => b.user && b.user.is_blogger_on_moderation).map(_b => this.findBiggestPlatform(_b));
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break;

                case 'blogers-list':
                    this.Loader.loaderOn('#blogers-list')

                    this.getBloggers([1, -1]).then(list => {
                        this.bloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break;

                case 'sellers-list':
                    this.Loader.loaderOn('#sellers-list')
                    this.getSellers().then((list) => {
                        this.sellers = list || [];
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break;

                case 'projects-list':
                    this.Loader.loaderOn('#projects-list')
                    this.getProjects().then((list) => {
                        this.projects = list || [];
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break

                case 'payment-history':
                    this.Loader.loaderOn('#payment-history')
                    this.getOrders().then((list) => {
                        this.orders = list || [];
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break

                case 'referral':
                    this.Loader.loaderOn('#referral')
                    this.getReferalsData().then((data) => {
                        setTimeout(()=>{
                            this.Loader.loaderOff()
                        }, 500)
                    })
                    break
            }
        }
    }
}
</script>
