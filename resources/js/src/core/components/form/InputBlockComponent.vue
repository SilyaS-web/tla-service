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
<style scoped>
    .input {
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,.2);
        background-color: #fff;
        padding: 13px;
        margin-bottom: 7px;
        max-width:100%;
        transition: all .1s linear;
        color:var(--text);
    }
    .input:hover{
        border-color: #544F4F;
    }
    .input:focus{
        border-color:var(--primary)
    }
    .input::-moz-placeholder{
        color:#56565680;
    }
    .input::placeholder{
        color:#56565680;
    }
    .input.no-correct{
        border-color:red;
    }
</style>
