<template>
    <div class="projects-list__filter filter blogers-list__filter">
        <div class="filter__body">
            <div class="filter__top">
                <p class="filter__title">
                    Фильтр
                </p>
                <a
                    href="#" class="filter__hide">
                    Скрыть
                </a>
            </div>
            <div class="filter__items">
                <div class="form-group filter__item">
                    <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию" v-model="filter.name">
                </div>

                <div class="form-group filter__item">
                    <div class="filter__item--has-content" id = "filter__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__checkbox"
                                id="has-content"
                                :value="filter.has_content"
                                @change="filter.has_content = Number(!filter.has_content)">
                            <label for="has-content">Есть контент</label>
                        </div>
                    </div>
                </div>

                <div class="form-group filter__item">
                    <label for="">Платформа</label>
                    <div class="form-platforms">
                        <div class="form-platforms__items">
                            <div
                                v-for="platform in platforms"
                                @click="filter.platform === platform.id ? filter.platform = '' : filter.platform = platform.id"
                                :class="'form-platform ' + (filter.platform == platform.id ? 'current' : '')">
                                <img :src="platform.image" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group filter__item">
                    <label for="filter-country">Страна блогера</label>
                    <select name="filter-country" id="filter-country" class="input" v-model="filter.country">
                        <option value="" class="">Выберите страну</option>
                        <option value="1" class="">Россия</option>
                    </select>
                </div>

                <div class="form-group filter__item">
                    <label for="filter-city">Город блогера</label>
                    <input type="text" class="input" name="filter-city" id="filter-city" placeholder="Введите город" v-model="filter.city">
                </div>

                <div class="form-group" style="flex-direction: column;">
                    <label for="">Выберите тематику</label>
                    <div :class="'form-formats ' + (isFilterThemesOpen ? 'form-formats--open' : '')">
                        <div
                            v-if="filter.themes.length > 0"
                            @click="isFilterThemesOpen = !isFilterThemesOpen"
                            class="form-formats__current">
                            <div
                                v-for="theme in filter.themes"
                                class="form-formats__current-item">
                                {{ (themes.find(_theme => theme == _theme.id).name) }}
                            </div>
                        </div>
                        <span
                            v-else
                            @click="isFilterThemesOpen = !isFilterThemesOpen"
                            class="form-formats__empty">
                            Выбрать
                        </span>

                        <div class="form-formats__items">
                            <div
                                v-for="theme in themes"
                                class="form__row form-format">
                                <input
                                    :id="'theme-' + theme.id"
                                    type="checkbox" name="themes[]" class="form-format__check"
                                    @change="setFilterThemes(theme)"
                                >
                                <label
                                    :for="'theme-' + theme.id">
                                    {{ theme.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group filter__item">
                    <label for="">Пол блогера</label>
                    <div class="filter__item--sex" id = "filter__item--sex">
                        <div class="input-checkbox-w">
                            <input
                                @change="setFilterSex($event, 'male')"
                                type="checkbox" class="checkbox" id="male" :checked="filter.sex.includes('male')">
                            <label for="male">Мужской</label>
                        </div>
                        <div class="input-checkbox-w">
                            <input
                                @change="setFilterSex($event, 'female')"
                                type="checkbox" class="checkbox" id="female" :checked="filter.sex.includes('female')">
                            <label for="female">Женский</label>
                        </div>
                    </div>
                </div>

                <div class="form-group filter__item">
                    <label for="">Количество подписчиков</label>
                    <div class="input-range-w">
                        <Slider
                            v-model="filterSubscribersQuantity.value"
                            v-bind="filterSubscribersQuantity"
                            :min="0"
                            :max="4000000"
                        ></Slider>
                    </div>
                    <div class="form-group row" style="margin-top: 10px; flex-direction:row; justify-content: space-between; display:flex; gap: 15px">
                        <input style="width:150px" type="number" class="input" v-model="filterSubscribersQuantity.value[0]">
                        <input style="width:150px" type="number" class="input" v-model="filterSubscribersQuantity.value[1]">
                    </div>
                </div>
                <div class="filter__btns">
                    <button
                        @click="applyFilter"
                        class="btn btn-primary">Применить</button>
                    <button
                        @click="resetFilter"
                        class="btn btn-secondary">Сбросить</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
import Slider from '@vueform/slider'
import Platforms from "../../../../core/services/api/Platforms";
import Themes from "../../../../core/services/api/Themes";

export default{
    components:{ Slider },
    data(){
        return{
            platforms: ref([]),
            themes: ref([]),

            filterSubscribersQuantity: ref({
                value: [0, 4000000]
            }),
            filter: ref({
                name: '',
                platform: '',
                city: '',
                country: '',
                themes: [],
                sex: [],
                subscriber_quantity_min: 0,
                subscriber_quantity_max: 4000000,
                has_content: 0,
            }),

            isFilterThemesOpen: ref(false),

            Platforms, Themes
        }
    },
    async mounted() {
        this.platforms = await this.Platforms.getList();
        this.themes = await this.Themes.getList();
    },
    methods: {
        setFilterSex(e, value){
            if($(e.target).prop('checked')){
                this.filter.sex.push(value)
            }
            else{
                this.filter.sex.splice(this.filter.sex.indexOf(value), 1);
            }
        },
        setFilterThemes(themeID){
            if(!this.filter.themes.find(t => t.id === themeID)){
                this.filter.themes.push(themeID)
            }
            else{
                this.filter.themes.splice(this.filter.themes.indexOf(themeID), 1);
            }
        },
        getFilterThemesString(){
            let currentThemes = themes.filter(t => this.filter.themes.find(t.id));

            return currentThemes.map(t => t.name).join(', ')
        },

        applyFilter(){
            this.filter.subscriber_quantity_min = this.filterSubscribersQuantity.value[0]
            this.filter.subscriber_quantity_max = this.filterSubscribersQuantity.value[1]

            this.$emit('applyFilter', this.filter);
        },
        resetFilter(){
            this.filter = {
                name: '',
                platform: '',
                city: '',
                country: '',
                themes: [],
                sex: [],
                subscriber_quantity_min: 0,
                subscriber_quantity_max: 4000000,
            }
            this.filterSubscribersQuantity = {
                value: [0, 4000000]
            }

            $('.form-format__check').prop('checked', false)
            $('.filter__item--sex').prop('checked', false)

            this.$emit('applyFilter', {})
        },
    }
}
</script>
