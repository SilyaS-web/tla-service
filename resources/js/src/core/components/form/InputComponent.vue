<script>
export default {
    name: "InputComponent",
    props: [
        'type', 'placeholder', 'classList',
        'id', 'disabled', 'value'
    ],
    computed:{
        inputClassString(){
            return this.classList && this.classList.length > 0 ? this.classList.join(' ') : ''
        },
    },
    methods:{  }
}
</script>

<template>
    <input
        v-on:input="$emit('input', $event)"
        v-on:focusout="$emit('focusout', $event)"
        :value="value"
        :type="type"
        :name="id"
        :id="id"
        :placeholder="placeholder"
        :class="['input', inputClassString]"
        :disabled="disabled === 1"
    >
</template>

<style scoped>
.input {
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,.2);
    background-color: #fff;
    padding: 13px;
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
.input[disabled]{
    background-color: #E0E0E0;
    color:#565656;
    border:unset !important;
}
.input[disabled]::-moz-placeholder{
    color:#565656;
}
.input[disabled]::placeholder{
    color:#565656;
}
@media(max-width:675px){
    .input{
        font-size: 14px;
    }
}
</style>

