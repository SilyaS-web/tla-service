<template>
    <div class="burger-menu" v-if="user">
        <div class="burger-menu__body">
            <div class="header__col header__profile-items">
                <div class="header__row">
                    <div class="header__profile-w header__profile-header header__profile-item--js">
                        <router-link :to="{path: '/profile'}">
                            <img
                                :src="user.image ? user.image : '/img/profile-icon.svg'"
                                alt="" class="header__profile">
                        </router-link>
                        <div class="header__profile-col">
                            <span class="header__profile-name">
                                {{ user.name }}
                            </span>
                            <span class="header__user-balance">
                                {{ `Баланс:${ (user.balance || '0') }₽` }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-if="user.role === 'seller'"
                class="header__balance balance-header">
                <div class="balance-header__tariff">
                    <p class="balance-header__tariff-label">
                        {{ user.tariffs && user.tariffs.length > 0 ? `Тариф «${user.tariffs[0].title}»` : 'Тариф отсутствует' }}
                    </p>
                    <span
                        :class="[
                            'balance-header__tariff-date',
                            (!user.tariffs || user.tariffs.length <= 0 ? 'balance-header__tariff-date--no-date' : '')
                        ]">
                        <span
                            v-if="user.tariffs && user.tariffs.length > 0"
                        > {{ "до " + formatDate(user.tariffs[0].finish_date) }} </span>
                    </span>
                </div>
            </div>

            <div class="burger-menu__nav nav-burger">
                <a
                    v-if="user.role === 'seller'"
                    @click.prevent="showTopupBalancePopup"
                    href="#"
                    class="nav-burger__link nav__link"
                >Пополнить cчет</a>

                <a
                    v-if="user.role === 'blogger'"
                    href="#"
                    class="nav-burger__link nav__link"
                >Вывести деньги</a>

                <router-link
                    v-if="user.role === 'seller'"
                    :to="{ path: '/tariffs' }" class="nav-burger__link nav__link">
                    Тарифы
                </router-link>

                <router-link
                    v-if="['SellerProfile', 'BloggerProfile'].includes($router.currentRoute.value.name)"
                    class="nav-burger__link nav__link" :to="{path: '/' + user.role + '/profile/edit'}">
                    Мои данные
                </router-link>

                <router-link
                    v-else
                    :to="{path: '/profile'}" class="nav-burger__link nav__link">
                    {{ user.role === 'seller' ? 'Все проекты' : 'Главная' }}
                </router-link>

                <a href="https://adswap.ru/instructions" class="nav-burger__link nav__link">Инструкции</a>
                <a href="https://adswap.ru/news" class="nav-burger__link nav__link">Новости</a>
                <a href="https://adswap.ru/files" class="nav-burger__link nav__link">Файлы</a>
                <a href="https://t.me/adswap_admin" class="nav-burger__link nav__link nav__link--tg">Тех.поддержка</a>

                <a
                    @click="logout"
                    class="nav-burger__link nav__link nav__link--logout"
                    style="width:100%; text-align:left">Выход</a>
            </div>

            <a href="#" class="burger-menu__close">
                <img src="/img/close-icon.svg" alt="">
            </a>
        </div>
    </div>

    <header class="header">
        <div class="header__container _container">
            <div class="header__body">
                <router-link :to="{path: '/profile'}" class="logo header__logo-w">
                    <img src="/img/logo.svg" alt="" class="logo__logo header__logo">
                </router-link>
                <nav
                    v-if="user"
                    class="nav header__nav">
                    <div class="nav__items">
                        <router-link :to="{ path: '/profile' }" class="nav__link">
                            {{ user.role === 'seller' ? 'Все проекты' : 'Главная' }}
                        </router-link>
                        <a href="https://adswap.ru/instructions" class="nav__link">Инструкции</a>
                        <a href="https://adswap.ru/files" class="nav__link">Файлы</a>
                        <a href="https://adswap.ru/news" class="nav__link">Новости</a>
                    </div>
                </nav>
                <div
                    v-if="user"
                    class=" header__profile-items header__row">
                    <div
                        v-if="user.role === 'seller'"
                        class="header__balance balance-header">
                        <div class="balance-header__tariff">
                            <p class="balance-header__tariff-label">
                                {{ user.tariffs && user.tariffs.length > 0 ? `Тариф «${user.tariffs[0].title}»` : 'Тариф отсутствует' }}
                            </p>
                            <span
                                :class="[
                                    'balance-header__tariff-date',
                                    (!user.tariffs || user.tariffs.length <= 0 ? 'balance-header__tariff-date--no-date' : '')
                                ]">
                                <span
                                    v-if="user.tariffs && user.tariffs.length > 0"
                                > {{ "до " + formatDate(user.tariffs[0].finish_date) }} </span>
                                <router-link
                                    v-else
                                    :to="{path: '/tariffs'}">
                                    Приобрести
                                </router-link>
                            </span>
                        </div>
                        <button
                            v-if="user.tariffs && user.tariffs.length > 0"
                            @click="showTopupBalancePopup"
                            class="btn btn-secondary balance-header__plus-btn">
                            Пополнить
                        </button>
                    </div>

                    <a
                        v-if="user"
                        href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                        <div class="header__profile-notif header-notif-count" v-if="notifications && notifications.length > 0">
                            {{ notifications.length }}
                        </div>
                        <img src="/img/notif-icon.svg" alt="" class="">
                        <div class="header__notif-items notif-header" v-if="notifications && notifications.length > 0">
                            <span
                                v-if="notifications.length > 1"
                                @click="hideAllNotifications"
                                style="display:block; color:var(--primary); margin-bottom:10px; font-size:14px;">Скрыть все</span>
                            <div class="notif-header__items header-notif-container" >
                                <div
                                    v-for="notif in notifications"
                                    class="notif-header__col ">
                                    <div class="notif-header__row">
                                        <div class="notif-header__col notif-header__img">
                                            <img :src="notif.image" alt="">
                                        </div>
                                        <div class="notif-header__col">
                                            <div class="notif-header__title">
                                                {{ notif.title || 'Новое уведомление' }}
                                            </div>
                                            <div class="notif-header__text">
                                                {{ notif.text }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notif-header__btns">
                                        <a
                                            v-if="notif.work_id && notif.is_work_active"
                                            @click="goToChat(notif.work_id)"
                                            href="#" class="notif-header__goto">Перейти</a>

                                        <a
                                            @click="hideNotification(notif)"
                                            href="#" class="notif-header__hide">Скрыть</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div v-if="user" class="header__profile-w header__profile-header header__profile-item--js">
                        <img :src="user.image ? user.image : '/img/profile-icon.svg'" alt="" class="header__profile">
                        <div class="header__profile-col">
                            <div class="header__profile-name">
                                {{ user.name }}
                                <div class="header__profile-arrow">
                                    <select-arrow-icon></select-arrow-icon>
                                </div>
                            </div>
                            <span class="header__user-balance">
                                {{ `Баланс:${ (user.balance || '0') }₽` }}
                            </span>
                        </div>
                        <div class="header__profile-settings">
                            <router-link :to="{path: '/' + user.role + '/profile/edit'}">
                                Личные данные
                            </router-link>

                            <router-link
                                v-if="user.role === 'seller'"
                                :to="{ path: '/tariffs' }" class="row">
                                Тарифы
                            </router-link>

                            <a
                                @click="logout"
                                class = "row" style="width:100%; text-align:left">Выход</a>
                        </div>
                    </div>
                </div>
                <a
                    v-if="user"
                    href="#" class="header__menu burger">
                    <img src="/img/menu-icon.svg" alt="">
                </a>
            </div>
        </div>
        <TopupBalancePopup ref="topupBalancePopup"></TopupBalancePopup>
    </header>
</template>

<script>
import moment from 'moment'
import axios from "axios";
import {ref} from "vue";

import User from '../../services/api/User'

import TopupBalancePopup from "../popups/topup-balance/TopupBalancePopup.vue";
import SelectArrowIcon from "../../icons/SelectArrowIcon.vue";

export default {
    inheritAttrs: false,
    props:['currentUser'],
    components:{SelectArrowIcon, TopupBalancePopup},
    data(){
        return {
            notifications: ref([]),
            user: ref(null),
            notificationsInterval: ref(null),
            User
        }
    },
    watch:{
        currentUser(){
            this.user = this.currentUser
        }
    },
    mounted(){
        if(!this.currentUser)
            this.user = this.User.getCurrent();

        this.getNotifications();

        this.notificationsInterval = localStorage.getItem('notifications_interval_id')

        if(!this.notificationsInterval) {
            this.notificationsInterval = setInterval(this.getNotifications, 5000)
            localStorage.setItem('notifications_interval_id', this.notificationsInterval)
        }
    },
    methods:{
        formatDate(value){
            if (value) {
                return moment(value).format('DD.MM.YY')
            }
        },
        logout(event){
            event.preventDefault()

            var notifsIntervalId = localStorage.getItem('notifications_interval_id'),
                chatsIntervalId = localStorage.getItem('chats_interval_id'),
                chatsMessagesIntervalId = localStorage.getItem('chats_messages_interval_id');

            notifsIntervalId && window.clearInterval(notifsIntervalId);
            chatsIntervalId && window.clearInterval(chatsIntervalId);
            chatsMessagesIntervalId && window.clearInterval(chatsMessagesIntervalId);

            localStorage.clear();

            axios.defaults.headers.common['Authorization'] = '';
            this.$router.replace('/login');
        },
        getNotifications(){
            if(this.user && this.user.id){
                axios({
                    method: 'get',
                    url: '/api/users/' + this.user.id + '/notifications?viewed=0',
                })
                    .then(( response ) => {
                        this.notifications = response.data.notifications
                    })
                    .catch((error) => {
                    });
            }
        },

        goToChat(work_id){
            if(this.$router.currentRoute.value.name === 'SellerProfile' || this.$router.currentRoute.value.name === 'BloggerProfile'){
                this.$emit('switchTab', 'chat', {
                    item: 'chat',
                    id: work_id
                });

                return;
            }

            this.$router.replace('/profile/chat/' + work_id)
        },

        showTopupBalancePopup(){ this.$refs.topupBalancePopup.show() },

        hideNotification(notification){
            axios({
                method: 'get',
                url: '/api/users/' + this.user.id + '/notifications/' + notification.id + '/view',
            })
            .then(( response ) => {
                this.getNotifications()
            })
            .catch((error) => {
                notify('info', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так, попробуйте позже.'
                })
            });
        },

        hideAllNotifications(){
            axios({
                method: 'get',
                url: '/api/users/' + this.user.id + '/notifications/view',
            })
            .then(( response ) => {
                this.notifications = [];
            })
            .catch((error) => {
                notify('info', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так, попробуйте позже.'
                })
            });
        }
    }
}
</script>

<style>
.header__profile-arrow svg path{
    fill:var(--text);
}
</style>

<style scoped>
.header {
    border-bottom: 1px solid rgba(86,86,86, .12);
    background-color: #fff;
    z-index: 3;
}
.header__container {
    margin: 0 auto;
    max-width: unset;
}
.header__body {
    display: flex;
    align-items: center;
    padding: 24px 17px;
    flex-wrap: nowrap;
}

.logo__logo{
    width: 120px;
}
.header__nav {
    margin:0 auto;
}
.nav__link {
    font-size: 16px;
    color:var(--text);
    font-weight: 600;
}
.nav__link:not(:last-child){
    margin-right: 20px;
}
.nav__link:hover{
    text-decoration: none;
    color:var(--secondary);
}
.nav__link.nav__link--tg{
    color:var(--secondary);
}
.nav__link.nav__link--logout{
    color:var(--err);
    border:0!important;
    margin-top: 24px;
}
.header__row{
    display: flex;
    gap: 8px;
    align-items: center;
}
.header__col{
    display: flex;
    flex-direction: column;
}


.balance-header{
    display: flex;
    gap: 12px;
}
.balance-header__tariff{
    display:flex;
    flex-direction: column;
    gap: 2px;
    justify-content: center;
}
.balance-header__tariff-label{
    color:#544F4F;
    font-weight: 500;
}
.balance-header__tariff-date{
    font-size: 12px;
    font-weight: 400;
    color:#544F4F;
}
.balance-header__plus-btn{
    padding: 10px 8px;
}

.header__col.header__notif{
    width:45px; height:45px;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background-color: var(--pale);
    position: relative;
}
.header__col.header__notif.active .header__notif-items{
    display: block;
}
.header__col .header__profile-notif{
    position: absolute;
    right: 3px;
    top: 3px;
    font-size: 10px;
    border-radius: 50%;
    background-color: var(--primary);
    min-width: 12px;
    height: 14px;
    color: #fff;
    text-align: center;
    z-index: 2;
    width: -moz-fit-content;
    width: fit-content;
    padding: 2px;
}
.header__notif-items {
    position: absolute;
    top:calc(100% + 10px);
    background-color: var(--pale);
    padding:10px;
    width:320px;
    display: none;
    border-radius: 5px;
    z-index: 9999;
    max-height:420px;
    overflow-y: auto;
    box-shadow:0px 0px 10px 6px rgba(0,0,0,.05);
}
.header__notif-items::-webkit-scrollbar {
    width: 12px;               /* ширина scrollbar */
}
.header__notif-items::-webkit-scrollbar-track {
    background: #fff;        /* цвет дорожки */
}
.header__notif-items::-webkit-scrollbar-thumb {
    background-color: #7A7674;    /* цвет плашки */
    border-radius: 20px;       /* закругления плашки */
    border: 3px solid #fff;  /* padding вокруг плашки */
}



.notif-header__items {
    display: flex;
    flex-direction: column;
    gap: 12px;
    color:#000;
}
.notif-header__row {
    display: flex;
    gap: 8px;
}
.notif-header__col {
    display: flex;
    flex-direction: column;
    gap: 3px;
}
.notif-header__img{
    max-width: 30px;
    height: 30px;
    border-radius: 5px;
    overflow: hidden;
    width: 100%;
}
.notif-header__img img{
    width: 100%;
    max-width:unset!important;
}
.notif-header__title {
    font-size: 14px;
    font-weight: 500;
}
.notif-header__text {
    font-size: 12px;
}
.notif-header__btns{
    display: flex;
    gap: 5px;
    font-size: 12px;
    margin-left: 38px;
}
.notif-header__hide{
    color:rgba(0, 0, 0, .4)
}
.header__profile-items{
    gap: 20px;
}
.header__profile-items>.header__col img{
    max-width: 17px;
}
.header__profile-w {
    display: flex;
    padding: 8px;
    max-width: unset;
    position: relative;
    cursor: pointer;
}
.header__profile-w.active .header__profile-settings{
    display: flex;
}
.header__profile-col{
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.header__profile-w:hover{
    text-decoration: none;
}
.header__profile {
    width: 100%;
    max-width: 24px;
    height: 24px;
    border-radius: 50%;
    margin-right: 8px;
    -o-object-fit:cover;
    object-fit:cover;
    -o-object-position: top;
    object-position: top;
}
.header__profile-name{
    font-size: 16px;
    font-weight: 500;
    color: var(--text);
    line-height: 1;
    display:flex;
    justify-content: space-between;
    gap: 8px;
}
.header__user-balance{
    font-size: 12px;
    font-weight: 400;
    color:var(--primary)
}
.header__profile-arrow{
    width: 16px;
    height: 16px;
    transition:all .1s linear;
}
.header__profile-header.active .header__profile-arrow{
    transform:rotate(180deg)
}

.header__profile-settings{
    position: absolute;
    top:calc(100% + 10px); right:0;
    width: 180px;
    background-color: var(--pale);
    padding:20px 10px;
    flex-direction: column;
    gap: 5px;
    display: none;
    border-radius: 5px;
    z-index: 9999;
    box-shadow:0px 0px 10px 6px rgba(0,0,0,.05);
}
.header__profile-settings>a{
    padding:10px 5px;
    color:#000;
    font-size: 14px;
    transition: all .2s linear;
    border-radius: 5px;
    width: 100%;
}
.header__profile-settings>a:hover{
    background-color: #fff;
    text-decoration: none;
    color:var(--primary)
}

.header__tarrif{
    background-color: var(--pale);
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding: 10px;
    max-width: unset;
    width:unset;height:unset;
    font-size: 14px;
    color: rgba(0, 0, 0, .4);
    position: relative;
    cursor: pointer;
}
.header__tarrif.active .tarrif-header__items{
    display: flex;
}
.header__tarrif:hover{
    text-decoration: none;
}
.tarrif-header__items{
    position: absolute;
    top:calc(100% + 10px); right:0;
    width: 235px;
    background-color: var(--pale);
    padding:20px 10px;
    display: none;
    flex-direction: column;
    gap: 5px;
    border-radius: 5px;
    z-index: 9999;
    box-shadow:0px 0px 10px 6px rgba(0,0,0,.05);
}
.tarrif-header__item{
    padding:10px 5px;
    color:#000;
    transition: all .2s linear;
    font-size: 14px;
    border-radius: 5px;
    font-weight: 400;
}
.tarrif-header__item:hover{
    background-color: #fff;
}
.tarrif-header__item b{
    color:var(--primary);
    font-weight: 600;
    text-wrap: wrap;
}
.tarrif-header__date{
    margin-top: 6px;
    margin-bottom: 10px;
    font-size: 12px;
    color:rgba(0, 0, 0, .4)
}


.burger{
    width: 25px;
    display: none;
}
.burger-menu {
    right:-100%;
    position: fixed;
    background-color: #fff;
    height: 100%;
    padding: 5px 15px;
    max-width: 215px;
    width: 100%;
    z-index: 9999;
    transition: right .2s linear;
}
.burger-menu.opened{
    right:0;
}
.burger-menu__body {
    padding-top: 30px;
}
.burger-menu .header__notif-items{
    right:0;
    width: 300px;
}
.burger-menu .notif-header__title{
    font-size: 12px;
}
.burger-menu .notif-header__text{
    font-size: 10px;
}

.nav-burger {
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
    margin-top: 30px;
}
.nav-burger > .nav__link{
    padding: 16px 0;
    border-top:1px solid rgba(0,0,0,.1);
}
.nav-burger > .nav__link:last-child{
    border-bottom: 1px solid rgba(0,0,0,.1);
}

.burger-menu__close {
    width: 20px;
    height: 20px;
    position: absolute;
    right: 5px; top: 15px;
}

@media (max-width: 1280px) {
    .burger {
        display: flex;
        align-items: center;
        margin-left: 26px;
    }
    .header__profile-items > *:not(.header__notif){
        display:none;
    }
    .burger-menu .header__profile-items > *{
        display:flex;
    }

    .balance-header{
        margin-top: 14px;
    }

    .nav__link:not(:last-child){
        margin-right: 0;
    }

    .balance-header__tariff-label{
        font-size: 14px;
    }

    .burger-menu .header__profile-name{
        font-size: 14px;
    }

    .nav-burger{
        margin-top: 14px;
        margin-bottom: 14px;
    }
    .nav-burger .nav__link{
        font-weight: 500;
        padding: 12px 0;
        font-size: 14px;
    }
    .header__notif-items {
        right: -50px;
        width: 300px;
    }

    .header__profile-w{
        padding: 0;
    }
    .header__profile{
        max-width: 36px;
        height: 36px;
    }
}

@media(max-width:675px){
    .header__body{
        padding: 14px 0;
    }
}
</style>
