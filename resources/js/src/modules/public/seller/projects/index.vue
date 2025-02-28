<template>
    <div class="profile-projects" id="projects-list">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Все проекты
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

                <div
                    v-if="projects.length > 0 && isShowLoadingProjects"
                    v-for="i of (projects.length % 4 + 4)"
                    class="loading-project">
                    <div class="loading-project__image _loading-row">
                    </div>
                    <div class="loading-project__content">
                        <div class="loading-project__loading-row _loading-row"></div>
                        <div class="loading-project__loading-row _loading-row"></div>
                        <div class="loading-project__loading-row _loading-row"></div>
                    </div>
                </div>
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

import ListItem from './ListItem'
import Filter from './FiltersComponent'

import Loader from '../../../../core/components/AppLoader.vue'

import AppObserve from "../../../../core/services/Observer.vue";

export default{
    props:[],
    components: {Filter, ListItem, AppObserve},
    data(){
        return {
            projects: ref([]),
            filterData: {},

            isShowLoadingProjects: ref(false),

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

            this.getProjects({is_blogger_access: 1, statuses: [0]})
        },
    }
}
</script>

<style scoped>
    .loading-project{
        width: calc(100% / 4 - 10px);
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        min-width: 250px;
        display: flex;
        flex-direction: column;
        max-width: 320px;
        transition: box-shadow .2s linear;
        cursor: pointer;
        gap: 6px;
    }
    .loading-project__image{
        position: relative;
        margin-bottom: 10px;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;
        padding-top: 270px;
        border-radius: 10px;
    }
    .loading-project__content{
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        margin-top: 15px;
        gap: 8px;
    }
    .loading-project__content > *{
        width: 100%;
        height: 24px;
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
