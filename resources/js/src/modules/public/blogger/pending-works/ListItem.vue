<template>
    <div
        v-if="work.project"
        class="list-projects__item project-item">

        <Carousel
            :carouselID="'project__imgs-carousel-' + work.project.id"
            :itemsList="work.project.project_files"
            :listClassList="['project-item__carousel']"
            :itemsClassList="['project-item__img']"
            :props="{
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
            }"
        ></Carousel>

        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ work.project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="work.project.product_name">
                {{ work.project.product_name }}
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in work.project.feedbackWork"
                    class="card__tags-item">
                    <span>{{ work.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Project from '../../../../core/services/api/Project'
import Carousel from '../../../../core/components/AppCarousel'

export default{
    props: ['work'],
    components:{Carousel},
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
    }
}
</script>
