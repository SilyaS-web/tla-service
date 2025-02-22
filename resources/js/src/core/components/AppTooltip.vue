<script>
import {ref} from "vue";

export default {
    name: "AppTooltip",
    data(){
        return {
            isVisible: ref(false),
            position: ref({
                x: 0,
                y: 0
            })
        }
    },
    methods:{
        show(event){
            if(this.isVisible) return;

            this.position.x = event.clientX;
            this.position.y = event.clientY;

            this.isVisible = true;
        },
        hide(){ this.isVisible = false }
    }
}
</script>

<template>
    <transition name="fade">
        <div
            @mouseover="show($event)"
            @mouseout="hide()"
            class="app-tooltip">
            <svg
                fill="#000000"
                viewBox="0 0 32 32"
                enable-background="new 0 0 32 32"
                id="Glyph"
                version="1.1"
                xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                class="blogger-card__options"
            >
                <path d="M13,16c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,14.346,13,16z" id="XMLID_294_"/>
                <path d="M13,26c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,24.346,13,26z" id="XMLID_295_"/>
                <path d="M13,6c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,4.346,13,6z" id="XMLID_297_"/>
            </svg>
            <div
                v-if="isVisible"
                :style="{left: `${position.x + 25}px`, top: `${position.y + 30}px`}"
                class="app-tooltip__content"
            >
                <div class="app-tooltip__body">
                    <a href="#">Редактировать</a>
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
    .app-tooltip{
        position: fixed;
        transition: all .2s linear;
        z-index: 999;
    }
    .app-tooltip__content{
        padding: 12px;
        border-radius: 6px;
        box-shadow:0px 0px 10px 6px rgba(0,0,0,.05);
    }
</style>
