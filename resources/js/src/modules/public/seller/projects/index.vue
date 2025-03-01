<template>
    <div class="profile-projects" id="projects-list">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__left">
                    <div class="list-projects__title title">
                        Список проектов
                    </div>
                    <div class="list-projects__sort">
                        <div
                            v-for="(value, name) in sort"
                            @click="sortProjects(name, value.orderBy === 'asc' ? 'desc' : 'asc')"
                            :class="'list-projects__sort-item list-projects__sort-item--' + value.orderBy"
                        >
                            {{ value.sortData[value.orderBy].title }}
                        </div>
                    </div>
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                </div>
            </div>
            <div class="profile-projects__items list-projects__items" style="max-width:1030px">
                <ListItem
                    v-if="projects.length > 0"
                    v-for="project in projects"
                    :project="project"
                ></ListItem>
                <span v-else>Проектов нет</span>

                <ProjectCardLoading
                    v-if="projects.length > 0 && isShowLoadingProjects"
                    v-for="i of calculateLoadingItemsCount( '.project-item', projects.length, (projects.length % 4) + 4)"
                ></ProjectCardLoading>
            </div>
        </div>

        <Filter
            v-on:applyFilter="applyFilter"
        ></Filter>

        <app-observe
            :options="{rootMargin: '0px 0px 500px 0px', threshold: [0]}"
            :itemsCount="10"
            ref="appObserver"
            @intersect="getProjects({is_blogger_access: 1, statuses: [0]})"
        ></app-observe>

    </div>
</template>
<script>
import {ref} from "vue";

import Project from '../../../../core/services/api/Project.vue'
import AppObserve from "../../../../core/services/Observer.vue";

import Filter from './FiltersComponent'
import ListItem from './ListItem'

import Loader from '../../../../core/components/AppLoader.vue'
import ProjectCardLoading from '../../../../core/components/project-card-loading/index.vue'

import {calculateLoadingItemsCount} from "../../../../core/utils/calculateLoadingItemsCount";

export default{
    props:[],
    components: {Filter, ListItem, ProjectCardLoading, AppObserve},
    data(){
        return {
            projects: ref([]),
            filterData: {},

            isShowLoadingProjects: ref(false),

            sort: ref({
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
                },
                product_price: {
                    key: 'order_by_product_price',
                    orderBy: 'desc',
                    sortData: {
                        asc: {
                            title: 'Сначала дорогие',
                        },
                        desc: {
                            title: 'Сначала дешевые',
                        },
                    }
                },
            }),

            Project, Loader
        }
    },
    mounted() {
        this.Loader.loaderOn(this.$el);

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

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.projects = [];

            this.getProjects({is_blogger_access: 1, statuses: [0]})
        },

        sortProjects(sortItemKey, newOrderDirection){
            this.sort[sortItemKey].orderBy = newOrderDirection;

            this.assignFilterAndSortData()

            this.Loader.loaderOn(this.$el);

            this.$refs.appObserver.stopObserve();
            this.$refs.appObserver.observer = null;
            this.$refs.appObserver.restoreLimit()
            this.projects = [];

            this.getProjects({is_blogger_access: 1, statuses: [0]})
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

            this.filterData = Object.assign(this.filterData, orderList)
        },


        calculateLoadingItemsCount
    }
}
</script>
