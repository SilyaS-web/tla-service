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
        <div class="profile-projects__filters">
            <div class="projects-list__filter filter">
                <div class="filter__body">
                    <div class="filter__top">
                        <p class = "filter__title">
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
                            <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию" v-model="filter.product_name">
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
                                @click=""
                                class="btn btn-secondary hide">Скрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ListItem from './ProjectsListItem.vue'
    import {ref} from "vue";

    export default{
        props:['projects'],
        data(){
            return {
                filter: ref({
                    project_type: '',
                    product_name: '',
                    category: '',
                }),
                currentCategory: ref(''),
                categories: ref([]),
            }
        },
        components:{ListItem},
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
            },
            getCategories(event){
                var value = $(event.target).val();

                axios({
                    method: 'get',
                    url: '/api/projects/categories',
                    params:{
                        category: value
                    }
                })
                .then(response => {
                    this.categories = response.data.categories
                })
                .catch(error => {
                })
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
