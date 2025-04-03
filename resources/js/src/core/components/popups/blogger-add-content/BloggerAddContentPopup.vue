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

<style scoped>

.popup__body:has(.blogger-popup){
    width: 100%;
    max-width:1200px!important;
}
.blogger-popup{
    display: flex;
    justify-content: space-between;
    gap: 13px;
}
.blogger-popup__header{
    margin-bottom: 24px;
}
.blogger-popup__title{
    font-weight: 600;
    font-size: 17px;
    margin-bottom: 8px;
}
.blogger-popup__subtitle{
    font-weight: 500;
    font-size: 14px;
    padding-right: 17px;
}
.blogger-content{
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 12px;
    align-items: center;
}
.blogger-content__card{
    border: 1px solid var(--primary);
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: all .1s linear;
    position: relative;
    width: 48px;
    height: 48px;
    overflow: hidden;
}
.blogger-content__card:hover{
    background-color: var(--primary);
}
.blogger-content__card.in-progress:hover{
    background-color: var(--pale);
}
.blogger-content__card:hover .blogger-content__plus{
    filter: brightness(0) invert(1);
}

.blogger-content__plus{
    width: 20px;
    height: 20px;
    filter: invert(54%) sepia(90%) saturate(4926%) hue-rotate(259deg) brightness(92%) contrast(86%);
    display: none;
    position: absolute;
    transition: all .1s linear;
}
.blogger-content__progress-bar{
    background-color: rgba(62,66,77, .4);
    padding: 2px;
    width: calc(100% - 24px);
    height: 6px;
    display: none;
    border-radius: 3px;
}
.blogger-content__progress-progress{
    background-color: var(--primary);
    height: 3px;
    width: 0;
}
.blogger-content__video{
    display: none;
    -o-object-fit: cover;
    object-fit: cover;
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
}
.blogger-content__card.empty .blogger-content__plus{
    display: block;
}
.blogger-content__card.in-progress{
    padding: 17% 0;
    width: 120px;
}
.blogger-content__card.in-progress .blogger-content__progress-bar{
    display: block;
}
.blogger-content__card.loaded .blogger-content__video{
    display: block;
}
.blogger-content__card.loaded{
    padding: 17% 12px;
    width: 120px;
}
.blogger-content__video-remove{
    display: none;
    width: 24px;
    height: 24px;
    justify-content: center;
    align-items: center;
    position: absolute;
    right: 5px;
    top:-5px;
    opacity: 0;
    transition: all .1s linear;
    z-index: 2;
    background-color: #DA3947;
    border-radius: 3px;
}
.blogger-content__video-remove img{
    filter: brightness(0) invert(1);
    width: 12px;
    height: 12px;
}
.blogger-content__card.loaded:hover .blogger-content__video-remove{
    top:10px;
    opacity: 1;
}
.blogger-content__card.loaded .blogger-content__video-remove{
    display: flex;
}
.blogger-popup__left{
    display: flex;
    flex-direction: column;

}
.blogger-popup__body{
}
.blogger-popup__footer{
    margin-top: auto;
    align-self: end;
    z-index: 1;
}
.blogger-comparison{
    display: flex;
    position: relative;
    border-radius: 12px;
    width: 595px;
    gap: 10px;
}
.blogger-popup__left{
    position: relative;
}
.blogger-popup__left::before{
    content: "";
    width: 80px;
    height: 80px;
    background-image: url(/img/scroll-gif.gif);
    background-size: 100%;
    background-position: center;
    position: absolute;
    bottom: -70px;
    left: -12px;
    opacity: 0;
}
.blogger-comparison__item{
    position: relative;
    transition: all .1s linear;
    overflow: hidden;
    width: calc(50% - 5px);
    height: 100%;
}
.blogger-comparison__item img{
    border-radius: 12px;
}
.blogger-comparison__img{
    transition: all .2s linear;
    overflow: hidden;
    border-radius: 12px;
}
.blogger-comparison__img video{
    -o-object-fit: cover;
    object-fit: cover;
    width: 100%;
    height: 100%;
    border-radius: 12px;
}
.blogger-comparison__more{
    padding: 6px;
    font-size: 14px;
    background-color: #fff;
}
.blogger-comparison__more-title{
    font-size: 18px;
    cursor: pointer;
    color:var(--primary);
    margin-top: 12px;
    margin-bottom: 8px;
}
.blogger-comparison__more-text{
    height: 0;
    font-size: 16px;
    font-weight: 500;
    overflow: hidden;
    transition: opacity,height .2s linear;
    opacity: 0;
    position: absolute;
}
.blogger-comparison__item.with-more-text--js .blogger-comparison__more-text{
    height: 250px;
    opacity: 1;
    position: relative;
}
/*.blogger-comparison__item.with-more-text--js .blogger-comparison__img{*/
/*    height: 394px;*/
/*}*/
.blogger-comparison__item-active--js{
    height: -moz-fit-content;
    height: fit-content;
}
.blogger-comparison__title{
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    color:#fff;
    border-radius: 6px;
    position: absolute;
    top:12px;left:0;right:0;
    margin: auto;
    padding: 6px;
    width: -moz-fit-content;
    width: fit-content;
}
.blogger-comparison__item--bad .blogger-comparison__title{
    background-color: #DA3947;
}
.blogger-comparison__item--good .blogger-comparison__title{
    background-color: #50C878;
}

.blogger-popup__warning{
    font-size: 12px;
    color:rgba(0,0,0, .6);
    margin-top: 14px;
}

.blogger-popup__body .card__img{
    width: 100%;
    height: 80px;
    max-width: 80px
}
.blogger-popup__body .card__name{
    padding: 6px 0;
}
</style>
