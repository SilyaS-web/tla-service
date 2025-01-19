<template>
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Заполните поля
            </div>
            <div class="form auth__form">
                <Input
                    v-model="blogger.city"
                    :label="'Ваш город'"
                    :inputType="'text'"
                    :inputPlaceholder="'Ваш город'"
                    :inputClassList="['input--city']"
                    :inputID="'city'"
                    :error="(errors && errors.city ? errors.city : '')"
                ></Input>
                <Select
                    v-model="blogger.country_id"
                    :label="'Ваша страна (Страны СНГ)'"
                    :selectClassList="['input--country']"
                    :selectID="'country'"
                    :optionsList="mapCountriesArray()"
                    :error="(errors && errors.country_id ? errors.country_id : '')">
                </Select>

                <Select
                    v-model="blogger.country_id"
                    :label="'Ваш пол'"
                    :selectClassList="['input--sex']"
                    :selectID="'sex'"
                    :optionsList="[
                        {
                            name: 'Мужской',
                            value: 'male',
                        },
                        {
                            name: 'Женский',
                            value: 'female',
                        },
                    ]"
                    :error="(errors && errors.country_id ? errors.country_id : '')">
                </Select>

                <Textarea
                    v-model="blogger.description"
                    :label="'Описание канала'"
                    :classList="[]"
                    :id="'desc'"
                    :cols="30"
                    :rows="10"
                    :placeholder="'Введите текст'"
                    :error="(errors && errors.description ? errors.description : '')"
                ></Textarea>

                <div class="form-group" style="flex-direction: column; margin-bottom:25px">
                    <label for="">Выберите тематику</label>
                    <div class="form-formats">
                        <div
                            v-for="theme in themes"
                            class="form__row form-format">
                            <input
                                :id="'theme-' + theme.id"
                                :value="theme.id"
                                @click="chooseTheme"
                                type="checkbox"
                                name=""
                                class="form-format__check">
                            <label :for="'theme-' + theme.id">{{ theme.name }}</label>
                        </div>
                    </div>
                    <span class="error" v-if="errors.themes">{{ errors.themes }}</span>
                </div>

                <div class="form-group form-group--file">
                    <InputFile v-model:image="blogger.image"></InputFile>
                    <span class="error" v-if="errors.image">{{ errors.image }}</span>
                </div>

                <div class="form-btns auth__form-btns" style="margin-top:32px">
                    <button
                        @click="sendToModeration"
                        class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
                <p class="form-addit">
                    Заполняя поля, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import Input from "../../../core/components/form/InputBlockComponent";
import Select from "../../../core/components/form/SelectBlockComponent";
import InputFile from "../../../core/components/form/InputFileBlockComponent";
import Textarea from "../../../core/components/form/TextareaBlockComponent";

import ChooseThemeBlock from "./ChooseThemeComponent";

import Blogger from "../../services/api/Blogger";
import Themes from "../../services/api/Themes";
import User from "../../services/api/User";

import axios from 'axios';
import {ref} from "vue";

export default{
    components:{Input, Select, InputFile, Textarea, ChooseThemeBlock},
    data(){
        return {
            user:ref({}),
            blogger:ref({}),
            errors: ref({}),
            themes: ref({}),
            countries: [
                {
                    id: 1,
                    name: 'Россия'
                },
            ],
            platformFields: ref([
                {
                    name: 'Telegram',
                    key: 'Telegram',
                    prefix: 'tg',
                    platform_id: 1,
                    link: null,
                    active: false
                },
                {
                    name: 'Ins',
                    key: 'Instagram',
                    prefix: 'inst',
                    platform_id: 3,
                    link: null,
                    active: false
                },
                {
                    name: 'Ytube',
                    key: 'Youtube',
                    prefix: 'yt',
                    platform_id: 2,
                    link: null,
                    active: false
                },
                {
                    name: 'Вконтакте',
                    key: 'VK',
                    prefix: 'vk',
                    platform_id: 4,
                    link: null,
                    active: false
                },
            ]),
            Themes, Blogger, User
        }
    },
    async mounted() {
        this.user = this.User.getCurrent();
        this.themes = await this.Themes.getList();

        if(this.user.blogger_id) {
            this.blogger = await this.Blogger.getItem(this.user.blogger_id);

            // for (let k in this.platformFields){
            //     var platform =
            //     if(this.platformFields[k].platform_id)
            // }
        }
    },
    methods: {
        chooseTheme(e){
            var list = $('.form-format .form-format__check:checked');

            if(list.length > 3){
                $(e.target).prop('checked', false);
                notify('info', {title: 'Внимание', message: 'Нельзя выбрать больше 3-х тематик'});
            }
        },

        mapCountriesArray(){
            return this.blogger.countries.map(country => {
                return {
                    name: country.name,
                    value: country.id
                }
            })
        },

        sendToModeration(){
            var formdata = new FormData;

            for(let k in this.blogger){
                if(!['themes'].includes(k))
                    formdata.append(k, this.blogger[k])
            }

            var themes = $('.form-format .form-format__check:checked');

            for (let i = 0; i < themes.length; i++){
                formdata.append(`themes[${i}]`, $(themes[i]).val())
            }

            var image = $('.tab-content__profile-img-upload').find('input[type="file"]')[0];

            if(image && image.files[0])
                formdata.append('image', image.files[0]);

            formdata.append('from_moderation', 1);

            axios({
                method: 'post',
                url: '/api/bloggers/' + this.user.blogger_id,
                data: formdata
            })
            .then((data) => {
                this.$router.replace('/profile')
            })
            .catch((err) =>{
                this.errors = err.response.data;
                notify('error', {title: 'Ошибка', message: 'Не удалось сохранить данные, проверьте все поля, если все в порядке напишите в поддержку.'});
            })
        }
    }
}
</script>
