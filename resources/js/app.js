require('./bootstrap');

import { createApp } from 'vue'
import { createMemoryHistory, createRouter } from 'vue-router'

// admin imports
import AdminIndex from './src/admin/pages/index.vue'

// user imports
import Auth from './src/auth/pages/AppAuth.vue'
import Register from './src/auth/pages/AppRegister.vue'
import BloggerRegister from './src/auth/pages/BloggerData.vue'
import Profile from './src/public/pages/index.vue'
import SellerEditProfile from './src/public/pages/seller/EditProfile.vue'
import BloggerEditProfile from './src/public/pages/blogger/EditProfile.vue'
import Tariffs from './src/public/pages/seller/AppTariffs.vue'

const adminApp = createApp();

adminApp.component('admin-index', AdminIndex)

adminApp.mount('#admin-app')


const app = createApp();

const routes = [
    { path: '/profile', name: 'Profile', component: Profile },
    { path: '/register', name: 'Register', component: Register },
    { path: '/blogger/register', name: 'BloggerRegister', component: BloggerRegister },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/seller/edit-profile', name: 'SellerEditProfile', component: SellerEditProfile },
    { path: '/blogger/edit-profile', name: 'BloggerEditProfile', component: BloggerEditProfile },
    { path: '/tariffs', name: 'Tariffs', component: Tariffs },
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

localStorage.setItem('notifications_interval_id', '')
localStorage.setItem('chats_interval_id', '')

app.use(router)
app.mount('#app')
