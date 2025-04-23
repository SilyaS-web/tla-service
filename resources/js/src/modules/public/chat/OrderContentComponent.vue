<script>
import {ref} from "vue";
import FileIcon from "../../../core/icons/FileIcon.vue";
import axios from "axios";
import ConfirmationPopup from "../../../core/components/popups/confirmation-popup/ConfirmationPopup.vue";


export default {
    components: {FileIcon, ConfirmationPopup},
    props:[
        'productImage', 'productName', 'order', 'user'
    ],
    data(){
        return{
            currentOrder: ref(null),
            orderStatuses: {
                'deleted': -2,
                'denied': -1,
                'pending': 0,
                'accepted': 1,
                'completed': 2,
            },
            isHidden: ref(false),
        }
    },
    name: "OrderContentComponent",
    watch:{
        order(){
            console.log(this.order.status, this.currentOrder.status)
            if(this.order.status !== this.currentOrder.status) this.currentOrder.status = this.order.status
            else if(!this.order) this.currentOrder.status = this.orderStatuses['deleted']
        }
    },
    created(){
        this.currentOrder = this.order
    },
    methods:{
        getOrderFileName(name){
            if(!name) return 'Неизвестно'

            const splitedFile = name.split('/');
            const file = splitedFile[splitedFile.length - 1];
            const fileName = file.split('.')[0];
            const fileFormat = file.split('.')[1];

            return [(fileName.slice(0, 12) + '... '), fileFormat].join('.');
        },
        acceptOrder(){
            axios({
                method: 'get',
                url: '/api/orders/' + this.currentOrder.id + '/accept',
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Статус заказа изменен.'
                })
            })
            .catch(error => {
                notify('error', {
                    title: 'Ошибка',
                    message: 'Что-то пошло не так. Невозможно изменить статус заказа, попробуйте позже.'
                })
            })
        },
        async denyOrder(){
            const isConfirmed = await this.$refs.confirmationPopup.show({
                title:'Вы уверены, что хотите отменить заказ?',
                subtitle:''
            })

            if(!isConfirmed) return

            axios({
                method: 'get',
                url: '/api/orders/' + this.currentOrder.id + '/reject',
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Статус заказа изменен.'
                })
            })
            .catch(error => {
                notify('error', {
                    title: 'Ошибка',
                    message: 'Что-то пошло не так. Невозможно изменить статус заказа, попробуйте позже.'
                })
            })
        },
        completeOrder(){
            axios({
                method: 'get',
                url: '/api/orders/' + this.currentOrder.id + '/complete',
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Статус заказа изменен.'
                })
            })
            .catch(error => {
                notify('error', {
                    title: 'Ошибка',
                    message: 'Что-то пошло не так. Невозможно изменить статус заказа, попробуйте позже.'
                })
            })
        },
        async deleteOrder(){
            const isConfirmed = await this.$refs.confirmationPopup.show({
                title:'Вы уверены, что хотите удалить заказ?',
                subtitle:''
            })

            if(!isConfirmed) return

            axios({
                method: 'delete',
                url: '/api/orders/' + this.currentOrder.id,
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заказ удален'
                })
            })
            .catch(error => {
                notify('error', {
                    title: 'Ошибка',
                    message: 'Что-то пошло не так. Невозможно удалить заказ, попробуйте позже.'
                })
            })
        },
    }
}
</script>

<template>
    <div
        v-if="currentOrder.status !== orderStatuses['deleted']"
        :class="['chat__order', 'order-chat', (isHidden ? 'order-chat--hidden' : '')]">
        <div class="order-chat__content">
            <div class="order-chat__header"></div>
            <div class="order-chat__body">
                <div class="order-chat__body-img">
                    <img :src="(productImage ? productImage : '/img/placeholder.webp')" alt="">
                </div>
                <div class="order-chat__body-content">
                    <div class="order-chat__main">
                        <div class="order-chat__label">
                            {{ productName }}
                        </div>
                        <div class="order-chat__description">
                            {{ order.specification }}
                        </div>
                    </div>
                    <div class="order-chat__files">
                        <a
                            v-for="(file, ind) in currentOrder.files"
                            :href="file.link"
                            download
                            class="order-chat__files-item order-file">
                            <div class="order-file__icon">
                                <file-icon></file-icon>
                            </div>
                            <span class="order-file__name">{{getOrderFileName(file.link) }}</span>
                        </a>
                    </div>
                    <div class="order-chat__more-info">
                        <div class="order-chat__price">
                            <label>Цена</label>
                            <span><b>{{ order.price || "-" }} ₽</b></span>
                        </div>
                        <div class="order-chat__period">
                            <label>Срок выполнения</label>
                            <span><b>{{ order.complete_till }}</b></span>
                        </div>
                    </div>
                    <div class="order-chat__btns">
                        <div
                            v-if="user.role === 'blogger' && currentOrder.status === orderStatuses['pending']"
                            class="order-chat__btns-item">
                            <button
                                @click="acceptOrder"
                                class="btn btn-primary">Принять</button>
                            <button
                                @click="denyOrder"
                                class="btn btn-white btn-secondary">Отклонить</button>
                        </div>
                        <div
                            v-if="user.role === 'seller' && currentOrder.status === orderStatuses['pending']"
                            class="order-chat__btns-item">
                            <button class="btn btn-white" disabled>Заказ на рассмотрении</button>
                            <a
                                @click="denyOrder"
                                href="#" class="order-chat__btns-link">Отменить заказ</a>
                        </div>
                        <div
                            v-if="user.role === 'blogger' && currentOrder.status === orderStatuses['accepted']"
                            class="order-chat__btns-item">
                            <button
                                @click="completeOrder"
                                class="btn btn-white">Подтвердить выполнение</button>
                        </div>
                        <div
                            v-if="user.role === 'seller' && currentOrder.status === orderStatuses['accepted']"
                            class="order-chat__btns-item">
                            <button class="btn btn-white btn-primary">Заказ принят</button>
                            <a
                                @click="denyOrder"
                                href="#" class="order-chat__btns-link">Отменить заказ</a>
                        </div>
                        <div
                            v-if="currentOrder.status === orderStatuses['denied']"
                            class="order-chat__btns-item">
                            <button class="btn btn-danger">Заказ отклонен</button>
                            <a
                                v-if="user.role === 'seller'"
                                @click="deleteOrder"
                                href="#" class="order-chat__btns-link">Удалить заказ</a>
                        </div>
                        <div
                            v-if="currentOrder.status === orderStatuses['completed']"
                            class="order-chat__btns-item">
                            <button class="btn btn-white btn-primary">Заказ выполнен</button>
                            <a
                                v-if="user.role === 'seller'"
                                @click="deleteOrder"
                                href="#" class="order-chat__btns-link">Удалить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-chat__toggle">
                <a
                    @click.prevent="this.isHidden = false"
                    href="#" class="order-chat__show">
                    Информация
                </a>
                <a
                    @click.prevent="this.isHidden = true"
                    href="#" class="order-chat__hide">
                    Скрыть
                </a>
            </div>
        </div>
        <confirmation-popup ref="confirmationPopup"></confirmation-popup>
    </div>
</template>

<style scoped>
    .order-chat{
        width: 100%;
        border:1px solid rgba(0,0,0,.1);
        border-radius:8px;
        transition:all .1s linear;
        max-width:850px;
        margin: 0 auto;
    }
    .order-chat--hidden .order-chat__main{
        margin-bottom: 0 !important;
    }
    .order-chat--hidden .order-chat__description{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 21px;
        max-height: 63px;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .order-chat--hidden .order-chat__more-info,
    .order-chat--hidden .order-chat__files,
    .order-chat--hidden .order-chat__btns {
        display:none !important;
    }
    .order-chat--hidden .order-chat__body-img{
        height: 53px;
    }
    .order-chat:not(:last-child){
        margin-bottom: 32px;
    }
    .order-chat__content{
        position:relative;
        padding: 24px;
    }
    .order-chat__toggle{
        position: absolute;
        right:16px;
        top:8px;
        font-size: 12px;
        font-weight: 400;
        display:flex;
        gap: 8px;
    }
    .order-chat__hide{
        color:#56565680;
    }
    .order-chat__hide:hover{
        text-decoration:none;
        color:var(--primary)
    }
    .order-chat__show{
        color:var(--primary);
        text-decoration:underline;
    }

    .order-chat__body{
        display:flex;
        gap: 24px;
    }
    .order-chat__body-content{
        width:calc(100% - 239px);
    }
    .order-chat__body-img{
        max-width:215px;
        width: 100%;
        height: 200px;
        position:relative;
        border-radius:10px;
        overflow: hidden;
    }
    .order-chat__body-img img{
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    .order-chat__main,
    .order-chat__more-info{
        display: flex;
        flex-direction: column;
    }
    .order-chat__main{
        gap: 12px;
        margin-bottom: 12px;
    }
    .order-chat__label{
        font-size: 18px;
        font-weight: 600;
        color: #000;
        text-align: left;
        max-width: 420px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 21px;
        max-height: 48px;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .order-chat__description{
        font-size: 16px;
        font-weight: 500;
        color:#000;
        text-align:left;
    }
    .order-chat__files{
        display:flex;
        flex-wrap:wrap;
        gap: 16px;
        margin-bottom: 24px;
    }
    .order-file__icon{
        width: 12px;
    }
    .order-file__name{
        font-size: 12px;
        color:var(--text-non-accent);
        font-weight: 400;
    }
    .order-file{
        display: flex;
        gap: 4px;
    }
    .order-chat__more-info{
        gap: 8px;
        margin-bottom: 33px;
    }
    .order-chat__more-info>*{
        display:flex;
        justify-content:space-between
    }
    .order-chat__more-info label{
        font-size: 16px;
        font-weight: 500;
        color:#544F4F;

    }
    .order-chat__more-info span{
        font-weight: 600;
        font-size: 18px;
        color:#000;
    }
    .order-chat__btns-item{
        display:flex;
        width: 100%;
        gap: 8px;
    }
    .order-chat__btns-item>*{
        flex:1 1 auto;
    }
    .order-chat__btns-item>.btn{
        padding: 8px;
    }
    .order-chat__btns-item:has(.order-chat__btns-link){
        flex-direction:column;
        justify-content:center;
    }
    .order-chat__btns-item:has(.order-chat__btns-link) .btn{
        width: 100%;
    }
    .order-chat__btns-link{
        font-size: 14px;
        font-weight: 400;
        color:#544F4F;
        flex:unset;
        align-self: center;
    }
    .order-chat__btns-link:hover{
        text-decoration: none;
        color:var(--err)
    }

    @media(max-width:1375px){
        .order-chat__main{
            gap: 8px;
            margin-bottom: 18px;
        }
        .order-chat__label{
            font-size: 16px;
        }
        .order-chat__description{
            font-size: 14px;
        }
        .order-chat__more-info{
            gap: 8px;
            margin-bottom: 27px;
        }
        .order-chat__more-info label{
            font-size: 14px;
        }
        .order-chat__more-info span{
            font-size: 16px;
        }
    }

    @media(max-width:1200px){
        .order-chat__content{
            padding: 22px 12px;
        }
        .order-chat__body{
            gap: 12px;
        }

        .order-chat__body-img{
            max-width: 145px;
            height: 130px;
        }
        .order-chat__body-content{
            width: calc(100% - 152px);
        }

        .order-chat__label{
            font-size: 14px;
        }
        .order-chat__description{
            font-size: 12px;
        }

        .order-chat__more-info label{
            font-size: 12px;
        }
        .order-chat__more-info span{
            font-size: 14px;
        }

        .order-chat__hide{
            right: 8px;
            top: 8px;
        }

        .order-chat__btns-item>.btn{
            font-size: 14px;
        }
    }

    @media(max-width:575px){
        .order-chat__hide {
            right: 0;
            top: 8px;
            left: 0;
            margin: auto;
        }
        .order-chat__content {
            padding: 16px;
            padding-top: 41px;
        }
        .order-chat__body-img {
            max-width: 294px;
            height: 100%;
            width: 100%;
        }
        .order-chat__body {
            gap: 12px;
            flex-direction: column;
            transition:all .1s linear;
        }
        .order-chat__body-content{
            width: 100%;
        }
        .order-chat--hidden .order-chat__body{
            flex-direction:row;
            gap: 12px;
        }
        .order-chat--hidden .order-chat__body-img {
            max-width: 72px;
            height: 84px;
        }
    }

    @media(max-width:375px){
        .order-chat__label {
            font-size: 13px;
            line-height: 1.2;
        }
        .order-chat__description {
            font-size: 12px;
            line-height: 1.2;
        }
        .order-chat__main {
            gap: 3px;
        }
        .order-chat__content[data-v-e2347f64] {
            padding: 12px;
            padding-top: 31px;
        }
    }

</style>
