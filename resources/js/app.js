require('./bootstrap');

import { createApp } from 'vue'
import { createMemoryHistory, createRouter } from 'vue-router'

import AdminIndex from './src/admin/pages/index.vue'
import AdminHeader from './src/admin/ui/AppHeader.vue'
import AdminAside from './src/admin/ui/AppAside.vue'
import AdminModerationPage from './src/admin/pages/BloggersModeration.vue'
import AdminBloggersPage from './src/admin/pages/AppBloggers.vue'
import AdminSellersPage from './src/admin/pages/AppSellers.vue'
import AdminProjectsPage from './src/admin/pages/AppProjects.vue'
import AdminOrdersPage from './src/admin/pages/AppOrders.vue'
import AdminReferalDataPage from './src/admin/pages/ReferalData.vue'

const adminApp = createApp();

adminApp.component('admin-index', AdminIndex)
adminApp.component('admin-header', AdminHeader)
adminApp.component('admin-aside', AdminAside)
adminApp.component('admin-bloggers-moderation-page', AdminModerationPage)
adminApp.component('admin-bloggers-page', AdminBloggersPage)
adminApp.component('admin-sellers-page', AdminSellersPage)
adminApp.component('admin-projects-page', AdminProjectsPage)
adminApp.component('admin-orders-page', AdminOrdersPage)
adminApp.component('admin-referal-data-page', AdminReferalDataPage)

adminApp.mount('#admin-app')


import Auth from './src/auth/pages/AppAuth.vue'
import Register from './src/auth/pages/AppRegister.vue'
import Profile from './src/public/pages/index.vue'

const app = createApp();

const routes = [
    { path: '/profile', name: 'Profile', component: Profile },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/register', name: 'Register', component: Register },
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    },
})

router.beforeEach((to, from) => {
    const isAuthenticated = localStorage.getItem('session_token')

    if (!['Register', 'Login'].includes(to.name) && !isAuthenticated) {
        return {
            name: 'Login'
        }
    }
    else if(!to.name && isAuthenticated){
        return {
            name: 'Profile'
        }
    }

    if(isAuthenticated){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');
    }
})


app.use(router)
app.mount('#app')
