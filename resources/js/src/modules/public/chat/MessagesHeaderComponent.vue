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
            :workType="chat.project_work.name"
        ></ProjectSignboard>

        <div
            @click="isOptionsOpen = !isOptionsOpen"
            :class="'chat__opts ' + (isOptionsOpen && 'active')">
            <img src="img/dots-icon.svg" alt="">
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
                    v-if="chat && !(chat.canceled_by_seller_at && chat.canceled_by_blogger_at)"
                    @click="chatAction('cancel')"
                    class="chat__opts-item chat__opts-item--cancel">
                    Отменить работу
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue'

import ProjectSignboard from './MessagesHeaderProjectComponent'

export default {
    props:['chat'],
    components:{ ProjectSignboard },
    data(){
        return {
            isOptionsOpen: ref(false)
        }
    },
    methods:{
        backToChats(){
            this.$emit('backToChats')
        },
        chatAction(action){
            this.$emit('chatAction', action)
        }
    }
}
</script>
