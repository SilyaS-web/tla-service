<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <textarea
            :name="id"
            :id="id"
            :cols="cols"
            :rows="rows"
            :class="'textarea ' + (getSelectClassString())"
            :placeholder="placeholder"
            v-bind:value="modelValue"
            v-on:input="$emit('update:modelValue', $event.target.value)"></textarea>
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
export default{
    props:['id', 'label', 'placeholder', 'cols', 'rows', 'classList', 'modelValue', 'error'],
    methods:{
        getSelectClassString(){
            return this.classList && this.classList.length > 0 ? this.classList.join(' ') : ''
        }
    }
}
</script>
