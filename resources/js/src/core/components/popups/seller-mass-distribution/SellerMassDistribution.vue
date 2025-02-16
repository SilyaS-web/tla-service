<template>
    <app-popup ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                {{ title }}
            </div>
            <div class="popup__subtitle">
            </div>
        </div>
        <div class="popup__content popup-distribution">
            <div class="popup-distribution__left">
                <div class="popup-distribution__bloggers-list distribution-bloggers">
                    <div class="popup-distribution__title">
                        Список блогеров
                    </div>
                    <div class="distribution-bloggers__content _scrollable">
                        <div class="distribution-bloggers__items">
                            <div
                                v-for="blogger in bloggers"
                                class="distribution-bloggers__item">
                                <div
                                    @click="openBloggerCard($event)"
                                    class="distribution-bloggers__item-header">
                                    <div class="distribution-bloggers__image">
                                        <img
                                            :src="(!blogger.user.image ? '/img/placeholder.webp' : blogger.user.image)"
                                            alt="">
                                    </div>
                                    <div class="distribution-bloggers__info">
                                        <div class="distribution-bloggers__name">
                                            {{ blogger.user.name }}
                                        </div>
                                        <div class="distribution-bloggers__status">
                                            Блогер
                                        </div>
                                    </div>
                                </div>
                                <div class="distribution-bloggers__item-body">
                                    <div class="distribution-bloggers__platforms">
                                        <div class="card__col card__stats">
                                            <div class="card__col card__stats-stats">
                                                <div class="card__row card__stats-row">

                                                    <div class="card__col card__stats-item">
                                                        <div class="card__stats-title">
                                                            <span>Подписчики</span>
                                                        </div>
                                                        <div class="card__stats-val" v-bind:title="blogger.summaryPlatform.subscriber_quantity">
                                                            <span>{{ blogger.summaryPlatform.subscriber_quantity }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="card__col card__stats-item">
                                                        <div class="card__stats-title">
                                                            <span>Охваты</span>
                                                        </div>
                                                        <div class="card__stats-val" v-bind:title="blogger.summaryPlatform.coverage">
                                                            <span>{{ blogger.summaryPlatform.coverage }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card__row card__stats-row">

                                                    <div class="card__col card__stats-item">
                                                        <div class="card__stats-title">
                                                            <span>ER %</span>
                                                        </div>
                                                        <div class="card__stats-val">
                                                            <span>{{ countER(blogger.summaryPlatform.subscriber_quantity, blogger.summaryPlatform.coverage) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="card__col card__stats-item">
                                                        <div class="card__stats-title">
                                                            <span>CPM</span>
                                                        </div>
                                                        <div class="card__stats-val">
                                                            <span>{{ countCPM(blogger.summaryPlatform.coverage) || '-' }}₽</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="distribution-bloggers__item-footer">
                                    <div
                                        @click="popBloggerFromList(blogger)"
                                        class="btn btn-secondary">Убрать из списка</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-distribution__right">
                <div class="info-distribution">
                    <div class="popup-distribution__title">
                        Подготовьте ТЗ
                    </div>
                    <div class="info-distribution__body">
                        <Textarea
                            :id="'info-distribution-text'"
                            :cols="30"
                            :rows="10"
                            :class-list="[]"
                            :placeholder="'Введите текст'"
                            :label="'Опишите подробности ТЗ'"
                            :error="errors && errors.text"

                            v-model="distributionInfo.text"
                        >
                        </Textarea>
                        <FilesUpload
                            v-model="distributionInfo.files"
                            :label="'Загрузите файлы ТЗ'"
                            :error="errors && errors.files"
                        ></FilesUpload>
                    </div>
                    <div class="info-distribution__footer">
                        <div class="btn btn-primary">
                            {{ okButton }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-popup>
</template>

<script>
import {countER} from "../../../utils/countER";
import {countCPM} from "../../../utils/countCPM";

import {ref} from "vue";

import AppPopup from "../AppPopup.vue";

import Textarea from "../../form/TextareaBlockComponent.vue";
import FilesUpload from "../../form/PlusFilesUploadBlockComponent.vue";

export default {
    name: "SellerMassDistribution",
    components: {AppPopup,Textarea,FilesUpload},
    data() {
        return {
            title: 'Массовая рассылка',
            okButton: 'Подтвердить',
            cancelButton: 'Отмена',

            bloggers: ref([]),

            distributionInfo:ref({
                text:"",
                files:[],
                bloggersIDs: [],
            }),

            errors: ref(null),

            resolvePromise: undefined,
            rejectPromise: undefined,
        }
    },
    methods: {
        show(opts = {}) {
            this.title = opts.title
            this.okButton = opts.okButton

            if (opts.cancelButton) {
                this.cancelButton = opts.cancelButton
            }

            this.bloggers = localStorage.getItem('massDistributionList') ?
                JSON.parse(localStorage.getItem('massDistributionList'))
                : [];

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(true)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },

        popBloggerFromList(blogger){
            this.bloggers = this.bloggers.filter(_blogger => _blogger.id !== blogger.id)
        },

        openBloggerCard(event){
            $(event.target).closest('.distribution-bloggers__item').toggleClass('opened')
        },

        countER, countCPM
    }
}
</script>


<style scoped>
    .btn:not(.btn-primary){
        padding: 10px 24px;
    }
    .popup__title{
        text-align: center;
    }
    .popup-distribution{
        display: flex;
        gap: 20px;
    }
    .popup-distribution>*{
        width:calc(50% - 6px)
    }
    .popup-distribution__title{
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 18px;
    }
    .distribution-bloggers__content{
        height: 366px;
        overflow-y: scroll;
    }
    .distribution-bloggers__items{
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .distribution-bloggers__item{
        width: 100%;
        border-radius: 12px;
        border: 1px solid #F5F5F5;
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 12px 12px 12px 12px;
        height: 94px;
        overflow: hidden;
        transition: all .1s linear;
    }
    .distribution-bloggers__item.opened{
        height:320px;
        overflow: unset;
    }
    .distribution-bloggers__item-header{
        display: flex;
        gap: 8px;
        margin-bottom: 8px;
        cursor: pointer;
    }
    .distribution-bloggers__item-header::after{
        width: 24px;
        height: 24px;
        background-image: url("/img/arrow-alt.svg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100%;
        content:"";
        margin-left:auto;
        transition: all .1s linear;
    }
    .distribution-bloggers__item.opened .distribution-bloggers__item-header::after{
        transform: rotate(180deg);
    }
    .distribution-bloggers__item-body{
        margin-bottom:18px;
    }
    .distribution-bloggers__image{
        width: 70px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    .distribution-bloggers__image img{
        object-fit: cover;
        position: absolute;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }
    .distribution-bloggers__info{
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .distribution-bloggers__name{
        font-size: 16px;
        font-weight: 500;
    }
    .distribution-bloggers__status{
        font-size: 14px;
        color:rgba(0,0,0,.4)
    }
    .card__stats-row{
        width: 100%;
    }
    .info-distribution{
        display: flex;
        flex-direction: column;
        gap: 6px;
    }


</style>
