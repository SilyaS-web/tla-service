<template>
    <div
        :id="id"
        class="form-group marketing-format" style="z-index: 3;" >
        <label for="format">Выберите формат</label>

        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    :id="id + '-feedback'"
                    class="checkbox__checkbox"
                    value="feedback"
                    v-model="types">
                <label :for="id + '-feedback'"></label>
            </div>
            <label for="feedback">Выкуп + отзыв
                <div class="format-tooltip format-tooltip--mobile" :data-hint="id + '-product-feedback'">
                    ?
                    <div class="format-hint format-hint--text" :id="id + '-product-feedback'">
                        <div class="format-hint__title">
                            Выкуп + отзыв
                        </div>
                        <div class="format-hint__body">
                            Блогер покупает товар на маркетплейсе по заданию селлера, после чего пишет отзыв и создаёт фото/видео-контент, не размещая его в соцсетях. Контент и отзыв соответствуют ТЗ селлера. Реклама и публикация в соцсетях не предусмотрены.
                        </div>
                    </div>
                </div>
            </label>
            <div class="format-tooltip" data-hint="feedback">
                ?
                <div class="format-hint format-hint--text" :id="id + '-feedback'">
                    <div class="format-hint__title">
                        Выкуп + отзыв
                    </div>
                    <div class="format-hint__body">
                        Блогер покупает товар на маркетплейсе по заданию селлера, после чего пишет отзыв и создаёт фото/видео-контент, не размещая его в соцсетях. Контент и отзыв соответствуют ТЗ селлера. Реклама и публикация в соцсетях не предусмотрены.
                    </div>
                </div>
            </div>
            <div
                @click="showVideo('/img/adswap ai/1.mp4')"
                class="format-video">
                <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="50" height="50" rx="25" stroke="black" stroke-width="4"/>
                    <path d="M37.5 26.134C38.1667 26.5189 38.1667 27.4811 37.5 27.866L22.5 36.5263C21.8333 36.9112 21 36.4301 21 35.6603V18.3397C21 17.5699 21.8333 17.0888 22.5 17.4737L37.5 26.134Z" fill="black"/>
                </svg>
            </div>
        </div>
        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    :id="id + '-integration'"
                    class="checkbox__checkbox"
                    value="integration"
                    v-model="types">
                <label :for="id + '-integration'"></label>
            </div>
            <label :for="id + '-integration'">
                Интеграция
                <div class="format-tooltip format-tooltip--mobile" :data-hint="id + '-product-inst'">
                    ?
                    <div class="format-hint format-hint--text" :id="id + '-product-inst'">
                        <div class="format-hint__title">
                            Интеграция
                        </div>
                        <div class="format-hint__body">
                            Селлер отправляет товар блогеру для обзора. Блогер делает контент и размещает его в своих соцсетях (пост, сторис, видео и т. д.), но не передаёт контент в использование селлеру и не пишет отзыв на маркетплейсах.
                        </div>
                    </div>
                </div>
            </label>
            <div class="format-tooltip" :data-hint="id + '-inst'">
                ?
                <div class="format-hint format-hint--text" :id="id + '-inst'">
                    <div class="format-hint__title">
                        Интеграция
                    </div>
                    <div class="format-hint__body">
                        Селлер отправляет товар блогеру для обзора. Блогер делает контент и размещает его в своих соцсетях (пост, сторис, видео и т. д.), но не передаёт контент в использование селлеру и не пишет отзыв на маркетплейсах.
                    </div>
                </div>
            </div>
            <div
                @click="showVideo('/img/adswap ai/2.mp4')"
                class="format-video">
                <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="50" height="50" rx="25" stroke="black" stroke-width="4"/>
                    <path d="M37.5 26.134C38.1667 26.5189 38.1667 27.4811 37.5 27.866L22.5 36.5263C21.8333 36.9112 21 36.4301 21 35.6603V18.3397C21 17.5699 21.8333 17.0888 22.5 17.4737L37.5 26.134Z" fill="black"/>
                </svg>
            </div>
        </div>
        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    :id="id + '-ugc-content'"
                    class="checkbox__checkbox"
                    value="ugc_content"
                    v-model="types"
                >
                <label :for="id + '-ugc-content'"></label>
            </div>
            <label for="ugc-content">
                UGC-контент
                <div class="format-tooltip format-tooltip--mobile" :data-hint="id + 'ugc-content-hint'">
                    ?
                    <div class="format-hint format-hint--text" :id="id + 'ugc-content-hint'">
                        <div class="format-hint__title">
                            UGC-контент
                        </div>
                        <div class="format-hint__body">
                            Селлер отправляет товар блогеру, который снимает фото/видео-контент и передаёт его селлеру для использования в рекламе и на маркетплейсах. Блогер не публикует контент в своих соцсетях и не пишет отзыв.
                        </div>
                    </div>
                </div>
            </label>
            <div class="format-tooltip" :data-hint="id + '-inst'">
                ?
                <div class="format-hint format-hint--text" :id="id + '-inst'">
                    <div class="format-hint__title">
                        UGC-контент
                    </div>
                    <div class="format-hint__body">
                        Селлер отправляет товар блогеру, который снимает фото/видео-контент и передаёт его селлеру для использования в рекламе и на маркетплейсах. Блогер не публикует контент в своих соцсетях и не пишет отзыв.
                    </div>
                </div>
            </div>
            <div
                @click="showVideo('/img/adswap ai/3.mp4')"
                class="format-video">
                <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="50" height="50" rx="25" stroke="black" stroke-width="4"/>
                    <path d="M37.5 26.134C38.1667 26.5189 38.1667 27.4811 37.5 27.866L22.5 36.5263C21.8333 36.9112 21 36.4301 21 35.6603V18.3397C21 17.5699 21.8333 17.0888 22.5 17.4737L37.5 26.134Z" fill="black"/>
                </svg>
            </div>
        </div>

        <span class="error" v-if="error">{{ error }}</span>
    </div>
    <video-popup ref="videoPopup"></video-popup>
</template>
<script>
import {ref} from "vue";

import VideoPopup from "../popups/fullscreen-asset/AssetPopup.vue"

export default {
    name: "FormatChooseComponent",
    props:{
        id: {type: String, required: true},
        label: {type: String, required: true},
        error: {type: String, required: false, default: ''},
        integrationTypes: {type: Array, default: []}
    },
    components:{ VideoPopup },
    data(){
        return {
            types: ref([])
        }
    },
    mounted() {
        if(this.integrationTypes && this.integrationTypes.length > 0)
            this.types = this.integrationTypes
    },
    watch: {
        types(_old, _new){
            this.$emit('update:modelValue', this.types)
        },
    },
    methods:{
        showVideo(url){
            this.$refs.videoPopup.show({
                videoUrl: url
            })
        }
    }
}
</script>

<style scoped>
    .format-video{
        cursor: pointer;
        display: flex;
        align-items: center;
        width: 100%;
        height: 32px;
        max-width: 32px;
    }
    .format-video svg{
    }
    .format-video svg rect{
        stroke:var(--primary);
        fill:var(--primary);
    }
    .format-video svg path{
        fill:#fff;
    }
    @media(max-width:675px){
        .format-video{
            max-width: 28px;
            height: 28px;
        }
    }
    @media(max-width:475px){
        .format-video{
            max-width: 28px;
        }
        .format-video:not(:only-child):last-child{
            margin-left: 0;
        }

    }
</style>
