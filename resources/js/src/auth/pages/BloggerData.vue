<template>
    <ClientStyles></ClientStyles>
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
                            value="{{ country.id }}">
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
                            :theme="theme"
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
                <div class="form-group">
                    <label for="" class="form-group__title">Социальные сети</label>
                    <label for="" class="form-group__subtitle">Ниже предоставьте ссылки на соц. сети вашего канала</label>
                </div>
                <div
                    v-for="field in platformFields"
                    :field="field"
                    class="popup__form-row popup__form-stat form-stat">
                    <div class="form-stat__title">
                        {{ field.name }}
                    </div>
                    <div class="form-stat__content">
                        <div class="form-stat__row">
                            <div class="form-group" style="width:100%; max-width:100%">
                                <label :for="field.prefix + '_link'">Ссылка</label>
                                <input
                                    :id = "field.prefix + '_link'"
                                    :name = "field.prefix + '-link'"
                                    v-model = "field.link"
                                    type="text"
                                    class="input" style="width:100%; max-width:100%">
                            </div>
                        </div>
                    </div>
                </div>

                <span class="error" v-if="errors.platforms">{{ errors.platforms }}</span>

                <div class="form-group form-group--file">
                    <InputFile v-model:image="blogger.image"></InputFile>
                    <span class="error" v-if="errors.image">{{ errors.image }}</span>
                </div>
                <div class="form-btns auth__form-btns" style="margin-top:32px">
                    <button class="btn btn-primary next" type="submit">
                        Отправить на модерацию
                    </button>
                </div>
                <p class="form-addit">
                    Заполняя поля, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                </p>
            </div>
        </div>
    </div>
    <ClientScripts></ClientScripts>
</template>

<script>
    import InputFile from "../../ui/forms/InputFile";
    import {ref} from "vue";

    import ClientStyles from '../../public/components/ClientStyles.vue'
    import ClientScripts from '../../public/components/ClientScripts.vue'

    export default{
        components:{InputFile, ClientStyles, ClientScripts},
        data(){
            return {
                blogger:{},
                errors: {},
                themes: {},
                countries: [
                    {
                        id: 1,
                        name: 'Российская Федерация'
                    },
                    {
                        id: 2,
                        name: 'Беларусь'
                    },
                ],
                platformFields: ref([
                    {
                        name: 'Telegram',
                        key: 'Telegram',
                        prefix: 'tg',
                        id: 1,
                        link: null
                    },
                    {
                        name: 'Ins',
                        key: 'Instagram',
                        prefix: 'inst',
                        id: 3,
                        link: null
                    },
                    {
                        name: 'Ytube',
                        key: 'Youtube',
                        prefix: 'yt',
                        id: 2,
                        link: null
                    },
                    {
                        name: 'Вконтакте',
                        key: 'VK',
                        prefix: 'vk',
                        id: 4,
                        link: null
                    },
                ]),
            }
        },
        methods: {
            chooseTheme(event){
                var list = $('.form-format .form-format__check:checked');

                if(list.length > 3){
                    $(e.target).prop('checked', false);
                    notify('info', {title: 'Внимание', message: 'Нельзя выбрать больше 3-х тематик'});
                }
            }
        }
    }
</script>
