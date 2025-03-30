<template>
    <transition name="fade">
        <div :id="id" class="popup _scrollable" style="" v-if="isVisible">
            <div class="popup__container _container">
                <div class="popup__body">
                    <slot></slot>
                    <div class="close-popup" @click="close">
                        <close-icon></close-icon>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
import CloseIcon from "../../icons/CloseIcon.vue";
export default {
    name: 'PopupModal',
    props:['id'],
    components:{CloseIcon},
    data: () => ({
        isVisible: false,
    }),

    methods: {
        open() {
            this.isVisible = true
        },

        close() {
            this.isVisible = false
        },
    },
}
</script>

<style>
.popup {
    position: fixed;
    top:0;left:0;
    width:100%;
    height:100%;
    background-color: rgba(0, 0, 0, .7);
    z-index: 9999;
    overflow-y: auto;
    flex-direction: column;
    align-items: center;
    /* justify-content: center; */
    display: flex;
    -webkit-backdrop-filter: blur(.6px);
    backdrop-filter: blur(.6px);
}

.popup::-webkit-scrollbar {
    width: 12px;
}
.popup::-webkit-scrollbar-track {
    background: unset;
}
.popup::-webkit-scrollbar-thumb {
    background-color: #7A7674;
    border-radius: 20px;
    border: 3px solid rgba(0,0,0,.1);
}
.fade-enter-active {
    animation: simpleShow .4s normal forwards;
    animation-delay: 0s;
}
.fade-leave-to {
    animation: simpleFade .4s normal forwards;
    animation-delay: 0s;
}
@keyframes simpleShow {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
@keyframes simpleFade {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

.popup__container {
    display: flex;
    justify-content: center;
    align-items: start;
}
.popup__body {
    position: relative;
    background-color: #fff;
    border-radius: 12px;
    padding:40px 30px;
    max-width: 680px;
    width: 100%;
}
#project-item-info .popup__body{
    max-width: 975px;
    padding:0;
}
.popup__body:has(.popup-project) {
    max-width: 975px !important;
    padding: 0;
}
.popup__body:has(.user-view){
    max-width: 1040px!important;
    width: 100%;
    padding-bottom: 75px;
}
.popup__body:has(.popup-distribution){
    max-width:1020px!important;
}
#topup-balance .popup__body{
    max-width:782px;
    padding: 24px;
}
.popup__body:has(.fullscreen-img),
#video-popup .popup__body:has(.fullscreen-video){
    background-color: unset !important;
    max-width:unset !important;
}
.popup__container:has(.fullscreen-img),
#video-popup .popup__container:has(.fullscreen-video){
    margin:0 auto;
}
.popup#add-content .popup__body{
    width: calc(100% - 200px);
    max-width:1400px;
}
.popup__header{
    margin-bottom: 28px;
}
.popup__title{
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 24px;
}
.user-view .popup__title{
    text-align: center;
}
.popup__header .popup__title {
    margin-bottom: 12px;
}
.popup__subtitle{
    font-size: 14px;
    color:#000;
    max-width: 475px;
    font-weight: 500;
    line-height: 1.3;
}
.popup__form-btns{
    display: flex;
    gap: 10px;
    margin-top: 20px;
}
.close-popup {
    position: absolute;
    right:20px;top:24px;
    cursor: pointer;
    z-index: 1;
    border-radius: 50%;
    background-color: #fff;
    padding: 5px;
    width: 34px; height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.close-popup svg{
    width: 24px;
    height: 24px;
}
.close-popup svg path{
    stroke:#544F4F;
}
.close-popup:hover svg path{
    stroke:var(--primary);
}
</style>
