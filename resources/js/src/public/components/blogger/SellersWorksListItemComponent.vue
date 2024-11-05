<template>
    <div
        v-if="work.project"
        :data-id="work.id"
        class="list-projects__item project-item">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    class="project-item__img" :style="'background-image:url(' + work.project.project_files[0].link + ')'"></div>
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
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-if="work.project.project_works && work.project.project_works.find(w => w.type == 'feedback')"
                    class="card__tags-item">
                    <span>Отзыв</span>
                </div>
                <div
                    v-if="work.project.project_works && work.project.project_works.find(w => w.type == 'integration')"
                    class="card__tags-item">
                    <span>Интеграция</span>
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
    },
    updated(){
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
