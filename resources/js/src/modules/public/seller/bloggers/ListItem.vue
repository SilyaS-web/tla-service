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
            <div
                v-if="currentProject"
                class="checkbox">
                <input
                    @change="toggleBloggerInMassDestributionList"
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

        openBloggerInfoPopup(){
            this.$refs.bloggerCardPopup.show(this.blogger).then(isConfirmed => {
                if(!isConfirmed) return

                this.sendOfferToBlogger()
            })
        },

        toggleBloggerInMassDestributionList(){
            window.dispatchEvent(new CustomEvent('massDistributionListChanged', {
                detail: {
                    storage: this.blogger
                }
            }));
        }
    }
}
</script>
<style scoped>
    .card__btns .checkbox{
        display: flex;

    }
    .card__btns .checkbox__checkbox + label{
        font-size: 0;
    }
    .card__btns .checkbox__checkbox + label:before{
        width: 30px;
        height: 30px;
        border: 1px solid rgba(0, 0, 0, .4);
    }
    .card__btns .checkbox__checkbox:checked + label::before{
        filter: invert(45%) sepia(40%) saturate(6353%) hue-rotate(259deg) brightness(91%) contrast(87%);
        background-size: 20px;
    }

    @media(max-width:1530px){
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
