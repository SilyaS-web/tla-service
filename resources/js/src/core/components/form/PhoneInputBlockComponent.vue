<template>
    <div
        :class="['form-group', inputWrapClassString]">
        <div
            v-if="label || headerLink"
            class="form-group__header">
            <label
                v-if="label"
                :for="inputID">{{ label }}</label>
            <a
                v-if="headerLink"
                href="#"
                @click="emitEvent(headerLink.eventName)"
            >
                {{ headerLink.name }}
            </a>
        </div>
        <input-component
            v-bind:value="modelValue"
            v-on:input="updateValue"
            v-on:focusout="$emit('focusout', $event)"
            :type="'text'"
            :name="inputID"
            :id="inputID"
            :placeholder="inputPlaceholder"
            :class="inputClassList"
            :disabled="disabled"
        ></input-component>

        <div class="form-group__question">
            <question-icon></question-icon>
        </div>

        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
import {ref} from "vue";

import InputComponent from "./InputComponent.vue";
import QuestionIcon from "../../icons/QuestionIcon.vue";

export default{
    components: {QuestionIcon, InputComponent},
    props: [
        'label', 'inputPlaceholder', 'inputClassList', 'wrapClassList',
        'inputID', 'headerLink', 'error', 'disabled','modelValue', 'question'
    ],
    data(){
        return{
            isEyeOpened: ref(false),
        }
    },
    created(){ },
    computed:{
        inputWrapClassString(){
            return this.wrapClassList && this.wrapClassList.length > 0 ? this.wrapClassList.join(' ') : ''
        },
    },
    methods:{
        emitEvent(eventName){
            this.$emit(eventName)
        },
        updateValue(event){
            this.$emit('update:modelValue', event.target.value)
        }
    }
}
</script>
<style scoped>

</style>
