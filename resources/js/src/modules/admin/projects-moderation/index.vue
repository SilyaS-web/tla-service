<template>
    <div class="admin-view__content projects-list tab-content" id="projects-list">
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
                    v-on:statusManagement="statusManagement"
                ></ProjectsItem>
            </div>
        </div>
    </div>
</template>
<script>
import ProjectsItem from '/ProjectsCard'

export default{
    props: ['projects'],
    components: {ProjectsItem},
    methods:{
        statusManagement(){
            this.$emit('statusManagement');
        }
    }
}
</script>
