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
                    :projects="projects"
                    :project="project"
                ></ProjectsItem>
            </div>
        </div>
    </div>
</template>
<script>
    import ProjectsItem from '../ProjectsItemComponent.vue'

    export default{
        props: ['projects'],
        components: {ProjectsItem},
        methods:{
        }
    }
</script>
