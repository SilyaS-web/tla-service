<template>
    <Header v-on:switchTab="switchTab"></Header>
    <section class="profile" id="blogger">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside @switchTab="switchTab" :chatMessages="newChatMessagesCount"></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">

                        <!-- Список всех проектов -->
                        <ProjectsList
                            :projects="allProjects"
                            v-on:applyFilter="applyFilterProjects">
                        </ProjectsList>

                        <!-- Список заявок -->
                        <SellersWorks
                            :works="works"
                            v-on:applyFilter="applyFilterWorks">
                        </SellersWorks>

                        <!-- Список моих проектов -->
                        <AcceptedProjects
                            :works="inWorkProjectsList"
                            v-on:applyFilter="applyFilterAcceptedProjects">
                        </AcceptedProjects>

                        <!-- Чат -->
                        <Chat
                            :currentItem=currentItem
                            v-on:switchTab="switchTab"
                            v-on:newMessages="newChatMessages"
                            v-on:updateCurrentItem="currentItem = $event"></Chat>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <Footer></Footer>

    <AddContentPopup ref="addContentPopup"></AddContentPopup>
</template>
<script>
import {ref} from "vue";

import Loader from '../../../core/components/AppLoader.vue'
import Tabs from '../../../core/components/AppTabs.vue'

import Project from '../../../core/services/api/Project'
import User from '../../../core/services/api/User'
import Work from '../../../core/services/api/Work'

import Aside from '../../../core/components/layout/blogger/AppAside.vue'
import Header from '../../../core/components/layout/AppHeader.vue'
import Footer from '../../../core/components/layout/AppFooter.vue'

import AcceptedProjects from './works/index'
import ProjectsList from './projects/index'
import SellersWorks from './pending-works/index'
import Chat from '../chat/index'

import AddContentPopup from '../../../core/components/popups/blogger-add-content/BloggerAddContentPopup'

export default{
    components: {
        Aside, Header, ProjectsList, Chat, SellersWorks, AcceptedProjects, Footer,
        AddContentPopup
    },
    data(){
        return {
            inWorkProjectsList: ref([]),
            allProjects: ref([]),
            works: ref([]),

            newChatMessagesCount: ref(0),
            currentItem: ref(null),

            Loader, Tabs,
            Project, User, Work
        }
    },
    async mounted() {
        this.Loader.loaderOn('.wrapper .profile__content-inner');

        this.user = this.User.getCurrent();
        this.inWorkProjectsList = await this.Work.getUserWorksList(this.user.id, false, 1);

        if(this.user && this.user.modals && this.user.modals.find(modal => modal.id === 1)) {
            this.$refs.contentPopup.show()
        }

        setTimeout(()=>{
            this.Loader.loaderOff();

            if(this.$router.currentRoute.value.params && this.$router.currentRoute.value.params.item && this.$router.currentRoute.value.params.id){
                this.switchTab('chat', {
                    item: this.$router.currentRoute.value.params.item,
                    id: this.$router.currentRoute.value.params.id
                })
            }
        }, 500)
    },
    methods: {
        newChatMessages(messagesCount){
            this.newChatMessagesCount = messagesCount
        },

        async switchTab(tab, currentItem = false){
            this.Tabs.tabClick(tab)

            this.currentItem = null

            if(currentItem)
                this.currentItem = currentItem;

            this.Loader.loaderOn('.wrapper #' + tab);

            switch (tab){
                case 'all-projects':
                    this.Project.getList({is_blogger_access: 1, statuses: [0]}).then(data => {
                        this.allProjects = data || [];

                        setTimeout(()=>{
                            this.Loader.loaderOff(`#${tab}`);
                        }, 300)
                    })

                    break;

                case 'my-projects':

                    this.Work.getUserWorksList(this.user.id, false, 1, { order_by_last_message: 'asc' }).then(data => {
                        this.inWorkProjectsList = data;

                        setTimeout(()=>{
                            this.Loader.loaderOff(`#${tab}`);
                        }, 300)
                    })

                    break;

                case 'avail-projects':
                    this.Work.getUserWorksList(this.user.id, -this.user.id, 0).then((data) =>{
                        this.works = (data || []).filter(w => w.project);

                        setTimeout(()=>{
                            this.Loader.loaderOff(`#${tab}`);
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

        async applyFilterProjects(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.Project.getList(filterData).then(data => {
                this.allProjects = data || [];

                setTimeout(()=>{
                    this.Loader.loaderOff();
                }, 300)
            })
        },

        async applyFilterAcceptedProjects(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.Work.getUserWorksList(this.user.id, false, 1, filterData).then(data => {
                this.inWorkProjectsList = data;

                setTimeout(()=>{
                    this.Loader.loaderOff();
                }, 300)
            })
        },

        async applyFilterWorks(filterData){
            this.Loader.loaderOn('.wrapper .profile__content-inner');

            this.Work.getUserWorksList(this.user.id, -this.user.id, 0, filterData).then((data) =>{
                this.works = (data || []).filter(w => w.project);

                setTimeout(()=>{
                    this.Loader.loaderOff();
                }, 300)
            })
        }
    }
}
</script>
