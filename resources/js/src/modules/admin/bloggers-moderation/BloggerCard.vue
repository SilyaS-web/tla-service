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
            <button class="btn btn-primary" v-on:click="agree">
                Принять
            </button>
            <button class="btn btn-delete" v-on:click="ban">
                Отклонить
            </button>
            <div class="btn-delete btn-delete--icon">
                <img src="/img/trash-icon.svg" alt="" v-on:click="deletionConfirmation">
            </div>
        </div>
    </BloggerCard>

    <blogger-card-popup ref="bloggerCardPopup"></blogger-card-popup>
</template>
<script>
import BloggerCardPopup from "../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../core/components/blogger-card/index";

export default{
    props: ['blogger', 'bloggers'],
    components: { BloggerCardPopup, BloggerCard },
    methods:{
        deletionConfirmation() {
            this.$emit('deletionConfirmation', this.blogger.user.id)
        },

        agree() {
            this.$emit('agree', this.blogger.id)
        },

        ban() {
            this.$emit('ban', this.blogger.user.id)
        },

        countER(subs, cover){
            var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

            if(val - 1 < 0) val = Math.round(val).toFixed(2);
            else val = Math.ceil(val);

            return val;
        },

        openBloggerInfoPopup(){
            this.$refs.bloggerCardPopup.show(this.blogger)
        }
    }
}
</script>
