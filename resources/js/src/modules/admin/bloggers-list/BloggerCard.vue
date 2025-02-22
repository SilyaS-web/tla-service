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
        <div class="card__row" style="text-align: center; justify-content:center">
            <a
                @click="openBloggerInfoPopup"
                target="_blank"
                class=""
                style="color:rgba(0,0,0,.4);
                            font-size:16px;
                            font-weight:500;
                            text-decoration:underline;
                            margin-top: -20px;">Подробнее</a>
        </div>
        <div class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
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
            <app-tooltip>

            </app-tooltip>
        </div>
    </BloggerCard>
    <blogger-card-popup ref="bloggerCardPopup"></blogger-card-popup>
</template>
<script>

import BloggerCardPopup from "../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../core/components/blogger-card/index";
import AppTooltip from "../../../core/components/AppTooltip.vue";

export default{
    props: ['blogger', 'bloggers'],
    components: { BloggerCard, BloggerCardPopup, AppTooltip },
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
    }
}
</script>

<style scoped>
    .blogger-card__options{
        width: 24px;
        height: 24px;
        align-self: center;
        opacity: .4;
        cursor: pointer;
        transition:all .1s linear;
    }
    .blogger-card__options:hover{
        opacity:1;
    }
</style>
