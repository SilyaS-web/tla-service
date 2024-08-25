<template>
    <popup-modal ref="popup">
        <div class="popup__title title">
            Заполните данные
        </div>
        <div class="popup__form" v-if="blogger">
            <div class="form-group">
                <label for="desc">Описание канала</label>
                <textarea name="desc" v-model="blogger.description" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст"></textarea>
            </div>
            <div class="form-row filter__item" style="display: flex; gap:10px;">
                <div class="form-group">
                    <label for="gender_ratio">Мужчины, %</label>
                    <input
                        id="gender_ratio"
                        v-model="blogger.gender_ratio"
                        v-on:input="maxValueHandler"
                        name="gender_ratio"
                        type="number"
                        class="input"
                        max="100"
                        value = "50">
                </div>
                <div class="form-group">
                    <label for="gender_ratio_f">Женщины, %</label>
                    <input
                        id="gender_ratio_f"
                        name="gender_ratio_f"
                        type="number"
                        class="input"
                        v-bind:value="(100 - parseInt(blogger.gender_ratio))"
                        v-on:input="calculateGender">
                </div>
            </div>
            <div class="form-row filter__item">
                <div class="form-group">
                    <label for="sex">Пол блогера</label>
                    <select name="sex" id="sex" class="input" v-model="blogger.sex">
                        <option value="male" class="">Мужской</option>
                        <option value="female" class="">Женский</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="country">Страна блогера</label>
                    <select name="country" id="country" class="input" v-model="blogger.country.id">
                        <option
                            v-for="country in countries"
                            v-bind:id="country.id"
                            v-bind:value="country.id">
                            {{ country.name }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city">Город блогера</label>
                    <input id="city" name="city" type="text" class="input" v-model="blogger.city">
                </div>

                <label for="">Статистика по блогеру</label>
                <platforms
                    v-for="platform in platformFields"
                    :platform="platform"
                    :platformAdditFields="platformAdditFields">
                </platforms>

                <div class="form-group">
                    <div class="input-checkbox-w">
                        <input name="is_achievement" type="checkbox" class="checkbox whois" id="is_achievement" v-model="blogger.is_achievement">
                        <label for="is_achievement">Проверенный блогер</label>
                    </div>
                </div>
            </div>
            <div class="popup__form-btns">
                <button @click="_confirm" class="btn btn-primary">
                    Принять
                </button>
                <button @click="_cancel" class="btn btn-secondary">
                    Отмена
                </button>
            </div>
        </div>

    </popup-modal>
</template>
<script>
    import { forIn } from 'lodash';
import PopupModal from '../../services/AppPopup.vue';
    import Platforms from './BloggerPlatformFields.vue';
    import axios from 'axios';
    import {ref, toRaw} from 'vue';

    export default {
        name: 'AcceptBloggerPopup',
        components: { PopupModal, Platforms },
        data: () => ({
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
                    id: 1
                },
                {
                    name: 'Ins',
                    key: 'Instagram',
                    prefix: 'inst',
                    id: 3
                },
                {
                    name: 'Ytube',
                    key: 'Youtube',
                    prefix: 'yt',
                    id: 2
                },
                {
                    name: 'Вконтакте',
                    key: 'VK',
                    prefix: 'vk',
                    id: 4
                },
            ]),
            blogger: ref(null),
            platformAdditFields: ref([]),
            resolvePromise: undefined,
            rejectPromise: undefined,
        }),
        methods: {
            async show(opts = {}) {
                this.$refs.popup.open()
                let requestData = await this.getBlogger(opts.id);

                this.blogger = requestData.blogger;
                this.platformAdditFields = requestData.platform_fields;
                this.platformFields.forEach(_f => _f.blogger_platform = this.extractBloggersPlatformById(_f.id));

                return new Promise((resolve, reject) => {
                    this.resolvePromise = resolve
                    this.rejectPromise = reject
                })
            },

            getBlogger(id){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'get',
                        url: '/api/bloggers/' + id,
                    })
                    .then(result => resolve(result.data))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },

            extractBloggersPlatformById(id){
                return (this.blogger.platforms || []).find(_p => _p.platform_id == id) || []
            },

            calculateGender(event){
                var value = $(event.target).val();

                if (value > 100) value = 100;

                this.blogger.gender_ratio = 100 - parseInt(value);
            },

            maxValueHandler(event){
                var value = $(event.target).val();

                if (value > 100) {
                    $(event.target).val(100)
                    this.blogger.gender_ratio = 100;
                };
            },

            accept(blogger){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'post',
                        url: '/api/bloggers/' + blogger.id + '/accept',
                        data: toRaw(blogger)
                    })
                    .then(result => resolve(result.data))
                    .catch(error => {
                        console.log(error)
                        resolve([])
                    })
                })
            },

            _confirm() {
                this.blogger.platforms = this.platformFields.map(_p => {
                    if(!_p.blogger_platform.platform_id) {
                        _p.blogger_platform.platform_id = _p.id
                    };

                    var newBloggerPlatforms = {};

                    for(let key in _p.blogger_platform){
                        newBloggerPlatforms[key] = _p.blogger_platform[key]
                    }

                    return toRaw(newBloggerPlatforms)
                })

                this.accept(this.blogger).then(()=>{
                    this.$refs.popup.close()
                    this.resolvePromise(true)
                })
            },

            _cancel() {
                this.$refs.popup.close()
                this.resolvePromise(false)
            },
        },
    }
</script>
