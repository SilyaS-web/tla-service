<template>
    <popup-modal ref="popup">
        <div class="popup__inner popup-project">
            <div class="popup-project__left">
                <Carousel
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
<!--                <div class="popup-project__carousel owl-carousel">-->
<!--                    <div-->
<!--                        v-for="file in projectInfo.imgs"-->
<!--                        :style="'background-image:url(/' + (file.link || 'img/placeholder.webp') + ')'"-->
<!--                        class="popup-project__img"></div>-->
<!--                </div>-->
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
                        <div class="characteristics__category">
                            {{ projectInfo.contentEmptyText ? projectInfo.contentEmptyText : projectInfo.category }}
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
