require('./bootstrap');

import { createApp } from 'vue'
import { createMemoryHistory, createWebHistory, createRouter } from 'vue-router'

// admin imports
import AdminIndex from './src/modules/admin/index.vue'

// user imports
import Auth from './src/modules/auth/login/index'
import Register from './src/modules/auth/register/index'
import BloggerRegister from './src/modules/auth/blogger-register/index'
import SellerProfile from './src/modules/public/seller/index'
import BloggerProfile from './src/modules/public/blogger/index'
import SellerEditProfile from './src/modules/public/seller/profile/index'
import BloggerEditProfile from './src/modules/public/blogger/profile/index'
import Tariffs from './src/modules/public/seller/tariffs/index'
import Moderation from './src/modules/public/blogger/moderation/index'
import Banned from './src/modules/public/banned/index'
import User from './src/core/services/api/User'

const app = createApp();

const routes = [
    {
        path: '/seller/profile/:item?/:id?',
        name: 'SellerProfile',
        component: SellerProfile,
        meta: {
            title: 'Личный кабинет',
            description: '',
        }
    },
    {
        path: '/blogger/profile/:item?/:id?',
        name: 'BloggerProfile',
        component: BloggerProfile,
        meta: {
            title: 'Личный кабинет',
            description: '',
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            title: 'Регистрация пользователя',
            description: '',
        }
    },
    {
        path: '/blogger/register',
        name: 'BloggerRegister',
        component: BloggerRegister,
        meta: {
            title: 'Регистрация пользователя',
            description: '',
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: Auth,
        meta: {
            title: 'Авторизация пользователя',
            description: '',
        }
    },
    {
        path: '/seller/profile/edit',
        name: 'SellerEditProfile',
        component: SellerEditProfile,
        meta: {
            title: 'Личный кабинет',
            description: '',
        }
    },
    {
        path: '/blogger/profile/edit',
        name: 'BloggerEditProfile',
        component: BloggerEditProfile,
        meta: {
            title: 'Личный кабинет',
            description: '',
        }
    },
    {
        path: '/tariffs',
        name: 'Tariffs',
        component: Tariffs,
        meta: {
            title: 'Тарифы',
            description: '',
        }
    },
    {
        path: '/moderation',
        name: 'Moderation',
        component: Moderation,
        meta: {
            title: 'Вы находитесь на модерации',
            description: '',
        }
    },
    {
        path: '/banned',
        name: 'Banned',
        component: Banned,
        meta: {
            title: 'Вы были забанены модератором',
            description: '',
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
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
        const user = !tgToken ? await User.getUser() : await User.getCurrentUser();

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

router.beforeEach((to) => {
    const { title } = to.meta;
    const defaultTitle = 'Личный кабинет';

    document.title = title || defaultTitle
})

function findGetParameter(parameterName) {
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

app.component('admin-index', AdminIndex)

app.use(router)
app.mount('#app')
