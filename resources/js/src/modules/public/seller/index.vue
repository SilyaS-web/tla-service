<template>
    <Header v-on:switchTab="switchTab"></Header>

    <section class="profile" id="seller">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside
                    v-on:switchTab="switchTab"
                    :tabs="[
                        {
                            tabName: 'Создать проект',
                            tabContent: 'create-project',
                            classList: ['project-link'],
                            isActive: tab === 'create-project'
                        },
                        {
                            tabName: 'Мои проекты',
                            tabContent: 'my-projects-list',
                            classList: ['projects-list-link'],
                            isActive: tab === 'my-projects-list'
                        },
                        {
                            tabName: 'Все проекты',
                            tabContent: 'projects-list',
                            classList: ['all-projects-list-link'],
                            isActive: tab === 'projects-list'
                        },
                        // {
                        //     tabName: 'Дашборд',
                        //     tabContent: 'dashboard',
                        // },
                        {
                            tabName: 'Каталог блогеров',
                            tabContent: 'bloggers-list',
                            classList: ['blogers-list-link'],
                            isActive: tab === 'bloggers-list'
                        },
                        {
                            tabName: 'Чат с блогерами',
                            tabContent: 'chat',
                            notifications: newChatMessagesCount,
                            classList: ['chat-link'],
                            isActive: tab === 'chat'
                        },
                        // {
                        //     tabName: 'Партнеры',
                        //     tabContent: 'partners',
                        // },
                    ]"
                ></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <!-- создание проекта -->
                        <CreateProject
                            v-if="tab === 'create-project'"
                            v-on:switchTab="switchTab">
                        </CreateProject>

                        <!-- список всех проектов -->
                        <ProjectsList
                            v-if="tab === 'projects-list'"
                            :projects="projects"
                        >
                        </ProjectsList>

                        <!-- список моих проектов -->
                        <MyProjectsList
                            v-if="tab === 'my-projects-list'"
                            :currentItem="currentItem"
                            v-on:switchTab="switchTab"
                        ></MyProjectsList>

                        <!-- список блогеров -->
                        <BloggersList
                            v-if="tab === 'bloggers-list'"
                            :user="user">
                        </BloggersList>

                        <!-- чат -->
                        <Chat
                            v-if="tab === 'chat'"
                            :currentItem="currentItem"
                            v-on:switchTab="switchTab"
                            v-on:newMessages="newChatMessages"
                            v-on:updateCurrentItem="currentItem = $event"></Chat>

<!--                        <Partners-->
<!--                            v-if=""-->
<!--                        ></Partners>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div
        v-if="isShowTariffs"
        class="popup popup-tariffs" id="" style="">
        <div class="popup__container _container">
            <div class="popup__body popup__body--tariffs">
                <Tariffs></Tariffs>
            </div>
            <div
                @click="isShowTariffs = false"
                class="close-popup">
                <img src="/img/close-icon.svg" alt="">
            </div>
        </div>
    </div>
<!--    <promotion-banner></promotion-banner>-->
    <Footer></Footer>
</template>
<script>
import {ref} from 'vue'
import axios from "axios";

import User from '../../../core/services/api/User.vue'
import Seller from '../../../core/services/api/Seller.vue'
import Project from '../../../core/services/api/Project.vue'

import Loader from '../../../core/services/AppLoader.vue'

import CreateProject from './new-project/index'
import ProjectsList from './projects/index'
import MyProjectsList from './my-projects/index'
import BloggersList from './bloggers/index'
import Chat from '../chat/index'
import Aside from '../../../core/components/layout/tabs-aside/index'
import Header from '../../../core/components/layout/AppHeader'
import Footer from '../../../core/components/layout/AppFooter'
import Tariffs from './tariffs/index'
import Partners from './partners/index'
import PromotionBanner from "../../../core/components/promotion-banner/index.vue";

export default{
    components: {
        Aside, CreateProject, ProjectsList,
        MyProjectsList, BloggersList, Chat, Header, Footer, Tariffs, Partners,
        PromotionBanner
    },
    data(){
        return {
            user: ref(null),
            platforms: ref([]),
            themes: ref([]),
            myProjects: ref([]),
            brands: ref([]),
            dashboard: ref({
                "is_wb_api_key": false,
                "total_feedbacks_count": 0,
                "avg_feedbacks_value": 0,
                "products_bad_feedbacks": [],
                "products_good_feedbacks": [],
                "products_great_feedbacks": [],
                "products_few_feedbacks_count": [],
                "products_normal_feedbacks_count": [],
                "unanswered_feedbacks_count": 0,
                "total_clicks": 0,
                "statistics": [],
                "feedback_ratio": 0,
                "er": 0,
                "cpc": 0
            }),
            projects: ref([]),

            currentItem: ref(null),
            newChatMessagesCount: ref(0),

            isShowTariffs: ref(false),

            tab: ref('projects-list'),

            User, Seller, Project,
            Loader
        }
    },
    async mounted(){
        this.user = this.User.getCurrent();

        // this.dashboard = await this.User.getStatistics();

        this.isShowTariffs = localStorage.getItem('show_tariffs') ?
            JSON.parse(localStorage.getItem('show_tariffs')) :
            false;

        if(this.isShowTariffs){
            localStorage.setItem('show_tariffs', false)
        }

        if(this.$router.currentRoute.value.params && this.$router.currentRoute.value.params.item && this.$router.currentRoute.value.params.id){
            this.switchTab('chat', {
                item: this.$router.currentRoute.value.params.item,
                id: this.$router.currentRoute.value.params.id
            })
        }
    },
    methods:{
        switchTab(tab, currentItem = false){
            this.tab = tab
            this.currentItem = null
            if(currentItem)
                this.currentItem = currentItem;

            $('.wrapper').toggleClass('footer_disabled', ['create-project', 'chat'].includes(tab))
        },

        newChatMessages(messagesCount){
            this.newChatMessagesCount = messagesCount
        },
    }
}
</script>
