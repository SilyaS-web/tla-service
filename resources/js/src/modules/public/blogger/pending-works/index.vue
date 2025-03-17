<template>
    <div class="profile-projects profile-tab--js" id = "avail-projects">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Заявки от селлеров
                </div>
                <div class="list-header__btns" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">
                        <svg width="" height="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 10.5A3.502 3.502 0 0 0 18.355 8H21a1 1 0 1 0 0-2h-2.645a3.502 3.502 0 0 0-6.71 0H3a1 1 0 0 0 0 2h8.645A3.502 3.502 0 0 0 15 10.5zM3 16a1 1 0 1 0 0 2h2.145a3.502 3.502 0 0 0 6.71 0H21a1 1 0 1 0 0-2h-9.145a3.502 3.502 0 0 0-6.71 0H3z" fill=""/>
                        </svg>
                        Фильтры
                    </button>
                </div>
            </div>
            <div class="list-projects__items">
                <ListItem
                    v-if="works.length > 0"
                    v-for="work in works"
                    :work="work"
                ></ListItem>
                <span class="list-empty" v-else>Проектов нет</span>
            </div>
        </div>

        <Filter
            v-on:applyFilter="applyFilter"></Filter>
    </div>
</template>
<script>
import {ref} from "vue";

import ListItem from './ListItem'
import Filter from './FilterComponent'

import Loader from "../../../../core/services/AppLoader.vue";
import User from "../../../../core/services/api/User.vue";
import Work from "../../../../core/services/api/Work.vue";

export default {
    components: { ListItem, Filter },
    data(){
        return{
            works: ref([]),
            filterData: {},
            user: {},
            defaultQueryData: {
                order_by_last_message: 'asc',
                created_by: false,
                is_active: 0
            },

            Loader, User, Work
        }
    },
    mounted(){
        this.user = this.User.getCurrent();

        this.Loader.loaderOn(this.$el);

        this.defaultQueryData.created_by = (this.user.id * -1)

        this.getWorks(this.defaultQueryData);
    },
    methods: {
        getWorks(data){
            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            for (const key in this.filterData) {
                if(this.filterData[key]) params[key] = this.filterData[key]
            }

            this.Work.getUserWorksList(this.user.id, params).then(data => {
                this.works = data;

                setTimeout(()=>{
                    this.Loader.loaderOff(this.$el);
                }, 300)
            })
        },
        applyFilter(filterData){
            this.filterData = filterData;
            this.Loader.loaderOn(this.$el);
            this.works = [];

            this.getWorks(this.defaultQueryData)
        },
    }
}
</script>
