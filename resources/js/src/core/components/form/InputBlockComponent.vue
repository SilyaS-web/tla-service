<template>
    <div class="form-group">
        <label
            v-if="label"
            :for="inputID">{{ label }}</label>
        <input
            v-bind:value="modelValue"
            v-on:input="$emit('update:modelValue', $event.target.value)"
            :type="inputType"
            :name="inputID"
            :id="inputID"
            :placeholder="inputPlaceholder"
            :class="'input ' +  (getInputClassString())"
            :disabled="disabled === 1"
        >
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
    export default{
        props: [
            'label', 'inputType', 'inputPlaceholder', 'inputClassList',
            'inputID', 'error', 'disabled','modelValue'
        ],
        methods:{
            getInputClassString(){
                return this.inputClassList && this.inputClassList.length > 0 ? this.inputClassList.join(' ') : ''
            }
        }
    }
</script>
