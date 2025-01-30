<template>
    <div class="profile-projects tab-content active" id="all-projects">
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
            </div>
        </div>

        <Filter
            v-on:applyFilter="applyFilter"
        ></Filter>

    </div>
</template>
<script>
import ListItem from './ListItem'
import Filter from './FiltersComponent'

export default{
    props:['projects'],
    components: {Filter, ListItem},
    data(){
        return {

        }
    },
    methods:{
        applyFilter(filterData){
            this.$emit('applyFilter', filterData);
        },
    }
}
</script>
