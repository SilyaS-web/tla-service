<template>
    <div class="admin-view__content statistics tab-content" id="statistics">
        <div class="admin-statistics__body">
            <div class="admin-statistics__header">
                <div class="admin-blogers__title admin-statistics__title title">
                    Статистика
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="admin-view__content-wrap statistics__body">
                <div class="statistics__items">
                    <div
                        v-for="(key, value) in statistics"
                        class="statistics__item">
                        <b>{{ key }}</b> - <b>{{ value }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";

import Statistics from "../../../core/services/api/Statistics.vue";

import Loader from '../../../core/services/AppLoader.vue'

export default {
    name: "index",
    data(){
        return{
            statistics:ref([]),

            Statistics, Loader
        }
    },
    mounted(){
         this.getStatistics()
    },
    components: {},
    methods:{
        getStatistics(dateStart, dateEnd){
            this.Loader.loaderOn(this.$el)

            if(!dateStart){
                let date = new Date();
                dateStart = new Date(date.getFullYear(), date.getMonth(), 1);
            }

            if(!dateEnd){
                dateEnd = Date.now()
            }

            this.Statistics.getStatistics().then(stats =>{
                this.statistics = stats
                this.Loader.loaderOff(this.$el)
            })
        }
    }
}
</script>

<style scoped>

</style>
