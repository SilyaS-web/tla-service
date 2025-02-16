<template>
    <BloggerCard
        v-if="blogger"

        :id="blogger.id"
        :image="blogger.user.image"
        :name="blogger.user.name"
        :platforms="blogger.platforms"
        :themes="blogger.themes"
        :description="blogger.description"
        :content="blogger.content"
        :is_achievement="blogger.is_achievement"
        :subscriber_quantity="blogger.summaryPlatform.subscriber_quantity"
        :coverage="blogger.summaryPlatform.coverage"

        :product_price="currentProject ? currentProject.product_price : false"
    >
        <div class="card__row card__btns">
            <button
                v-if="!isOfferSent"
                @click="sendOfferToBlogger"
                class="btn btn-primary">
                Отправить заявку
            </button>
            <button
                v-else
                class="btn btn-secondary">
                Заявка отправлена
            </button>
            <button
                @click="openBloggerInfoPopup"
                class="btn btn-secondary">
                Подробнее
            </button>
        </div>
    </BloggerCard>
    <BloggerCardPopup ref="bloggerCardPopup"></BloggerCardPopup>
</template>
<script>
import {ref} from "vue";

import BloggerCardPopup from "../../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../../core/components/blogger-card/index";

import Work from "../../../../core/services/api/Work.vue"

export default{
    props:['blogger', 'currentProject'],
    components: { BloggerCardPopup, BloggerCard },
    data(){
        return{
            themes: ref([]),
            platforms: ref([]),
            isOfferSent: ref(false),

            Work
        }
    },
    methods:{
        sendOfferToBlogger(){
            if(!this.currentProject){
                notify('info', {
                    title: 'Внимание!',
                    message: 'Сначала выберите проект.'
                })
                return
            }

            this.Work.sendOfferToBlogger(this.blogger.id, this.currentProject.choosedWork.id)
                .then(() => { this.isOfferSent = true })
        },

        openBloggerInfoPopup(){
            this.$refs.bloggerCardPopup.show(this.blogger).then(isConfirmed => {
                if(!isConfirmed) return

                this.sendOfferToBlogger()
            })
        }
    }
}
</script>
