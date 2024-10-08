<template>
    <div class="profile__navigation nav-menu">
        <div class="nav-menu__body">
            <div class="nav-menu__items">
                <a href="#" v-on:click="switchTab('create-project')" class="nav-menu__item nav-menu__link tab project-link" data-content="create-project">
                    Создать проект
                </a>
                <a href="#" v-on:click="switchTab('profile-projects')" class="nav-menu__item nav-menu__link tab projects-list-link" data-content="profile-projects">
                    Мои проекты
                </a>
                <a href="#" v-on:click="switchTab('all-projects')" class="nav-menu__item nav-menu__link tab all-projects-list-link" data-content="all-projects">
                    Все проекты
                </a>
                <a href="#" v-on:click="switchTab('dashboard')" class="nav-menu__item nav-menu__link tab active dashboard-link" data-content="dashboard">
                    Дашборд
                </a>
                <a href="#" v-on:click="switchTab('profile-blogers-list')" class="nav-menu__item nav-menu__link tab blogers-list-link" data-content="profile-blogers-list">
                    Каталог блогеров
                </a>
                <a href="#" v-on:click="switchTab('chat')" class="nav-menu__item nav-menu__link tab chat-link" data-content="chat">
                    Чат с блогерами
                    <div class="nav-menu__item-notifs notifs notifs-chat" v-if="chatMessages && chatMessages > 0">
                        {{ chatMessages }}
                    </div>
                </a>
                <a
                    v-on:click="switchTab('partners')"
                    style="margin-top:30px; display: none"
                    href="#" class="nav-menu__item nav-menu__link tab partners-link" data-content="partners">
                    Партнеры
                </a>
            </div>
        </div>
        <div class="nav-menu__close">
            <img src="/img/arrow-alt.svg" alt="">
        </div>
    </div>
</template>
<script>
export default{
    props:['chatMessages'],
    methods:{
        switchTab(link){
            this.$emit('switchTab', link)
        }
    }
}
</script>
