<template>
    <div class="profile-projects profile-tab--js" id="all-projects">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список проектов
                </div>
                <div class="list-projects__sort list-sort">
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
                            @click="sortProjects(name, value.orderBy === 'asc' ? 'desc' : 'asc')"
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
                        <svg width="" height="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5A3.502 3.502 0 0 0 18.355 8H21a1 1 0 1 0 0-2h-2.645a3.502 3.502 0 0 0-6.71 0H3a1 1 0 0 0 0 2h8.645A3.502 3.502 0 0 0 15 10.5zM3 16a1 1 0 1 0 0 2h2.145a3.502 3.502 0 0 0 6.71 0H21a1 1 0 1 0 0-2h-9.145a3.502 3.502 0 0 0-6.71 0H3z" fill=""/>
                        </svg>
                        Фильтры
                    </button>
                </div>
            </div>
            <div :class="['profile-projects__items', 'list-projects__items', (_list)]" style="max-width:1030px">
                <ListItem
                    v-if="projects.length > 0"
                    v-for="project in projects"
                    :project="project"
                    :classList="[_listItem]"
                ></ListItem>
                <span class="list-empty" v-else>Проектов нет</span>

                <ProjectCardLoading
                    v-if="projects.length > 0 && isShowLoadingProjects"
                    v-for="i of loadingItemsCount"
                ></ProjectCardLoading>
            </div>
        </div>

        <Filter v-on:applyFilter="applyFilter"></Filter>

        <app-observe
            :options="{rootMargin: '0px 0px 500px 0px', threshold: [0, 0.5, 1]}"
            :itemsCount="10"
            ref="appObserver"
            @intersect="getProjects({is_blogger_access: 1, statuses: [0]})"
        ></app-observe>
    </div>
</template>
<script>
import {ref} from "vue";

import ListItem from './ListItem'
import Filter from './FiltersComponent'

import ProjectCardLoading from "../../../../core/components/project-card-loading/index.vue";

import LoadingItems from "../../../../core/mixins/LoadingListItems";

import AppObserve from "../../../../core/components/AppObserver.vue";
import Project from "../../../../core/services/api/Project.vue";
import Loader from "../../../../core/services/AppLoader.vue";

export default{
    data(){
        return {
            projects: ref([]),
            filterData: {},

            isShowLoadingProjects: ref(false),

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
                productPrice: {
                    key: 'order_by_product_price',
                    orderBy: 'desc',
                    isActive: false,
                    sortData: {
                        asc: {
                            title: 'Сначала дешевые',
                        },
                        desc: {
                            title: 'Сначала дорогие',
                            default:true
                        },
                    }
                },
            }),

            Project, Loader
        }
    },
    mixins:[LoadingItems],
    components:{ AppObserve, ProjectCardLoading, ListItem, Filter },
    mounted() {
        this.Loader.loaderOn(this.$el);

        this.listName = 'projects'

        this.$refs.appObserver.restoreLimit()
        this.getProjects({is_blogger_access: 1, statuses: [0]})
    },
    methods:{
        getProjects(data){
            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            for (const key in this.filterData) {
                if(this.filterData[key]) params[key] = this.filterData[key]
            }

            const limitData = this.$refs.appObserver.getPaginationData()
            params.limit = [limitData.itemsOnPage, limitData.itemsCount]

            this.Project.getList(params).then(projects => {
                if(!this.$refs.appObserver.observer){
                    this.$refs.appObserver.startObserve()
                }

                if(!projects || projects.length === 0) {
                    this.$refs.appObserver.stopObserve();
                    this.isShowLoadingProjects = false
                }
                else {
                    this.projects = [...this.projects, ...projects];
                    this.isShowLoadingProjects = true
                }

                setTimeout(()=>{
                    this.Loader.loaderOff(this.$el);
                }, 300)
            })
        },

        applyFilter(filterData){
            this.filterData = filterData;

            this.assignFilterAndSortData();

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.projects = [];

            this.getProjects({is_blogger_access: 1, statuses: [0]})
        },

        sortProjects(sortItemKey, newOrderDirection){
            for (const sortItem in this.sort) {
                this.sort[sortItem].isActive = false;
            }

            this.sort[sortItemKey].orderBy = newOrderDirection;
            this.sort[sortItemKey].isActive = true;

            this.assignFilterAndSortData();

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit();
            this.projects = [];

            this.getProjects({is_blogger_access: 1, statuses: [0]})
        },

        assignFilterAndSortData(){
            for (const sortListKey in this.sort) {
                if(this.sort[sortListKey].isActive){
                    const orderDirectionKey = this.sort[sortListKey].key;
                    const orderDirectionValue = this.sort[sortListKey].orderBy;

                    this.filterData = Object.assign(this.filterData, {
                        [orderDirectionKey]: orderDirectionValue
                    })
                }
                else{
                    delete this.filterData[this.sort[sortListKey].key]
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
            this.$refs.appObserver.restoreLimit();
            this.projects = [];

            this.getProjects({is_blogger_access: 1, statuses: [0]})
        }
    }
}
</script>
