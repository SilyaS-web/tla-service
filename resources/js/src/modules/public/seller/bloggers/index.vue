<template>
    <div :class="'profile-blogers profile-tab--js ' + (isBloggersListBlocked ? 'not-paid' : '')" id="bloggers-list">
        <!-- страница каталога блогеров-->
        <div v-if="!isChooseProjectList" class="profile-blogers__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список блогеров
                </div>
                <div class="list-bloggers__sort list-sort">
                    <div class="list-sort__title">
                        <svg width="" height="" viewBox="0 0 449 544" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.0073 151.245L24.0073 151.2V65.952C24.0073 65.8329 24.0065 65.7139 24.0047 65.5948C23.6686 43.016 41.653 24.4287 64.2097 24H383.804C406.362 24.4287 424.345 43.0158 424.009 65.5946C424.007 65.7137 424.006 65.8329 424.006 65.952V151.2L424.007 151.271C424.013 153.375 423.317 155.411 422.046 157.066L282.351 269.29C281.56 269.925 280.81 270.611 280.106 271.341C269.743 282.088 263.979 296.439 264.006 311.349V478.016C264.006 478.062 264.007 478.107 264.007 478.153C264.026 481.52 262.178 484.622 259.209 486.21C259.189 486.22 259.169 486.231 259.149 486.241L195.486 519.027C192.996 520.236 190.048 520.071 187.702 518.58C185.331 517.071 183.923 514.426 183.998 511.611C184.004 511.4 184.006 511.188 184.006 510.976V311.357C184.04 296.435 178.265 282.084 167.907 271.341C167.203 270.611 166.454 269.927 165.664 269.292L25.9692 157.035C24.6992 155.383 24.0034 153.349 24.0073 151.245Z" stroke="black" stroke-width="48" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.0073 151.245L24.0073 151.2V65.952C24.0073 65.8329 24.0065 65.7139 24.0047 65.5948C23.6686 43.016 41.653 24.4287 64.2097 24H383.804C406.362 24.4287 424.345 43.0158 424.009 65.5946C424.007 65.7137 424.006 65.8329 424.006 65.952V151.2L424.007 151.271C424.013 153.375 423.317 155.411 422.046 157.066L282.351 269.29C281.56 269.925 280.81 270.611 280.106 271.341C269.743 282.088 263.979 296.439 264.006 311.349V478.016C264.006 478.062 264.007 478.107 264.007 478.153C264.026 481.52 262.178 484.622 259.209 486.21C259.189 486.22 259.169 486.231 259.149 486.241L195.486 519.027C192.996 520.236 190.048 520.071 187.702 518.58C185.331 517.071 183.923 514.426 183.998 511.611C184.004 511.4 184.006 511.188 184.006 510.976V311.357C184.04 296.435 178.265 282.084 167.907 271.341C167.203 270.611 166.454 269.927 165.664 269.292L25.9692 157.035C24.6992 155.383 24.0034 153.349 24.0073 151.245Z" stroke="black" stroke-opacity="0.2" stroke-width="48" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="44" y="37" width="367" height="152" fill="black"/>
                            <rect x="97" y="189" width="247" height="37" fill="black"/>
                            <rect x="150" y="226" width="154" height="37" fill="black"/>
                            <rect x="170" y="263" width="105" height="226" fill="black"/>
                        </svg>
                    </div>
                    <div class="list-sort__items">
                        <div
                            v-for="(value, name) in sort"
                            @click="sortBloggers(name, value.orderBy === 'asc' ? 'desc' : 'asc')"
                            :class="[
                                'list-sort__item', 'list-sort__item--' + (value.orderBy), (sort[name].isActive ? 'active' : '')
                            ]"
                        >
                            {{ value.sortData[value.orderBy].title }}
                        </div>
                    </div>
                    <div
                        @click="dropSortData"
                        class="list-sort__drop">
                        <svg width="" height="" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="list-header__btns" style="">
                    <button class="btn btn-primary projects-list__filter-btn">
                        <svg width="" height="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5A3.502 3.502 0 0 0 18.355 8H21a1 1 0 1 0 0-2h-2.645a3.502 3.502 0 0 0-6.71 0H3a1 1 0 0 0 0 2h8.645A3.502 3.502 0 0 0 15 10.5zM3 16a1 1 0 1 0 0 2h2.145a3.502 3.502 0 0 0 6.71 0H21a1 1 0 1 0 0-2h-9.145a3.502 3.502 0 0 0-6.71 0H3z" fill=""/></svg>
                        Фильтры
                    </button>
                    <button
                        v-if = "!currentProject"
                        class="btn btn-primary" @click="switchToProjectsList">
                        <svg width="" height="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z" stroke="" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Выберите проект
                    </button>
                </div>
            </div>

            <!-- плашка выбранного проекта-->
            <ChoosedProject
                v-if="currentProject"
                :project="currentProject"
                v-on:switchToProjectsList="switchToProjectsList()"
            ></ChoosedProject>

            <!-- каталог блогеров-->
            <div :class="'blogers-list__list list-blogers ' + _list">
                <BloggersListItem
                    v-if="bloggers && bloggers.length > 0"
                    v-for="blogger in bloggers"
                    :blogger="blogger"
                    :currentProject="currentProject"
                    :classList="[_listItem]"
                >
                </BloggersListItem>
                <span class="list-empty" v-else> В списке блогеров пусто </span>

                <BloggerCardLoading
                    v-if="bloggers.length > 0 && isShowLoadingBloggers"
                    v-for="i of loadingItemsCount"
                ></BloggerCardLoading>
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
                    <div class="list-header__btns" style="">
                        <button class="btn btn-primary projects-list__filter-btn">
                            <svg width="" height="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5A3.502 3.502 0 0 0 18.355 8H21a1 1 0 1 0 0-2h-2.645a3.502 3.502 0 0 0-6.71 0H3a1 1 0 0 0 0 2h8.645A3.502 3.502 0 0 0 15 10.5zM3 16a1 1 0 1 0 0 2h2.145a3.502 3.502 0 0 0 6.71 0H21a1 1 0 1 0 0-2h-9.145a3.502 3.502 0 0 0-6.71 0H3z" fill=""/></svg>
                            Фильтры
                        </button>
                        <button
                            v-if = "isChooseProjectList"
                            class="btn btn-primary" @click="isChooseProjectList = !isChooseProjectList">
                            <svg width="" height="" fill="rgba(0,0,0,.4)" viewBox="0 0 2050 2050" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1582.2,1488.7a44.9,44.9,0,0,1-36.4-18.5l-75.7-103.9A431.7,431.7,0,0,0,1121.4,1189h-60.1v64c0,59.8-33.5,112.9-87.5,138.6a152.1,152.1,0,0,1-162.7-19.4l-331.5-269a153.5,153.5,0,0,1,0-238.4l331.5-269a152.1,152.1,0,0,1,162.7-19.4c54,25.7,87.5,78.8,87.5,138.6v98.3l161,19.6a460.9,460.9,0,0,1,404.9,457.4v153.4a45,45,0,0,1-45,45Z"/>
                            </svg>
                            Вернуться
                        </button>
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
                    <span class="list-empty" v-else>Проектов нет</span>
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
        <payment-alert-component></payment-alert-component>

        <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>

        <distribution-table
            v-on:mass-distribution="openMassDistributionPopup"
        ></distribution-table>

        <distribution-popup
            ref="distributionPopup"
        ></distribution-popup>

        <app-observe
            :options="{rootMargin: '0px 0px 1000px 0px', threshold: [0, 1]}"
            :itemsCount="20"
            ref="appObserver"
            @intersect="getBloggers({statuses:[1]})"
        ></app-observe>
    </div>
</template>
<script>
import {ref} from "vue";

import User from '../../../../core/services/api/User.vue'
import Project from '../../../../core/services/api/Project.vue'
import Blogger from '../../../../core/services/api/Blogger.vue'
import Loader from '../../../../core/services/AppLoader.vue'

import ProjectsList from "../projects/index";
import BloggersListItem from "./ListItem";

import BloggerCardLoading from '../../../../core/components/blogger-card-loading/index.vue'

import ProjectCard from '../../../../core/components/project-card/index'

import Filter from './FiltersComponent'
import ChoosedProject from './ChoosedProjectComponent'

import ChooseProjectPopup from '../../../../core/components/popups/choose-project/ChooseProjectPopup'

import PaymentAlertComponent from "./PaymentAlertComponent.vue";

import DistributionTable from './DistributionTable.vue'
import DistributionPopup from "../../../../core/components/popups/seller-mass-distribution/SellerMassDistribution.vue";

import AppObserve from "../../../../core/components/AppObserver.vue";

import LoadingItems from '../../../../core/mixins/LoadingListItems.js'

export default{
    props:['user'],
    mixins:[LoadingItems],
    components:{
        DistributionPopup,
        ProjectsList, BloggersListItem,
        ChooseProjectPopup, Filter, ChoosedProject,
        ProjectCard, DistributionTable, BloggerCardLoading, PaymentAlertComponent,

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

            sort: ref({
                createdAt: {
                    key: 'order_by_created_at',
                    orderBy: 'desc',
                    isActive: false,
                    sortData: {
                        asc: {
                            title: 'Сначала старые',
                        },
                        desc: {
                            title: 'Сначала новые',
                            default: true
                        },
                    }
                },
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

        this.listName = 'bloggers'

        this.Loader.loaderOn(this.$el);

        this.$refs.appObserver.restoreLimit()
        this.getBloggers({statuses: [1]})
    },

    updated(){
    },

    methods:{
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
            for (const sortItem in this.sort) {
                this.sort[sortItem].isActive = false;
            }

            this.sort[sortItemKey].orderBy = newOrderDirection;
            this.sort[sortItemKey].isActive = true;

            this.assignFilterAndSortData()

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.bloggers = [];

            this.getBloggers({statuses:[1]})
        },

        //фильтры списка блогеров
        applyBloggersFilter(filterData){
            this.Loader.loaderOn(this.$el);

            this.bloggersFilter = filterData;

            this.assignFilterAndSortData()

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.bloggers = [];

            this.getBloggers({statuses: [1]})
        },

        assignFilterAndSortData(){
            for (const sortListKey in this.sort) {
                if(this.sort[sortListKey].isActive){
                    const orderDirectionKey = this.sort[sortListKey].key;
                    const orderDirectionValue = this.sort[sortListKey].orderBy;

                    this.bloggersFilter = Object.assign(this.bloggersFilter, {
                        [orderDirectionKey]: orderDirectionValue
                    })
                }
                else{
                    delete this.bloggersFilter[this.sort[sortListKey].key]
                }
            }
        },

        dropSortData(){
            for (const sortItem in this.sort) {
                this.sort[sortItem].isActive = false;
            }

            this.assignFilterAndSortData()

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.bloggers = [];

            this.getBloggers({statuses: [1]})
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
    }
}
</script>
