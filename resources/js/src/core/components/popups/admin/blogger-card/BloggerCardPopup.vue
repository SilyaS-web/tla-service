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
                                v-if="currentTab === 'blogger-data'"
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
                                            ></Input>
                                            <Input
                                                v-model="blogger.city"
                                                :label="'Город'"
                                                :inputType="'text'"
                                                :inputPlaceholder="'Город'"
                                                :inputClassList="['input--city']"
                                                :inputID="'city'"
                                                :error="(errors && errors.city ? errors.city : '')"
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

                                        <Textarea
                                            v-model="blogger.description"
                                            :label="'Описание канала'"
                                            :classList="[]"
                                            :id="'desc'"
                                            :cols="30"
                                            :rows="10"
                                            :placeholder="'Введите описание канала'"
                                            :error="(errors && errors.description ? errors.description : '')"
                                        ></Textarea>

                                        <ChooseThemeBlock
                                            v-model="blogger.themes"
                                            :themes="blogger.themes"
                                            :maxThemesLength="3"
                                        ></ChooseThemeBlock>

                                        <div class="form-group" >
                                            <label>Аватар пользователя</label>
                                            <div class="data-blogger__image">
                                                <img
                                                    v-if="blogger.user.image"
                                                    :src="blogger.user.image"
                                                >
                                                <div class="data-blogger__image-load">
                                                    <input type="file" hidden>

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
                                v-if="currentTab === 'chats-data'"
                                class="admin-blogger__chats chats-blogger">
                                <!--                                <div class="chat__left">-->
                                <!--                                    <ChatsListComponent-->
                                <!--                                        :works="works"-->
                                <!--                                        :userRole="user.role"-->
                                <!--                                        :currentChatID="currentChat && currentChat.id"-->

                                <!--                                        v-on:chooseChat="chooseChat"-->
                                <!--                                    ></ChatsListComponent>-->
                                <!--                                </div>-->
                                <!--                                <div class="chat__right">-->
                                <!--                                    <MessagesList-->
                                <!--                                        :messages="messages"-->
                                <!--                                        :user="user"-->
                                <!--                                        :chatWorks="currentChat ? currentChat.project_works : false"-->
                                <!--                                        :chatStatus="currentChat ? currentChat.status : false"-->
                                <!--                                        :statistics="currentChat ? currentChat.statistics : false"-->
                                <!--                                        :partnerName="currentChat ? currentChat.partner_user.name : ''"-->
                                <!--                                    ></MessagesList>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </popup-modal>
</template>

<script>
import axios from "axios";
import {ref} from "vue";

import Blogger from '../../../../services/api/Blogger.vue'

import PopupModal from "../../AppPopup.vue";
import InputFile from "../../../form/InputFileBlockComponent.vue";
import Select from "../../../form/SelectBlockComponent.vue";
import ChooseThemeBlock from "../../../choose-theme/index.vue";
import Input from "../../../form/InputBlockComponent.vue";
import Textarea from "../../../form/TextareaBlockComponent.vue";
import ChatsListComponent from "../../../../../modules/public/chat/ChatsListComponent.vue";
import MessagesList from "../../../../../modules/public/chat/MessagesListComponent.vue";

export default {
    name: "BloggerCardPopup",
    components: {
        MessagesList, ChatsListComponent, Textarea, Input,
        ChooseThemeBlock, Select, InputFile, PopupModal
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

            works: ref([]),
            currentChat: ref(null),
            messages: ref([]),

            user: ref(null),

            currentTab: ref('blogger-data'),

            Blogger
        }
    },
    methods: {
        show(bloggerID) {
            this.$refs.popup.open()

            this.bloggerID = bloggerID

            this.Blogger.getItem(this.bloggerID).then(blogger => {
                const themes = blogger.themes.map(theme => theme.theme_id)
                const countryID = blogger.country.id

                this.blogger = blogger;
                this.blogger.themes = themes
                this.blogger.country_id = countryID
            })

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        getChats() {
        },
        getMessages() {
        },
        saveBlogger() {
        },
        chooseChat() {
        },
        mapCountriesArray() {
            return this.countries.map(country => {
                return {
                    name: country.name,
                    value: country.id
                }
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
}

.data-blogger__form {
    max-width: unset;
    padding: 20px 16px;
}

</style>
