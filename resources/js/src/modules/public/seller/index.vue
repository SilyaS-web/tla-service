<template>
    <Header v-on:switchTab="switchTab"></Header>

    <section class="profile" id="seller">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside v-on:switchTab="switchTab" :chatMessages="newChatMessagesCount"></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <!-- создание проекта -->
                        <CreateProject v-on:switchTab="switchTab"></CreateProject>

                        <!-- Список всех проектов -->
                        <ProjectsList
                            :projects="projects"
                            v-on:applyFilter="applyFilterProjects">
                        </ProjectsList>

                        <!-- список моих проектов -->
                        <MyProjectsList
                            :myProjects="myProjects"
                            v-on:updateMyProjects="updateMyProjects"
                            v-on:switchTab="switchTab"
                            v-on:applyFilter="applyFilterMyProjects"
                        ></MyProjectsList>

                        <!-- список блогеров -->
                        <BloggersList
                            v-on:applyFilter="applyFilterBloggers"
                            :bloggers="bloggers"
                            :user="user">
                        </BloggersList>

                        <!-- чат -->
                        <Chat
                            :currentItem=currentItem
                            :isChatTab=isChatTab
                            v-on:switchTab="switchTab"
                            v-on:newMessages="newChatMessages"
                            v-on:updateCurrentItem="currentItem = $event"></Chat>

                        <Partners></Partners>
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
    <Footer></Footer>
</template>
<script>
import {ref} from 'vue'
import axios from "axios";

import User from '../../../core/services/api/User.vue'
import Seller from '../../../core/services/api/Seller.vue'
import Project from '../../../core/services/api/Project.vue'
import Blogger from '../../../core/services/api/Blogger.vue'

import Loader from '../../../core/components/AppLoader'
import Tabs from '../../../core/components/AppTabs'

import CreateProject from './new-project/index'
import ProjectsList from './projects/index'
import MyProjectsList from './my-projects/index'
import BloggersList from './bloggers/index'
import Chat from '../chat/index'
import Aside from '../../../core/components/layout/seller/AppAside'
import Header from '../../../core/components/layout/AppHeader'
import Footer from '../../../core/components/layout/AppFooter'
import Tariffs from './tariffs/index'
import Partners from './partners/index'

export default{
    components: {
        Aside, CreateProject, ProjectsList,
        MyProjectsList, BloggersList, Chat, Header, Footer, Tariffs, Partners,
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
            bloggers: ref([]),
            projects: ref([]),

            currentItem: ref(null),
            newChatMessagesCount: ref(0),

            isShowTariffs: ref(false),

            User, Seller, Blogger, Project,
            Loader, Tabs
        }
    },
    async mounted(){
        this.Loader.loaderOn('.wrapper #all-projects');

        this.user = this.User.getCurrent();

        // this.dashboard = await this.User.getStatistics();

        this.projects = await this.Project.getList({is_blogger_access: 1, statuses: [0]});

        this.isShowTariffs = localStorage.getItem('show_tariffs') ? JSON.parse(localStorage.getItem('show_tariffs')) : false;

        if(this.isShowTariffs){
            localStorage.setItem('show_tariffs', false)
        }

        setTimeout(() => {
            this.Loader.loaderOff('#all-projects');
        }, 300)

        if(this.$router.currentRoute.value.params && this.$router.currentRoute.value.params.item && this.$router.currentRoute.value.params.id){
            await this.switchTab('chat', {
                item: this.$router.currentRoute.value.params.item,
                id: this.$router.currentRoute.value.params.id
            })
        }
    },
    methods:{
        async switchTab(tab, currentItem = false){
            this.Tabs.tabClick(tab)

            this.currentItem = null

            if(currentItem)
                this.currentItem = currentItem;

            this.Loader.loaderOn('.wrapper #' + tab);

            this.isChatTab = tab === 'chat';

            $('.wrapper').toggleClass('footer_disabled', this.isChatTab || tab === 'create-project')

            switch (tab){
                case 'profile-projects':
                    this.myProjects = []

                    this.User.getProjects(this.user.id).then(data => {
                        var list = data || [];

                        if(this.currentItem){ //если мы перешли с другого модуля
                            if(this.currentItem.item === 'projects'){
                                list = list.map(_p => {
                                    _p.currentProject = _p.id == this.currentItem.id

                                    return _p;
                                });

                                this.currentItem = null
                            }
                        }

                        this.myProjects = list;

                        setTimeout(()=>{
                            this.Loader.loaderOff('#profile-projects');
                        }, 300)
                    })

                    break;

                case 'profile-blogers-list':
                    this.Blogger.getList([1]).then(data => {
                        this.bloggers = (data || []).map(_b => this.findBloggerBiggestPlatform(_b));

                        setTimeout(()=>{
                            this.Loader.loaderOff('#profile-blogers-list');
                        }, 300)
                    })

                    break;

                case 'all-projects':
                    this.Project.getList({is_blogger_access: 1, statuses: [0]}).then(data => {
                        this.projects = data || [];

                        setTimeout(()=>{
                            this.Loader.loaderOff('#all-projects');
                        }, 300)
                    })

                    break;

                default:
                    setTimeout(()=>{
                        this.Loader.loaderOff();
                    }, 300)
                    break
            }
        },

        async updateMyProjects(){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.myProjects = await this.User.getProjects(this.user.id);

            setTimeout(()=>{
                this.Loader.loaderOff();
            }, 300)
        },

        findBloggerBiggestPlatform(blogger){
            var summaryPlatform = { subscriber_quantity: 0 };

            if(blogger.platforms){
                blogger.platforms.forEach(_p => {
                    if(summaryPlatform.subscriber_quantity < _p.subscriber_quantity)
                        summaryPlatform = _p
                });
            }

            blogger.summaryPlatform = summaryPlatform;

            return blogger;
        },

        newChatMessages(messagesCount){
            this.newChatMessagesCount = messagesCount
        },

        async applyFilterBloggers(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.Blogger.getList(false, filterData).then(data => {
                this.bloggers = (data || []).map(_b => this.findBloggerBiggestPlatform(_b));

                setTimeout(()=>{
                    this.Loader.loaderOff();
                }, 300)
            })
        },

        async applyFilterMyProjects(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.myProjects = await this.User.getProjects(this.user.id, filterData);

            setTimeout(()=>{
                this.Loader.loaderOff();
            }, 300)
        },

        async applyFilterProjects(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.projects = await this.Project.getList(Object.assign(filterData, {is_blogger_access: 1, statuses: [0]}));

            setTimeout(()=>{
                this.Loader.loaderOff();
            }, 300)
        }
    }
}
</script>
