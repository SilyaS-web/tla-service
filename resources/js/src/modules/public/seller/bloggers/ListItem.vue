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

        :product_price="currentProject.product_price"
    >
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
    </BloggerCard>
    <BloggerCardPopup ref="bloggerCardPopup"></BloggerCardPopup>
</template>
<script>
import {ref} from "vue";
import axios from "axios";
import BloggerCardPopup from "../../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../../core/components/blogger-card/index";

export default{
    props:['blogger', 'currentProject'],
    components: { BloggerCardPopup, BloggerCard },
    data(){
        return{
            themes: ref([]),
            platforms: ref([]),
            isOfferSent: ref(false),
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

            axios({
                url: '/api/works',
                method: 'post',
                data: {
                    blogger_id: this.blogger.id,
                    project_work_id: this.currentProject.choosedWork.id
                }
            })
            .then((data) => {
                this.isOfferSent = true
            })
            .catch(errors => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Попробуйте позже.'
                })
            })
        },
        countER(subs, cover){
            var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

            if(val - 1 < 0) val = Math.round(val).toFixed(2);
            else val = Math.ceil(val);

            return val;
        },
        countCPM(cover){
            if(!cover) return '-';

            if(!this.currentProject || !this.currentProject.product_price) return '-';

            let result = (this.currentProject.product_price / cover) * 1000;

            return Math.round(result) === 0 ? (result).toFixed(3) : Math.round(result);
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
