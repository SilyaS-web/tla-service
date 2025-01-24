<template>
    <div class="profile-projects__filters">
        <div class="projects-list__filter filter">
            <div class="filter__body">
                <div class="filter__top">
                    <p class="filter__title">
                        Фильтр
                    </p>
                    <a
                        @click="resetFilter"
                        href="#" class="filter__reset">
                        Сбросить
                    </a>
                </div>
                <div class="filter__items">
                    <div class="form-group filter__item">
                        <input type="text" class="input" name="filter-name" id="filter-name" v-model="filter.product_name" placeholder="Поиск по названию">
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Формат рекламы</label>
                        <select name="project_type" id="filter-format" class="input" v-model="filter.project_type">
                            <option value="" class="">Выберите формат</option>
                            <option value="integration" class="">Интеграция</option>
                            <option value="feedback" class="">Выкуп + отзыв</option>
                        </select>
                    </div>

                    <div class="filter__btns">
                        <button
                            @click="applyFilter"
                            class="btn btn-primary">Применить</button>
                        <button
                            @click=""
                            class="btn btn-secondary hide">Скрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

export default{
    data(){
        return {
            filter: ref({
                project_type: null,
                product_name: null,
            }),
        }
    },
    methods:{
        applyFilter(){
            this.$emit('applyFilter', this.filter);
        },
        resetFilter(){
            this.filter = {
                product_name: '',
                project_type: '',
            }

            this.$emit('applyFilter', false);
        },
    }
}
</script>
