<template>
    <aside class="admin-menu">
        <div class="admin-menu__container">
            <div class="admin-menu__body">
                <nav class="nav admin-menu__nav">
                    <div class="nav__items">
                        <a v-on:click="switchTab" href="" class="nav__link tab active" data-content="moderation" title="Модерация блогеров">
                            <img src="/admin/img/blogers-list-icon.svg" alt="" class="nav__link-img">
                            Модерация блогеров
                        </a>
                        <a v-on:click="switchTab" href="" class="nav__link tab" data-content="blogers-list" title="Список блогеров">
                            <img src="/admin/img/blog-icon.svg" alt="" class="nav__link-img">
                            Список блогеров
                        </a>
                        <a v-on:click="switchTab" v-if="isAdmin" href="" class="nav__link tab" data-content="sellers-list" title="Список селлеров">
                            <img src="/admin/img/money-icon.svg" alt="" class="nav__link-img">
                            Список селлеров
                        </a>
                        <a v-on:click="switchTab" v-if="isAdmin" href="" class="nav__link tab" data-content="projects-list" title="Модерация проектов">
                            <img src="/admin/img/list-icon.svg" alt="" class="nav__link-img">
                            Модерация проектов
                        </a>
                        <a v-on:click="switchTab" v-if="isAdmin" href="#" class="nav__link tab" data-content="payment-history" title="История заказов">
                            <img src="/admin/img/history-icon.svg" alt="" class="nav__link-img">
                            История заказов
                        </a>
                        <a v-on:click="switchTab" v-if="isAdmin" href="#" class="nav__link tab" data-content="referral" title="Реферальные ссылки">
                            <img src="/admin/img/link-icon.svg" alt="" class="nav__link-img">
                            Реферальные ссылки
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </aside>
</template>
<script>
import Tabs from '../../services/AppTabs.vue'

export default{
    props:['isAdmin'],
    data(){
        return Tabs;
    },
    methods:{
        switchTab(event){
            this.$emit('switchTab', $(event.target).data('content'))
            this.tabClick($(event.target).data('content'))
        }
    }
}

</script>
