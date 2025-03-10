<template>
    <popup-modal id="admin-blogger-card" ref="popup">
        <div class="admin-blogger">
            <div class="admin-blogger__container">
                <div class="admin-blogger__content">
                    <div class="admin-blogger__body">
                        <div class="admin-blogger__tabs">
                            <div
                                @click="currentTab = 'blogger-data'"
                                :class="[
                                    'admin-blogger__tabs-item',
                                    (currentTab === 'blogger-data' ? 'active' : '')
                                ]">
                                Данные блогера
                            </div>
                            <div
                                @click="currentTab = 'chats-data'"
                                :class="[
                                    'admin-blogger__tabs-item',
                                    (currentTab === 'chats-data' ? 'active' : '')
                                ]">
                                Чаты
                            </div>
                        </div>
                        <div class="admin-blogger__tabs-content">
                            <div
                                v-show="currentTab === 'blogger-data'"
                                class="admin-blogger__data data-blogger">
                                <div class="data-blogger__content">
                                    <div class="data-blogger__form form auth__form">
                                        <div class="form__row">
                                            <Input
                                                v-model="blogger.user.name"
                                                :label="'Имя'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Имя пользователя'"
                                                :inputClassList="['input--name']"
                                                :inputID="'name'"
                                                :error="(errors && errors.name ? errors.name[0] : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Input
                                                v-model="blogger.user.email"
                                                :label="'E-mail'"
                                                :inputType="'email'"
                                                :inputPlaceholder="'Почта пользователя'"
                                                :inputClassList="['input--email']"
                                                :inputID="'email'"
                                                :error="(errors && errors.email ? errors.email[0] : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                        </div>
                                        <div class="form__row">
                                            <Input
                                                v-model="blogger.user.phone"
                                                :label="'Номер телефона'"
                                                :inputType="'phone'"
                                                :inputPlaceholder="'+79000000000'"
                                                :inputClassList="['input--phone']"
                                                :inputID="'phone'"
                                                :error="(errors && errors.phone ? errors.phone[0] : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                                :disabled="1"
                                            ></Input>
                                            <Input
                                                v-model="blogger.city"
                                                :label="'Город'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Город'"
                                                :inputClassList="['input--city']"
                                                :inputID="'city'"
                                                :error="(errors && errors.city ? errors.city[0] : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                        </div>
                                        <div class="form__row">
                                            <Select
                                                v-model="blogger.country_id"
                                                :label="'Страна (Страны СНГ)'"
                                                :selectClassList="['input--country']"
                                                :selectID="'country'"
                                                :optionsList="mapCountriesArray()"
                                                :style="{width:'calc(50% - 4px)'}"
                                                :error="errors.country_id">
                                            </Select>
                                            <Select
                                                v-model="blogger.sex"
                                                :label="'Пол'"
                                                :selectClassList="['input--sex']"
                                                :selectID="'sex'"
                                                :style="{width:'calc(50% - 4px)'}"
                                                :optionsList="[
                                                {
                                                    name: 'Мужской',
                                                    value: 'male',
                                                },
                                                {
                                                    name: 'Женский',
                                                    value: 'female',
                                                },
                                            ]"
                                                :error="(errors && errors.sex ? errors.sex : '')">
                                            </Select>
                                        </div>

                                        <div class="form__row">
                                             <Textarea
                                                 v-model="blogger.description"
                                                 :label="'Описание канала'"
                                                 :classList="[]"
                                                 :id="'desc'"
                                                 :cols="30"
                                                 :rows="10"
                                                 :placeholder="'Введите описание канала'"
                                                 :style="{width:'calc(50% - 4px)'}"
                                                 :error="(errors && errors.description ? errors.description : '')"
                                             ></Textarea>

                                            <ChooseThemeBlock
                                                v-model="blogger.themes"
                                                :themes="blogger.themes"
                                                :style="{width:'calc(50% - 4px)'}"
                                                :maxThemesLength="3"
                                            ></ChooseThemeBlock>
                                        </div>

                                        <div class="form-group" >
                                            <label>Контент пользователя</label>
                                            <div class="data-blogger__content">
                                                <div class="blogger-popup__upload-content blogger-content">
                                                    <div
                                                        :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[0]))"
                                                        @click="uploadCardContent(cardsVideoContent[0], $event)">
                                                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                                        <div class="blogger-content__progress-bar">
                                                            <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[0].progress + '%' }">
                                                            </div>
                                                        </div>
                                                        <video
                                                            @click="showFullscreenVideo(cardsVideoContent[0].src)"
                                                            src="" class="blogger-content__video" loop autoplay muted>
                                                            <source src="" type="video/mp4" />
                                                        </video>
                                                        <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[0], 0, $event)">
                                                            <img src="/img/close-icon.svg" alt="">
                                                        </div>
                                                        <input type="file" hidden @change="saveCardContent(0, $event)">
                                                    </div>
                                                    <div
                                                        :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[1]))"
                                                        @click="uploadCardContent(cardsVideoContent[1], $event)">
                                                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                                        <div class="blogger-content__progress-bar">
                                                            <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[1].progress + '%' }">
                                                            </div>
                                                        </div>
                                                        <video @click="showFullscreenVideo(cardsVideoContent[1].src)" src="" class="blogger-content__video" loop autoplay muted>
                                                            <source src="" type="video/mp4" />
                                                        </video>
                                                        <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[1], 1, $event)">
                                                            <img src="/img/close-icon.svg" alt="">
                                                        </div>
                                                        <input type="file" hidden @change="saveCardContent(1, $event)">
                                                    </div>
                                                    <div
                                                        :class="'blogger-content__card ' + (getCardClass(cardsVideoContent[2]))"
                                                        @click="uploadCardContent(cardsVideoContent[2], $event)">
                                                        <img src="/img/plus-icon.svg" alt="" class="blogger-content__plus">
                                                        <div class="blogger-content__progress-bar">
                                                            <div class="blogger-content__progress-progress" :style="{ width: cardsVideoContent[2].progress + '%' }">
                                                            </div>
                                                        </div>
                                                        <video @click="showFullscreenVideo(cardsVideoContent[2].src)" src="" class="blogger-content__video" loop autoplay muted>
                                                            <source src="" type="video/mp4" />
                                                        </video>
                                                        <div class="blogger-content__video-remove" @click="removeCardContent(cardsVideoContent[2], 2, $event)">
                                                            <img src="/img/close-icon.svg" alt="">
                                                        </div>
                                                        <input type="file" hidden @change="saveCardContent(2, $event)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" >
                                            <label>Аватар пользователя</label>
                                            <div class="data-blogger__image">
                                                <div
                                                    v-if="blogger.user.image"
                                                    class="data-blogger__image-image">
                                                    <img
                                                        @click="showFullscreenImage"
                                                        :src="blogger.user.image"
                                                        alt=""
                                                    >
                                                    <a
                                                        @click="deleteUserImage"
                                                        href="#" class="data-blogger__image-delete">
                                                        <img src="/img/close-icon.svg" alt="">
                                                    </a>
                                                </div>
                                                <div
                                                    v-else
                                                    @click="triggerUpload"
                                                    class="data-blogger__image-load">
                                                    <input
                                                        @change="uploadUserImage"
                                                        type="file" hidden>
                                                    <img src="/img/plus-icon.svg" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-btns auth__form-btns" style="margin-top:32px">
                                            <button
                                                @click="saveBlogger"
                                                class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-show="currentTab === 'chats-data'"
                                class="admin-blogger__chats chats-blogger">
                                <div class="chat__left">
                                    <ChatsListComponent
                                        :works="works"
                                        :userRole="blogger.user.role"
                                        :currentChatID="currentChat && currentChat.id"

                                        v-on:chooseChat="chooseChat"
                                    ></ChatsListComponent>
                                </div>
                                <div class="chat__right">
                                    <MessagesList
                                        :messages="messages"
                                        :user="blogger.user"
                                        :chatWorks="currentChat ? currentChat.project_works : false"
                                        :chatStatus="currentChat ? currentChat.status : false"
                                        :statistics="currentChat ? currentChat.statistics : false"
                                        :partnerName="currentChat ? currentChat.partner_user.name : ''"
                                    ></MessagesList>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <FullScreenMedia ref="fullscreenMedia"></FullScreenMedia>
        </div>
    </popup-modal>
</template>

<script>
import axios from "axios";
import {ref} from "vue";

import Blogger from '../../../../services/api/Blogger.vue'
import User from '../../../../services/api/User.vue'

import PopupModal from "../../AppPopup.vue";
import FullScreenMedia from '../../../popups/fullscreen-asset/AssetPopup.vue'
import InputFile from "../../../form/InputFileBlockComponent.vue";
import Select from "../../../form/SelectBlockComponent.vue";
import ChooseThemeBlock from "../../../choose-theme/index.vue";
import Input from "../../../form/InputBlockComponent.vue";
import Textarea from "../../../form/TextareaBlockComponent.vue";
import ChatsListComponent from "../../../../../modules/public/chat/ChatsListComponent.vue";
import MessagesList from "../../../../../modules/public/chat/MessagesListComponent.vue";

import Loader from "../../../../services/AppLoader.vue";

export default {
    name: "BloggerCardPopup",
    components: {
        MessagesList, ChatsListComponent, Textarea, Input,
        ChooseThemeBlock, Select, InputFile, PopupModal, FullScreenMedia
    },
    data() {
        return {
            bloggerID: null,
            blogger: ref({
                user: {}
            }),
            errors: ref({}),

            countries: [
                {
                    id: 1,
                    name: 'Россия'
                },
            ],

            cardsVideoContent: ref([
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
                {
                    'id': null,
                    'src': null,
                    'progress': null
                },
            ]),

            works: ref([]),
            currentChat: ref(null),
            messages: ref([]),

            user: ref(null),

            currentTab: ref('blogger-data'),

            resolvePromise: undefined,
            rejectPromise: undefined,

            Blogger, User, Loader
        }
    },
    methods: {
        async show(bloggerID) {
            this.$refs.popup.open()

            this.bloggerID = bloggerID

            setTimeout(() => { this.Loader.loaderOn('.admin-blogger') }, 100)

            await this.Blogger.getItem(this.bloggerID).then(blogger => {
                const themes = blogger.themes.map(theme => theme.theme_id)
                const countryID = blogger.country.id

                this.blogger = blogger;
                this.blogger.themes = themes
                this.blogger.country_id = countryID
            })

            await this.User.getWorks(this.blogger.user.id).then(chats => {
                this.works = chats;
                this.currentChat = this.works.length > 0 ? this.works[0] : null

                if(this.currentChat) this.getMessages()
            })

            let videosNodeList = $(document).find('.blogger-content__card video');

            this.cardsVideoContent = this.cardsVideoContent.map((item, index) => {
                if(!this.blogger.content[index]) {
                    return {
                        'id': null,
                        'src': null,
                        'progress': null
                    }
                }

                videosNodeList[index].src = '/' + this.blogger.content[index].path;
                videosNodeList[index].load();

                return {
                    'id': this.blogger.content[index].id,
                    'src': this.blogger.content[index].path,
                    'progress': 100
                }
            })

            this.Loader.loaderOff('.admin-blogger')

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        getChats() {
            this.currentChat = null;
            this.User.getWorks(this.blogger.user.id).then(chats => {
                this.works = chats
            })
        },
        chooseChat(chat) {
            this.currentChat = chat;

            this.getMessages()
        },
        getMessages() {
            this.User.getMessages(this.currentChat.id, this.blogger.user.id, 1).then(data => {
                this.messages = (data || [])
            })
        },

        saveBlogger() {
            const data = {
                name: this.blogger.user.name,
                email: this.blogger.user.email,
                sex: this.blogger.sex,
                city: this.blogger.city,
                country_id: this.blogger.country_id,
                description: this.blogger.description,
                themes: this.blogger.themes,
            };

            this.Blogger.update(this.blogger.id, data).then(() => {
                this.$refs.popup.close()
                this.resolvePromise(true)
            })
            .catch((errors) => { this.errors = errors })
        },

        mapCountriesArray() {
            return this.countries.map(country => {
                return {
                    name: country.name,
                    value: country.id
                }
            })
        },

        deleteUserImage(){
            this.User.update(this.blogger.user.id, {}).then(() => { this.blogger.user.image = null })
        },
        triggerUpload(e){ $(e.target).find('input[type="file"]').click() },
        uploadUserImage(e){
            const file = e.target.files[0];

            const data = {
                image: file
            }

            this.User.update(this.blogger.user.id, data).then((url) => { this.blogger.user.image = `/storage/${url}` })
        },
        showFullscreenImage(){ this.$refs.fullscreenMedia.show({imageUrl: this.blogger.user.image}) },
        showFullscreenVideo(src){ this.$refs.fullscreenMedia.show({videoUrl: `/storage/${src}`}) },

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
                formdata = new FormData;

            if(file && file.files[0])
                formdata.append('videos[0]', file.files[0]);

            axios({
                method: 'post',
                url: '/api/bloggers/' + this.blogger.id + '/content',
                data: formdata,
                onUploadProgress: (progressEvent) => {
                    const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');

                    if (totalLength !== null) {
                        this.cardsVideoContent[cardContentIndex].progress = Math.round((progressEvent.loaded * 100) / totalLength)
                    }
                }
            })
            .then((result) => {
                this.cardsVideoContent[cardContentIndex].src = result.data[0].path
                this.cardsVideoContent[cardContentIndex].id = result.data[0].id
                this.cardsVideoContent[cardContentIndex].progress = 100

                $(event.target).closest('.blogger-content__card').find('video')[0].src = '/' + result.data[0].path;
                $(event.target).closest('.blogger-content__card').find('video')[0].load();
            })
            .catch((err) =>{
                let message = (err.response && err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно загрузить контент, попробуйте позже в личном кабинете';

                notify('error', {
                    title: 'Внимание!',
                    message: message
                })
            })
        },
        removeCardContent(cardContent, cardContentIndex, event){
            let videoId = this.cardsVideoContent[cardContentIndex].id,
                user = this.User.getCurrent();

            if(!videoId) return

            axios({
                method: 'delete',
                url: '/api/bloggers/' + user.blogger_id + '/content',
                data: {
                    videos: [videoId]
                }
            })
                .then((result) => {
                    this.cardsVideoContent[cardContentIndex] = {
                        'id': null,
                        'src': null,
                        'progress': null
                    };

                    $(event.target).closest('.blogger-content__card').find('input[type="file"]').val('');
                })
                .catch((err) =>{
                    let message = (err.response && err.response.data && err.response.data.message) ?
                        err.response.data.message :
                        'Невозможно почистить контент, попробуйте позже в личном кабинете';

                    notify('error', {
                        title: 'Внимание!',
                        message: message
                    })
                })
        },
    }
}
</script>

<style scoped>
.admin-blogger {
    width: 100%;
}

.admin-blogger__container {
    width: 100%;
    padding: 0 10px;
}

.admin-blogger__content {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.admin-blogger__body {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.admin-blogger__tabs {
    display: flex;
    align-items: center;
    gap: 3px;
}

.admin-blogger__tabs-item {
    padding: 12px;
    font-weight: 500;
    font-size: 14px;
    background-color: rgba(0, 0, 0, .05);
    color: rgba(0, 0, 0, .4);
    transition: all .1s linear;
    border-radius: 8px;
    cursor: pointer;
}

.admin-blogger__tabs-item:hover {
    background-color: var(--primary);
    color: #fff;
}

.admin-blogger__tabs-item.active {
    background-color: var(--primary);
    color: #fff;
}

.admin-blogger__tabs-content {
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: 8px;
    padding: 12px;
}

.data-blogger__form {
    max-width: unset;
    padding: 20px 16px;
}

.chats-blogger{
    display:flex;
}

.data-blogger__image-load{
    border:1px solid var(--primary);
    border-radius: 6px;
    padding: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 38px;
    height: 38px;
    cursor: pointer;
}
.data-blogger__image-load img{
    width: 20px;
    height: 20px;
    filter:invert(54%) sepia(90%) saturate(4926%) hue-rotate(259deg) brightness(92%) contrast(86%);
}
.data-blogger__image-image{
    position: relative;
    width: fit-content;
}
.data-blogger__image-image img{
    width: 120px;
    height: 120px;
    border-radius: 6px;
    cursor: pointer;
    object-fit: cover;
}
.data-blogger__image-delete{
    width: 18px;
    height: 18px;
    position: absolute;
    top: -5px;
    right:10px;
    opacity: 0;
    transition: all .1s linear;
}
.data-blogger__image-delete img{
    width: 18px;
    height: 18px;
}
.data-blogger__image-image:hover .data-blogger__image-delete{
    top:10px;
    opacity: 1;
}

</style>
