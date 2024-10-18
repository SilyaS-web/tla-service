<template>
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Заполните поля
            </div>
            <div class="form auth__form">
                <div class="form-group">
                    <label for="city">Ваш город</label>
                    <input type="text" id="city" name="city" placeholder="Введите название города" class="input input--city" v-model="blogger.city">
                    <span class="error" v-if="errors.city">{{ errors.city }}</span>
                </div>
                <div class="form-group">
                    <label for="country">Ваша страна (Страны СНГ)</label>
                    <select id="country" name="country" class="input input--country select" v-model="blogger.country_id">
                        <option
                            v-for="country in countries"
                            :value="country.id">
                            {{ country.name }}
                        </option>
                    </select>
                    <span class="error">{{ errors.country }}</span>
                </div>
                <div class="form-group">
                    <label for="sex">Ваш пол</label>
                    <select id="sex" name="sex" class="input input--sex select" v-model="blogger.sex">
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                    <span class="error" v-if="errors.sex">{{ errors.sex }}</span>
                </div>
                <div class="form-group">
                    <label for="desc">Описание канала</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст" v-model="blogger.description"></textarea>
                    <span class="error" v-if="errors.description">{{ errors.description }}</span>
                </div>
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
                        Отправить на модерацию
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
    import InputFile from "../../ui/forms/InputFile";

    import Blogger from "../../services/api/Blogger";
    import Themes from "../../services/api/Themes";
    import User from "../../services/api/User";

    import axios from 'axios';
    import {ref} from "vue";

    export default{
        components:{InputFile},
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

                axios({
                    method: 'post',
                    url: '/api/bloggers/' + this.user.blogger_id + '/update/' ,
                    data: formdata
                })
                .then((data) => {
                    this.$router.replace('/moderation')
                })
                .catch(() =>{
                })
            }
        }
    }
</script>
