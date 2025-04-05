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
                    <input-block-component
                        v-model="filter.product_name"
                        :inputID="'filter-name'"
                        :inputType="'text'"
                        :inputPlaceholder="'Поиск по названию'"
                        :wrapClassList="['filter__item']"
                    >
                    </input-block-component>

                    <choose-category-component
                        v-model="filter.category"
                    ></choose-category-component>

                    <select-block-component
                        v-model="filter.project_type"
                        :label="'Формат рекламы'"
                        :selectID="'filter-format'"
                        :wrapClassList="['filter__item']"
                        :optionsList="[
                            {
                                name: 'Интеграция',
                                value: 'integration',
                            },
                            {
                                name: 'Выкуп + отзыв',
                                value: 'feedback',
                            },
                            {
                                name: 'UGC-контент',
                                value: 'ugc_content',
                            },
                        ]"
                    ></select-block-component>

                    <div class="filter__btns">
                        <button
                            @click="applyFilter"
                            class="btn btn-primary ">Применить</button>
                        <button
                            @click="resetFilter"
                            class="btn btn-secondary">Сбросить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
import Categories from "../../../../core/services/api/Categories.vue";
import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";
import ChooseCategoryComponent from "../../../../core/components/filter/ChooseCategoryComponent.vue";
export default {
    components: {ChooseCategoryComponent, SelectBlockComponent, InputBlockComponent},
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
            this.$emit('applyFilter', this.filter);
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
            this.currentCategory = category.theme;
        },
        clearCategories(){
            window.setTimeout(() => {this.categories = []}, 150)
        }
    }
}
</script>
