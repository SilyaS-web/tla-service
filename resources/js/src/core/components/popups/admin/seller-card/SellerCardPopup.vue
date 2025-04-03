<template>
    <popup-modal id="admin-seller-card" ref="popup">
        <div class="admin-seller">
            <div class="admin-seller__container">
                <div class="admin-seller__content">
                    <div class="admin-seller__body">
                        <div class="admin-seller__tabs">
                            <div
                                @click="currentTab = 'seller-data'"
                                :class="[
                                    'admin-seller__tabs-item',
                                    (currentTab === 'seller-data' ? 'active' : '')
                                ]">
                                Данные селлера
                            </div>
                            <div
                                @click="currentTab = 'projects'"
                                :class="[
                                    'admin-seller__tabs-item',
                                    (currentTab === 'projects' ? 'active' : '')
                                ]">
                                Проекты
                            </div>
                            <div
                                @click="currentTab = 'chats-data'"
                                :class="[
                                    'admin-seller__tabs-item',
                                    (currentTab === 'chats-data' ? 'active' : '')
                                ]">
                                Чаты
                            </div>
                        </div>
                        <div class="admin-seller__tabs-content">
                            <div
                                v-show="currentTab === 'seller-data'"
                                class="admin-seller__data data-seller">
                                <div class="data-seller__content">
                                    <div class="data-seller__form form auth__form">
                                        <div class="form__row">
                                            <Input
                                                v-model="seller.user.name"
                                                :label="'Имя'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Имя пользователя'"
                                                :inputClassList="['input--name']"
                                                :inputID="'name'"
                                                :error="(errors && errors.name ? errors.name[0] : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Input
                                                v-model="seller.user.email"
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
                                                v-model="seller.user.phone"
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
                                                v-model="seller.inn"
                                                :label="'ИНН'"
                                                :inputType="'inn'"
                                                :inputPlaceholder="'ИНН'"
                                                :inputClassList="['input--inn']"
                                                :inputID="'inn'"
                                                :error="(errors && errors.inn ? errors.inn : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                        </div>

                                        <div class="form__row">
                                            <Input
                                                v-model="seller.organization_name"
                                                :label="'Название организации'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Название организации'"
                                                :inputClassList="['input--organization_name']"
                                                :inputID="'organization_name'"
                                                :error="(errors && errors.organization_name ? errors.organization_name : '')"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Select
                                                v-model="seller.organization_type"
                                                :label="'Тип организации'"
                                                :selectClassList="[]"
                                                :selectID="'organization_type'"
                                                :optionsList="[
                                                    {
                                                        name: 'ООО',
                                                        value: 'ООО',
                                                    },
                                                    {
                                                        name: 'ИП',
                                                        value: 'ИП',
                                                    },
                                                    {
                                                        name: 'ОАО',
                                                        value: 'ОАО',
                                                    },
                                                ]"
                                                :style="{width:'calc(50% - 4px)'}"
                                                :error="errors.organization_type">
                                            </Select>
                                        </div>

                                        <div class="form__row">
                                            <Input
                                                v-model="seller.wb_link"
                                                :label="'Ссылка на магазин WB'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Ссылка на магазин WB'"
                                                :inputClassList="[]"
                                                :inputID="'wb_link'"
                                                :error="errors.wb_link"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Input
                                                v-model="seller.wb_api_key"
                                                :label="'Ключ API WB'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Ключ API WB'"
                                                :inputClassList="[]"
                                                :inputID="'wb_api_key'"
                                                :error="errors.wb_api_key"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                        </div>

                                        <div class="form__row">
                                            <Input
                                                v-model="seller.ozon_link"
                                                :label="'Ссылка на магазин OZON'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Ссылка на магазин OZON'"
                                                :inputClassList="[]"
                                                :inputID="'ozon_link'"
                                                :error="errors.ozon_link"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Input
                                                v-model="seller.ozon_client_id"
                                                :label="'Client ID OZON'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Client ID OZON'"
                                                :inputClassList="[]"
                                                :inputID="'ozon_client_id'"
                                                :error="errors.ozon_client_id"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                            <Input
                                                v-model="seller.ozon_api_key"
                                                :label="'Ключ API OZON'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Ключ API OZON'"
                                                :inputClassList="[]"
                                                :inputID="'ozon_api_key'"
                                                :error="errors.ozon_api_key"
                                                :style="{width:'calc(50% - 4px)'}"
                                            ></Input>
                                        </div>

                                        <div class="form-group" >
                                            <label>Аватар пользователя</label>
                                            <div class="data-seller__image">
                                                <div
                                                    v-if="seller.user.image"
                                                    class="data-seller__image-image">
                                                    <img
                                                        @click="showFullscreenImage"
                                                        :src="seller.user.image"
                                                        alt=""
                                                    >
                                                    <a
                                                        @click="deleteUserImage"
                                                        href="#" class="data-seller__image-delete">
                                                        <img src="/img/close-icon.svg" alt="">
                                                    </a>
                                                </div>
                                                <div
                                                    v-else
                                                    @click="triggerUpload"
                                                    class="data-seller__image-load">
                                                    <input
                                                        @change="uploadUserImage"
                                                        type="file" hidden>
                                                    <img src="/img/plus-icon.svg" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-btns auth__form-btns" style="margin-top:32px">
                                            <button
                                                @click="saveSeller"
                                                class="btn btn-primary">
                                                Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-show="currentTab === 'projects'"
                                class="admin-seller__projects">
                                <div class="admin-seller__projects-items _scrollable">
                                    <ProjectCard
                                        v-for="project in projects"
                                        :id="project.id"
                                        :name="project.product_name"
                                        :price="project.product_price"
                                        :works="project.project_works"
                                        :imgs="project.project_files"
                                    ></ProjectCard>
                                </div>
                            </div>
                            <div
                                v-show="currentTab === 'chats-data'"
                                class="admin-seller__chats chats-seller">
                                <div class="chat__left">
                                    <ChatsListComponent
                                        :works="works"
                                        :userRole="seller.user.role"
                                        :currentChatID="currentChat && currentChat.id"

                                        v-on:chooseChat="chooseChat"
                                    ></ChatsListComponent>
                                </div>
                                <div class="chat__right">
                                    <MessagesList
                                        :messages="messages"
                                        :user="seller.user"
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
import {ref} from "vue";

import Seller from '../../../../services/api/Seller.vue'
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
import ProjectCard from '../../../project-card/index.vue'

import Loader from "../../../../services/AppLoader.vue";

export default {
    name: "sellerCardPopup",
    components: {
        MessagesList, ChatsListComponent, Textarea, Input,
        ChooseThemeBlock, Select, InputFile, PopupModal, FullScreenMedia, ProjectCard
    },
    data() {
        return {
            sellerID: null,
            seller: ref({
                user: {}
            }),
            errors: ref({}),

            projects: ref([]),

            works: ref([]),
            currentChat: ref(null),
            messages: ref([]),

            user: ref(null),

            currentTab: ref('seller-data'),

            Seller, User, Loader
        }
    },
    methods: {
        async show(sellerID) {
            this.$refs.popup.open()

            setTimeout(() => { this.Loader.loaderOn('.admin-seller') }, 100)

            this.sellerID = sellerID

            await this.Seller.getItem(this.sellerID).then(seller => {
                this.seller = seller;
            })

            await this.User.getWorks(this.seller.user.id).then(chats => {
                this.works = chats;
                this.currentChat = this.works[0]

                this.getMessages()
            })

            await this.User.getProjects(this.seller.user.id, {}).then(projects => {
                this.projects = projects
            })

            this.Loader.loaderOff('.admin-seller')

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        getChats() {
            this.currentChat = null;
            this.User.getWorks(this.seller.user.id).then(chats => {
                this.works = chats
            })
        },
        chooseChat(chat) {
            this.currentChat = chat;

            this.getMessages()
        },
        getMessages() {
            this.User.getMessages(this.currentChat.id, this.seller.user.id, 1).then(data => {
                this.messages = (data || [])
            })
        },
        saveSeller() {
            let data = {
                name: this.seller.user.name,
                email: this.seller.user.email,
                inn: this.seller.inn,
                organization_name: this.seller.organization_name,
                organization_type: this.seller.organization_type,
                ozon_api_key: this.seller.ozon_api_key,
                ozon_client_id: this.seller.ozon_client_id,
                ozon_link: this.seller.ozon_link,
                wb_api_key: this.seller.wb_api_key,
                wb_link: this.seller.wb_link,
            };

            this.Seller.update(this.seller.id, data).then(() => {
                this.$refs.popup.close()
                this.resolvePromise(true)
            })
            .catch((errors) => { this.errors = errors })
        },

        deleteUserImage(){
            const data = {
                image: null
            }

            this.User.update(this.seller.user.id, data).then(() => { this.seller.user.image = null })
        },
        triggerUpload(e){ $(e.target).find('input[type="file"]').click() },
        uploadUserImage(e){
            const file = e.target.files[0];

            const data = {
                image: file
            }

            this.User.update(this.seller.user.id, data).then((url) => { this.seller.user.image = `/storage/${url}` })
        },
        showFullscreenImage(){ this.$refs.fullscreenMedia.show({imageUrl: this.seller.user.image}) },
        showFullscreenVideo(src){ this.$refs.fullscreenMedia.show({videoUrl: `/storage/${src}`}) },
    }
}
</script>

<style scoped>
.admin-seller {
    width: 100%;
}

.admin-seller__container {
    width: 100%;
    padding: 0 10px;
}

.admin-seller__content {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.admin-seller__body {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.admin-seller__tabs {
    display: flex;
    align-items: center;
    gap: 3px;
}

.admin-seller__tabs-item {
    padding: 12px;
    font-weight: 500;
    font-size: 14px;
    background-color: rgba(0, 0, 0, .05);
    color: rgba(0, 0, 0, .4);
    transition: all .1s linear;
    border-radius: 8px;
    cursor: pointer;
}

.admin-seller__tabs-item:hover {
    background-color: var(--primary);
    color: #fff;
}

.admin-seller__tabs-item.active {
    background-color: var(--primary);
    color: #fff;
}

.admin-seller__tabs-content {
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: 8px;
    padding: 12px;
}

.data-seller__form {
    max-width: unset;
    padding: 20px 16px;
}

.chats-seller{
    display:flex;
}

.data-seller__image-load{
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
.data-seller__image-load img{
    width: 20px;
    height: 20px;
}
.data-seller__image-image{
    position: relative;
    width: fit-content;
}
.data-seller__image-image img{
    width: 120px;
    height: 120px;
    border-radius: 6px;
    cursor: pointer;
    object-fit: cover;
}
.data-seller__image-delete{
    width: 18px;
    height: 18px;
    position: absolute;
    top: -5px;
    right:10px;
    opacity: 0;
    transition: all .1s linear;
}
.data-seller__image-delete img{
    width: 18px;
    height: 18px;
}
.data-seller__image-image:hover .data-seller__image-delete{
    top:10px;
    opacity: 1;
}

.admin-seller__projects-items{
    display: flex;
    gap: 5px;
    max-height:648px;
    overflow-y:auto;
    flex-wrap:wrap;
}

</style>
