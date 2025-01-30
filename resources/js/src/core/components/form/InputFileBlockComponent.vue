<template>
    <div class="form-group form-group--file">
        <label
            :class="'tab-content__profile-img-upload input-file ' + (fileName ? 'uploaded' : '')" for="profile-img">
            <div class="input-file__col">
                <span class = "input-file__notify">{{ fileName ? uploadedLabel : label }}</span>
                <span class = "input-file__file-name">{{ fileName }}</span>
            </div>
            <input
                @change="uploadImage"
                v-bind:value="modelValue"
                v-on:input="$emit('update:modelValue', $event.target.files[0])"
                type="file" name="image" class="" id="profile-img">
        </label>
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
import {ref} from 'vue'

export default{
    props: ['modelValue', 'label', 'uploadedLabel', 'error'],
    data(){
        return{
            fileName: ref(null)
        }
    },
    methods:{
        uploadImage(event){
            this.fileName = event.currentTarget.files[0].name
        }
    }
}
</script>
