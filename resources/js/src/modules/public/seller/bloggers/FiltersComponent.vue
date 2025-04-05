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
                <input-block-component
                    v-model="filter.name"
                    :inputID="'filter-name'"
                    :inputType="'text'"
                    :inputPlaceholder="'Поиск по названию'"
                    :wrapClassList="['filter__item']"
                ></input-block-component>

                <div class="form-group filter__item">
                    <div class="filter__item--has-content" id = "filter__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__checkbox"
                                id="has-content"
                                :value="filter.has_content"
                                :checked="filter.has_content === 1"
                                @change="filter.has_content = Number(!filter.has_content)">
                            <label for="has-content">Есть примеры контента</label>
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
                                :class="'form-platform ' + (filter.platform === platform.id ? 'current' : '')">
                                <img :src="'/' + platform.image" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <select-block-component
                    v-model="filter.country"
                    :label="'Страна блогера'"
                    :selectID="'filter-country'"
                    :wrapClassList="['filter__item']"
                    :optionsList="[
                        {
                            name: 'Россия',
                            value: '1',
                        },
                    ]"
                ></select-block-component>

                <input-block-component
                    v-model="filter.city"
                    :label="'Город блогера'"
                    :inputID="'filter-city'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите город'"
                    :wrapClassList="['filter__item']"
                ></input-block-component>

                <ChooseTheme
                    v-model="filter.themes"
                ></ChooseTheme>

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
                        <input-component
                            @input="filterSubscribersQuantity.value[0] = $event.target.value"
                            :value="filterSubscribersQuantity.value[0]"
                            :id="'subscribers-quantity-from'"
                            :type="'number'"
                            :placeholder="''"
                        >
                        </input-component>
                        <input-component
                            @input="filterSubscribersQuantity.value[1] = $event.target.value"
                            :value="filterSubscribersQuantity.value[1]"
                            :id="'subscribers-quantity-to'"
                            :type="'number'"
                            :placeholder="''"
                        >
                        </input-component>
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

import ChooseTheme from "../../../../core/components/choose-theme/index"
import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";
import InputComponent from "../../../../core/components/form/InputComponent.vue";

export default{
    components:{InputComponent, SelectBlockComponent, InputBlockComponent, Slider, ChooseTheme },
    data(){
        return{
            platforms: ref([]),

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
                subscriber_quantity_max: 0,
                has_content: 0,
                status: [1],
            }),

            Platforms
        }
    },
    async mounted() {
        this.platforms = await this.Platforms.getList();
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
                has_content: 0,
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

<style scoped>
    .form-group label{
        margin-bottom: 20px;
    }
    .form-group .input-checkbox-w label,
    .form-group .checkbox label{
        margin-bottom: 0;
    }
    #subscribers-quantity-from,
    #subscribers-quantity-to{
        width: 110px;
    }
</style>
