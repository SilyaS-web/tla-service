<template>
    <div class="chat__messages messages-chat">
        <order-content-component
            v-if="order"
            :productImage="project.project_files[0]"
            :productName="project.product_name"
            :user="user"
            :order="order"
        ></order-content-component>

        <div
            v-if="isAvailableToShowMessages(messages)"
            v-for="message in messages"
            :class="'messages-chat__item ' + getMessageClass(message)">

            <div
                v-if="!message.is_specification"
                class="messages-chat__item-content">
                <div class="messages-chat__item-header">
                    <div class="messages-chat__item-title">
                        {{ getSenderName(message) }}
                    </div>
                    <div class="messages-chat__item-date">
                        {{ getFormatedDate(message.created_at, 'd.m.y H:i') }}
                    </div>
                </div>
                <div class="messages-chat__item-msg">
                    <span v-html="message.message"></span>

                    <div
                        v-if="statistics && message.sender_id == 1 && statistics.message_id == message.id"
                        class="messages-chat__item-stats">
                        Просмотры: {{ statistics.views }}
                        Репосты: {{ statistics.reposts }}
                        Лайки: {{ statistics.likes }}
                    </div>
                    <div
                        v-for = "file in message.files">
                        <img
                            v-if="isImg(file.link)"
                            :src="file.link"
                            @click="openImage(file.link)"
                            alt=""
                            class="chat-img-popup"
                        >

                        <a
                            v-else

                            :href="file.link"
                            class="chat-file"
                            download
                        >

                            <div class="chat-file__icon">{{ getFileType(file.link) }}</div>
                            <div class="chat-file__text">
                                {{ file.link }}
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div
                v-else
                class="messages-chat__item-content msg-specification">
                <div class="msg-specification__title">
                    Техническое задание
                </div>
                <div class="msg-specification__subtitle">
                    Селлер оставил техничесое задание к работе, чтобы ознакомиться с ним нажмите на кнопку ниже
                </div>
                <button @click="openSpecification(message)" class="msg-specification__btn btn btn-primary">Ознакомиться</button>
            </div>
        </div>

        <div
            v-else
            class="messages-chat__item messages-chat__item--system">
            <div class="messages-chat__item-msg">
                <p>
                    Перед началом общения и обсуждения условий обмена товарами на рекламу, пожалуйста, учитывайте следующие важные моменты:
                </p>
                <br>
                <p>
                    Бартерные сделки: Наш сервис предполагает исключительно обмен товарами на рекламу и отзывы по бартерной основе. Мы не рекомендуем обмениваться товарами с доплатой или платить за рекламу. В случае обмена денежными средствами мы не несем ответственности за такие переводы.
                </p>
                <br>
                <p>
                    Вежливость и уважение: Будьте вежливыми и уважительными при общении. Соблюдайте правила сайта и общение должно быть конструктивным и профессиональным.
                </p>
                <br>
                <p>
                    Ясные условия: Четко обсуждайте условия обмена, чтобы избежать недоразумений. Убедитесь, что обе стороны согласны с условиями сделки перед отправкой товаров или публикацией рекламы.
                </p>
            </div>
        </div>

        <div
            v-if="chatStatus"
            :class="'messages-chat__item-status ' + chatStatus">
            {{ getStatusName(chatStatus) }}
        </div>
    </div>
    <image-popup ref="imagePopup"></image-popup>
    <specification-popup ref="specificationPopup"></specification-popup>
</template>
<script>
import moment from "moment";
import ImagePopup from "../../../core/components/popups/fullscreen-asset/AssetPopup";
import SpecificationPopup from '../../../core/components/popups/specification-popup/SpecificationPopup.vue'
import OrderContentComponent from "./OrderContentComponent.vue";

export default{
    props:[
        'user', 'messages', 'chatWorks', 'chatStatus',
        'statistics', 'partnerName', 'order', 'project'
    ],
    components: { OrderContentComponent, ImagePopup, SpecificationPopup },
    data(){
        return{
            statusNames: {
                'completed': 'Проект завершен',
                'pending': 'В ожидании',
                'progress': 'В работе',
                'canceled': 'Проект отменен',
            },
        }
    },
    updated() {
        $('.messages-chat').off('scroll').on('scroll', function(e){
            $('.messages-chat__item-status').css('top', $(document).find('.messages-chat').scrollTop() + 10 +'px')
        })
    },
    methods:{
        getMessageClass(message){
            switch (message.sender_id) {
                case 1:
                    return 'messages-chat__item--system';
                case this.user.id:
                    return 'messages-chat__item--author'
                default:
                    return '';
            }
        },
        getFormatedDate(value){
            if (value) {
                return moment(String(value)).format('DD.MM.YY H:mm')
            }
        },
        getSenderName(message){
            switch (message.sender_id) {
                case 1:
                    return '';
                case this.user.id:
                    return this.user.name
                default:
                    return this.partnerName;
            }
        },
        getStatusName(){
            return this.statusNames[this.chatStatus] || ''
        },
        getFileType(file){
            return file.split('.').pop();
        },

        openImage(src){
            this.$refs.imagePopup.show({imageUrl: src})
        },
        openSpecification(message){
            this.$refs.specificationPopup.show({
                specification:{
                    files: message.files,
                    text: message.message,
                    works_types: this.chatWorks
                },
                withConfirmation: false
            })
        },

        isAvailableToShowMessages(messages){
            const isMessages = messages && messages.length > 0;

            return isMessages && !(messages.length === 1 && messages[0].is_specification)
        },

        isImg(file){
            let types = ['png', 'jpg', 'jpeg', 'webp'],
                fileType = this.getFileType(file)

            return types.includes(fileType)
        },
    }
}
</script>
<style scoped>
    .msg-specification{
        display:flex;
        flex-direction:column;
        gap: 8px;
        align-items: center;
    }
    .msg-specification__title{
        font-size: 17px;
        font-weight: 600;
    }
    .msg-specification__subtitle{
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 12px;
    }
    .msg-specification__btn{
        padding: 8px 14px;
        font-size: 15px;
    }
    @media(max-width:768px){
        .msg-specification__title{
            font-size: 16px;
        }
        .msg-specification__subtitle{
            font-size: 14px;
            margin-bottom: 8px;
        }
        .msg-specification__btn {
            padding: 8px 12px;
            font-size: 14px;
        }
    }
    @media(max-width:475px){
        .msg-specification__title{
            font-size: 14px;
        }
        .msg-specification__subtitle{
            font-size: 12px;
            margin-bottom: 4px;
        }
        .msg-specification__btn {
            padding: 8px 12px;
            font-size: 12px;
        }
    }
</style>
