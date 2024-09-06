<template>
    <vue-mask
        name="phone" id="phone"
        class="input input--phone"

        v-bind:value="modelValue"
        v-on:input="$emit('update:modelValue', $event.target.value)"
        mask="+7 (000) 000-00-00"
        :raw="false">
    </vue-mask>
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
