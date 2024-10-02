<template>
    <div class="list-projects__item project-item">
        <div class="owl-carousel project-item__carousel">
            <div
                :style="'background-image: url(' + project.project_files[0].link + ')'"
                class="project-item__img">
            </div>
            <div class="project-item__status active">
                {{ project.status_name }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="project.product_name">
                {{ project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val"
                         :style="'width:' + ((project.project_works.map(_p => parseInt(_p.lost_quantity)).reduce((a, b) => a + b, 0) / project.project_works.map(_p => parseInt(_p.quantity)).reduce((a, b) => a + b, 0)) * 100) + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.project_works.map(_p => parseInt(_p.lost_quantity)).reduce((a, b) => a + b, 0) }} / {{ project.project_works.map(_p => parseInt(_p.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-if="project.feedbackWork && project.feedbackWork.quantity > 0"
                    class="card__tags-item">
                    <span>Отзыв - {{ project.feedbackWork.lost_quantity }}/{{ project.feedbackWork.quantity }}</span>
                </div>
                <div
                    v-if="project.integrationWork && project.integrationWork.quantity > 0"
                    class="card__tags-item">
                    <span>Интеграция - {{ project.integrationWork.lost_quantity }}/{{ project.integrationWork.quantity }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Project from '../../../services/api/Project';

    export default {
        props: ['project'],
        data(){
            return{
                Project
            }
        },
        mounted() {
            if (!this.project) {
                return
            }

            this.project.feedbackWork = this.Project.getFeedbackWork(this.project);
            this.project.integrationWork = this.Project.getIntegrationWork(this.project);
        },
        updated(){
            if(this.project){
                this.project.feedbackWork = this.Project.getFeedbackWork(this.project);
                this.project.integrationWork = this.Project.getIntegrationWork(this.project);
            }
        },
    }
</script>
