<template>
    <div
        :data-id="work.id"
        v-on:click="chooseChat(work)"
        :class="'chat__chat-item item-chat ' + (isCurrent && 'current')"
        style="position:relative">

        <div class="item-chat__img" :style="'background-image: url(' + work.partner_user.image + ')'">
        </div>

        <div class="item-chat__text">
            <div class="item-chat__title">{{ work.product_name || 'Проект удалён' }}</div>
            <div class="item-chat__last-msg">
                <p>{{ userRole == 'blogger' ? 'Селлер' : 'Блогер' }}: {{ work.partner_user.name }}</p>
                <p>ID проекта: {{ work.id }}</p>
            </div>
        </div>

        <div
            v-if="work.new_messages_count > 0"
            class="nav-menu__item-notifs notifs" style="">{{ work.new_messages_count }}</div>

    </div>
</template>
<script>
export default {
    props:['work', 'userRole', 'isCurrent'],
    methods:{
        chooseChat(work){
            this.$emit('chooseChat', work)
        }
    }
}
</script>
