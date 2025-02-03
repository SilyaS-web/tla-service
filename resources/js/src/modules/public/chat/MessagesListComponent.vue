<template>
    <div class="chat__messages messages-chat">
        <div
            v-if="messages && messages.length > 0"
            v-for="message in messages"
            :class="'messages-chat__item ' + getMessageClass(message)">

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

            <div
                v-if="chatStatus"
                :class="'messages-chat__item-status ' + chatStatus">
                {{ getStatusName(chatStatus) }}
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
    </div>
    <image-popup ref="imagePopup"></image-popup>
</template>
<script>
import moment from "moment";
import ImagePopup from "../../../core/components/popups/fullscreen-image/ImapePopup";

export default{
    props:['user', 'messages', 'chatStatus', 'statistics', 'partnerName'],
    components: { ImagePopup },
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
            if(message.sender_id === 1){
                return 'messages-chat__item--system'
            }
            if(message.sender_id === this.user.id){
                return 'messages-chat__item--author'
            }

            return '';
        },
        getFormatedDate(value){
            if (value) {
                return moment(String(value)).format('DD.MM.YY H:mm')
            }
        },
        getSenderName(message){
            if(message.sender_id === 1){
                return ''
            }
            if(message.sender_id === this.user.id){
                return this.user.name
            }

            return this.partnerName;
        },
        getStatusName(){
            return this.statusNames[this.chatStatus] || ''
        },
        getFileType(file){
            return file.split('.').pop();
        },

        openImage(src){
            this.$refs.imagePopup.show(src)
        },

        isImg(file){
            let types = ['png', 'jpg', 'jpeg', 'webp'],
                fileType = this.getFileType(file)

            return types.includes(fileType)
        },
    }
}
</script>
