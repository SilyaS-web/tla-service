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
                v-on:change="$emit('update:modelValue', $event.target.files[0])"
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
<style scoped>
.input-file {
    position: relative;
    display: flex!important;
    align-items: center;
    padding-left: 20px;
}
.input-file::before{
    content:"";
    display: block;
    width: 100%;
    max-width: 30px;
    height: 30px;
    background-image: url(/images/download-icon.svg?8cdc3fdf3c116d343739a34df735b96f);
    filter: invert(41%) sepia(98%) saturate(2849%) hue-rotate(259deg) brightness(91%) contrast(87%);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    margin-right: 8px;
}
.input-file.uploaded::before{
    max-width: 30px; height:30px;
    background-image: url(/images/approved-aproved-confirm-2-svgrepo-com.svg?49ae55329536a7286152d8835bf2a101);
    filter: invert(41%) sepia(98%) saturate(2849%) hue-rotate(259deg) brightness(91%) contrast(87%)
}
.input-file input{
    display: none;
}
.input-file__col{
    display: flex;
    flex-direction: column;
}
.input-file__file-name{
    max-width:200px;
    text-wrap: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    font-size: 14px;
    color:var(--primary)
}
.input-file__notify{
    margin-bottom: 3px;
}
</style>
