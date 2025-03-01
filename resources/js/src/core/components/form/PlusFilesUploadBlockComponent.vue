<template>
    <div
        :id="id"
        class="form-group form-group--file create-project__files upload-files">
        <div class="upload-files__title">
            {{ label }}
        </div>
        <div class="upload-files__body">
            <div
                v-for="(file, ind) in uploadFiles"
                class="upload-files__item uploaded" :style="'display:' + (!['not-uploaded', 'uploading'].includes(file.link) ? 'flex' : 'none')">
                <div class="upload-files__path" :title="file.link">{{ file.link }}</div>
                <div
                    @click="deleteFile(file)"
                    class="upload-files__delete">
                </div>
                <input
                    @click.once=""
                    @change="uploadFile"
                    type="file" :data-id="ind" hidden="" name="images[]">
            </div>
            <div
                @click="triggerUpload"
                class="upload-files__plus">
            </div>
        </div>
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>

<script>
import {ref} from "vue"

export default {
    name: "PlusFilesUploadBlockComponent",
    props:{
        id:{type: String, required: true},
        label:{type: String, required: true},
        files:{type:Array, required: false, default: []},
        error:{type: [String, Array], required: false, default: ""}
    },
    data(){
        return {
            uploadFiles: ref([])
        }
    },
    mounted(){
        if(this.files && this.files.length > 0)
            this.uploadFiles = [...this.files]
    },
    updated(){
        let notUploadedFile = this.uploadFiles.find(f => f.link === "not-uploaded");

        if(notUploadedFile){
            notUploadedFile.link = 'uploading'
            $(`#${this.id} .upload-files__item input[data-id=${this.uploadFiles.length - 1}]`).click();
        }
    },
    methods:{
        deleteFile(file){
            this.uploadFiles = this.uploadFiles.filter(_f => _f.link !== file.link);

            this.$emit('update:modelValue', this.uploadFiles)
        },
        triggerUpload(){
            this.uploadFiles.push({link: 'not-uploaded', isUploaded: true});
        },
        uploadFile(event){
            const file = $(event.target)[0].files[0];

            this.uploadFiles[this.uploadFiles.length - 1].link = file.name;
            this.uploadFiles[this.uploadFiles.length - 1].file = file;

            this.$emit('update:modelValue', this.uploadFiles)
        },
    }
}
</script>

<style scoped>

</style>
