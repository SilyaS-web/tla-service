<template>
    <BloggerCard
        v-if="blogger"

        :id="blogger.id"
        :image="blogger.user.image"
        :name="blogger.user.name"
        :platforms="blogger.platforms"
        :themes="blogger.themes"
        :description="blogger.description"
        :subscriber_quantity="blogger.summaryPlatform.subscriber_quantity"
        :coverage="blogger.summaryPlatform.coverage"
        :content="blogger.content"
        :is_achievement="blogger.is_achievement"
    >
        <div class="card__row" style="display: flex; gap: 6px; flex-wrap: wrap; align-items: center">
            <button
                v-if="blogger.user.status === 1"
                class="btn btn-primary" v-on:click="ban">
                Заблокировать
            </button>
            <button
                v-else-if="blogger.user.status === -1"
                class="btn btn-primary" v-on:click="unban">
                Разблокировать
            </button>
            <button class="btn btn-delete" v-on:click="deletionConfirmation">
                Удалить
            </button>
            <app-tooltip @click="toggleTooltip" ref="appTooltip">
                <a
                    href="#"
                    @click.prevent="showBloggerData"
                >Подробнее</a>
                <a
                    href="#"
                    @click.prevent="copyData"
                >Скопировать данные</a>
            </app-tooltip>
        </div>
    </BloggerCard>
    <blogger-card-popup ref="bloggerCardPopup"></blogger-card-popup>
    <blogger-data ref="bloggerData"></blogger-data>
</template>
<script>

import BloggerCardPopup from "../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../core/components/blogger-card/index";
import AppTooltip from "../../../core/components/AppTooltip.vue";

import BloggerData from '../../../core/components/popups/admin/blogger-card/BloggerCardPopup.vue'

export default{
    props: ['blogger'],
    components: { BloggerCard, BloggerCardPopup, BloggerData, AppTooltip },
    methods:{
        deletionConfirmation() {
            this.$emit('deletionConfirmation', this.blogger.user.id)
        },

        ban() {
            this.$emit('ban', this.blogger.user.id)
        },

        unban() {
            this.$emit('unban', this.blogger.user.id)
        },

        openBloggerInfoPopup(){
            this.$refs.bloggerCardPopup.show(this.blogger)
        },

        toggleTooltip(e){ this.$refs.appTooltip.show(e) },

        showBloggerData(){
            this.$refs.bloggerData.show(this.blogger.id).then(() => this.$emit('updateList'))
        },

        copyData(){
            if(navigator.clipboard !== undefined){
                const bloggerData = {
                    id: this.blogger.id,
                    user_id: this.blogger.user.id,
                    name: this.blogger.user.name,
                    phone: this.blogger.user.phone,
                    email: this.blogger.user.email,
                }

                navigator.clipboard.writeText(JSON.stringify(bloggerData)).then(function() {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Данные блогера скопированы в буфер обмена'
                    })
                });
            }
        }
    }
}
</script>

<style scoped>
</style>
