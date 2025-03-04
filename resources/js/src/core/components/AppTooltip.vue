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
            }),
            timeoutID: null
        }
    },
    methods:{
        show(event){
            this.isVisible = !this.isVisible;

            this.position.x = event.clientX + 20;
            this.position.y = event.clientY;

            if(this.timeoutID){
                clearTimeout(this.timeoutID)
            }
        },
        hide(){
            if(this.timeoutID){
                clearTimeout(this.timeoutID)
            }

            this.timeoutID = setTimeout(() => this.isVisible = false, 100)
        }
    }
}
</script>

<template>
    <div class="dots-options">
        <svg
            fill="#000000"
            viewBox="0 0 32 32"
            enable-background="new 0 0 32 32"
            id="Glyph"
            version="1.1"
            xml:space="preserve"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            class="dots-options__icon"
        >
            <path d="M13,16c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,14.346,13,16z" id="XMLID_294_"/>
            <path d="M13,26c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,24.346,13,26z" id="XMLID_295_"/>
            <path d="M13,6c0,1.654,1.346,3,3,3s3-1.346,3-3s-1.346-3-3-3S13,4.346,13,6z" id="XMLID_297_"/>
        </svg>
        <transition name="fade">
            <div
                v-if="isVisible"
                :style="{left: `${position.x}px`, top: `${position.y}px`}"

                @click="isVisible = true"

                class="app-tooltip">
                <div class="app-tooltip__content">
                    <div class="app-tooltip__body">
                        <div class="app-tooltip__options">
                           <slot></slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
    .dots-options__icon{
        width: 24px;
        height: 24px;
        opacity: .4;
        cursor: pointer;
        transition:all .1s linear;
    }
    .dots-options__icon:hover{
        opacity:1;
    }
    .app-tooltip{
        position: fixed;
        transition: all .2s linear;
        z-index: 999;
        width: calc(100vw - 20px);
        max-width: fit-content;
        background-color: #fff;
        padding: 12px;
        border-radius: 6px;
        box-shadow:0px 0px 10px 6px rgba(0,0,0,.05);
    }
    .app-tooltip__body{
    }
    .app-tooltip__content{
    }
    .app-tooltip__options{
        display:flex;
        flex-direction: column;
        gap: 6px;
    }
    .app-tooltip__options > *{
        text-decoration: none;
        color: rgba(0, 0, 0, .4);
        font-size: 14px;
        font-weight: 500;
        padding: 5px 8px;
        border-radius: 3px;
        border: 1px solid rgba(0, 0, 0, .4);
        line-height: 1;
        transition: all .1s linear;
    }
    .app-tooltip__options >*:hover{
        border-color: #000;
        color:#000;
    }

</style>
