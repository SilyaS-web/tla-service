<template>
    <Header v-on:switchTab="switchTab"></Header>
    <section class="profile" id="blogger">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside
                    v-on:switchTab="switchTab"
                    :tabs="[
                        {
                            tabName: 'Проекты в работе',
                            tabContent: 'my-projects',
                            classList: ['projects-work-link'],
                            isActive: tab === 'my-projects'
                        },
                        {
                            tabName: 'Все проекты',
                            tabContent: 'all-projects',
                            classList: ['projects-list-link'],
                            isActive: tab === 'all-projects'
                        },
                        {
                            tabName: 'Заявки от селлеров',
                            tabContent: 'avail-projects',
                            classList: ['projects-avail-link'],
                            isActive: tab === 'avail-projects'
                        },
                        {
                            tabName: 'Чат с селлерами',
                            tabContent: 'chat',
                            notifications: newChatMessagesCount,
                            classList: ['chat-link'],
                            isActive: tab === 'chat'
                        },
                    ]"
                ></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">

                        <!-- Список всех проектов -->
                        <ProjectsList
                            v-if="tab === 'all-projects'">
                        </ProjectsList>

                        <!-- Список заявок -->
                        <SellersWorks
                            v-if="tab === 'avail-projects'">
                        </SellersWorks>

                        <!-- Список моих проектов -->
                        <AcceptedProjects
                            v-if="tab === 'my-projects'">
                        </AcceptedProjects>

                        <!-- Чат -->
                        <Chat
                            v-show="tab === 'chat'"
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

import Aside from '../../../core/components/layout/tabs-aside/index.vue'
import Header from '../../../core/components/layout/AppHeader.vue'
import Footer from '../../../core/components/layout/AppFooter.vue'

import User from '../../../core/services/api/User.vue'

import AcceptedProjects from './works/index'
import ProjectsList from './projects/index'
import SellersWorks from './pending-works/index'
import Chat from '../chat/index'

import AddContentPopup from '../../../core/components/popups/blogger-add-content/BloggerAddContentPopup'

export default{
    components: {
        Aside, Header, ProjectsList, Chat, SellersWorks,
        AcceptedProjects, Footer, AddContentPopup
    },
    data(){
        return {
            newChatMessagesCount: ref(0),
            currentItem: ref(null),

            tab: ref('all-projects'),

            user: {},

            User
        }
    },
    mounted() {
        this.user = this.User.getCurrent();

        if(this.user && this.user.modals && this.user.modals.find(modal => modal.id === 1)) {
            this.$refs.contentPopup.show()
        }

        setTimeout(()=>{
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

        switchTab(tab, currentItem = false){
            this.tab = tab
            this.currentItem = null

            if(currentItem)
                this.currentItem = currentItem;

            $('.wrapper').toggleClass('footer_disabled', ['chat'].includes(tab))
        },
    }
}
</script>
