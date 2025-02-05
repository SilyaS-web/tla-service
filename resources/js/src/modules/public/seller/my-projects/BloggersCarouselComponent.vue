<template>
    <div
        :id="carouselID"
        :class="'profile-projects__row profile-projects__blogers projects-blogers owl-carousel ' + (getCarouselClassString())">

        <BloggerCard
            v-if="works && works.length > 0"
            v-for="work in works"

            :id="work.blogger.id"
            :image="work.blogger.user.image"
            :name="work.blogger.user.name"
            :platforms="work.blogger.platforms"
            :themes="work.blogger.themes"
            :work_message="work.message"
            :subscriber_quantity="work.blogger.summaryPlatform.subscriber_quantity"
            :coverage="work.blogger.summaryPlatform.coverage"
        >
            <div class="card__row" style="text-align: center;">
                <a
                    @click="openBloggerMoreInfo(work.blogger)"
                    class=""
                    style="width: 100%; color: var(--primary); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -10px;">Подробнее</a>
            </div>
            <div
                v-if="cardsType === 'leads'"
                class="card__row bloger-item--btns" style="gap:12px; width:100%; flex-wrap: wrap; justify-content: center">
                <button class="btn btn-primary" @click="acceptWork(work)">
                    Принять
                </button>
                <button class="btn btn-secondary" @click="denyWork(work)">
                    Отклонить
                </button>
            </div>
            <div
                v-if="cardsType === 'in-work'"
                class="card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                <button
                    v-if="work.status == null"
                    class="btn btn-secondary">
                    Заявка отправлена
                </button>
                <button
                    v-else
                    :data-work-id="work.id"
                    @click="goToChat(work)"
                    class="btn btn-primary">
                    Перейти в диалог
                </button>
            </div>
        </BloggerCard>
        <div
            v-else
            class="profile-projects__blogers--empty">Список блогеров в данный момент пуст</div>
    </div>
    <blogger-card-popup ref="bloggerCardPopup"></blogger-card-popup>
</template>
<script>
import BloggerCardPopup from "../../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../../core/components/blogger-card/index";

export default{
    props:['project', 'carouselID', 'works', 'carouselClassList', 'cardsType'],
    components:{ BloggerCardPopup, BloggerCard },
    data(){
        return{

        }
    },
    mounted(){
        if(this.works && this.works.length > 0) {
            $('.owl-carousel#' + this.carouselID).owlCarousel({
                margin: 5,
                nav: false,
                dots: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });
        }
    },
    updated(){
        $('.owl-carousel#' + this.carouselID).owlCarousel('destroy')

        if(this.works && this.works.length > 0) {
            $('.owl-carousel#' + this.carouselID).owlCarousel({
                margin: 5,
                nav: false,
                dots: true,
                responsive: {
                    0:{
                        items: 1
                    },
                    1180: {
                        items:2
                    }
                }
            });
        }
    },
    methods:{
        acceptWork(work){
            this.$emit('acceptWork', work)
        },
        denyWork(work){
            this.$emit('denyWork', work)
        },
        goToChat(work){
            this.$emit('goToChat', work)
        },

        getCarouselClassString(){
            return this.carouselClassList && this.carouselClassList.length > 0 ? this.carouselClassList.join(' ') : ''
        },

        openBloggerMoreInfo(blogger){
            this.$refs.bloggerCardPopup.show(blogger)
        }
    }
}
</script>
