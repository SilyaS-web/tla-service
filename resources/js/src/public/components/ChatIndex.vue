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
                        <div class="chat__left">
                            <div class="chat__chat-items">
                                <div
                                    v-if="works.length > 0"
                                    v-for="work in works"
                                    :data-id="work.id"
                                    class="chat__chat-item item-chat" style="position:relative">
                                    <div class="item-chat__img" :style="'background-image: url(' + work.user.image + ')'">
                                    </div>
                                    <div class="item-chat__text">
                                        <div class="item-chat__title">{{ work.user.name }}</div>
                                        <div class="item-chat__last-msg">
                                            <p>Проект:</p>
                                            <span>{{ work.project ? work.project.product_name : 'Проект удалён' }}</span>
                                            <p>ID: {{ work.id }}</p>
                                        </div>
                                        <a href="#"
                                           :class="'item-chat__project-link' + (user.role == 'seller' ? 'item-chat__project-link--seller' : 'item-chat__project-link--blogger')"
                                           :data-project-id = "work.project.id || 0">
                                            Перейти к проекту
                                        </a>
                                    </div>
                                    <div
                                        v-if="work.new_messages_count > 0"
                                        class="nav-menu__item-notifs notifs" style="">{{ work.new_messages_count }}</div>
                                </div>
                                <p
                                    v-else
                                    class="chat__chat-empty">Чат пустой, <span style="color:var(--primary); cursor:pointer" onclick="(function(){ $(document).find('.nav-menu__item.project-link').click() })();">создайте проект</span> и начните работу с блогерами</p>
                            </div>
                        </div>
                        <div class="chat__right">
                            <div class="chat__overflow chat__overflow--completed" style="z-index: 1; display:none">
                                <div class="chat__overflow-text">
                                    Проект завершен
                                </div>
                            </div>
                            <div class="chat__overflow chat__overflow--tariff" style="z-index: 1; display:none">
                                <div class="chat__overflow-text">

                                </div>
                            </div>
                            <div class="chat__back">
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
                                            {{ message.user.name }}
                                        </div>
                                        <div class="messages-chat__item-date">
                                            {{ format_date(message.created_at, 'd.m.y H:i') }}
                                        </div>
                                    </div>
                                    <div class="messages-chat__item-msg">
                                        <span v-if="message.user_id == 1">
                                            {{ message.message }}
                                        </span>

                                        <div
                                            v-if="message.finishStats"
                                            class="messages-chat__item-stats">
                                            Просмотры: {{ message.finishStats.views }}
                                            Репосты: {{ message.finishStats.reposts }}
                                            Лайки: {{ message.finishStats.likes }}
                                        </div>
                                        <span v-else>
                                            {{ message.message }}
                                        </span>

                                        <img
                                            v-for="image in message.images"
                                            :src="image.link"
                                            alt="" class="chat-img-popup">
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
                                            Прикрепите файл
                                        </label>
                                        <input type="file" id = "chat-upload" hidden>
                                    </div>
                                    <textarea name="" id="" placeholder="Введите текст" class="messages-create__textarea textarea"></textarea>
                                </div>
                                <div class="chat__btns" style="display: flex; flex-wrap: wrap; gap:8px;">
                                    <button class="btn btn-primary btn-send-msg">Отправить</button>
                                    <a href="" class="btn btn-secondary btn-action" id="">Подтвердить выполнение проекта</a>
                                </div>
                            </div>

                            <div
                                v-if="!currentChatId"
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
</template>
<script>
    import {ref} from "vue";

    import User from '../../services/api/User.vue'
    import moment from "moment";

    export default{
        data(){
            return {
                works:ref([]),
                messages:ref([]),
                currentMessage: ref({
                    message: null,
                    file: null
                }),
                currentChatId: ref(null),
                user: ref(null),
                User
            }
        },
        mounted(){
            this.user = this.User.getCurrent();
            // this.loadChats();
        },
        methods: {
            sendMessage(){

            },
            loadChats(){
                return new Promise((resolve, reject) => {
                    this.User.getWorks(this.user.id).then(data => {
                        this.works = (data || []);

                        resolve(data)
                    })
                })
            },
            openChat(){

            },
            getMessageClass(message){
                if(message.user_id === 1){
                    return 'messages-chat__item--system'
                }
                if(message.user_id === this.user.id){
                    return 'messages-chat__item--author'
                }

                return '';
            },
            format_date(value){
                if (value) {
                    return moment(String(value)).format('DD.MM.YY H:i')
                }
            },
        }
    }
</script>
