<template>
    <div class="chat__search" style="width:100%">
        <input
            v-model="chatSearchString"
            type="text"
            style="width:100%"
            class="input chat__search-input"
            placeholder="Введите ID проекта, Имя или Название проекта">
    </div>

    <div class="chat__chat-items">
        <ChatItem
            v-if="works"
            v-for="work in (chatSearchString ? works.filter(work => isChatSatisfying(work)) : works)"

            :work="work"
            :userRole="userRole"
            :isCurrent="isChatChoosed(work)"

            v-on:chooseChat="chooseChat"
        >
        </ChatItem>

        <p
            v-else
            class="chat__chat-empty">
            <span v-if="userRole == 'seller'">Чат пустой,создайте проект и начните работу с блогерами</span>
            <span v-else>Чат пустой, начните работу с селлерами</span>
        </p>
    </div>
</template>
<script>
import {ref} from "vue";

import ChatItem from './ChatItemComponent'

export default {
    props:['works', 'userRole', 'currentChatID'],
    components: { ChatItem },
    data(){
        return {
            chatSearchString: ref(null),
        }
    },
    methods:{
        chooseChat(work){
            this.$emit('chooseChat', work)
        },
        isChatChoosed(work){
            if(this.currentChatID == work.id) return true

            return work.currentWork;
        },
        isChatSatisfying(work){
            let searchString = this.chatSearchString.toLowerCase(),
                isWorkIDIncludesSearchString = String(work.id).indexOf(this.chatSearchString) !== -1,
                isProjectNameIncludesSearchString = false,
                isPartnerNameIncludesSearchString = false;

            if(work.project){
                let projectName = String(work.project.product_name).toLowerCase();

                isProjectNameIncludesSearchString = projectName.indexOf(searchString) !== -1
            }

            if(work.partner_user.name){
                let partnerName = String(work.partner_user.name).toLowerCase();

                isPartnerNameIncludesSearchString = partnerName.indexOf(searchString) !== -1
            }


            return isWorkIDIncludesSearchString || isProjectNameIncludesSearchString || isPartnerNameIncludesSearchString;
        },
    }
}
</script>
