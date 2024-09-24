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
import Moderation from './src/public/pages/blogger/AppModeration.vue'

const app = createApp();

const routes = [
    { path: '/profile', name: 'Profile', component: Profile },
    { path: '/register', name: 'Register', component: Register },
    { path: '/blogger/register', name: 'BloggerRegister', component: BloggerRegister },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/seller/edit-profile', name: 'SellerEditProfile', component: SellerEditProfile },
    { path: '/blogger/edit-profile', name: 'BloggerEditProfile', component: BloggerEditProfile },
    { path: '/tariffs', name: 'Tariffs', component: Tariffs },
    { path: '/moderation', name: 'Moderation', component: Moderation },
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
    const isAuthenticated = localStorage.getItem('session_token');

    if (!['Register', 'Login'].includes(to.name) && !isAuthenticated) {
        return {
            name: 'Login'
        }
    }
    else if(!to.name && isAuthenticated){
        var user = JSON.parse(localStorage.getItem('user'));

        if(user.role == 'blogger'){
            if(!user.blogger_id){
                return {
                    name: 'BloggerRegister'
                }
            }
            if(user.status == 0){
                return {
                    name: 'Moderation'
                }
            }
        }

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

app.component('admin-index', AdminIndex)

app.use(router)
app.mount('#app')

