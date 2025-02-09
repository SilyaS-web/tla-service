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
                    :error="errors.country_id">
                </Select>

                <Select
                    v-model="blogger.sex"
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
                    :error="(errors && errors.sex ? errors.sex : '')">
                </Select>

                <Textarea
                    v-model="blogger.description"
                    :label="'Описание канала'"
                    :classList="[]"
                    :id="'desc'"
                    :cols="30"
                    :rows="10"
                    :placeholder="'Введите описание канала'"
                    :error="(errors && errors.description ? errors.description : '')"
                ></Textarea>

                <ChooseThemeBlock
                    v-model="themes"
                    :maxThemesLength="3"
                ></ChooseThemeBlock>

                <InputFile
                    v-model="blogger.image"
                    :label="'Загрузите аватарку профиля'"
                    :uploadedLabel="'Аватарка профиля загружена'"
                    :error="errors.image"
                ></InputFile>

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
import axios from 'axios';
import {ref} from "vue";

import Input from "../../../core/components/form/InputBlockComponent";
import Select from "../../../core/components/form/SelectBlockComponent";
import InputFile from "../../../core/components/form/InputFileBlockComponent";
import Textarea from "../../../core/components/form/TextareaBlockComponent";

import ChooseThemeBlock from "../../../core/components/choose-theme/index";

import Blogger from "../../../core/services/api/Blogger";
import User from "../../../core/services/api/User";

export default{
    components:{Input, Select, InputFile, Textarea, ChooseThemeBlock},
    data(){
        return {
            user:ref({}),
            blogger:ref({}),
            errors: ref({}),
            themes: ref([]),
            countries: [
                {
                    id: 1,
                    name: 'Россия'
                },
            ],

            Blogger, User
        }
    },
    async mounted() {
        this.user = this.User.getCurrent();

        if(this.user.blogger_id) {
            this.blogger = await this.Blogger.getItem(this.user.blogger_id);
        }
    },
    methods: {
        mapCountriesArray(){
            return this.countries.map(country => {
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

            for (let i = 0; i < this.themes.length; i++){
                formdata.append(`themes[${i}]`, this.themes[i])
            }

            formdata.append('image', this.blogger.image);
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
                console.log(this.errors.image)
                notify('error', {title: 'Ошибка', message: 'Не удалось сохранить данные, проверьте все поля, если все в порядке напишите в поддержку.'});
            })
        }
    }
}
</script>
