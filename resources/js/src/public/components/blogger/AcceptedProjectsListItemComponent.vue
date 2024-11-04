<template>
    <div
        v-if="work.project"
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
                    v-if="work.project.feedbackWork && work.project.feedbackWork.quantity > 0"
                    class="card__tags-item">
                    <span>Отзыв</span>
                </div>
                <div
                    v-if="work.project.integrationWork && work.project.integrationWork.quantity > 0"
                    class="card__tags-item">
                    <span>Интеграция</span>
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
    import Project from '../../../services/api/Project'

    export default{
        props: ['work'],
        data(){
            return {
                Project
            }
        },
        mounted(){
        },
        updated(){
        },
        methods: {
            goToChat(){

            },
            acceptApplication(){

            }
        }
    }
</script>
