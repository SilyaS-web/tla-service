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
                            :projects="works"
                            v-on:applyFilter="applyFilterProjects">
                        </SellersWorks>

                        <!-- Список моих проектов -->
                        <AcceptedProjects
                            :projects="projects"
                            v-on:applyFilter="applyFilterProjects">
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
    import AcceptedProjects from '../../components/blogger/AcceptedProjectsListComponent'
    import ProjectsList from '../../components/blogger/AllProjectsListComponent'
    import SellersWorks from '../../components/blogger/SellersWorksListComponent'
    import Chat from '../../components/ChatIndex'

    export default{
        components: { Aside, Header, ProjectsList, Chat, SellersWorks, AcceptedProjects },
        data(){
            return {
                projects: ref([]),
                allProjects: ref([]),
                works: ref([]),

                newChatMessagesCount: ref(0),
                currentItem: ref(null),

                Loader, Tabs,
                Project, User, Work
            }
        },
        async mounted() {
            this.Loader.loaderOn('.wrapper profile__content-inner');

            this.user = this.User.getCurrent();
            this.projects = await this.Project.getUsersProjectsList(this.user.id);

            setTimeout(()=>{
                this.Loader.loaderOff();
            }, 300)
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
                console.log(tab)
                switch (tab){
                    case 'all-projects':
                        this.Project.getList().then(data => {
                            this.allProjects = data || [];

                            setTimeout(()=>{
                                this.Loader.loaderOff(`#${tab}`);
                            }, 300)
                        })

                        break;

                    case 'my-projects':

                        this.projects = await this.Project.getUsersProjectsList(this.user.id);

                        setTimeout(()=>{
                            this.Loader.loaderOff(`#${tab}`);
                        }, 300)

                        break;

                    case 'avail-projects':

                        this.works = await this.Work.getUserWorksList(this.user.id);

                        setTimeout(()=>{
                            this.Loader.loaderOff(`#${tab}`);
                        }, 300)

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

                this.projects = await this.Project.getList(filterData);

                setTimeout(()=>{
                    this.Loader.loaderOff();
                }, 300)
            }
        }
    }
</script>
