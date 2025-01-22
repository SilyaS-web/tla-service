
<template>
    <div
        @click="openMoreInfo"
        class="list-projects__item project-item" :data-id="project.id">

        <!--        <carousel-->
        <!--            :nav="false"-->
        <!--            :dots="true"-->
        <!--            :items="1"-->
        <!--            :responsive="{ 0:{ items: 1 }, 1180: { items:1 } }">-->
        <!--            <div-->
        <!--                v-for="file in project.project_files"-->
        <!--                :style="'background-image: url(' + file.link + ')'"-->
        <!--                class="project-item__img">-->
        <!--            </div>-->
        <!--        </carousel>-->

        <div class="owl-carousel project-item__carousel">
        </div>
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

    <ProjectInfoPopup ref="moreInfo"></ProjectInfoPopup>
</template>
<script>
// import carousel from 'vue-owl-carousel/src/Carousel'

import Project from '../../../../core/services/api/Project';
import ProjectInfoPopup from '../../../../core/components/popups/project-more-info/ProjectMoreInfoPopup';
import {ref} from "vue";

export default {
    props: ['project'],
    components: { ProjectInfoPopup },
    data(){
        return{
            projectImgs: [],
            projectInfo: ref(false),

            Project
        }
    },
    mounted() {
        this.project.project_files.forEach(file => {
            $('.project-item[data-id="' + this.project.id + '"]')
                .find('.project-item__carousel')
                .append(`<div class="project-item__img" style="background-image: url(${file.link});"></div>`)
        })

        $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').owlCarousel({
            margin: 5,
            nav: false,
            dots: true,
            responsive: {
                0:{
                    items: 1
                },
                1180: {
                    items:1
                }
            }
        });
    },
    beforeUpdate() {
    },
    updated(){
        $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').empty();
        $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').trigger('destroy.owl.carousel').removeClass('owl-loaded');

        this.project.project_files.forEach(file => {
            $('.project-item[data-id="' + this.project.id + '"]')
                .find('.project-item__carousel')
                .append(`<div class="project-item__img" style="background-image: url(${file.link});"></div>`)
        })

        $('.project-item[data-id="' + this.project.id + '"]').find('.project-item__carousel').owlCarousel({
            margin: 5,
            nav: false,
            dots: true,
            responsive: {
                0:{
                    items: 1
                },
                1180: {
                    items:1
                }
            }
        });
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

            this.$refs.moreInfo.show(this.projectInfo)
        }
    }
}
</script>
