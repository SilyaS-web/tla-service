<template>
    <div class="profile-projects tab-content" id = "avail-projects">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Заявки от селлеров
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                </div>
            </div>
            <div class="list-projects__items">
                <ListItem
                    v-if="works.length > 0"
                    v-for="work in works"
                    :work="work"
                ></ListItem>
                <span v-else>Проектов нет</span>
            </div>
        </div>

        <Filter v-on:applyFilter="applyFilter"></Filter>
    </div>
</template>
<script>
import ListItem from './ListItem'
import Filter from './FilterComponent'

export default {
    props: ['works'],
    components: {ListItem, Filter},
    data(){
        return{
        }
    },
    mounted(){
        console.log(123)
    },
    methods: {
        applyFilter(filterData){
            this.$emit('applyFilter', filterData);
        },
    }
}
</script>
