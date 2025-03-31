import "./bootstrap"
import { createApp } from 'vue'
import {
    createMemoryHistory, createRouter, RouteLocationNormalizedGeneric,
    RouteLocationNormalizedLoadedGeneric, RouteRecordRaw
} from 'vue-router'
import axios from "axios"

// admin imports
import AdminIndex from './src/modules/admin/index.vue'

// user imports
import Auth from './src/modules/auth/login/index.vue'
import Register from './src/modules/auth/register/index.vue'
import BloggerRegister from './src/modules/auth/blogger-register/index.vue'
import SellerProfile from './src/modules/public/seller/index.vue'
import BloggerProfile from './src/modules/public/blogger/index.vue'
import SellerEditProfile from './src/modules/public/seller/profile/index.vue'
import BloggerEditProfile from './src/modules/public/blogger/profile/index.vue'
import Tariffs from './src/modules/public/seller/tariffs/index.vue'
import Moderation from './src/modules/public/blogger/moderation/index.vue'
import Banned from './src/modules/public/banned/index.vue'
import User from './src/core/services/api/User.vue'

const routes: Array<RouteRecordRaw> = [
    { path: '/seller/profile/:item?/:id?', name: 'SellerProfile', component: SellerProfile },
    { path: '/blogger/profile/:item?/:id?', name: 'BloggerProfile', component: BloggerProfile },
    { path: '/register', name: 'Register', component: Register },
    { path: '/blogger/register', name: 'BloggerRegister', component: BloggerRegister },
    { path: '/login', name: 'Login', component: Auth },
    { path: '/seller/profile/edit', name: 'SellerEditProfile', component: SellerEditProfile },
    { path: '/blogger/profile/edit', name: 'BloggerEditProfile', component: BloggerEditProfile },
    { path: '/tariffs', name: 'Tariffs', component: Tariffs },
    { path: '/moderation', name: 'Moderation', component: Moderation },
    { path: '/banned', name: 'Banned', component: Banned },
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
    scrollBehavior(to:RouteLocationNormalizedGeneric, from:RouteLocationNormalizedLoadedGeneric, savedPosition:any):any {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    },
})

router.beforeEach(async (to:RouteLocationNormalizedGeneric, from:RouteLocationNormalizedLoadedGeneric) => {
    const tgToken:string|null = findGetParameter('token');
    let isAuthenticated:string|null = localStorage.getItem('session_token');

    if(tgToken){
        isAuthenticated = tgToken;
    }

    if(isAuthenticated){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + isAuthenticated;
    }

    if (typeof to.name === 'string' && !['Register', 'Login'].includes(to.name) && !isAuthenticated) {
        return {
            name: 'Login'
        }
    }
    else if(!to.name && isAuthenticated){
        let user = !tgToken ? await User.getUser() : await User.getCurrentUser();

        if(user.status == -1){
            return {
                name: 'Banned'
            }
        }

        if(user.role == 'blogger'){
            if(user.status == 1){
                return {
                    name: 'BloggerProfile'
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
})

function findGetParameter(parameterName:string):string|null {
    let result = null,
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

const app = createApp({});

app.component('admin-index', AdminIndex)

app.use(router)
app.mount('#app')
