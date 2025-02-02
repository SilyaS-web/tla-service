<template>
    <div :class="'profile-blogers tab-content '" id="profile-blogers-list">
        <!-- страница каталога блогеров-->
        <div v-if="!isChooseProjectList" class="profile-blogers__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список блогеров
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                    <button
                        v-if = "!currentProject"
                        class="btn btn-primary" @click="switchToProjectsList">Выберите проект</button>
                </div>
            </div>

            <!-- плашка выбранного проекта-->

            <ChoosedProject
                v-if="currentProject"
                :project="currentProject"
                v-on:switchToProjectsList="switchToProjectsList()"
            ></ChoosedProject>

            <!-- каталог блогеров-->

            <div class="blogers-list__list list-blogers">
                <BloggersListItem
                    v-if="bloggers && bloggers.length > 0"
                    v-for="blogger in bloggers"
                    :blogger="blogger"
                    :currentProject="currentProject">
                </BloggersListItem>
                <span v-else> В списке блогеров пусто </span>
            </div>
        </div>

        <!-- фильтры-->
        <Filter
            v-if="!isChooseProjectList"
            v-on:applyFilter="applyBloggersFilter"
        ></Filter>

        <!-- каталог проектов-->
        <div
            v-if="isChooseProjectList"
            class="profile-projects" id="profile-projects-choose">
            <div class="profile-projects__body">
                <div class="projects-list__header">
                    <div class="list-projects__title title">
                        Список моих проектов
                    </div>
                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                        <button
                            v-if = "isChooseProjectList"
                            class="btn btn-primary" @click="isChooseProjectList = !isChooseProjectList">Вернуться</button>
                    </div>
                </div>
                <div class="profile-projects__items list-projects__items" style="max-width:1030px">
                    <div
                        v-if="projects.length > 0"
                        v-for="project in projects"
                        class="list-projects__item project-item">
                        <!--                        <div class="owl-carousel project-item__carousel">-->
                        <!--                            <div-->
                        <!--                                v-for="file in project.project_files"-->
                        <!--                                :style="'background-image: url(' + file.link + ')'"-->
                        <!--                                class="project-item__img">-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <carousel
                            :nav="false"
                            :dots="true"
                            :items="1"
                            :responsive="{ 0:{ items: 1 }, 1180: { items:1 } }">
                            <div
                                v-for="file in project.project_files"
                                :style="'background-image: url(' + file.link + ')'"
                                class="project-item__img">
                            </div>
                        </carousel>
                        <div class="project-item__content">
                            <div class="project-item__title">
                                <span class="project-item__price">{{ project.product_price }}</span>₽
                            </div>
                            <div class="project-item__subtitle" :title="project.product_name">
                                {{ project.product_name }}
                            </div>
                            <div class="project-item__format-tags card__row card__tags">
                                <div
                                    v-for="work in project.project_works"
                                    class="card__tags-item">
                                    <span>{{ work.name }}</span>
                                </div>
                            </div>
                            <div class="project-item__btns">
                                <a
                                    @click="chooseProject(project)"
                                    href="#" class="btn btn-primary">Выбрать</a>
                            </div>
                        </div>
                    </div>
                    <span v-else>Проектов нет</span>
                </div>
            </div>
            <div class="profile-projects__filters profile-projects__filters--choose">
                <div class="projects-list__filter filter">
                    <div class="filter__body">
                        <div class="filter__top">
                            <p class="filter__title">
                                Фильтр
                            </p>
                            <a
                                href="#" class="filter__hide">
                                Скрыть
                            </a>
                        </div>
                        <div class="filter__items">
                            <div class="form-group filter__item">
                                <input
                                    v-model="projectsFilter.product_name"
                                    type="text" class="input" name="filter-name" placeholder="Поиск по названию">
                            </div>
                            <div class="form-group filter__item">
                                <label>Формат рекламы</label>
                                <select
                                    v-model="projectsFilter.project_type"
                                    name="project_type" id="filter-format" class="input">
                                    <option value="" class="">Выберите формат</option>
                                    <option value="feedback" class="">Отзыв на товар</option>
                                    <option value="inst" class="">Интеграция Ins</option>
                                    <option value="youtube" class="">Интеграция YTube</option>
                                    <option value="vk" class="">Интеграция VK</option>
                                    <option value="telegram" class="">Интеграция Telegram</option>
                                </select>
                            </div>

                            <div class="filter__btns" >
                                <button
                                    @click="applyProjectsFilter"
                                    class="btn btn-primary">Применить</button>
                                <button
                                    @click="resetProjectsFilter"
                                    class="btn btn-secondary">Сбросить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- плашка об оплате тарифа-->
<!--        <div class="not_paid-alert">-->
<!--            <div class="not_paid-alert__body">-->
<!--                <div class="not_paid-alert__title">-->
<!--                    Каталог блогеров недоступен-->
<!--                </div>-->
<!--                <div class="not_paid-alert__text">-->
<!--                    Необходимо оплатить тариф, чтобы иметь возможность просматривать<br> каталог блогеров и начать работу с ними-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="not_paid-alert__footer">-->
<!--                <router-link :to="{ path: '/tariffs' }" class="not_paid-alert__btn btn btn-primary">Разблокировать каталог</router-link>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
</template>
<script>
import carousel from 'vue-owl-carousel/src/Carousel'
import {ref} from "vue";

import User from '../../../../core/services/api/User.vue'
import Project from '../../../../core/services/api/Project.vue'
import Loader from '../../../../core/components/AppLoader.vue'

import ProjectsList from "../projects/index";
import BloggersListItem from "./ListItem";
import ProjectsListItem from '../projects/ListItem'

import Filter from './FiltersComponent'
import ChoosedProject from './ChoosedProjectComponent'

import ChooseProjectPopup from '../../../../core/components/popups/choose-project/ChooseProjectPopup'

export default{
    props:['bloggers', 'user'],
    components:{
        ProjectsList, BloggersListItem, ProjectsListItem,
        ChooseProjectPopup, carousel, Filter, ChoosedProject
    },
    data(){
        return {
            projects:ref([]),
            currentProject: ref(null),
            isChooseProjectList: ref(false),

            isBlocked: ref(false),

            projectsFilter: ref({
                project_type: "",
                product_name: '',
            }),

            Project, User,
            Loader
        }
    },

    async mounted(){
        let user = this.User.getCurrent();

        this.isBlocked = !(user && (user.tariffs && user.tariffs.length > 0))
    },

    updated(){
        if(this.isChooseProjectList){
            $('.project-item').find('.project-item__carousel').owlCarousel({
                margin: 5,
                nav: false,
                dots: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:1
                    }
                }
            });
        }
    },
    methods:{
        async chooseProject(project){
            const data = await this.$refs.chooseProjectPopup.show({
                title: 'Выберите формат рекламы',
                subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
                works: project.project_works,
            });

            if(data){
                project.choosedWork = data
                this.currentProject = project;

                this.isChooseProjectList = false;
            }
        },
        switchToProjectsList(){
            this.isChooseProjectList = true;

            this.Loader.loaderOn('#profile-blogers-list');

            this.Project.getUsersProjectsList(this.user.id, {is_blogger_access: 1, statuses: [0]}).then(data => {
                this.projects = data || [];

                setTimeout(()=>{
                    this.Loader.loaderOff('#profile-blogers-list');
                }, 300)
            })
        },

        // фильтры для проектов
        applyProjectsFilter(){
            this.Loader.loaderOn('#profile-blogers-list');

            this.Project.getUsersProjectsList(this.user.id, this.projectsFilter).then(data => {
                this.projects = data || [];
                setTimeout(()=>{
                    this.Loader.loaderOff('#profile-blogers-list');
                }, 300)
            })
        },
        resetProjectsFilter(){
            this.projectsFilter = {
                product_name: '',
                project_type: '',
            }

            this.Loader.loaderOn('#profile-blogers-list');

            this.Project.getUsersProjectsList(this.user.id, {}).then(data => {
                this.projects = data || [];
                setTimeout(()=>{
                    this.Loader.loaderOff('#profile-blogers-list');
                }, 300)
            })
        },

        //фильтры списка блогеров
        applyBloggersFilter(filterData){
            this.$emit('applyFilter', filterData);
        }
    }
}
</script>
