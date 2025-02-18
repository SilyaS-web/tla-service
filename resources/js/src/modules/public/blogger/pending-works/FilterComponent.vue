<template>
    <div class="profile-projects__filters">
        <div class="projects-list__filter filter">
            <div class="filter__body">
                <div class="filter__top">
                    <p class = "filter__title">
                        Фильтр
                    </p>
                    <a
                        href="#" class="filter__hide">
                        Скрыть
                    </a>
                </div>
                <div class="filter__items">
                    <div class="form-group filter__item">
                        <input
                            v-model="filter.product_name"
                            type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                    </div>
                    <div class="form-group filter__item">
                        <label for="filter-category">Категория</label>
                        <input
                            @input="getCategories"
                            @focusout="clearCategories"
                            v-model="currentCategory"
                            type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">
                        <input type="text" id = "filter-category-id" hidden>
                        <div class="filter-tooltip" v-if="categories && categories.length">
                            <div class="filter-tooltip__items">
                                <div
                                    v-for="category in categories"
                                    @click="chooseCategory(category)"
                                    class="filter-tooltip__row">
                                    {{ category.theme }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Формат рекламы</label>
                        <select name="filter-format" id="filter-format" class = "input" v-model="filter.project_type">
                            <option value="" class="">Выберите формат</option>
                            <option value="integration" class="">Интеграция</option>
                            <option value="feedback" class="">Выкуп + отзыв</option>
                        </select>
                    </div>
                    <div class="filter__btns">
                        <button
                            @click="applyFilter"
                            class="btn btn-primary ">Применить</button>

                        <button
                            @click="resetFilter"
                            class="btn btn-secondary">Cбросить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import Categories from "../../../../core/services/api/Categories.vue";

export default {
    data(){
        return{
            filter: ref({
                project_type: '',
                product_name: '',
                category: '',
            }),
            currentCategory: ref(''),
            categories: ref([]),

            Categories
        }
    },
    methods:{
        applyFilter(){
            var filterData = {};

            for(let k in this.filter){
                if(this.filter[k])
                    filterData[k] = this.filter[k]
            }

            this.$emit('applyFilter', filterData);
        },
        resetFilter(){
            this.filter = {
                product_name: '',
                project_type: '',
                category: '',
            }
            this.currentCategory = ''

            this.$emit('applyFilter', {});
        },
        getCategories(event){
            const value = $(event.target).val();

            this.Categories.getList(value)
                .then((categories) => this.categories = categories)
        },
        chooseCategory(category){
            this.filter.category = category.theme;
            this.currentCategory = category.theme
        },
        clearCategories(){
            window.setTimeout(() => {this.categories = []}, 150)
        }
    }
}
</script>
