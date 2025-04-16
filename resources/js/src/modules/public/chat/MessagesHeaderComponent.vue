<template>
    <div class="chat__header">
        <div
            @click="backToChats"
            class="chat__back">
            <img src="/img/arrow-alt.svg" alt="">
        </div>

        <ProjectSignboard
            v-if="chat && chat.project"
            :project="chat.project"
            :workType="getWorkType()"
        ></ProjectSignboard>

        <div
            @click="isOptionsOpen = !isOptionsOpen"
            :class="['chat__opts', (isOptionsOpen ? 'active' : '')]">
            <img src="/img/dots-icon.svg" alt="">
            <div class="chat__opts-items">
                <div class="chat__opts-partner">
                    <div
                        v-if="chat"
                        class="chat__opts-partner__row">
                        <div
                            :style="'background-image:url(' + ((chat.partner_user && chat.partner_user.image) ? chat.partner_user.image : '/img/profile-icon.svg') + ')'"
                            class="chat__opts-partner__img">
                        </div>
                        <div
                            class="chat__opts-partner__col">
                            <span class = "chat__opts-partner__role">{{ chat.partner_user.name }}</span>
                            <span class = "chat__opts-partner__name">{{ (chat.partner_user.role == 'blogger' ? 'Блогер' : 'Селлер') }}</span>
                        </div>
                    </div>
                </div>
                <div
                    v-if="chat && chat.btnData && chat.btnData.action"
                    @click="chatAction(chat.btnData.action)"
                    :class="'chat__opts-item ' + (chat.btnData.action ? '' : 'chat__opts-item--disabled')"
                >
                    {{ chat.btnData.title }}
                </div>
                <div
                    v-if="this.user.role === 'seller'"
                    class="chat__opts-item"
                    @click="sendOfferPopup"
                >
                    Предложить заказ
                </div>
                <div
                    v-if="chat && !(chat.canceled_by_seller_at && chat.canceled_by_blogger_at)"
                    @click="chatAction('cancel')"
                    class="chat__opts-item chat__opts-item--cancel">
                    Отменить работу
                </div>
            </div>
        </div>
        <SendOffer ref="sendOfferPopup"></SendOffer>
    </div>
</template>
<script>
import {ref} from 'vue'

import User from '../../../core/services/api/User.vue'

import SendOffer from '../../../core/components/popups/seller-send-offer/SendOfferPopup'

import ProjectSignboard from './MessagesHeaderProjectComponent'

export default {
    props:['chat'],
    components:{ ProjectSignboard, SendOffer },
    data(){
        return {
            isOptionsOpen: ref(false),
            user: null,

            User
        }
    },
    created(){
        this.user = this.User.getCurrent()
    },
    methods:{
        backToChats(){
            this.$emit('backToChats')
        },
        chatAction(action){
            this.$emit('chatAction', action)
        },
        getWorkType(){
            const chat = this.chat;
            const typeFromWork = (chat.project_works && chat.project_works.length > 0) ? chat.project_works[0].name : false;
            const typeFromProject = (chat.project.project_works && chat.project.project_works.length > 0) ? chat.project.project_works[0].name : false;

            if(typeFromWork) return typeFromWork;

            if(typeFromProject) return typeFromProject;

            return 'Неизвестно'
        },
        sendOfferPopup(){
            this.$refs.sendOfferPopup.show(null, null, this.chat.id)
        }
    }
}
</script>
