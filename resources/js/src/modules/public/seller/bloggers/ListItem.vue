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

        :classList="classList"
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
            <div
                v-if="currentProject"
                class="checkbox">
                <input
                    @change="toggleBloggerInMassDistributionList($event)"
                    :id="'checkbox-blogger-card-' + blogger.id"
                    class="checkbox__checkbox" type="checkbox" name="">

                <label
                    :for="'checkbox-blogger-card-' + blogger.id"
                    class="">
                    Выбрать блогера
                </label>
            </div>
        </div>
    </BloggerCard>
    <BloggerCardPopup ref="bloggerCardPopup"></BloggerCardPopup>
</template>
<script>
import {ref} from "vue";

import BloggerCardPopup from "../../../../core/components/popups/blogger-card-popup/BloggerCardPopup";
import BloggerCard from "../../../../core/components/blogger-card/index";

import Work from "../../../../core/services/api/Work.vue"

import DistributionList from "../../../../core/mixins/DistributionList.js"

export default{
    props:['blogger', 'currentProject', 'classList'],
    components: { BloggerCardPopup, BloggerCard },
    mixins:[DistributionList],
    data(){
        return{
            themes: ref([]),
            platforms: ref([]),
            isOfferSent: ref(false),

            Work
        }
    },
    mounted(){
        window.addEventListener(this.distributionEventNames.remove, (event) => {
            if(event.detail.blogger.id === this.blogger.id)
                $('#checkbox-blogger-card-' + this.blogger.id).prop('checked', false)
        })
        window.addEventListener(this.distributionEventNames.empty, () => {
            $('#checkbox-blogger-card-' + this.blogger.id).prop('checked', false)
        })
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

            this.Work.sendOffer({blogger_ids: [this.blogger.user.id], project_work_id: this.currentProject.choosedWork.id})
                .then(() => { this.isOfferSent = true })
        },

        openBloggerInfoPopup(){
            this.$refs.bloggerCardPopup.show(this.blogger).then(isConfirmed => {
                if(!isConfirmed) return

                this.sendOfferToBlogger()
            })
        },

        toggleBloggerInMassDistributionList(event){
            const isChecked = $(event.target).prop('checked');

            if(isChecked)
                this.appendBloggerToDistributionList(this.blogger)
            else
                this.removeBloggerToDistributionList(this.blogger)
        }
    }
}
</script>
<style scoped>
    .card__btns .checkbox{
        display: flex;

    }
    .card__btns .checkbox__checkbox:checked + label::before{
        filter: invert(45%) sepia(40%) saturate(6353%) hue-rotate(259deg) brightness(91%) contrast(87%);
        background-size: 20px;
    }
    .card__btns{
        flex-wrap: wrap;
    }
    .card__btns .checkbox{
        order:1;
        width: 100%;
    }
    .card__btns .btn-primary{
        order:2;
    }
    .card__btns .btn-secondary{
        order:3;
    }
    .card__btns .checkbox__checkbox + label{
        font-size: inherit;
        font-weight: 500;
        color:rgba(0,0,0,.6);
        margin-bottom: 12px;
    }
    .card__btns .checkbox__checkbox + label::before{
        width: 24px;
        height: 24px;
        border-radius: 6px;
    }
    .card__btns .checkbox__checkbox:checked + label::before{
        background-size: 17px;
    }
    .card__btns .checkbox__checkbox:checked + label{
        color:var(--primary)
    }

    @media(max-width:475px){
        .card__btns .checkbox__checkbox + label{
            font-size: 13px;
        }
        .card__btns .checkbox__checkbox + label::before{
            width: 18px;
            height: 18px;
            border-radius: 4px;
        }
        .card__btns .checkbox__checkbox:checked + label::before{
            background-size: 13px;
        }
    }
</style>
