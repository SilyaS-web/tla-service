<template>
    <popup-modal ref="popup">
        <div class="popup__inner popup-project">
            <div class="popup-project__left">
                <Carousel
                :carouselID="'popup-project__imgs-carousel'"
                :itemsList="projectInfo.imgs"
                :listClassList="['popup-project__carousel']"
                :itemsClassList="['popup-project__img']"
                :props="{
                    margin: 5,
                    nav: false,
                    dots: true,
                    responsive: {
                        0:{
                            items: 1
                        },
                        1180: {
                            items: 1
                        }
                    }
                }" >
                </Carousel>
            </div>
            <div class="popup-project__right">
                <div class="popup-project__info">
                    <div class="popup-project__title">
                        {{ projectInfo.name }}
                    </div>
                    <div class="popup-project__row" style="line-height:1">
                        <div class="popup-project__mark">
                        </div>
                        <div class="popup-project__articul">
                            <p>{{ projectInfo.articul ? 'Арт: ' + projectInfo.articul : 'Артикул отсутствует' }}</p>
                        </div>
                    </div>
                    <div class="popup-project__row popup-project__cost">
                        {{ projectInfo.price ? projectInfo.price + '₽' : '- ₽' }}
                    </div>
                    <div class="popup-project__addit characteristics">
                        <p class="popup-project__addit-title">Дополнительная информация</p>
                        <div class="characteristics__category" v-html="(projectInfo.contentEmptyText ? projectInfo.contentEmptyText : projectInfo.category)">
                        </div>
                        <div
                            v-if="!projectInfo.contentEmptyText"
                            class="characteristics-items">
                            <div
                                v-for="option in projectInfo.options"
                                class="characteristics__row">
                                <div class="characteristics__row-left">
                                    <div class="characteristics__title">
                                        {{ option.name }}
                                    </div>
                                    <hr>
                                </div>
                                <div class="characteristics__row-right">
                                    <div class="characteristics__desc">
                                        {{ option.value }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-item__btns">
                        <a
                            v-if="projectInfo.link"
                            :href="projectInfo.link"
                            class="btn btn-secondary btn-go-to-shop"
                            target="_blank">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </popup-modal>
</template>
<script>
import PopupModal from '../AppPopup.vue';
import Carousel from '../../AppCarousel';
import {ref} from "vue";

export default {
    components:{ PopupModal, Carousel },
    data: () => ({
        projectInfo: ref(false),
        resolvePromise: undefined,
        rejectPromise: undefined,
    }),
    mounted() {
    },
    updated(){
    },
    methods:{
        show(projectInfo) {
            this.projectInfo = projectInfo
            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(true)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    }

}
</script>

<style>
.popup-project{
    display: flex;
    gap: 20px;
}
.popup-project__left, .popup-project__right{
    width: calc(50% - 10px);
}
.popup-project__right{
    padding: 20px 20px 20px 0;
}
.popup-project__carousel{
    position: relative;
    border-radius: 20px 0 0 20px;
    overflow: hidden;
}
.popup-project__carousel .owl-dots{
    position: absolute;
    bottom: 10px;
    margin: 0 auto;
    left: 0;
    right: 0;
}
.popup-project__img{
    background-position: 0 0;
    background-size: cover;
    background-repeat: no-repeat;
    -o-object-fit: cover;
    object-fit: cover;
    height:672px;
    width: 100%;
}
.popup-project__title{
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 18px;
}
.popup-project__row{
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.popup-project__mark{
    display: flex;
    gap: 6px;
    font-weight: 500;
}
.popup-project__mark-star{
    width: 14px; height: 14px;
}
.popup-project__articul{
    font-size: 16px;
    font-weight: 600;
    color: rgba(0, 0, 0, .4);
    margin-bottom: 20px;
}
.popup-project__cost{
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 18px;
}
.popup-project__addit-title{
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 18px;
}
.characteristics__category{
    font-size: 16px;
    font-weight: 600;
    color: rgba(0, 0, 0, .4);
    margin-bottom: 12px;
}
.characteristics-items{
    height:250px;
    overflow-y: auto;
}
.characteristics-items::-webkit-scrollbar {
    width: 12px;
}
.characteristics-items::-webkit-scrollbar-track {
    background: #fff;
}
.characteristics-items::-webkit-scrollbar-thumb {
    background-color: #7A7674;
    border-radius: 20px;
    border: 3px solid #fff;
}
.characteristics__row{
    display: flex;
    font-size: 15px;
    color: rgba(0, 0, 0, .4);
    gap: 8px;
}
.characteristics__row:not(:last-child){
    margin-bottom: 10px;
}
.characteristics__row-right, .characteristics__row-left{
    width: 50%;
}
.characteristics__row-left{
    display: flex;
    gap: 8px;
    height:-moz-fit-content;
    height:fit-content;
    align-items: flex-end;
    line-height: 1;
}
.characteristics__row-left hr{
    border-bottom: 1px dashed rgba(0, 0, 0, .1);
    flex: 1 1 auto;
}
.popup-project__addit{
    margin-bottom: 20px;
}
@media(max-width: 884px){
    .popup-project{
        flex-direction: column;
        padding:20px 10px;
    }
    .popup-project__carousel{
        border-radius: 20px;
    }
    .popup-project__left{
        width:75%;
    }
    .popup-project__right{
        padding:0;
        width:100%;
    }
    .project-item__btns{
        max-width:250px;
    }
}
@media(max-width: 545px){
    .popup-project__left{
        width: 100%;
    }
    .popup-project__img{
        height:420px;
        width:100%;
    }
}
</style>
