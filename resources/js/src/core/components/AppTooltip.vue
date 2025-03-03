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
            if(this.isVisible) return;

            this.position.x = event.clientX;
            this.position.y = event.clientY;

            this.isVisible = true;

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
    <transition name="fade">
        <div
            v-if="isVisible"
            :style="{left: `${position.x}px`, top: `${position.y}px`}"

            @mouseenter="isVisible = true"
            @mouseout="isVisible = false"

            class="app-tooltip">
            <div class="app-tooltip__content">
                <div class="app-tooltip__body">
                    <div class="app-tooltip__options">
                        <a href="#">Подробнее</a>
                        <a href="#">Редактировать</a>
                        <a href="#">Скопировать данные</a>
                    </div>
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
    .app-tooltip__options a{
        text-decoration: none;
        color:rgba(0,0,0,.4);
        font-size: 14px;
        font-weight: 500;
        padding: 8px;
        border-radius: 3px;
        border:1px solid rgba(0,0,0,.4)
    }

</style>
