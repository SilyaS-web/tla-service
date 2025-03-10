<template>
    <div class="admin-view__content projects-list" id="projects-list">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Список проектов • {{projects.length}}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                </div> -->
            </div>
            <div class='list-projects__items admin-view__content-wrap'>
                <ProjectsItem
                    v-for="project in projects"
                    :project="project"
                ></ProjectsItem>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import Project from '../../../core/services/api/Project.vue'

import Loader from '../../../core/services/AppLoader.vue'

import ProjectsItem from './ProjectCard'

export default{
    data(){
        return {
            projects: ref([]),
            defaultQueryData: {},

            Project, Loader
        }
    },
    components: { ProjectsItem },
    mounted(){
        this.getProjects(this.defaultQueryData);
    },
    methods:{
        getProjects(data){
            this.Loader.loaderOn(this.$el)

            let params = {};

            for (const key in params) {
                if(data[key]) params[key] = data[key]
            }

            this.Project.getList(this.defaultQueryData)
            .then(projects => {
                this.projects = projects;
                this.Loader.loaderOff(this.$el);
            })
        }
    }
}
</script>
