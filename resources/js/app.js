require('./bootstrap');

import { createApp } from 'vue'
import { createMemoryHistory, createRouter } from 'vue-router'

// admin imports
import AdminIndex from './src/modules/admin/index.vue'

// user imports
import Auth from './src/modules/auth/login/index.vue'
import Register from './src1/auth/pages/AppRegister.vue'
import BloggerRegister from './src/modules/auth/blogger-register/index'
import SellerProfile from './src/modules/public/seller/index'
import SellerEditProfile from './src1/public/pages/seller/EditProfile.vue'
import BloggerEditProfile from './src1/public/pages/blogger/EditProfile.vue'
import Tariffs from './src1/public/pages/seller/AppTariffs.vue'
import Moderation from './src1/public/pages/blogger/AppModeration.vue'
import Banned from './src1/public/pages/AppBanned.vue'
import NotFound from './src1/public/pages/404.vue'
import User from './src1/services/api/User.vue'

const app = createApp();

const routes = [
    { path: '/seller/profile/:item?/:id?', name: 'SellerProfile', component: SellerProfile },
    // { path: '/blogger/profile/:item?/:id?', name: 'BloggerProfile', component: Profile },
    { path: '/register', name: 'Register', component: Register },
    { path: '/blogger/register', name: 'BloggerRegister', component: BloggerRegister },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/seller/profile/edit', name: 'SellerEditProfile', component: SellerEditProfile },
    { path: '/blogger/profile/edit', name: 'BloggerEditProfile', component: BloggerEditProfile },
    { path: '/tariffs', name: 'Tariffs', component: Tariffs },
    { path: '/moderation', name: 'Moderation', component: Moderation },
    { path: '/banned', name: 'Banned', component: Banned },
    { path: '/not-found', name: '404', component: NotFound },
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
    const tgToken = findGetParameter('token');
    let isAuthenticated = localStorage.getItem('session_token');

    if(tgToken){
        isAuthenticated = tgToken;
    }

    if(isAuthenticated){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + isAuthenticated;
    }

    if (!['Register', 'Login'].includes(to.name) && !isAuthenticated) {
        return {
            name: 'Login'
        }
    }
    else if(!to.name && isAuthenticated){
        var user = !tgToken ? await User.getUser() : await User.getCurrentUser();

        if(user.status == -1){
            return {
                name: 'Banned'
            }
        }

        if(user.role == 'blogger'){
            if(user.status == 1){
                return {
                    name: 'Profile'
                }
            }
            if(user.status == 0){
                return {
                    name: 'BloggerRegister'
                }
            }
        }
        else if(user.role == 'admin'){
            if(!window.location.href.toString().includes('/profile/admin'))
                window.location.href = '/profile/admin'
        }

        return {
            name: 'SellerProfile'
        }
    }
    else{
        if (!to.matched.length) {
            return {
                name: '404'
            }
        }
    }
})

function findGetParameter(parameterName) {
    var result = null,
        tmp = [];

    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}

localStorage.setItem('notifications_interval_id', '')
localStorage.setItem('chats_interval_id', '')
localStorage.setItem('chats_messages_interval_id', '')

app.component('admin-index', AdminIndex)

app.use(router)
app.mount('#app')
