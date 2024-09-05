<template>
    <div class="profile-projects tab-content" id="profile-projects-choose">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список моих проектов
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
        <div class="profile-projects__filters profile-projects__filters--choose">
            <div class="projects-list__filter filter">
                <div class="filter__body">
                    <div class="filter__top">
                        <p class="filter__title">
                            Фильтр
                        </p>
                        <a href="#" class="filter__reset">
                            Сбросить
                        </a>
                    </div>
                    <div class="filter__items">
                        <div class="form-group filter__item">
                            <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                        </div>
                        <div class="form-group filter__item">
                            <label for="">Формат рекламы</label>
                            <select name="project_type" id="filter-format" class="input">
                                <option value="" class="">Выберите формат</option>
                                <option value="feedback" class="">Отзыв на товар</option>
                                <option value="inst" class="">Интеграция Ins</option>
                                <option value="youtube" class="">Интеграция YTube</option>
                                <option value="vk" class="">Интеграция VK</option>
                                <option value="telegram" class="">Интеграция Telegram</option>
                            </select>
                        </div>

                        <div class="filter__btns">
                            <button class="btn btn-primary btn-filter-send">Применить</button>
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
        data(){
            return {
                projects: ref([])
            }
        },
        components:{ListItem},
    }
</script>
