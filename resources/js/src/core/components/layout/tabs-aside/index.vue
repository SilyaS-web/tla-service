<template>
    <div class="profile__navigation nav-menu">
        <div class="nav-menu__body">
            <div class="nav-menu__items">
                <ListItem
                    v-for="tab in tabs"
                    :tabName="tab.tabName"
                    :tabContentName="tab.tabContent"
                    :notifications="tab.notifications"
                    :isActive="tab.isActive"
                    :classList="tab.classList"

                    @switchTab="switchTab"
                ></ListItem>
            </div>
        </div>
        <div class="nav-menu__close">
            <img src="/img/arrow-alt.svg" alt="">
        </div>
    </div>
</template>
<script>
import ListItem from "./ListItem.vue";

export default{
    props:['tabs'],
    components: {ListItem},
    methods:{
        switchTab(link){
            $('.nav-menu__item').removeClass('active')
            $(`#${link}-tab`).addClass('active')

            this.$emit('switchTab', link)
        }
    }
}
</script>
