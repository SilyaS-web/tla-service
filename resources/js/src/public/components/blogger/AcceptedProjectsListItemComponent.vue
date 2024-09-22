<template>
    <div
        v-if="project"
        class="list-projects__item project-item" :data-id="project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in project.project_files"
                    class="project-item__img" :style="'background-image:url(' + image.link + ')'"></div>
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
                    <div class="line__val" style="'width:' +
                    (project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) / project.works.map(_w => parseInt(_w.quantity)).reduce((a, b) => a + b, 0)) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.project_works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) }}/{{ project.project_works.map(_w => parseInt(_w.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in project.project_works"
                    class="card__tags-item" :data-id="work.id">
                    <span>{{ work.name }} - {{ parseInt(work.quantity) - work.lost_quantity }}/{{ work.quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
<!--                <button-->
<!--                    @click="goToChat"-->
<!--                    class="btn btn-primary btn-blogger-send-offer" style="width:100%">Перейти в чат</button>-->
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue"

    export default{
        props: ['work'],
        data(){
            return {
                project: ref(null)
            }
        },
        mounted(){
            console.log(this.work)
            this.project = this.work.project;
        },
        methods: {
            goToChat(){

            },
            acceptApplication(){

            }
        }
    }
</script>
