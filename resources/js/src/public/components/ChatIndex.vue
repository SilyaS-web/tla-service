<template>
    <div class="profile-chat tab-content" id="chat">
        <div class="profile-chat__body" v-if="user">
            <div class="profile-projects__title title">
                <span v-if="user.role == 'blogger'"> Чат с селлерами </span>
                <span v-else> Чат с блогерами </span>
            </div>
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
                                        <a href="#"
                                           :class="'item-chat__project-link ' + (user.role == 'seller' ? 'item-chat__project-link--seller' : 'item-chat__project-link--blogger')"
                                           :data-project-id = "work.project_id"
                                            @click="goToProjects(work.project_id)">
                                            Перейти к проекту
                                        </a>
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
                                class="chat__overflow chat__overflow--completed" style="z-index: 1; display: none">
                                <div class="chat__overflow-text">
                                    Проект завершен
                                </div>
                            </div>
                            <div
                                v-if="isLostIntegrationQuantityZero"
                                class="chat__overflow chat__overflow--tariff" style="z-index: 1;">
                                <div class="chat__overflow-text">
                                    Все доступные места на интеграцию заняты
                                </div>
                            </div>
                            <div
                                @click="isMessagesMobile = false; isChatsMobile = true;"
                                class="chat__back">
                                <img src="img/arrow-alt.svg" alt="">
                                <span> Вернуться </span>
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
                                        <span v-if="message.sender_id == 1" v-html="message.message"></span>
                                        <div
                                            v-if="currentChat.statistics && message.sender_id == 1"
                                            class="messages-chat__item-stats">
                                            Просмотры: {{ currentChat.statistics.views }}
                                            Репосты: {{ currentChat.statistics.reposts }}
                                            Лайки: {{ currentChat.statistics.likes }}
                                        </div>
                                        <span v-else v-html="message.message"></span>
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
                                    <div class="textarea-upload">
                                        <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" class="base-0-2-1" ie-style="">
                                            <path clip-rule="evenodd" d="m14.9502 3.80108c-1.0653-1.06811-2.7917-1.06811-3.857 0l-5.53401 5.54845c-1.74559 1.75017-1.74559 4.58847 0 6.33867 1.7445 1.7491 4.57211 1.7491 6.31661 0l.0025-.0026 2.8799-2.8595c.294-.2918.7688-.2901 1.0607.0038.2918.2939.2901.7688-.0038 1.0606l-2.8773 2.857-.0013.0013c-2.3307 2.3354-6.1092 2.3349-8.43936-.0013-2.32952-2.3356-2.32952-6.1216 0-8.45724l5.53396-5.54845c1.6514-1.65575 4.3297-1.65575 5.9811 0 1.6504 1.65465 1.6504 4.33657 0 5.99123l-5.5339 5.54846c-.97226.9748-2.54938.9748-3.52162 0-.97115-.9737-.97115-2.5516 0-3.5253l.0024-.0024 3.10232-3.08243c.2939-.29195.7688-.29042 1.0607.00341.292.29383.2904.7687-.0034 1.06065l-3.09997 3.08007-.00102.001c-.38619.3883-.38586 1.0178.00102 1.4057.38613.3872 1.01136.3872 1.3975 0l5.53397-5.54844c1.0664-1.06918 1.0664-2.80349 0-3.87268z" fill="currentColor" fill-rule="evenodd"></path>
                                        </svg>
                                        <label for = "chat-upload" class="textarea-upload__text">
                                            {{ uploadFileTitle }}
                                        </label>
                                        <input
                                            @change="onFileChange"
                                            type="file" id = "chat-upload" hidden>
                                    </div>
                                    <textarea
                                        v-model="currentMessage.message"
                                        @keyup.enter="sendMessage"
                                        name="" placeholder="Введите текст" class="messages-create__textarea textarea"></textarea>
                                </div>
                                <div class="chat__btns" style="display: flex; flex-wrap: wrap; gap:8px;">
                                    <button
                                        @click="sendMessage"
                                        class="btn btn-primary">Отправить</button>
                                    <button
                                        v-if="currentChat && currentChat.btnData"
                                        @click="btnAction(currentChat.btnData.action)"
                                        href=""
                                        class="btn btn-secondary">{{ currentChat.btnData.title }}</button>
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
</template>
<script>
import {reactive, ref} from "vue";

    import User from '../../services/api/User.vue'
    import Platforms from '../../services/api/Platforms.vue'
    import moment from "moment";
    import axios from "axios";

    export default{
        props:['currentItem'],
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
                uploadFileTitle: ref('Прикрепите файл'),

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
        },
        methods: {
            sendStatistics(){
                var formData = new FormData;

                for (let k in this.bloggerStatistics){
                    if(this.bloggerStatistics)
                        formData.append(k, this.bloggerStatistics[k])
                }

                var images = $('.statistics-file')

                images.each((i, v) => {
                    if($(v)[0].files)
                        formData.append('images[' + i + ']', $(v)[0].files[0])
                })

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
            btnAction(action){
                if(!action){
                    return
                }

                if(action != 'stats'){
                    axios({
                        method: 'get',
                        url: '/api/works/' + this.currentChat.id + '/' + action,
                    })
                    .then(() => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Статус проекта успешо изменен.'
                        })
                    })
                    .catch(() => {
                        notify('error', {
                            title: 'Внимание!',
                            message: 'Не удалось изменить статус проекта, попробуйте позже.'
                        })
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

                this.uploadFileTitle = 'Файл прикреплен';

                this.currentMessage.file = files[0];
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

                    axios({
                        method: 'post',
                        url: 'api/users/' + this.user.id + '/works/' + this.currentChat.id + '/messages',
                        data: formData
                    })
                    .then(response => {
                        this.currentMessage.message = null;

                        $('#chat-upload').val(null)
                        $('#chat-upload').closest('.textarea-upload').find('.textarea-upload__text').text('Прикрепите файл')

                        resolve(true);
                    })
                    .catch((errors) => {
                        notify('error', {
                            title: 'Внимание!',
                            message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                        })

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

                this.uploadFileTitle = 'Прикрепите файл';

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

                return this.currentChat.partner_user.name;
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
                else if(work && work.status == 'progress'){
                    if(work.project_work.type != 'feedback' && work.statistics == null){
                        console.log(work, this.user.role)
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
            }
        }
    }
</script>
