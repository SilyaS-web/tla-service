<template>
    <div class="popup" style="" v-if="isVisible">
        <div class="popup__container _container">
            <div class="popup__body" style="max-width:600px">
                <div class="popup__blogger-content blogger-popup">
                    <div class="blogger-popup__left">
                        <div class="blogger-popup__body">
                            <div class="card__col" style="width: 100%">
                                <div class="card__row card__header">
                                    <div
                                        class="card__img"
                                        :style="'background-image: url(' + (blogger.user.image || '/img/placeholder.webp') + ')'"></div>
                                    <div class="card__name">
                                        <p class="card__name-name" title="">{{ user.name }}</p>
                                        <p class="card__name-tag" title="">Блогер</p>
                                        <p class="card__name-desc" title="">{{ (blogger.description || '').slice(0, 80) + '...' }}</p>
                                    </div>
                                </div>
                                <div
                                    v-if="blogger && blogger.themes"
                                    class="card__row card__tags">
                                    <div
                                        v-for="theme in blogger.themes"
                                        class="card__tags-item">
                                        <span>{{ theme.name }}</span>
                                    </div>
                                </div>
                                <div class="card__row card__tags card__tags--achives">
                                    <div class="card__tags-item" >
                                        <div class="card__tags-icon" style="background-image: url('/img/has-content-icon.svg');">
                                        </div>
                                        <span>Есть контент</span>
                                    </div>
<!--                                    <div class="card__tags-item">-->
<!--                                        <div class="card__tags-icon" style="background-image: url('/img/documents-ok-icon.svg');">-->
<!--                                        </div>-->
<!--                                        <span>Документы проверены</span>-->
<!--                                    </div>-->
<!--                                    <div class="card__tags-item">-->
<!--                                        <div class="card__tags-icon" style="background-image: url('/img/star-icon-alt.svg');">-->
<!--                                        </div>-->
<!--                                        <span>Платформа рекомендует</span>-->
<!--                                    </div>-->
                                </div>
                            </div>
                            <div class="blogger-popup__upload-content blogger-content">
                                <div
                                    :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[0]))"
                                    @click="uploadCardContent(cardsVideoContent[0], $event)">
                                    <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                    <div class="blogger-content__progress-bar">
                                        <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[0].progress + '%' }">
                                        </div>
                                    </div>
                                    <video src="" class="blogger-content__video" loop autoplay muted>
                                        <source src="" type="video/mp4" />
                                    </video>
                                    <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[0], 0, $event)">
                                        <img src="/img/close-icon.svg" alt="">
                                    </div>
                                    <input type="file" hidden @change="saveCardContent(0, $event)">
                                </div>
                                <div
                                    :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[1]))"
                                    @click="uploadCardContent(cardsVideoContent[1], $event)">
                                    <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                    <div class="blogger-content__progress-bar">
                                        <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[1].progress + '%' }">
                                        </div>
                                    </div>
                                    <video src="" class="blogger-content__video" loop autoplay muted>
                                        <source src="" type="video/mp4" />
                                    </video>
                                    <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[1], 1, $event)">
                                        <img src="/img/close-icon.svg" alt="">
                                    </div>
                                    <input type="file" hidden @change="saveCardContent(1, $event)">
                                </div>
                                <div
                                    :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[2]))"
                                    @click="uploadCardContent(cardsVideoContent[2], $event)">
                                    <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                    <div class="blogger-content__progress-bar">
                                        <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[2].progress + '%' }">
                                        </div>
                                    </div>
                                    <video src="" class="blogger-content__video" loop autoplay muted>
                                        <source src="" type="video/mp4" />
                                    </video>
                                    <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[2], 2, $event)">
                                        <img src="/img/close-icon.svg" alt="">
                                    </div>
                                    <input type="file" hidden @change="saveCardContent(2, $event)">
                                </div>
                            </div>
                            <div
                                v-if="!cardsVideoContent.find(content => content.id !== null)"
                                class="blogger-popup__header" >
                                <div class="blogger-popup__title">
                                    {{ title }}
                                </div>
                                <div class="blogger-popup__subtitle">
                                    {{ subtitle }}
                                </div>
                            </div>
                        </div>
                        <div class="blogger-popup__footer">
                            <div
                                @click="closePopup"
                                class="btn btn-primary blogger-content__btn">
                                Отправить
                            </div>
                            <div class="blogger-popup__warning">
                                Видеофайлы должны быть не более 90 МБ и представлены в одном из следующих форматов: mpeg, ogg, mp4, webm, 3gp, mov, flv, avi, wmv, ts.
                            </div>
                        </div>
                    </div>
                    <div class="blogger-popup__right">
                        <div class="blogger-popup__comparison blogger-comparison">
                            <div
                                :class="'blogger-comparison__item blogger-comparison__item--bad ' +
                                        (moreTextVisibilitiesArr['bad'] ? ' with-more-text--js' : '')">
                                <div class="blogger-comparison__img">
                                    <video src="/img/showreel1.mp4" loop autoplay muted>
                                    </video>
                                </div>
                                <div class="blogger-comparison__title">
                                    Не рекомендуем
                                </div>
                                <div class="blogger-comparison__more">
                                    <div
                                        @click="toggleMoreText('bad', $event)"
                                        class="blogger-comparison__more-title">
                                        {{ moreTextTitlesArr['bad'] }}
                                    </div>
                                    <div class="blogger-comparison__more-text">
                                        1. Загружены случайные видео, не отражающие ваш стиль контента.<br>
                                        2. Размытая картинка, плохое освещение, звук с шумами.<br>
                                        3. Блогер отсутствует в кадре, голос неразборчивый или отсутствует.<br>
                                        4. Товар почти не показан или взаимодействие с ним поверхностное.<br>
                                    </div>
                                </div>
                            </div>
                            <div
                                :class="'blogger-comparison__item blogger-comparison__item--good ' +
                                    (moreTextVisibilitiesArr['good'] ? ' with-more-text--js' : '')">
                                <div class="blogger-comparison__img">
                                    <video src="/img/showreel2.mp4" loop autoplay muted>
                                    </video>
                                </div>
                                <div class="blogger-comparison__title">
                                    Рекомендуем
                                </div>
                                <div class="blogger-comparison__more">
                                    <div
                                        @click="toggleMoreText('good', $event)"
                                        class="blogger-comparison__more-title">
                                        {{ moreTextTitlesArr['good'] }}
                                    </div>
                                    <div class="blogger-comparison__more-text">
                                        1. Выберите свои лучшие работы<br>
                                        2. Видео четкое, звук чистый<br>
                                        3. Вы в кадре, или слышно ваш закадровый голос<br>
                                        4. Презентуете или взаимодействуете с товаром<br>
                                        5. Каждое из трех загруженных видео разной подачи (юмор, обзор, рекомендация, нативный формат, или опыт использования до/после)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="close-popup" @click="closePopup">
                    <img src='/img/close-icon.svg' alt="">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue'
import axios from "axios";
import User from "../../../services/api/User";
import PopupModal from '../AppPopup.vue';

export default {
    name: 'AddBloggerContentPopup',
    components: { PopupModal },
    data(){
        return {
            title: 'Загрузите примеры контента',
            subtitle: 'Загрузите пример своего контента, чтобы вас заметили топовые бренды и селлеры, получите специальное достижение, место в рекомендованных и больше предложений на сотрудничество!',

            moreTextVisibilitiesArr: ref({
                'good': false,
                'bad': false
            }),

            moreTextTitlesArr: ref({
                'good': 'Посмотреть подробнее',
                'bad': 'Посмотреть подробнее'
            }),

            cardsVideoContent: ref([
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
            ]),

            isVisible: ref(false),

            resolvePromise: undefined,
            rejectPromise: undefined,

            user: ref({}),
            blogger: ref({}),

            User
        }
    },
    async mounted(){
        this.user = this.User.getCurrent();

        await axios({
            method: 'get',
            url: '/api/bloggers/' + this.user.blogger_id,
        })
        .then(result => this.blogger = result.data.blogger)
        .catch(error => {})
    },
    methods: {
        show(opts = {}){
            this.isVisible = true

            axios({
                method: 'get',
                url: '/api/bloggers/' + this.user.blogger_id + '/content',
            })
            .then((result) => {
                let contentList = result.data,
                    videosNodeList = $(document).find('.blogger-content__card video');

                this.cardsVideoContent = this.cardsVideoContent.map((item, index) => {
                    videosNodeList[index].src = '/' + contentList[index].path;
                    videosNodeList[index].load();

                    return {
                        'id': contentList[index].id,
                        'src': contentList[index].path,
                        'progress': 100
                    }
                })
            })
            .catch((err) => {
                let message = (err.response && err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно загрузить контент, попробуйте позже в личном кабинете';

                notify('error', {
                    title: 'Внимание!',
                    message: message
                })
            })

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        toggleMoreText(key, event){
            this.moreTextVisibilitiesArr[key] = !this.moreTextVisibilitiesArr[key]
            this.moreTextTitlesArr[key] = (this.moreTextTitlesArr[key] === 'Скрыть' ? 'Посмотреть подробнее' : 'Скрыть')

            let wrap = $(event.target).closest('.blogger-comparison__item'),
                text = wrap.find('.blogger-comparison__more-text'),
                img = wrap.find('.blogger-comparison__img');

            if(this.moreTextVisibilitiesArr[key]){
                img.css('height', `${img.height() / 2}px`)
            }
            else{
                img.css('height', `${img.height() * 2}px`)
            }

        },

        getCardClass(videoContent){
            if(videoContent.src !== null) return 'loaded';

            if(videoContent.progress !== null) return 'in-progress';

            return 'empty'
        },

        uploadCardContent(cardContent, event){
            if(cardContent.src !== null) return;

            $(event.target).closest('.blogger-content__card').find('input[type="file"]').click()
        },

        saveCardContent(cardContentIndex, event){
            let file = $(event.target)[0],
                formdata = new FormData,
                user = this.User.getCurrent();

            if(file && file.files[0])
                formdata.append('videos[0]', file.files[0]);

            axios({
                method: 'post',
                url: '/api/bloggers/' + user.blogger_id + '/content',
                data: formdata,
                onUploadProgress: (progressEvent) => {
                    const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');

                    if (totalLength !== null) {
                        this.cardsVideoContent[cardContentIndex].progress = Math.round((progressEvent.loaded * 100) / totalLength)
                    }
                }
            })
            .then((result) => {
                this.cardsVideoContent[cardContentIndex].src = result.data[0].path
                this.cardsVideoContent[cardContentIndex].id = result.data[0].id
                this.cardsVideoContent[cardContentIndex].progress = 100

                $(event.target).closest('.blogger-content__card').find('video')[0].src = '/' + result.data[0].path;
                $(event.target).closest('.blogger-content__card').find('video')[0].load();
            })
            .catch((err) =>{
                let message = (err.response && err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно загрузить контент, попробуйте позже в личном кабинете';

                notify('error', {
                    title: 'Внимание!',
                    message: message
                })
            })
        },

        removeCardContent(cardContent, cardContentIndex, event){
            let videoId = this.cardsVideoContent[cardContentIndex].id,
                user = this.User.getCurrent();

            if(!videoId) return

            axios({
                method: 'delete',
                url: '/api/bloggers/' + user.blogger_id + '/content',
                data: {
                    videos: [videoId]
                }
            })
            .then((result) => {
                this.cardsVideoContent[cardContentIndex] = {
                    'id': null,
                    'src': null,
                    'progress': null
                };

                $(event.target).closest('.blogger-content__card').find('input[type="file"]').val('');
            })
            .catch((err) =>{
                let message = (err.response && err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно почистить контент, попробуйте позже в личном кабинете';

                notify('error', {
                    title: 'Внимание!',
                    message: message
                })
            })
        },

        closePopup(){
            this.isVisible = false

            axios({
                url: '/api/users/' + this.user.id + '/modals/' + 1 + '/show',
                method: 'get',
            })

            this.resolvePromise(false)
        },

        _confirm() {
            this.isVisible = false
            this.resolvePromise(true)
        },

        _cancel() {
            this.isVisible = false
            this.resolvePromise(false)
        },
    },
}
</script>
