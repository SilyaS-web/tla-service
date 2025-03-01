
<template>
    <ProjectCard
        @click="openMoreInfo"

        :id="project.id"
        :name="project.product_name"
        :price="project.product_price"
        :works="project.project_works"
        :imgs="project.project_files"
    ></ProjectCard>

    <ProjectInfoPopup ref="moreInfo"></ProjectInfoPopup>
</template>
<script>
import {ref} from "vue";

import Project from '../../../../core/services/api/Project';

import ProjectCard from '../../../../core/components/project-card/index';
import ProjectInfoPopup from '../../../../core/components/popups/project-more-info/ProjectMoreInfoPopup';
import Carousel from '../../../../core/components/AppCarousel';

export default {
    props: ['project'],
    components: { ProjectCard, ProjectInfoPopup, Carousel },
    data(){
        return{
            projectInfo: ref(false),

            Project
        }
    },
    mounted() {
    },
    updated(){
    },

    methods:{
        openMoreInfo(){
            var options = this.project.marketplace_options ? JSON.parse(this.project.marketplace_options) : null,
                contentEmptyText = '';

            if(!options && !this.project.marketplace_category){
                if(this.project.id !== 262) {
                    contentEmptyText = 'К сожалению, информация о товаре в данный момент недоступна. Вы можете узнать подробности, нажав на кнопку «Подробнее».'
                }
                else{
                    contentEmptyText = 'Запишите короткое видео (15-60 секунд) с обзором и упоминанием сервиса Adswap (или его мини-ап в телеграм), поставьте #adswap под видео чтобы мы его нашли и получите возможность выиграть 10 000 рублей.<br> Голосованием нашей команды мы выберем лучший рилс, будем учитывать не только просмотры, но и креативность, активность блогера и тд.<br> ➡️Старт конкурса 28 февраля. Итоги подведем 28 марта.'
                }
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
