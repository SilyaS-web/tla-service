<template>
    <div
        v-if="work.project"
        :data-id="work.id"
        class="list-projects__item project-item">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in work.project.project_files"
                    class="project-item__img" :style="'background-image:url(' + image.link + ')'"></div>
            </div>
            <div class="project-item__status active">
                {{ work.project.status_name }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ work.project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="work.project.product_name">
                {{ work.project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val" style="'width:' +
                    (project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) / project.works.map(_w => _w.quantity).reduce((a, b) => a + b, 0)) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ work.project.project_works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) }}/{{ work.project.project_works.map(_w => parseInt(_w.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-if="work.project.feedbackWork && work.project.feedbackWork.quantity > 0"
                    class="card__tags-item">
                    <span>Отзыв - {{ work.project.feedbackWork.lost_quantity }}/{{ work.project.feedbackWork.quantity }}</span>
                </div>
                <div
                    v-if="work.project.integrationWork && work.project.integrationWork.quantity > 0"
                    class="card__tags-item">
                    <span>Интеграция - {{ work.project.integrationWork.lost_quantity }}/{{ work.project.integrationWork.quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button
                    @click="acceptApplication"
                    class="btn btn-primary" style="width:100%">Принять заявку</button>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue'
import Work from '../../../services/api/Work'
import Project from '../../../services/api/Project'

export default{
    props: ['work'],
    data(){
        return {
            Work, Project
        }
    },
    mounted(){
        if(!this.work.project){
            return
        }

        this.work.project.feedbackWork = this.Project.getFeedbackWork(this.work.project);
        this.work.project.integrationWork = this.Project.getIntegrationWork(this.work.project);
    },
    updated(){
        if(!this.work.project){
            return
        }

        var feedbackWork = this.Project.getFeedbackWork(this.work.project),
            integrationWork = this.Project.getIntegrationWork(this.work.project);

        if(!this.work.project.feedbackWork || this.work.project.feedbackWork.quantity != feedbackWork.quantity || this.work.project.feedbackWork.lost_quantity != feedbackWork.lost_quantity)
            this.work.project.feedbackWork = feedbackWork;

        if(!this.work.project.integrationWork || this.work.project.integrationWork.quantity != integrationWork.quantity || this.work.project.integrationWork.lost_quantity != integrationWork.lost_quantity)
            this.work.project.integrationWork = integrationWork;
    },
    methods: {
        acceptApplication(){
            this.Work.accept(this.work.id).then(
                () => {
                    $(`#avail-projects .list-projects__item[data-id="${this.work.id}"]`).hide();
                },
                err => {

                }
            )
        }
    }
}
</script>
