<template>
    <div class="admin-view__content statistics tab-content" id="statistics">
        <div class="admin-statistics__body">
            <div :style="{backgroundColor: '#fff', padding:'10px 15px'}" class="admin-statistics__header">
                <div
                    :style="{ fontSize: '20px', fontWeight: '600'}"
                    class="admin-statistics__title title">
                    Статистика
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                </div> -->
                <div :style="{display: 'flex', gap: '12px',}" class="">
                    <input :style="{width: '250px'}" type="date" name="" id="" v-model="dates.start">
                    <input :style="{width: '250px'}" type="date" name="" id="" v-model="dates.end">
                    <button
                        @click="getStatistics"
                        :style="{width: '150px'}" class="btn btn-primary">Применить</button>
                </div>
            </div>
            <div class="admin-view__content-wrap statistics__body">
                <div class="statistics__items">
                    <div
                        v-for="(key, value) in statistics"
                        class="statistics__item">
                        <b>{{ value }}</b> - <b>{{ key }}</b>
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
            dates: ref({
                start: null,
                end: null,
            }),

            Statistics, Loader
        }
    },
    mounted(){
    },
    components: {},
    methods:{
        getStatistics(){
            this.Loader.loaderOn(this.$el)

            const startDate = this.dates.start
            const endDate = this.dates.end

            this.Statistics.getStatistics(startDate, endDate).then(stats =>{
                this.statistics = stats
                this.Loader.loaderOff(this.$el)
            })
        }
    }
}
</script>

<style scoped>

</style>
