<template>
    <div
        @click="openMoreInfo"
        class="list-projects__item project-item" :data-id="project.id">

        <carousel
            v-if="projectImgs && projectImgs.length > 0"
            :nav="false"
            :dots="true"
            :items="1"
            :responsive="{ 0:{ items: 1 }, 1180: { items:1 } }">
            <div
                v-for="file in projectImgs"
                :style="'background-image: url(' + file.link + ')'"
                class="project-item__img">
            </div>
        </carousel>

<!--        <div class="owl-carousel project-item__carousel">-->
<!--            <div-->
<!--                v-for="file in project.project_files"-->
<!--                :style="'background-image: url(' + file.link + ')'"-->
<!--                class="project-item__img">-->
<!--            </div>-->
<!--        </div>-->
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="project.product_name">
                {{ project.product_name }}
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in project.project_works"
                    class="card__tags-item">
                    <span>{{ work.name }}</span>
                </div>
            </div>
        </div>
    </div>
    <div
        v-if="isProjectPopup"
        id="project-item-info" class="popup">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__inner popup-project">
                    <div class="popup-project__left">
                        <div class="popup-project__carousel owl-carousel">
                            <div
                                v-for="file in projectInfo.imgs"
                                :style="'background-image:url(/' + (file.link || 'img/placeholder.webp') + ')'"
                                class="popup-project__img"></div>
                        </div>
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
                <div
                    @click="isProjectPopup = false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import carousel from 'vue-owl-carousel/src/Carousel'

    import Project from '../../../services/api/Project';
    import {ref} from "vue";

    export default {
        props: ['project'],
        components: { carousel },
        data(){
            return{
                projectImgs: [],
                projectInfo: ref(false),
                isProjectPopup: ref(false),
                Project
            }
        },
        mounted() {
            this.projectImgs = this.project.project_files;

            // $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').owlCarousel({
            //     margin: 5,
            //     nav: false,
            //     dots: true,
            //     responsive: {
            //         0:{
            //             items: 1
            //         },
            //         1180: {
            //             items:1
            //         }
            //     }
            // });
        },
        updated(){
            if(this.projectInfo){
                $('#project-item-info').find('.popup-project__carousel').owlCarousel({
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
                })
            }

            // $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').trigger('refresh.owl.carousel')
        },

        methods:{
            openMoreInfo(){
                var options = this.project.marketplace_options ? JSON.parse(this.project.marketplace_options) : null,
                    contentEmptyText = '';

                if(!options && !this.project.marketplace_category){
                    contentEmptyText = 'К сожалению, информация о товаре в данный момент недоступна. Вы можете узнать подробности, нажав на кнопку «Подробнее».'
                }

                var worksInfo = {
                    lostQuantity: 0,
                    totalQuantity: 0,
                }

                if(this.project.project_works){
                    worksInfo.lostQuantity = this.project.project_works.map(w => w.lost_quantity).reduce((a, b) => a + b, 0);
                    worksInfo.totalQuantity = this.project.project_works.map(w => parseInt(w.quantity)).reduce((a, b) => a + b, 0);
                }

                this.projectInfo = {
                    name: this.project.product_name,
                    brand: this.project.marketplace_brand,
                    category: this.project.marketplace_category,
                    articul: this.project.product_nm,
                    imgs: this.project.project_files,
                    price: this.project.product_price,
                    rating: this.project.product_rating,
                    description: this.project.marketplace_description,
                    link: this.project.product_link,
                    contentEmptyText: contentEmptyText,
                    options: options,
                    worksInfo: worksInfo
                }
                this.isProjectPopup = true
            }
        }
    }
</script>
