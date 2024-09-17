<template>
    <div class="profile__navigation nav-menu">
        <div class="nav-menu__body">
            <div class="nav-menu__items">
                <a href="#" v-on:click="switchTab" class="nav-menu__item nav-menu__link tab projects-work-link active" data-content = "my-projects">
                    Проекты в работе
                </a>
                <a href="#" v-on:click="switchTab" class="nav-menu__item nav-menu__link tab projects-list-link" data-content = "profile-projects">
                    Все проекты
                </a>
                <a href="#" v-on:click="switchTab" class="nav-menu__item nav-menu__link tab projects-avail-link" data-content = "avail-projects">
                    Заявки от селлеров
                </a>
                <a href="#" v-on:click="switchTab" class="nav-menu__item nav-menu__link tab chat-link" data-content = "chat">
                    Чат с селлерами
                </a>
            </div>
        </div>
        <div class="nav-menu__close">
            <img src='/img/arrow-alt.svg' alt="">
        </div>
    </div>
</template>
<script>
    import Tabs from '../../../services/AppTabs.vue'

    export default{
        data(){
            return Tabs;
        },
        methods:{
            switchTab(event){
                this.$emit('switchTab', $(event.target).data('content'))
                this.tabClick(event)
            }
        }
    }
</script>
