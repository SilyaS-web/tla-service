<template>
    <div
        v-if="work.project"
        :data-id="work.id"
        class="list-projects__item project-item">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="file in work.project.project_files"
                    class="project-item__img" :style="'background-image:url(' + file.link + ')'"></div>
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
                    v-for="work in work.project.project_works"
                    class="card__tags-item">
                    <span>{{ work.name }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button
                    @click="acceptApplication"
                    class="btn btn-primary">Принять</button>
                <button
                    @click="denyApplication"
                    class="btn btn-secondary">Отклонить</button>
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
        $('.project-item').find('.project-item__carousel--carousel').owlCarousel({
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
        },
        denyApplication(){
            this.Work.deny(this.work.id).then(
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
