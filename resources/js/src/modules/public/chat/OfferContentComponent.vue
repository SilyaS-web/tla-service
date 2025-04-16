<script>
import {ref} from "vue";
import FileIcon from "../../../core/icons/FileIcon.vue";

export default {
    components: {FileIcon},
    props:[
        'productImage', 'productName', 'offer', 'user'
    ],
    data(){
        return{
            isHidden: ref(false)
        }
    },
    name: "OfferContentComponent",
    methods:{
        getOfferFileName(name){
            if(!name) return 'Неизвестно'

            const splitedFile = name.split('/');

            return splitedFile[splitedFile.length - 1];
        }
    }
}
</script>

<template>
    <div :class="['chat__offer', 'offer-chat', (isHidden ? 'offer-chat--hidden' : '')]">
        <div class="offer-chat__content">
            <div class="offer-chat__header"></div>
            <div class="offer-chat__body">
                <div class="offer-chat__body-img">
                    <img :src="(productImage ? productImage : '/img/placeholder.webp')" alt="">
                </div>
                <div class="offer-chat__body-content">
                    <div class="offer-chat__main">
                        <div class="offer-chat__label">
                            {{ productName }}
                        </div>
                        <div class="offer-chat__description">
                            {{ offer.specification }}
                        </div>
                    </div>
                    <div class="offer-chat__files">
                        <a
                            v-for="file in offer.files"
                            :href="file.name"
                            download
                            class="offer-chat__files-item offer-file">
                            <div class="offer-file__icon">
                                <file-icon></file-icon>
                            </div>
                            <span class="offer-file__name">{{ getOfferFileName(file.name) }}</span>
                        </a>
                    </div>
                    <div class="offer-chat__more-info">
                        <div class="offer-chat__price">
                            <label>Цена</label>
                            <span><b>{{ offer.price || "-" }} ₽</b></span>
                        </div>
                        <div class="offer-chat__period">
                            <label>Срок выполнения</label>
                            <span><b>{{ offer.complete_till }}</b></span>
                        </div>
                    </div>
                    <div class="offer-chat__btns">
                        <div
                            v-if="user.role === 'blogger' && offer.status === 0"
                            class="offer-chat__btns-item">
                            <button class="btn btn-primary">Принять</button>
                            <button class="btn btn-white btn-secondary">Отклонить</button>
                        </div>
                        <div
                            v-if="user.role === 'seller' && offer.status === 0"
                            class="offer-chat__btns-item">
                            <button class="btn btn-white" disabled>Заказ на рассмотрении</button>
                            <a href="#" class="offer-chat__btns-link">Отменить заказ</a>
                        </div>
                        <div
                            v-if="user.role === 'blogger' && offer.status === 1"
                            class="offer-chat__btns-item">
                            <button class="btn btn-white">Подтвердить выполнение</button>
                        </div>
                        <div
                            v-if="user.role === 'seller' && offer.status === 1"
                            class="offer-chat__btns-item">
                            <button class="btn btn-white btn-primary">Заказ принят</button>
                            <a href="#" class="offer-chat__btns-link">Отменить заказ</a>
                        </div>
                        <div
                            v-if="offer.status === -1"
                            class="offer-chat__btns-item">
                            <button class="btn btn-danger">Заказ отклонен</button>
                            <a
                                v-if="user.role === 'seller'"
                                href="#" class="offer-chat__btns-link">Удалить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offer-chat__toggle">
                <a
                    @click.prevent="this.isHidden = true"
                    href="#" class="offer-chat__show">
                    Информация
                </a>
                <a
                    @click.prevent="this.isHidden = false"
                    href="#" class="offer-chat__hide">
                    Скрыть
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .offer-chat{
        width: 100%;
        border:1px solid rgba(0,0,0,.1);
        border-radius:8px;
        transition:all .1s linear;
        max-width:850px;
        margin: 0 auto;
    }
    .offer-chat--hidden .offer-chat__main{
        margin-bottom: 0 !important;
    }
    .offer-chat--hidden .offer-chat__more-info,
    .offer-chat--hidden .offer-chat__btns {
        display:none !important;
    }
    .offer-chat--hidden .offer-chat__body-img{
        height: 53px;
    }
    .offer-chat:not(:last-child){
        margin-bottom: 32px;
    }
    .offer-chat__content{
        position:relative;
        padding: 24px;
    }
    .offer-chat__toggle{
        position: absolute;
        right:16px;
        top:16px;
        font-size: 12px;
        font-weight: 400;
    }
    .offer-chat__hide{
        color:#56565680;
    }
    .offer-chat__hide:hover{
        text-decoration:none;
        color:var(--primary)
    }
    .offer-chat__show{
        color:var(--primary);
        text-decoration:underline;
    }

    .offer-chat__body{
        display:flex;
        gap: 24px;
    }
    .offer-chat__body-content{
        width:calc(100% - 239px);
    }
    .offer-chat__body-img{
        max-width:215px;
        width: 100%;
        height: 200px;
        position:relative;
        border-radius:10px;
        overflow: hidden;
    }
    .offer-chat__body-img img{
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    .offer-chat__main,
    .offer-chat__more-info{
        display: flex;
        flex-direction: column;
    }
    .offer-chat__main{
        gap: 12px;
        margin-bottom: 12px;
    }
    .offer-chat__label{
        font-size: 18px;
        font-weight: 600;
        color:#000;
        text-align:left;
    }
    .offer-chat__description{
        font-size: 16px;
        font-weight: 500;
        color:#000;
        text-align:left;
    }
    .offer-chat__files{
        display:flex;
        flex-wrap:wrap;
        gap: 16px;
        margin-bottom: 24px;
    }
    .offer-file{
        display: flex;
        gap: 4px;
    }
    .offer-chat__more-info{
        gap: 8px;
        margin-bottom: 33px;
    }
    .offer-chat__more-info>*{
        display:flex;
        justify-content:space-between
    }
    .offer-chat__more-info label{
        font-size: 16px;
        font-weight: 500;
        color:#544F4F;

    }
    .offer-chat__more-info span{
        font-weight: 600;
        font-size: 18px;
        color:#000;
    }
    .offer-chat__btns-item{
        display:flex;
        width: 100%;
        gap: 8px;
    }
    .offer-chat__btns-item>*{
        flex:1 1 auto;
    }
    .offer-chat__btns-item>.btn{
        padding: 8px;
    }
    .offer-chat__btns-link{
        font-size: 14px;
        font-weight: 400;
        color:#544F4F;
        flex:unset;
        align-self: center;
        margin-right: 16px;
    }
    .offer-chat__btns-link:hover{
        text-decoration: none;
        color:var(--err)
    }

    @media(max-width:1375px){
        .offer-chat__main{
            gap: 8px;
            margin-bottom: 18px;
        }
        .offer-chat__label{
            font-size: 16px;
        }
        .offer-chat__description{
            font-size: 14px;
        }
        .offer-chat__more-info{
            gap: 8px;
            margin-bottom: 27px;
        }
        .offer-chat__more-info label{
            font-size: 14px;
        }
        .offer-chat__more-info span{
            font-size: 16px;
        }
    }

    @media(max-width:1200px){
        .offer-chat__content{
            padding: 12px;
        }
        .offer-chat__body{
            gap: 12px;
        }

        .offer-chat__body-img{
            max-width: 145px;
            height: 130px;
        }
        .offer-chat__body-content{
            width: calc(100% - 152px);
        }

        .offer-chat__label{
            font-size: 14px;
        }
        .offer-chat__description{
            font-size: 12px;
        }

        .offer-chat__more-info label{
            font-size: 12px;
        }
        .offer-chat__more-info span{
            font-size: 14px;
        }

        .offer-chat__hide{
            right: 8px;
            top: 8px;
        }

        .offer-chat__btns-item>.btn{
            font-size: 14px;
        }
    }

    @media(max-width:575px){
        .offer-chat__hide {
            right: 0;
            top: 8px;
            left: 0;
            margin: auto;
        }
        .offer-chat__content {
            padding: 16px;
            padding-top: 41px;
        }
        .offer-chat__body-img {
            max-width: 294px;
            height: 100%;
            width: 100%;
        }
        .offer-chat__body {
            gap: 12px;
            flex-direction: column;
            transition:all .1s linear;
        }
        .offer-chat__body-content{
            width: 100%;
        }
        .offer-chat--hidden .offer-chat__body{
            flex-direction:row;
            gap: 12px;
        }
        .offer-chat--hidden .offer-chat__body-img {
            max-width: 72px;
            height: 84px;
        }
    }

    @media(max-width:375px){
        .offer-chat__label {
            font-size: 13px;
            line-height: 1.2;
        }
        .offer-chat__description {
            font-size: 12px;
            line-height: 1.2;
        }
        .offer-chat__main {
            gap: 3px;
        }
        .offer-chat__content[data-v-e2347f64] {
            padding: 12px;
            padding-top: 31px;
        }
    }

</style>
