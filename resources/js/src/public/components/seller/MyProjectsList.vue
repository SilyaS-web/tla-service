<template>
    <div class="profile-projects tab-content" id="profile-projects">
        <div class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список моих проектов
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                </div>
            </div>
            <div class="profile-projects__sort form-group" style="margin-bottom:32px;">
                <select
                    @click="extractBrands"
                    @change="sortByBrand"
                    name="projects-sort" id="projects-sort" style="border-radius:5px; border:1px solid rgba(0,0,0,.1); padding:0 8px; max-width:380px; height: 50px; font-size:18px">
                    <option value="">Выберите бренд</option>
                    <option value="">Все бренды</option>
                    <option
                        v-for="brand in brands"
                        :value="brand">
                        {{ brand }}
                    </option>
                </select>
            </div>
            <div class="profile-projects__items">
                <MyProjectsListItem
                    v-if="myProjects && myProjects.length > 0"
                    v-for="project in myProjects"
                    :project = "project"
                    v-on:switchTab="switchTab"
                ></MyProjectsListItem>
                <span v-else> Проектов нет </span>
            </div>
        </div>
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
                                <option value="" class="" >Выберите формат</option>
                                <option value="feedback" class="">Отзыв на товар</option>
                                <option value="inst" class="">Интеграция Ins</option>
                                <option value="youtube" class="">Интеграция YTube</option>
                                <option value="vk" class="">Интеграция VK</option>
                                <option value="telegram" class="">Интеграция Telegram</option>
                            </select>
                        </div>

                        <div class="filter__btns">
                            <button
                                @click="applyFilter"
                                class="btn btn-primary">Применить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Project from "../../../services/api/Project";
    import {ref} from "vue";

    import MyProjectsListItem from "./MyProjectsListItem";

    export default {
        components: {MyProjectsListItem},
        props: ['myProjects'],
        data(){
            return {
                brands: ref([]),
                filter: ref({
                    project_type: '',
                    product_name: '',
                }),
                Project
            }
        },
        methods:{
            extractBrands(){
                if(!this.brands || this.brands.length === 0){
                    var list = (this.myProjects || []).filter(_p => _p.marketplace_brand).map(_p => _p.marketplace_brand);
                    this.brands = list.filter((value, index, array) => array.indexOf(value) === index)
                }
            },
            sortByBrand(){
                var sort = String($('#projects-sort').val()), counter = 0;

                if(sort.length === 0){
                    $('.profile-projects__item').show()
                    return
                }

                $('.profile-projects__item').each((i, v)=>{
                    if( String($(v).data('brand')).toLowerCase() != sort.toLowerCase() ){
                        $(v).hide();
                        counter++;
                    }
                    else $(v).show()
                })

                if(counter === $('.profile-projects__item').length){
                    notify('info', {title: 'Внимание!', message: 'Проектов с таким брендом не найдено.'});
                }
            },
            switchTab(work_id){
                this.$emit('switchTab', 'chat', {
                    item: 'chat',
                    id: work_id
                })
            },
            applyFilter(){
                this.$emit('applyFilter', this.filter);
            },
            resetFilter(){
                this.filter = {
                    product_name: '',
                    project_type: '',
                }
                this.$emit('applyFilter', false);
            }
        }
    }
</script>
