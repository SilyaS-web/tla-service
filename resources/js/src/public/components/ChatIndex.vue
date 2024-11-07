<template>
    <div class="profile-chat tab-content" id="chat">
        <div class="profile-chat__body" v-if="user">
<!--            <div class="profile-projects__title title">-->
<!--                <span v-if="user.role == 'blogger'"> Чат с селлерами </span>-->
<!--                <span v-else> Чат с блогерами </span>-->
<!--            </div>-->
            <div class="profile-tabs__content-item">
                <div class="tab-content__chat chat">
                    <div class="chat__body">
                        <div v-if="isChatsMobile" class="chat__left">
                            <div class="chat__chat-items">
                                <div
                                    v-if="works.length > 0"
                                    v-for="work in works"
                                    :data-id="work.id"
                                    @click="chooseChat(work)"
                                    :class="'chat__chat-item item-chat ' + (work.currentWork ? 'current' : (currentChat && currentChat.id == work.id ? 'current' : ''))"
                                    style="position:relative">
                                    <div class="item-chat__img" :style="'background-image: url(' + work.partner_user.image + ')'">
                                    </div>
                                    <div class="item-chat__text">
                                        <div class="item-chat__title">{{ work.product_name || 'Проект удалён' }}</div>
                                        <div class="item-chat__last-msg">
                                            <p>{{ user.role == 'blogger' ? 'Селлер' : 'Блогер' }}: {{ work.partner_user.name }}</p>
                                            <p>ID проекта: {{ work.id }}</p>
                                        </div>
                                    </div>
                                    <div
                                        v-if="work.new_messages_count > 0"
                                        class="nav-menu__item-notifs notifs" style="">{{ work.new_messages_count }}</div>
                                </div>
                                <p
                                    v-else
                                    class="chat__chat-empty">
                                    <span v-if="user.role == 'seller'">Чат пустой,создайте проект и начните работу с блогерами</span>
                                    <span v-else>Чат пустой, начните работу с селлерами</span>
                                </p>
                            </div>
                        </div>
                        <div v-if="isMessagesMobile" class="chat__right">
                            <div
                                class="chat__overflow chat__overflow--completed" style="z-index: 2; display: none">
                                <div class="chat__overflow-text">
                                    Проект завершен
                                </div>
                            </div>
                            <div
                                v-if="isLostIntegrationQuantityZero"
                                class="chat__overflow chat__overflow--tariff" style="z-index: 2;">
                                <div class="chat__overflow-text">
                                    Все доступные места на интеграцию заняты
                                </div>
                            </div>
                            <div class="chat__header">
                                <div
                                    @click="backToChats"
                                    class="chat__back">
                                    <img src="img/arrow-alt.svg" alt="">
                                </div>
                                <div
                                    v-if="currentChat && currentChat.project"
                                    class="projects-list__row projects-list__current-project current-project">
                                    <div class="current-project__main">
                                        <div class="current-project__row">
                                            <div class="current-project__img" :style="'background-image: url(' + (currentChat.project.project_files && currentChat.project.project_files[0] ? currentChat.project.project_files[0].link : '/img/profile-icon.svg') + ')'"></div>
                                        </div>
                                        <div class="current-project__title">
                                            <p class="name"><b>{{ currentChat.project.product_name }}</b></p>
                                            <p class="articul">Артикул товара: <span class="">{{ currentChat.project.product_nm }}</span></p>
                                        </div>
                                    </div>
                                    <div class="current-project__col">
                                        <div class="current-project__title">
                                            <p class="name"><b>Формат рекламы</b></p>
                                            <p class="articul"> {{ currentChat.project_work.name }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    @click="isChatOptsOpen = !isChatOptsOpen"
                                    :class="'chat__opts ' + (isChatOptsOpen ? 'active' : '')">
                                    <img src="img/dots-icon.svg" alt="">
                                    <div class="chat__opts-items">
                                        <div class="chat__opts-partner">
                                            <div
                                                v-if="currentChat"
                                                class="chat__opts-partner__row">
                                                <div
                                                    :style="'background-image:url(' + ((currentChat.partner_user && currentChat.partner_user.image) ? currentChat.partner_user.image : '/img/profile-icon.svg') + ')'"
                                                    class="chat__opts-partner__img">
                                                </div>
                                                <div
                                                    class="chat__opts-partner__col">
                                                    <span class = "chat__opts-partner__role">{{ currentChat.partner_user.name }}</span>
                                                    <span class = "chat__opts-partner__name">{{ (currentChat.partner_user.role == 'blogger' ? 'Блогер' : 'Селлер') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            v-if="currentChat && currentChat.btnData && currentChat.btnData.action"
                                            @click="btnAction(currentChat.btnData.action)"
                                            href=""
                                            :class="'chat__opts-item ' + (currentChat.btnData.action ? '' : 'chat__opts-item--disabled')">{{ currentChat.btnData.title }}</div>
                                        <div
                                            v-if="currentChat && !(currentChat.canceled_by_seller_at && currentChat.canceled_by_blogger_at)"
                                            @click="btnAction('cancel')"
                                            class="chat__opts-item chat__opts-item--cancel">
                                            Отменить работу
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            {{ format_date(message.created_at, 'd.m.y H:i') }}
                                        </div>
                                    </div>
                                    <div class="messages-chat__item-msg">
                                        <span v-html="message.message"></span>
                                        <div
                                            v-if="currentChat && currentChat.statistics && message.sender_id == 1 && currentChat.statistics.message_id == message.id"
                                            class="messages-chat__item-stats">
                                            Просмотры: {{ currentChat.statistics.views }}
                                            Репосты: {{ currentChat.statistics.reposts }}
                                            Лайки: {{ currentChat.statistics.likes }}
                                        </div>
                                        <div
                                            v-for = "file in message.files">
                                            <img
                                                v-if="isImg(file.link)"
                                                :src="file.link"
                                                @click="openImage(file.link)"
                                                alt="" class="chat-img-popup">

                                            <a
                                                v-else
                                                :href="file.link" download class = "chat-file">

                                                <div class="chat-file__icon">{{ getFileType(file.link) }}</div>
                                                <div class="chat-file__text">
                                                    {{ file.link }}
                                                </div>

                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        v-if="currentChat && currentChat.status"
                                        :class="'messages-chat__item-status ' + currentChat.status">
                                        {{ getStatusName(currentChat.status) }}
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
    </div>
    <div
        v-if="imageIsOpen"
        class="popup" id="chat-img" style="">
        <div class="popup__container _container">
            <div class="popup__body" style="max-width:790px">
                <div class="chat-img__w">
                    <img :src="openedImageUrl" alt="" class="chat-img" style="width:100%">
                </div>
                <div
                    @click="imageIsOpen = false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div
        v-if="isBloggerStatisticsPopupOpen"
        class="popup" id="" style="">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__header">
                    <div class="popup__title title">
                        Заполните статистику
                    </div>
                    <div class="popup__subtitle">
                        После того, как вы прикрепите статистику по интеграции, проект будет завершен
                    </div>
                </div>
                <div class="popup__form">
                    <div class="form-group">
                        <label for="views">Просмотры</label>
                        <input
                            v-model="bloggerStatistics.views"
                            id="views" name="views" type="views" class="input">
                    </div>
                    <div class="form-group">
                        <label for="likes">Лайки</label>
                        <input
                            v-model="bloggerStatistics.likes"
                            id="likes" name="likes" type="likes" class="input">
                    </div>
                    <div class="form-group">
                        <label for="reposts">Репосты</label>
                        <input
                            v-model="bloggerStatistics.reposts"
                            id="reposts" name="reposts" type="reposts" class="input">
                    </div>
                    <div class="form-group">
                        <label for="platform">Площадка</label>
                        <select
                            v-model="bloggerStatistics.platform_id"
                            id="platform" name="platform" class="input">
                            <option value="">Не выбрано</option>
                            <option
                                v-for="platform in platforms"
                                :value="platform.id">{{ platform.title }}</option>
                        </select>
                    </div>
                    <div class="input-file input-file--stat tab-content__profile-img-upload" style="padding-left:0; margin-bottom:20px;">
                        <label for="statistics-file">{{ uploadStatisticsFileTitle }}</label>
                        <input
                            @change="uploadStatisticsFileTitle = 'Файлы загружены'"
                            id="statistics-file" type="file" multiple hidden>
                    </div>
                    <button
                        @click="sendStatistics"
                        class="btn btn-primary">
                        Отправить
                    </button>
                </div>
                <div
                    @click="isBloggerStatisticsPopupOpen = false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <confirm-popup ref="confirmPopup"></confirm-popup>
</template>
<script>
    import {reactive, ref} from "vue";

    import User from '../../services/api/User.vue'
    import Platforms from '../../services/api/Platforms.vue'
    import moment from "moment";
    import axios from "axios";
    import ConfirmPopup from "../../ui/ConfirmationPopup";

    export default{
        props:['currentItem'],
        components: {ConfirmPopup},
        data(){
            return {
                imageIsOpen: false,
                openedImageUrl: '',
                works:ref([]),
                messages:ref([]),
                currentMessage: ref({
                    message: null,
                    file: null
                }),
                isWorkCompleted: ref(false),
                platforms: ref([]),
                isLostIntegrationQuantityZero: ref(false),
                currentChat: ref(null),
                currentChatIntervalId: ref(null),
                chatsListIntervalId: ref(null),
                user: ref(null),
                isBloggerStatisticsPopupOpen: ref(false),
                bloggerStatistics: ref({}),
                uploadStatisticsFileTitle: ref('Прикрепить отчет по статистике'),
                uploadFileObject: ref({
                    title: 'Прикрепите файл',
                    icon: '/img/papperclip-icon.svg',
                    class: '',
                }),

                isChatOptsOpen: ref(false),

                statusNames: {
                    'completed': 'Проект завершен',
                    'pending': 'В ожидании',
                    'progress': 'В работе',
                    'canceled': 'Проект отменен',
                },

                isTablet: ref(false),
                isChatsMobile: ref(true),
                isMessagesMobile: ref(true),

                User, Platforms
            }
        },
        async mounted(){
            this.platforms = await this.Platforms.getList();
            this.user = this.User.getCurrent();

            this.getChats();

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
                    var list = this.works.map(_w => {
                        if(_w.id == this.currentItem.id){
                            _w.currentWork = true
                        }
                        else {
                            _w.currentWork = false
                        }

                        return _w;
                    });

                    this.$emit('updateCurrentItem', null);

                    var childOffset = ($(document).find(`.item-chat[data-id="${this.currentItem.id}"]`) ? $(document).find(`.item-chat[data-id="${this.currentItem.id}"]`).offset().top : 0),
                        wrapOffset = $(document).find('#chat .chat__chat-items').offset().top,
                        scrolledValue = $(document).find('#chat .chat__chat-items').scrollTop();

                    $('.chat__chat-items').animate({
                        scrollTop: (childOffset - wrapOffset + scrolledValue) - 20
                    }, 1000);
                }
            }

            if(this.isTablet){
                if(this.isChatsMobile && this.currentChat && this.backBtnPressed){
                    var childOffset = ($(document).find(`.item-chat[data-id="${this.currentChat.id}"]`) ? $(document).find(`.item-chat[data-id="${this.currentChat.id}"]`).offset().top : 0),
                        wrapOffset = $(document).find('#chat .chat__chat-items').offset().top,
                        scrolledValue = $(document).find('#chat .chat__chat-items').scrollTop();

                    $('.chat__chat-items').animate({
                        scrollTop: (childOffset - wrapOffset + scrolledValue) - 20
                    }, 0);

                    this.backBtnPressed = false;
                }
            }

            $('.messages-chat').off('scroll').on('scroll', function(e){
                $('.messages-chat__item-status').css('top', $(document).find('.messages-chat').scrollTop() + 10 +'px')
            })
        },
        methods: {
            sendStatistics(){
                var formData = new FormData;

                for (let k in this.bloggerStatistics){
                    if(this.bloggerStatistics)
                        formData.append(k, this.bloggerStatistics[k])
                }

                var image = $('#statistics-file'),
                    files = image[0].files;

                for(let i = 0; i < files.length; i++){
                    if(files[0])
                        formData.append('images[' + i + ']', files[0])
                }

                axios({
                    method: 'post',
                    url: '/api/works/' + this.currentChat.id + '/stats',
                    data: formData
                })
                .then(() => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Статистика отправлена.'
                    })
                    this.isBloggerStatisticsPopupOpen = false;
                    this.currentChat.btnData = this.getChatBtnData(this.currentChat);

                    for (let k in this.bloggerStatistics){
                        this.bloggerStatistics[k] = null;
                    }

                    this.uploadStatisticsFileTitle = 'Прикрепить отчет по статистике'
                    $('#statistics-file').val(null)
                })
                .catch(() => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Не удалось отправить статистику, попробуйте позже. Возможно какие-то поля не заполнены, либо заполнены некорректно.'
                    })
                })
            },
            async btnAction(action){
                if(!action){
                    return
                }

                let isConfirmed = true;

                if(action == 'cancel'){
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

                if(action != 'stats'){
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
                    .catch(() => {
                        notify('error', {
                            title: 'Внимание!',
                            message: 'Не удалось изменить статус проекта, попробуйте позже.'
                        })

                        $(document).find('.btn--chat-action').removeClass('btn-loading');
                    })
                }
                else{
                    this.isBloggerStatisticsPopupOpen = true;
                }
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

                    formData.append('message', (this.currentMessage.message ? this.currentMessage.message.trim() : ''));
                    formData.append('img', this.currentMessage.file);

                    if(!this.currentChat){
                        notify('error', {
                            title: 'Внимание!',
                            message: 'Не выбран чат.'
                        })

                        resolve(false);

                        return
                    }

                    $(document).find('.btn--send-message').addClass('btn-loading');

                    axios({
                        method: 'post',
                        url: 'api/users/' + this.user.id + '/works/' + this.currentChat.id + '/messages',
                        data: formData
                    })
                    .then(response => {
                        this.currentMessage.message = null;
                        this.currentMessage.file = null;

                        $('#chat-upload').val(null)
                        $(document).find('.btn--send-message').removeClass('btn-loading');

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

                        $(document).find('.btn--send-message').removeClass('btn-loading');

                        resolve(false)
                    })
                })
            },
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

                this.isLostIntegrationQuantityZero = false;
                this.isWorkCompleted = false;

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
                        this.messages = (data || []);

                        resolve(data)
                    })
                })
            },
            getChats(){
                this.User.getWorks(this.user.id).then(data => {
                    this.works = (data || [])

                    var newMessages = this.works.filter(w => w.new_messages_count).map(w => w.new_messages_count).reduce((a, b) => a + b, 0);

                    if(this.currentChat) {
                        var work = this.works.find(w => w.id == this.currentChat.id)

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
                })
            },
            getMessageClass(message){
                if(message.sender_id === 1){
                    return 'messages-chat__item--system'
                }
                if(message.sender_id === this.user.id){
                    return 'messages-chat__item--author'
                }

                return '';
            },
            getSenderName(message){
                if(message.sender_id === 1){
                    return ''
                }
                if(message.sender_id === this.user.id){
                    return this.user.name
                }

                return this.currentChat ? this.currentChat.partner_user.name : '';
            },
            goToProjects(project_id){
                this.$emit('switchTab', 'profile-projects', {
                    item: 'projects',
                    id: project_id
                });
            },
            format_date(value){
                if (value) {
                    return moment(String(value)).format('DD.MM.YY H:mm')
                }
            },
            getFileType(file){
                return file.split('.').pop();
            },
            isImg(file){
                var types = ['png', 'jpg', 'jpeg', 'webp'],
                    isImg = false,
                    fileType = this.getFileType(file)

                return types.includes(fileType)
            },
            openImage(src){
                this.openedImageUrl = src;
                this.imageIsOpen = true;
            },
            getChatBtnData(work){
                if(work && (work.status == 'pending' || work.status == null) && work.project_work.lost_quantity < 1){
                    this.isLostIntegrationQuantityZero = true
                }

                if(work && work.status == 'completed'){
                    this.isWorkCompleted = true;
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
                    if(work.project_work.type != 'feedback' && work.statistics == null){
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
            getStatusName(){
                return this.statusNames[this.currentChat.status] || ''
            },
            changeTextareaHeight(){
                $('.messages-create__textarea').css('height',  'auto')
                $('.messages-create__textarea').css('height',  $('.messages-create__textarea')[0].scrollHeight + 'px')
            },
            backToChats(){
                this.isMessagesMobile = false;
                this.isChatsMobile = true;
                this.backBtnPressed = true;
            }
        }
    }
</script>
