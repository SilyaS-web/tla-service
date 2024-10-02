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
</template>
<script>
    import {ref} from "vue";

    import Loader from '../../../services/AppLoader.vue'
    import Tabs from '../../../services/AppTabs.vue'

    import Project from '../../../services/api/Project'
    import User from '../../../services/api/User'
    import Work from '../../../services/api/Work'

    import Aside from '../../components/blogger/AppAside.vue'
    import Header from '../../components/layout/AppHeader.vue'
    import Footer from '../../components/layout/AppFooter.vue'
    import AcceptedProjects from '../../components/blogger/AcceptedProjectsListComponent'
    import ProjectsList from '../../components/blogger/AllProjectsListComponent'
    import SellersWorks from '../../components/blogger/SellersWorksListComponent'
    import Chat from '../../components/ChatIndex'

    export default{
        components: {
            Aside, Header, ProjectsList, Chat, SellersWorks, AcceptedProjects, Footer
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

                        this.Work.getUserWorksList(this.user.id, false, 1).then(data => {
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
