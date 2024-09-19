<template>
    <div class="profile__navigation nav-menu">
        <div class="nav-menu__body">
            <div class="nav-menu__items">
                <a href="#" v-on:click="switchTab('my-projects')" class="nav-menu__item nav-menu__link tab projects-work-link active" data-content = "my-projects">
                    Проекты в работе
                </a>
                <a href="#" v-on:click="switchTab('all-projects')" class="nav-menu__item nav-menu__link tab projects-list-link" data-content = "all-projects">
                    Все проекты
                </a>
                <a href="#" v-on:click="switchTab('avail-projects')" class="nav-menu__item nav-menu__link tab projects-avail-link" data-content = "avail-projects">
                    Заявки от селлеров
                </a>
                <a href="#" v-on:click="switchTab('chat')" class="nav-menu__item nav-menu__link tab chat-link" data-content = "chat">
                    Чат с селлерами
                    <div class="nav-menu__item-notifs notifs notifs-chat" v-if="chatMessages && chatMessages > 0">
                        {{ chatMessages }}
                    </div>
                </a>
            </div>
        </div>
        <div class="nav-menu__close">
            <img src='/img/arrow-alt.svg' alt="">
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
