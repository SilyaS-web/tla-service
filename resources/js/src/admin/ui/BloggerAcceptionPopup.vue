<template>
    <popup-modal ref="popup">
        <div class="popup__title title">
            Заполните данные
        </div>
        <div class="popup__form" v-if="blogger">
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
                    <span class="error" v-if="errors.gender_ratio">{{ errors.gender_ratio }}</span>
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
                <label for="">Статистика по блогеру</label>
                <platforms
                    v-for="platform in platformFields"
                    :platform="platform"
                    :platformAdditFields="platformAdditFields">
                </platforms>
                <span class="error" v-if="errors.platforms">{{ errors.platforms }}</span>
                <div class="form-group">
                    <div class="input-checkbox-w">
                        <input name="is_achievement" type="checkbox" class="checkbox" id="is_achievement" v-model="blogger.is_achievement">
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
    import PopupModal from '../../services/AppPopup.vue';
    import Platforms from './BloggerPlatformFields.vue';
    import axios from 'axios';
    import {ref, toRaw} from 'vue';

    export default {
        name: 'AcceptBloggerPopup',
        components: { PopupModal, Platforms },
        data: () => ({
            errors: ref({}),
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
                    name: 'Одноклассники',
                    key: 'OK',
                    prefix: 'ok',
                    id: 7
                },
                {
                    name: 'Дзен',
                    key: 'Dzen',
                    prefix: 'dzen',
                    id: 6
                },
                {
                    name: 'Rutube',
                    key: 'Rutube',
                    prefix: 'rutube',
                    id: 8
                },
                {
                    name: 'Yappy',
                    key: 'Yappy',
                    prefix: 'yappy',
                    id: 5
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

                if(this.blogger && !this.blogger.gender_ratio)
                    this.blogger.gender_ratio = 50;

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

            accept(){
                return new Promise((resolve, reject) => {
                    axios({
                        method: 'post',
                        url: '/api/bloggers/' + this.blogger.id + '/accept',
                        data: toRaw(this.blogger)
                    })
                    .then(result => resolve(result.data))
                    .catch(err => {
                        this.errors = err.response.data;
                        notify('info', {title: 'Внимание', message: 'Не удалось принять блогера'});
                        reject()
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
                this.accept().then(()=>{
                    this.errors = {}
                    this.$refs.popup.close()
                    this.resolvePromise(true)
                })
            },

            _cancel() {
                this.errors = {}
                this.$refs.popup.close()
                this.resolvePromise(false)
            },
        },
    }
</script>
