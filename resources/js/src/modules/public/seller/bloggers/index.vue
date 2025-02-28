<template>
    <div :class="'profile-blogers profile-tab--js ' + (isBloggersListBlocked ? 'not-paid' : '')" id="bloggers-list">
        <!-- страница каталога блогеров-->
        <div v-if="!isChooseProjectList" class="profile-blogers__body">
            <div class="projects-list__header">
                <div class="list-projects__left">
                    <div class="list-projects__title title">
                        Список блогеров
                    </div>
                    <div class="list-projects__sort">
                        <div
                            @click="sortBloggers('createdAt', sort.createdAt.orderBy === 'asc' ? 'desc' : 'asc')"
                            :class="'list-projects__sort-item list-projects__sort-item--' + sort.createdAt.orderBy"
                        >
                            {{ sort.createdAt.sortData[sort.createdAt.orderBy].title }}
                        </div>
                    </div>
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

                <div
                    v-if="bloggers.length > 0 && isShowLoadingBloggers"
                    v-for="i of (bloggers.length % 4 + 4)"
                    class="loading-blogger">
                    <div class="loading-blogger__header _loading-row">
                    </div>
                    <div class="loading-blogger__body">
                        <div class="loading-blogger__loading-stats _loading-row"></div>
                        <div class="loading-blogger__loading-row">
                            <div class="loading-blogger__loading-col loading-blogger__loading-col--two-third  _loading-row"></div>
                            <div class="loading-blogger__loading-col loading-blogger__loading-col--one-third _loading-row"></div>
                        </div>
                    </div>
                </div>
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
                    <ProjectCard
                        v-if="projects && projects.length > 0"

                        v-for="project in projects"

                        :id="project.id"
                        :name="project.product_name"
                        :price="project.product_price || 0"
                        :works="project.project_works"
                        :imgs="project.project_files"
                    >
                        <div class="project-item__btns">
                            <a
                                @click="chooseProject(project)"
                                href="#" class="btn btn-primary">Выбрать</a>
                        </div>
                    </ProjectCard>

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
        <div class="not_paid-alert">
            <div class="not_paid-alert__body">
                <div class="not_paid-alert__title">
                    Каталог блогеров недоступен
                </div>
                <div class="not_paid-alert__text">
                    Необходимо оплатить тариф, чтобы иметь возможность просматривать<br> каталог блогеров и начать работу с ними
                </div>
            </div>
            <div class="not_paid-alert__footer">
                <router-link :to="{ path: '/tariffs' }" class="not_paid-alert__btn btn btn-primary">Разблокировать каталог</router-link>
            </div>
        </div>

        <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
        <distribution-table
            v-on:mass-distribution="openMassDistributionPopup"
        ></distribution-table>
        <distribution-popup
            ref="distributionPopup"
        ></distribution-popup>

        <app-observe
            :options="{rootMargin: '0px 0px 1000px 0px', threshold: [0]}"
            :itemsCount="20"
            ref="appObserver"
            @intersect="getBloggers({status:[1]})"
        ></app-observe>
    </div>
</template>
<script>
import {ref} from "vue";

import User from '../../../../core/services/api/User.vue'
import Project from '../../../../core/services/api/Project.vue'
import Blogger from '../../../../core/services/api/Blogger.vue'
import Loader from '../../../../core/components/AppLoader.vue'

import ProjectsList from "../projects/index";
import BloggersListItem from "./ListItem";
import ProjectsListItem from '../projects/ListItem'

import ProjectCard from '../../../../core/components/project-card/index'

import Filter from './FiltersComponent'
import ChoosedProject from './ChoosedProjectComponent'

import ChooseProjectPopup from '../../../../core/components/popups/choose-project/ChooseProjectPopup'

import DistributionTable from './DistributionTable.vue'
import DistributionPopup from "../../../../core/components/popups/seller-mass-distribution/SellerMassDistribution.vue";

import AppObserve from "../../../../core/services/Observer.vue";

export default{
    props:['user'],
    components:{
        DistributionPopup,
        ProjectsList, BloggersListItem, ProjectsListItem,
        ChooseProjectPopup, Filter, ChoosedProject,
        ProjectCard, DistributionTable,

        AppObserve
    },
    data(){
        return {
            bloggers:ref([]),

            projects:ref([]),
            currentProject: ref(null),
            isChooseProjectList: ref(false),

            isBloggersListBlocked: ref(false),

            bloggersFilter: {},

            sort:ref({
                createdAt: {
                    key: 'order_by_created_at',
                    orderBy: 'desc',
                    sortData: {
                        asc: {
                            title: 'Сначала старые',
                        },
                        desc: {
                            title: 'Сначала новые',
                        },
                    }
                }
            }),

            projectsFilter: ref({
                project_type: "",
                product_name: '',
            }),

            isShowLoadingBloggers: ref(false),

            Project, User, Blogger,
            Loader
        }
    },
    mounted(){
        const user = this.User.getCurrent();

        if(user){
            if(user.tariffs && user.tariffs.length > 0){
                this.isBloggersListBlocked = false
            }
        }

        this.Loader.loaderOn(this.$el);

        this.$refs.appObserver.restoreLimit()
        this.getBloggers({status: [1]})
    },

    updated(){
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

            this.User.getProjects(this.user.id, {is_blogger_access: 1, statuses: [0]}).then(data => {
                this.projects = data || [];

                setTimeout(()=>{
                    this.Loader.loaderOff('#profile-blogers-list');
                }, 300)
            })
        },
        // фильтры для проектов
        applyProjectsFilter(){
            this.Loader.loaderOn('#profile-blogers-list');

            this.User.getProjects(this.user.id, this.projectsFilter).then(data => {
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

            this.User.getProjects(this.user.id, {}).then(data => {
                this.projects = data || [];
                setTimeout(()=>{
                    this.Loader.loaderOff('#profile-blogers-list');
                }, 300)
            })
        },

        getBloggers(data){
            let params = {}

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            for (const key in this.bloggersFilter) {
                if(this.bloggersFilter[key]) params[key] = this.bloggersFilter[key]
            }

            const limitData = this.$refs.appObserver.getPaginationData()
            params.limit = [limitData.itemsOnPage, limitData.itemsCount]

            this.Blogger.getList(params).then(bloggers => {
                if(!this.$refs.appObserver.observer){
                    this.$refs.appObserver.startObserve()
                }

                if(!bloggers || bloggers.length === 0) {
                    this.$refs.appObserver.stopObserve();
                    this.isShowLoadingBloggers = false
                }
                else {
                    this.bloggers = [...this.bloggers, ...(bloggers || []).map(_b => this.findBloggerBiggestPlatform(_b))];
                    this.isShowLoadingBloggers = true
                }

                setTimeout(()=>{
                    this.Loader.loaderOff(this.$el);
                }, 300)
            })
        },

        sortBloggers(sortItemKey, newOrderDirection){
            this.sort[sortItemKey].orderBy = newOrderDirection;

            this.assignFilterAndSortData()

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.bloggers = [];

            this.getBloggers({status:[1]})
        },

        //фильтры списка блогеров
        applyBloggersFilter(filterData){
            this.Loader.loaderOn(this.$el);

            this.bloggersFilter = filterData;

            this.assignFilterAndSortData()
            this.getBloggers({status: [1]})
        },

        assignFilterAndSortData(){
            let orderList = {};

            for (const sortListKey in this.sort) {
                const orderDirectionKey = this.sort[sortListKey].key;
                const orderDirectionValue = this.sort[sortListKey].orderBy;

                Object.assign(orderList, {
                    [orderDirectionKey]: orderDirectionValue
                })
            }

            this.bloggersFilter = Object.assign(this.bloggersFilter, orderList)
        },

        openMassDistributionPopup(){
            this.$refs.distributionPopup.show({
                title: 'Массовая рассылка',
                integrationTypes:  this.currentProject.choosedWork,
                productPrice:  this.currentProject.product_price,
                productID:  this.currentProject.id,
                okButton: 'Отправить'
            })
        },

        findBloggerBiggestPlatform(blogger){
            let summaryPlatform = { subscriber_quantity: 0 };

            if(blogger.platforms){
                blogger.platforms.forEach(_p => {
                    if(summaryPlatform.subscriber_quantity < _p.subscriber_quantity)
                        summaryPlatform = _p
                });
            }

            blogger.summaryPlatform = summaryPlatform;

            return blogger;
        },
    }
}
</script>

<style scoped>
    .loading-blogger{
        display: flex;
        gap: 12px;
        flex-direction: column;
        height: 100%;
        width: calc(100% / 3 - 10px);
        max-width: 510px;
        padding: 20px;
        background-color: #fff;
        min-width: 337px;
        border: 1px solid #F5F5F5;
    }
    .loading-blogger__header{
        height: 175px;
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
    }
    .loading-blogger__body{
        margin-top: 21px;
        display: flex;
        flex-direction: column;
        gap: 30px;
        width: 100%;
    }
    .loading-blogger__loading-stats{
        width: 100%;
        height: 125px;
        border-radius: 10px;
        overflow: hidden;
    }
    .loading-blogger__loading-row{
        width: 100%;
        display: flex;
        gap: 8px;
    }
    .loading-blogger__loading-col{
        height: 46px;
        border-radius: 10px;
        overflow: hidden;
    }
    .loading-blogger__loading-col--one-third{
        width:calc(33.33% - 4px);
    }
    .loading-blogger__loading-col--two-third{
        width:calc(67.77% - 4px);
    }

    ._loading-row {
        color: transparent;
        background: linear-gradient(100deg, #eceff1 30%, #f6f7f8 50%, #eceff1 70%);
        background-size: 400%;
        animation: loading 1.2s ease-in-out infinite;
    }

    @keyframes loading {
        0% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0 50%;
        }
    }
</style>
