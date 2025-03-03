<template>
    <div class="profile-chat" id="chat" style="position: relative">
        <div class="profile-chat__body" v-if="user">
            <div class="profile-tabs__content-item">
                <div class="tab-content__chat chat">
                    <div class="chat__body">
                        <div v-if="isChatsMobile" class="chat__left">
                            <ChatsListComponent
                                :works="works"
                                :userRole="user.role"
                                :currentChatID="currentChat && currentChat.id"

                                v-on:chooseChat="chooseChat"
                            ></ChatsListComponent>
                        </div>

                        <div v-if="isMessagesMobile" class="chat__right">
                            <CompletedWorkSignboard v-if="false"></CompletedWorkSignboard>

                            <MessagesHeader
                                :chat="currentChat"

                                @backToChats="backToChats"
                                @chatAction="btnAction"
                            ></MessagesHeader>

                            <MessagesList
                                :messages="messages"
                                :user="user"
                                :chatWorks="currentChat ? currentChat.project_works : false"
                                :chatStatus="currentChat ? currentChat.status : false"
                                :statistics="currentChat ? currentChat.statistics : false"
                                :partnerName="currentChat ? currentChat.partner_user.name : ''"
                            ></MessagesList>

                            <div class="chat__messages messages-create">
                                <div class="textarea-w">
                                    <div
                                        :class="'textarea-upload ' + uploadFileObject.class">
                                        <div class="messages-create__icon">
                                            <img
                                                :src="uploadFileObject.icon"
                                                alt="">
                                        </div>
                                        <label for="chat-upload" class="textarea-upload__text">
                                            {{ uploadFileObject.title }}
                                        </label>
                                        <input
                                            @change="onFileChange"
                                            type="file" id = "chat-upload" hidden>
                                        <div
                                            v-if="currentMessage && currentMessage.file"
                                            @click="cancelUploadedFile"
                                            class="textarea-upload__cancel">
                                            <img src="/img/close-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="messages-create__row">
                                        <textarea
                                            v-model="currentMessage.message"
                                            @keyup.enter="sendMessage"
                                            @input="changeTextareaHeight"
                                            name="" placeholder="Введите текст" class="messages-create__textarea textarea"></textarea>
                                        <div
                                            @click="sendMessage"
                                            class="messages-create__create mobile">
                                            <img src="/img/send-message-icon.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="chat__btns" style="display: flex; flex-wrap: wrap; gap:8px;">
                                    <button
                                        @click="sendMessage"
                                        class="btn btn-primary btn--send-message">Отправить</button>
                                </div>
                            </div>

                            <div
                                v-if="!currentChat"
                                class="chat__overflow">
                                <div v-if="works.length == 0"
                                     class="chat__overflow-text">
                                    <span v-if="user.role == 'seller'">Сейчас у вас нет возможности переписываться с блогерами. Чтобы отправлять сообщения создайте проект.</span>
                                    <span v-else-if="user.role == 'blogger'"> Сейчас у вас нет возможности общаться с другими пользователями. Чтобы начать переписку, начните сотрудничество с селлерами.</span>
                                </div>
                                <div v-else class="chat__overflow-text">
                                    <span>Выберите чат, чтобы начать переписку</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <confirm-popup ref="confirmPopup"></confirm-popup>
        <statistics-popup ref="statisticsPopup"></statistics-popup>
    </div>
</template>
<script>
import { ref } from "vue";
import axios from "axios";

import User from '../../../core/services/api/User.vue'

import ChatsListComponent from "./ChatsListComponent";
import CompletedWorkSignboard from "./CompletedWorkSignboardComponent";
import MessagesHeader from "./MessagesHeaderComponent";
import MessagesList from "./MessagesListComponent";

import ConfirmPopup from "../../../core/components/popups/confirmation-popup/ConfirmationPopup";
import StatisticsPopup from "../../../core/components/popups/work-statistics/WorkStatisticsPopup";

import Loader from '../../../core/services/AppLoader.vue'

export default{
    props:['currentItem'],
    components: {
        ConfirmPopup, StatisticsPopup, ChatsListComponent,
        CompletedWorkSignboard, MessagesHeader, MessagesList
    },
    data(){
        return {
            works:ref([]),
            messages:ref([]),

            currentMessage: ref({
                message: null,
                file: null
            }),

            currentChat: ref(null),
            currentChatIntervalId: ref(null),
            chatsListIntervalId: ref(null),

            user: ref(null),

            uploadFileObject: ref({
                title: 'Прикрепите файл',
                icon: '/img/papperclip-icon.svg',
                class: '',
            }),

            isTablet: ref(false),
            isChatsMobile: ref(true),
            isMessagesMobile: ref(true),

            User, Loader
        }
    },
    mounted(){
        this.user = this.User.getCurrent();

        this.Loader.loaderOn(this.$el);
        this.getChats().then(() => { this.Loader.loaderOff(this.$el); });

        this.chatsListIntervalId = localStorage.getItem('chats_interval_id')

        if(!this.chatsListIntervalId) {
            this.chatsListIntervalId = setInterval(() => {
                this.getChats()
            }, 5000)
            localStorage.setItem('chats_interval_id', this.chatsListIntervalId)
        }

        this.isTablet = window.matchMedia('(max-width: 970px)').matches;

        if(this.isTablet){
            this.isChatsMobile = true;
            this.isMessagesMobile = false;
        }
    },
    updated(){
        if(this.currentItem){ //если мы перешли с другого модуля
            if(this.currentItem.item === 'chat'){
                this.works.map(_w => {
                    if(_w.id == this.currentItem.id){
                        _w.currentWork = true
                    }
                    else {
                        _w.currentWork = false
                    }

                    return _w;
                });

                this.$emit('updateCurrentItem', null);

                let childOffset = ($(document).find(`.item-chat[data-id="${this.currentItem.id}"]`) ? $(document).find(`.item-chat[data-id="${this.currentItem.id}"]`).offset().top : 0),
                    wrapOffset = $(document).find('#chat .chat__chat-items').offset().top,
                    scrolledValue = $(document).find('#chat .chat__chat-items').scrollTop();

                $('.chat__chat-items').animate({
                    scrollTop: (childOffset - wrapOffset + scrolledValue) - 20
                }, 1000);
            }
        }

        if(this.isTablet){
            if(this.isChatsMobile && this.currentChat && this.backBtnPressed){
                let childOffset = ($(document).find(`.item-chat[data-id="${this.currentChat.id}"]`) ? $(document).find(`.item-chat[data-id="${this.currentChat.id}"]`).offset().top : 0),
                    wrapOffset = $(document).find('#chat .chat__chat-items').offset().top,
                    scrolledValue = $(document).find('#chat .chat__chat-items').scrollTop();

                $('.chat__chat-items').animate({
                    scrollTop: (childOffset - wrapOffset + scrolledValue) - 20
                }, 0);

                this.backBtnPressed = false;
            }
        }
    },
    methods: {
        async chooseChat(work){
            for (let k in this.currentMessage){
                this.currentMessage[k] = null
            }

            if(this.isTablet) {
                this.isMessagesMobile = true;
                this.isChatsMobile = false;
            }

            this.uploadFileObject.title = 'Прикрепите файл';
            this.uploadFileObject.icon = '/img/papperclip-icon.svg';
            this.uploadFileObject.class = '';

            this.works = this.works.map(_w => {
                if(_w.id == work.id){
                    _w.new_messages_count = 0
                }

                return _w;
            })

            work.btnData = this.getChatBtnData(work);

            this.currentChatIntervalId = localStorage.getItem('chats_messages_interval_id')

            if(!this.currentChatIntervalId){
                this.currentChatIntervalId = setInterval(() => {
                    this.getMessages(this.currentChat);
                }, 5000)

                localStorage.setItem('chats_messages_interval_id', this.currentChatIntervalId)
            }

            await this.getMessages(work)

            $('.chat__messages').animate({ scrollTop: $('.chat__messages')[0].scrollHeight + 'px' }, 0);
        },
        getMessages(work){
            return new Promise((resolve, reject) => {
                this.currentChat = work;

                this.User.getMessages(work.id, this.user.id).then(data => {
                    this.messages = (data || [])
                    resolve(data)
                })
            })
        },
        getChats(){
            return new Promise((resolve, reject) => {
                this.User.getWorks(this.user.id).then(data => {
                    this.works = (data || [])

                    const newMessages = this.works.filter(w => w.new_messages_count).map(w => w.new_messages_count).reduce((a, b) => a + b, 0);

                    if(this.currentChat) {
                        const work = this.works.find(w => w.id === this.currentChat.id)

                        this.currentChat.status = work ? work.status : this.currentChat.status;
                        this.currentChat.accepted_by_seller_at = work ? work.accepted_by_seller_at : this.currentChat.accepted_by_seller_at;
                        this.currentChat.accepted_by_blogger_at = work ? work.accepted_by_blogger_at : this.currentChat.accepted_by_blogger_at;
                        this.currentChat.confirmed_by_blogger_at = work ? work.confirmed_by_blogger_at : this.currentChat.confirmed_by_blogger_at;
                        this.currentChat.confirmed_by_seller_at = work ? work.confirmed_by_seller_at : this.currentChat.confirmed_by_seller_at;
                        this.currentChat.statistics = work ? work.statistics : this.currentChat.statistics;

                        this.currentChat.btnData = this.getChatBtnData(this.currentChat)
                    }
                    if(newMessages && newMessages > 0){
                        this.$emit('newMessages', newMessages)
                    }

                    resolve(data)
                })
            })
        },
        async btnAction(action){
            if(!action){
                return
            }

            let isConfirmed = true;

            if(action === 'cancel'){
                isConfirmed = await this.$refs.confirmPopup.show({
                    title: 'Подтвердите действие',
                    subtitle: 'После подтверждения работу нельзя будет восстановить',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                });
            }

            if(!isConfirmed){
                return
            }

            if(action !== 'stats'){
                $(document).find('.btn--chat-action').addClass('btn-loading');

                axios({
                    method: 'get',
                    url: '/api/works/' + this.currentChat.id + '/' + action,
                })
                .then(() => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Статус проекта успешо изменен.'
                    })

                    $(document).find('.btn--chat-action').removeClass('btn-loading');

                    this.getChats();
                    this.currentChat && this.getMessages(this.currentChat);
                })
                .catch((err) => {
                    var message = err.response.data.message ? err.response.data.message : 'Не удалось изменить статус проекта, попробуйте позже.';
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Не удалось изменить статус проекта, попробуйте позже.'
                    })

                    $(document).find('.btn--chat-action').removeClass('btn-loading');
                })
            }
            else{
                this.$refs.statisticsPopup.show(this.currentChat.id).then(isConfirmed => {
                    if(!isConfirmed) return;

                    this.currentChat.btnData = this.getChatBtnData(this.currentChat);
                })
            }
        },
        sendMessage(){
            return new Promise((resolve, reject) => {
                if(!this.currentMessage) {
                    resolve(false)
                    return
                }

                if([null, undefined, ''].includes(this.currentMessage.message) && [null, undefined, ''].includes(this.currentMessage.file)){
                    resolve(false)
                    return
                }

                var formData = new FormData;

                formData.append('message', (this.currentMessage.message ? this.urlify(this.currentMessage.message.trim()) : ''));
                formData.append('img', this.currentMessage.file);

                if(!this.currentChat){
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Не выбран чат.'
                    })

                    resolve(false);

                    return
                }

                $(document).find('.messages-create__create').addClass('btn-loading');
                $(document).find('.btn--send-message').addClass('btn-loading');

                this.currentMessage.message = null;
                this.currentMessage.file = null;

                axios({
                    method: 'post',
                    url: '/api/users/' + this.user.id + '/works/' + this.currentChat.id + '/messages',
                    data: formData,
                })
                .then(response => {
                    this.uploadFileObject.title = 'Прикрепите файл';
                    this.uploadFileObject.icon = '/img/papperclip-icon.svg';
                    this.uploadFileObject.class = '';

                    resolve(true);
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                    })

                    resolve(false)
                })
                .finally(() => {
                    $('#chat-upload').val(null)

                    $(document).find('.messages-create__create').removeClass('btn-loading');
                    $(document).find('.btn--send-message').removeClass('btn-loading');
                })
            })
        },
        getChatBtnData(work){
            // if(work && (work.status == 'pending' || work.status == null) && work.project_work.lost_quantity < 1){
            // }

            if(work && work.status == 'completed'){
                return {
                    title: 'Проект завершен',
                }
            }
            else if(work && work.status == 'canceled'){
                return {
                    title: 'Проект отменен',
                }
            }
            else if(work && work.status == 'progress'){
                if(work.project_works[0].type != 'feedback' && work.statistics == null){
                    if(this.user.role == 'blogger'){
                        return {
                            title: 'Прикрепить статистику',
                            action: 'stats'
                        }
                    }
                    else{
                        return {
                            title: 'Ожидаем статистику от блогера',
                        }
                    }
                }
                else if(this.user.role == 'blogger' && work.confirmed_by_blogger_at != null){
                    return {
                        title: 'Ожидаем ответа от ' + work.partner_user.name
                    }
                }
                else if(this.user.role == 'seller' && work.confirmed_by_seller_at == null){
                    return {
                        title: 'Завершить проект',
                        action: 'confirm'
                    }
                }
                else if(this.user.role == 'blogger' && work.confirmed_by_blogger_at == null){
                    return {
                        title: 'Завершить проект',
                        action: 'confirm'
                    }
                }
            }
            else if(work && work.status == 'pending'){
                if(this.user.role == 'blogger' && work.accepted_by_blogger_at != null){
                    return {
                        title: 'Ожидаем ответа от ' + work.partner_user.name
                    }
                }
                else if(this.user.role == 'seller' && work.accepted_by_seller_at != null){
                    return {
                        title: 'Ожидаем ответа от блогера',
                    }
                }
            }

            return {
                title: 'Начать работу',
                action: 'start'
            }
        },

        goToProjects(project_id){
            this.$emit('switchTab', 'profile-projects', {
                item: 'projects',
                id: project_id
            });
        },
        backToChats(){
            this.isMessagesMobile = false;
            this.isChatsMobile = true;
            this.backBtnPressed = true;
        },

        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;

            if (!files.length)
                return;

            if(files[0].size > 52428800){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Нельзя загружать файлы больше 50мб.'
                })

                $(e.target).val(null);

                return;
            }

            this.uploadFileObject.title = files[0].name;
            this.uploadFileObject.icon = '/img/approved-aproved-confirm-2-svgrepo-com.svg';
            this.uploadFileObject.class = 'uploaded';

            this.currentMessage.file = files[0];
        },
        cancelUploadedFile(){
            this.currentMessage.file = null;
            this.uploadFileObject.title = 'Прикрепите файл';
            this.uploadFileObject.icon = '/img/papperclip-icon.svg';
            this.uploadFileObject.class = '';
        },

        changeTextareaHeight(){
            $('.messages-create__textarea').css('height',  'auto')
            $('.messages-create__textarea').css('height',  $('.messages-create__textarea')[0].scrollHeight + 'px')
        },

        urlify(text){
            let urlRegex = /(https?:\/\/[^\s]+)/g;

            return text.replace(urlRegex, function(url) {
                return '<a target="_blank" href="' + url + '">' + url + '</a>';
            })
        }
    }
}
</script>
