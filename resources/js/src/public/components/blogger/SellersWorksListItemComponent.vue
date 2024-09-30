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
                    v-for="work in work.project.project_works"
                    class="card__tags-item" :data-id="work.id">
                    <span>{{ work.name }} - {{ work.lost_quantity }}/{{ work.quantity }}</span>
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

export default{
    props: ['work'],
    data(){
        return {
            Work,
        }
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
