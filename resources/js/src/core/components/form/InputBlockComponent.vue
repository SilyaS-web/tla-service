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
            :type="currentInputType"
            :name="inputID"
            :id="inputID"
            :placeholder="inputPlaceholder"
            :class="inputClassList"
            :disabled="disabled"
        ></input-component>
        <closed-eye-icon
            v-show="inputType === 'password' && !isEyeOpened"
            @click="togglePassword"
            class="password-input-icon password-input-icon--closed"
        ></closed-eye-icon>
        <opened-eye-icon
            v-show="inputType === 'password' && isEyeOpened"
            @click="togglePassword"
            class="password-input-icon password-input-icon--opened"
        ></opened-eye-icon>
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
    import {ref} from "vue";

    import ClosedEyeIcon from "../../icons/ClosedEyeIcon.vue";
    import OpenedEyeIcon from "../../icons/OpenedEyeIcon.vue";
    import InputComponent from "./InputComponent.vue";

    export default{
        components: {InputComponent, OpenedEyeIcon, ClosedEyeIcon},
        props: [
            'label', 'inputType', 'inputPlaceholder', 'inputClassList', 'wrapClassList',
            'inputID', 'headerLink', 'error', 'disabled','modelValue'
        ],
        data(){
            return{
                isEyeOpened: ref(false),
                currentInputType: ref('')
            }
        },
        created(){
            this.currentInputType = this.inputType
        },
        computed:{
            inputWrapClassString(){
                return this.wrapClassList && this.wrapClassList.length > 0 ? this.wrapClassList.join(' ') : ''
            },
        },
        methods:{
            togglePassword(){
                this.currentInputType = this.currentInputType === 'password' ? 'text' : 'password';
                this.isEyeOpened = !this.isEyeOpened
            },
            emitEvent(eventName){
                this.$emit(eventName)
            },
            updateValue(event){
                this.$emit('update:modelValue', event.target.value)
            }
        }
    }
</script>
<style>
.password-input-icon{
    width: 22px;
    height: 18px;
    right: 12px;
    /* top: 12px; */
    bottom: 13px;
    /* margin: 12px 0; */
    position: absolute;
    z-index: 3;
    cursor: pointer;
}
.password-input-icon path{
    fill:#B6B0B080;
    transition:all .1s linear;
}
.password-input-icon:hover path{
    fill:#56565680;
}
</style>
