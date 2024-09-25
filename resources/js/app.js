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
import Banned from './src/public/pages/AppBanned.vue'
import User from './src/services/api/User.vue'

const app = createApp();

const routes = [
    { path: '/profile/:item?/:id?', name: 'Profile', component: Profile },
    { path: '/register', name: 'Register', component: Register },
    { path: '/blogger/register', name: 'BloggerRegister', component: BloggerRegister },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/seller/edit-profile', name: 'SellerEditProfile', component: SellerEditProfile },
    { path: '/blogger/edit-profile', name: 'BloggerEditProfile', component: BloggerEditProfile },
    { path: '/tariffs', name: 'Tariffs', component: Tariffs },
    { path: '/moderation', name: 'Moderation', component: Moderation },
    { path: '/banned', name: 'Banned', component: Banned },
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

router.beforeEach(async (to, from) => {
    const isAuthenticated = localStorage.getItem('session_token');

    if(isAuthenticated){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');
    }

    if (!['Register', 'Login'].includes(to.name) && !isAuthenticated) {
        return {
            name: 'Login'
        }
    }
    else if(!to.name && isAuthenticated){
        var user = await User.getUser();

        if(user.status == -1){
            return {
                name: 'Banned'
            }
        }

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
})

localStorage.setItem('notifications_interval_id', '')
localStorage.setItem('chats_interval_id', '')
localStorage.setItem('chats_messages_interval_id', '')

app.component('admin-index', AdminIndex)

app.use(router)
app.mount('#app')

