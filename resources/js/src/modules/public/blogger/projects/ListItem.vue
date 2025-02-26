<template>
    <ProjectCard
        @click="openMoreInfo"

        :id="project.id"
        :name="project.product_name"
        :price="project.product_price"
        :works="project.project_works"
        :imgs="project.project_files"
    >
        <div class="project-item__btns">
            <button
                v-if="!project.is_blogger_works"
                @click="chooseWork($event, project.project_works)"
                class="btn btn-primary" style="width:100%">Откликнуться</button>
            <button
                v-else
                class="btn btn-secondary" style="width:100%" disabled>Заявка отправлена</button>
        </div>
    </ProjectCard>

    <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
    <project-info ref="projectInfoPopup"></project-info>
    <send-offer ref="sendOfferPopup"></send-offer>
</template>
<script>
import {ref} from "vue";

import User from "../../../../core/services/api/User";
import Project from '../../../../core/services/api/Project';

import ChooseProjectPopup from '../../../../core/components/popups/choose-project/ChooseProjectPopup.vue'
import ProjectInfo from '../../../../core/components/popups/project-more-info/ProjectMoreInfoPopup.vue'
import SendOffer from '../../../../core/components/popups/blogger-send-offer/BloggerSendOfferPopup'

import Carousel from '../../../../core/components/AppCarousel';
import ProjectCard from '../../../../core/components/project-card/index';

export default{
    components: { ChooseProjectPopup, Carousel, ProjectInfo, SendOffer, ProjectCard },
    props:['project'],
    data(){
        return {
            isSendOfferPopupOpen: ref(false),
            user: ref(null),
            projectInfo: ref(false),
            User, Project
        }
    },
    mounted() {
        this.user = this.User.getCurrent();
    },
    updated(){
    },
    methods:{
        async chooseWork(e, works){
            e.stopPropagation();

            const data = await this.$refs.chooseProjectPopup.show({
                title: 'Выберите формат рекламы',
                subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите отправить селлеру',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
                works: works
            });

            if(data){
                this.$refs.sendOfferPopup.show({
                    project_work_id: data.id,
                    message: ""
                })
                .then(isConfirmed => {
                    if(isConfirmed) this.project.is_blogger_works = true;
                })
            }
        },
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

            this.$refs.projectInfoPopup.show(this.projectInfo)
        }
    }
}
</script>
