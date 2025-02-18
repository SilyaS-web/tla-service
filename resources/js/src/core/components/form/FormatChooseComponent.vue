<template>
    <div class="form-group marketing-format" style="z-index: 3;" >
        <label for="format">Выберите формат</label>
        <span class="error" v-if="error">{{ error }}</span>

        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    id="feedback"
                    class="checkbox__checkbox"
                    value="feedback"
                    v-model="types">
                <label for="feedback"></label>
            </div>
            <label for="feedback">Выкуп + отзыв
                <div class="format-tooltip format-tooltip--mobile" data-hint="product-feedback">
                    ?
                    <div class="format-hint format-hint--text" id="product-feedback">
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
                <div class="format-hint format-hint--text" id="feedback">
                    <div class="format-hint__title">
                        Выкуп + отзыв
                    </div>
                    <div class="format-hint__body">
                        Блогер покупает товар на маркетплейсе по заданию селлера, после чего пишет отзыв и создаёт фото/видео-контент, не размещая его в соцсетях. Контент и отзыв соответствуют ТЗ селлера. Реклама и публикация в соцсетях не предусмотрены.
                    </div>
                </div>
            </div>
        </div>
        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    id="integration"
                    class="checkbox__checkbox"
                    value="integration"
                    v-model="types">
                <label for="integration"></label>
            </div>
            <label for="integration">
                Интеграция
                <div class="format-tooltip format-tooltip--mobile" data-hint="product-inst">
                    ?
                    <div class="format-hint format-hint--text" id="product-inst">
                        <div class="format-hint__title">
                            Интеграция
                        </div>
                        <div class="format-hint__body">
                            Селлер отправляет товар блогеру для обзора. Блогер делает контент и размещает его в своих соцсетях (пост, сторис, видео и т. д.), но не передаёт контент в использование селлеру и не пишет отзыв на маркетплейсах.
                        </div>
                    </div>
                </div>
            </label>
            <div class="format-tooltip" data-hint="inst">
                ?
                <div class="format-hint format-hint--text" id="inst">
                    <div class="format-hint__title">
                        Интеграция
                    </div>
                    <div class="format-hint__body">
                        Селлер отправляет товар блогеру для обзора. Блогер делает контент и размещает его в своих соцсетях (пост, сторис, видео и т. д.), но не передаёт контент в использование селлеру и не пишет отзыв на маркетплейсах.
                    </div>
                </div>
            </div>
        </div>
        <div class="marketing-format__item input-checkbox-w">
            <div class="checkbox">
                <input
                    type="checkbox"
                    id="ugc-content"
                    class="checkbox__checkbox"
                    value="ugc_content"
                    v-model="types"
                >
                <label for="ugc-content"></label>
            </div>
            <label for="ugc-content">
                UGC-контент
                <div class="format-tooltip format-tooltip--mobile" data-hint="ugc-content-hint">
                    ?
                    <div class="format-hint format-hint--text" id="ugc-content-hint">
                        <div class="format-hint__title">
                            UGC-контент
                        </div>
                        <div class="format-hint__body">
                            Селлер отправляет товар блогеру, который снимает фото/видео-контент и передаёт его селлеру для использования в рекламе и на маркетплейсах. Блогер не публикует контент в своих соцсетях и не пишет отзыв.
                        </div>
                    </div>
                </div>
            </label>
            <div class="format-tooltip" data-hint="inst">
                ?
                <div class="format-hint format-hint--text" id="inst">
                    <div class="format-hint__title">
                        UGC-контент
                    </div>
                    <div class="format-hint__body">
                        Селлер отправляет товар блогеру, который снимает фото/видео-контент и передаёт его селлеру для использования в рекламе и на маркетплейсах. Блогер не публикует контент в своих соцсетях и не пишет отзыв.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    name: "FormatChooseComponent",
    props:{
        label: {type: String, required: true},
        error: {type: String, required: false, default: ''},
        integrationTypes: {type: Array, required: false, default: []}
    },
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
    }
}
</script>

<style scoped>

</style>
