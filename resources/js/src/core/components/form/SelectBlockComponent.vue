<template>
    <div class="form-group">
        <label for="country">{{ label }}</label>
        <select
            :id="selectID"
            :name="selectID"
            :class="'input select ' + (getSelectClassString())"
            v-bind:value="modelValue"
            v-on:change="$emit('update:modelValue', $event.target.value)">
            <option
                v-for="option in optionsList"
                :value="option.value">
                {{ option.name }}
            </option>
        </select>
        <span v-if="error" class="error">{{ error }}</span>
    </div>
</template>
<script>
export default{
    props:[
        'label', 'error', 'modelValue', 'selectClassList',
        'selectID', 'optionsList'
    ],
    data(){
        return {}
    },
    methods:{
        getSelectClassString(){
            return this.selectClassList && this.selectClassList.length > 0 ? this.selectClassList.join(' ') : ''
        }
    }
}
</script>
