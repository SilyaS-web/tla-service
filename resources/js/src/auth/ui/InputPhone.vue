<template>
    <input
        type="text"
        name="phone" id="phone"
        v-bind:value="modelValue"
        v-on:input="$emit('update:modelValue', $event.target.value)"
        placeholder="Введите ваш номер" class="input input--phone">
</template>
<script>
    export default{
        props: ['modelValue'],
        mounted(){
        },
    }
</script>
