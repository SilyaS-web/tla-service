<template>
    <div class="popup__blogger-content blogger-popup">
        <div class="blogger-popup__left">
            <div class="blogger-popup__header">
                <div class="blogger-popup__title">
                    {{ title }}
                </div>
                <div class="blogger-popup__subtitle">
                    {{ subtitle }}
                </div>
            </div>
            <div class="blogger-popup__comparison blogger-comparison blogger-comparison--tablet">
                <div
                    :class="'blogger-comparison__item blogger-comparison__item--bad ' +
                        (currentExample === 'blogger-comparison__item--bad' ? 'blogger-comparison__item-active--js' : '') +
                            (moreTextVisibilitiesArr['bad'] ? ' with-more-text--js' : '')">
                    <div class="blogger-comparison__img">
                        <img src="/img/project-view/6.webp" alt="">
                    </div>
                    <div class="blogger-comparison__title">
                        Плохое оформление
                    </div>
                    <div class="blogger-comparison__more">
                        <div
                            @click="toggleMoreText('bad')"
                            class="blogger-comparison__more-title">
                            {{ moreTextTitlesArr['bad'] }}
                        </div>
                        <div class="blogger-comparison__more-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, aut autem beatae consequatur cumque dolorum esse et ex excepturi exercitationem explicabo laudantium perferendis quo quod recusandae rerum suscipit veniam voluptates.
                        </div>
                    </div>
                </div>
                <div
                    :class="'blogger-comparison__item blogger-comparison__item--good' +
                        (currentExample === 'blogger-comparison__item--good' ? ' blogger-comparison__item-active--js' : '') +
                            (moreTextVisibilitiesArr['good'] ? ' with-more-text--js' : '')">
                    <div class="blogger-comparison__img">
                        <img src="/img/project-view/6.webp" alt="">
                    </div>
                    <div class="blogger-comparison__title">
                        Хорошее оформление
                    </div>
                    <div class="blogger-comparison__more">
                        <div
                            @click="toggleMoreText('good', $event)"
                            class="blogger-comparison__more-title">
                            {{ moreTextTitlesArr['good'] }}
                        </div>
                        <div class="blogger-comparison__more-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, aut autem beatae consequatur cumque dolorum esse et ex excepturi exercitationem explicabo laudantium perferendis quo quod recusandae rerum suscipit veniam voluptates.
                        </div>
                    </div>
                </div>
                <div
                    @click="switchExample"
                    class="blogger-comparison__switch">
                </div>
            </div>
            <div class="blogger-popup__body">
                <div class="card__col">
                    <div class="card__row card__header">
                        <div class="card__img" style="background-image: url(&quot;http://localhost/storage/profile/iijulv25MZQIMIIBxH7AgIUIquvlzKHfe2W9jkKT.jpg&quot;);"></div>
                        <div class="card__name">
                            <p class="card__name-name" title="">Екатерина</p>
                        </div>
                    </div>
                    <div class="card__row card__tags">
                        <div class="card__tags-item">
                            <span>Дети, семья и отношения</span>
                        </div>
                        <div class="card__tags-item">
                            <span>Дом, сад и огород</span>
                        </div>
                        <div class="card__tags-item">
                            <span>Дизайн интерьера, ремонт</span>
                        </div>
                    </div>
                    <div class="card__row card__desc">
                        <p>Лайстайл блог о семье, детях. Ремонт и обустройство дома и быта.</p>
                    </div>
                </div>
                <div class="blogger-popup__upload-content blogger-content">
                    <div
                        :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[0]))"
                        @click="uploadCardContent(cardsVideoContent[0], $event)">
                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                        <div class="blogger-content__progress-bar">
                            <div class="blogger-content__progress-progress">
                            </div>
                        </div>
                        <video src="" class="blogger-content__video" loop autoplay muted>
                            <source src="{{ cardsVideoContent[0].src }}" type="video/mp4" />
                        </video>
                        <input type="file" hidden @change="saveCardContent(0, $event)">
                    </div>
                    <div
                        :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[0]))">
                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                    </div>
                    <div :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[0]))">
                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                    </div>
                </div>
            </div>
            <div class="blogger-popup__footer">
                <div class="btn btn-primary blogger-content__btn">
                    Отправить
                </div>
            </div>
        </div>
        <div class="blogger-popup__right">
            <div class="blogger-popup__comparison blogger-comparison">
                <div
                    :class="'blogger-comparison__item blogger-comparison__item--bad ' +
                        (currentExample === 'blogger-comparison__item--bad' ? 'blogger-comparison__item-active--js' : '') +
                            (moreTextVisibilitiesArr['bad'] ? ' with-more-text--js' : '')">
                    <div class="blogger-comparison__img">
                        <img src="/img/project-view/6.webp" alt="">
                    </div>
                    <div class="blogger-comparison__title">
                        Плохое оформление
                    </div>
                    <div class="blogger-comparison__more">
                        <div
                            @click="toggleMoreText('bad')"
                            class="blogger-comparison__more-title">
                            {{ moreTextTitlesArr['bad'] }}
                        </div>
                        <div class="blogger-comparison__more-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, aut autem beatae consequatur cumque dolorum esse et ex excepturi exercitationem explicabo laudantium perferendis quo quod recusandae rerum suscipit veniam voluptates.
                        </div>
                    </div>
                </div>
                <div
                    :class="'blogger-comparison__item blogger-comparison__item--good' +
                        (currentExample === 'blogger-comparison__item--good' ? ' blogger-comparison__item-active--js' : '') +
                            (moreTextVisibilitiesArr['good'] ? ' with-more-text--js' : '')">
                    <div class="blogger-comparison__img">
                        <img src="/img/project-view/6.webp" alt="">
                    </div>
                    <div class="blogger-comparison__title">
                        Хорошее оформление
                    </div>
                    <div class="blogger-comparison__more">
                        <div
                            @click="toggleMoreText('good', $event)"
                            class="blogger-comparison__more-title">
                            {{ moreTextTitlesArr['good'] }}
                        </div>
                        <div class="blogger-comparison__more-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, aut autem beatae consequatur cumque dolorum esse et ex excepturi exercitationem explicabo laudantium perferendis quo quod recusandae rerum suscipit veniam voluptates.
                        </div>
                    </div>
                </div>
                <div
                    @click="switchExample"
                    class="blogger-comparison__switch">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue'
import axios from "axios";
import User from "../../../services/api/User";

export default {
    name: 'AddBloggerContentPopup',
    components: {User},
    data(){
        return {
            title: 'Загрузите примеры контента',
            subtitle: 'Наше дело не так однозначно, как может показаться: экономическая повестка сегодняшнего дня однозначно определяет',

            currentExample: ref('blogger-comparison__item--bad'),

            moreTextVisibilitiesArr: ref({
                'good': false,
                'bad': true
            }),

            moreTextTitlesArr: ref({
                'good': 'Посмотреть подробнее',
                'bad': 'Скрыть'
            }),

            cardsVideoContent: ref({
                0: {
                    'src': null,
                    'progress': null
                },
                1: {
                    'src': null,
                    'progress': null
                },
                2: {
                    'src': null,
                    'progress': null
                },
            }),

            resolvePromise: undefined,
            rejectPromise: undefined,
        }
    },
    methods: {
        switchExample(){
            if(this.currentExample === 'blogger-comparison__item--bad') this.currentExample = 'blogger-comparison__item--good';
            else this.currentExample = 'blogger-comparison__item--bad'
        },

        toggleMoreText(key){
            this.moreTextVisibilitiesArr[key] = !this.moreTextVisibilitiesArr[key]
            this.moreTextTitlesArr[key] = (this.moreTextTitlesArr[key] === 'Скрыть' ? 'Посмотреть подробнее' : 'Скрыть')
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
                formdata.append('vides[0]', file.files[0]);

            axios({
                method: 'post',
                url: '/api/bloggers/' + user.blogger_id + '/content',
                data: formdata
            })
            .then((data) => {

            })
            .catch((err) =>{
                let message = err.response.data.message ? err.response.data.message : 'Не удалось изменить статус проекта, попробуйте позже.';

                notify('error', {
                    title: 'Внимание!',
                    message: message
                })
            })
        },

        _confirm() {
            this.resolvePromise(this.choosedWork)
        },

        _cancel() {
            this.resolvePromise(false)
        },
    },
}
</script>
