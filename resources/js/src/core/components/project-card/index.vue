<template>
    <div
        :class="'list-projects__item project-item ' + (projectClasses)"
        :data-id="id">

        <Carousel
            v-if="!isSingleImage"
            :carouselID="'project__imgs-carousel-' + carouselID"
            :itemsList="imgs"
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

        <div
            v-else
            class="project-item__carousel">
            <div class="project-item__img" :style="'background-image:url(' + (!imgs[0].link ? '/img/placeholder.webp' : imgs[0].link) + ')'">
            </div>
        </div>

        <div class="project-item__content">
            <div
                class="project-item__title">
                <span class="project-item__price">{{ price }}</span>₽
            </div>

            <div class="project-item__subtitle" :title="name">
                {{ name }}
            </div>

            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in works"
                    class="card__tags-item">
                    <span>{{ work.name }}</span>
                </div>
            </div>

            <slot></slot>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import Carousel from '../AppCarousel';

export default {
    props: {
        id: {type: Number, required: true},
        imgs: { type: Array, required: true, default: []},
        isSingleImage: {type: Boolean, default: false},
        price: {type:Number, required: true},
        name: {type:String, required: true},
        works: {type: Array, required: true},
        classList: {type: Array, required: false, default: []}
    },
    components: { Carousel },
    data(){
        return{
            projectInfo: ref(false),
            carouselID: ref(''),
        }
    },
    mounted() {
        this.carouselID = this.makeRandomString(5)
    },
    updated(){
    },
    computed:{
        projectClasses(){ return this.classList.join(' ') },
    },
    methods:{
        makeRandomString(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            return result;
        }
    }
}
</script>
