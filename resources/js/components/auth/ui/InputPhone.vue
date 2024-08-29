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
            $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
            $("#phone").mask("+7 (h99) 999-99-99");
        },
    }
</script>
