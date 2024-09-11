<template>
    <input
        name="phone" id="phone"
        class="input input--phone"
        placeholder="+70000000000"
        type="tel"
        v-bind:value="modelValue"
        v-on:input="$emit('update:modelValue', $event.target.value)">
<!--    <vue-mask-->
<!--        name="phone" id="phone"-->
<!--        class="input input&#45;&#45;phone"-->
<!--        placeholder="Введите номер"-->
<!--        v-bind:value="modelValue"-->
<!--        v-on:input="$emit('update:modelValue', $event.target.value)"-->
<!--        mask="+0 (000) 000-0000"-->
<!--        :raw="true">-->
<!--    </vue-mask>-->
</template>
<script>
    import vueMask from 'vue-jquery-mask';

    export default{
        components: {
            vueMask
        },
        props: ['modelValue'],
        data(){
            return {
                // options: {
                //     placeholder: '+7 (___) ___-__-__',
                // }
            }
        },
        mounted(){
        },
    }
</script>
