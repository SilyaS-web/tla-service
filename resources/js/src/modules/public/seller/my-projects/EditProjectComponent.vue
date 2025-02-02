<template>
    <div
        class="profile-create-project edit-project__quest" id="" style="width:100%; margin:0 auto;">
        <div class="create-project__body">
            <div class="create-project__title title">
                Редактировать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current" style="margin-bottom:30px;">
                        <div class="form-group">
                            <label for="product-name">Название товара</label>
                            <input
                                v-model="project.product_name"
                                type="text"
                                id="product-name"
                                name="product_name"
                                placeholder="Введите наименование товара" class="input input--product_name">
                            <span class="error" v-if="errors.product_name">{{ errors.product_name }}</span>
                        </div>
                        <div class="quest__step-row">
                            <div class="form-group">
                                <label for="project-articul">Артикул товара</label>
                                <input
                                    type="text"
                                    v-model="project.product_nm"
                                    id="product-articul"
                                    name="product_nm"
                                    placeholder="Введите артикул" class="input input--product_price">
                                <span class="error" v-if="errors.product_nm">{{ errors.product_nm }}</span>
                            </div>
                            <div class="form-group" style="flex:1 1">
                                <label for="" style="display:unset">Цена товара</label>
                                <div class="quantity-input">
                                    <input
                                        v-model="project.product_price"
                                        type="number" class="input" value="0" name="product_price">
                                </div>
                            </div>
                        </div>
                        <div class="quest__step-row">
                            <div class="form-group" style="flex:1 1 auto">
                                <label for="project-link">Ссылка на товар</label>
                                <input
                                    v-model="project.product_link"
                                    type="text" id="project-link" name="product_link" placeholder="Ссылка" class="input input--product_link">
                                <span class="error" v-if="errors.product_link">{{ errors.product_link }}</span>
                            </div>

                        </div>
                        <div class="form-group form-group--file create-project__files upload-files">
                            <div class="upload-files__title">
                                Загрузите изображения товара
                            </div>
                            <div class="upload-files__body">
                                <div
                                    v-for="(file, ind) in projectFiles"
                                    class="upload-files__item uploaded" :style="'display:' + (file.link != 'uploading' ? 'flex' : 'none')">
                                    <div class="upload-files__path" :title="file.link">{{ file.link }}</div>
                                    <div
                                        @click="deleteFile(file)"
                                        class="upload-files__delete">
                                    </div>
                                    <input
                                        @change="uploadFile"
                                        type="file" :data-id="ind" hidden="" name="images[]">
                                </div>
                                <div
                                    @click="triggerUpload"
                                    class="upload-files__plus">

                                </div>
                            </div>
                            <span class="error" v-if="errors.images">{{ errors.images }}</span>
                        </div>
                    </div>
                    <div id="step_2" class="quest__step step current">
                        <div class="quest__btns">
                            <button @click="modifyProject" class="btn btn-primary">
                                Сохранить
                            </button>
                            <button
                                class="btn btn-secondary" @click="resetEditData">Вернуться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
import Project from "../../../../core/services/api/Project";

export default{
    props:['project'],
    data(){
        return {
            errors: ref({}),
            projectFiles: ref({}),
            Project
        }
    },
    mounted(){
        this.projectFiles = this.project.project_files;
    },
    updated(){
        if(this.projectFiles.find(f => f.link === "uploading")){
            $(`.upload-files__item input[data-id=${this.projectFiles.length - 1}]`).click();
        }
    },
    methods:{
        modifyProject(){
            this.project.images = this.projectFiles.filter(f => f.file && !f.id).map(f => f.file);
            this.project.uploaded_files = this.projectFiles.filter(f => f.id).map(f => f.id);

            var formData = new FormData;

            formData.append('product_name', this.project.product_name);
            formData.append('product_nm', this.project.product_nm);
            formData.append('product_link', this.project.product_link);
            formData.append('product_price', this.project.product_price);

            if(this.project.integration_types){
                for (let i = 0; i < this.project.integration_types.length; i++){
                    formData.append('integration_types[' + i + ']', this.project.integration_types[i]);
                }
            }

            for (let i = 0; i < this.project.images.length; i++){
                if(this.project.images[i])
                    formData.append('images[' + i + ']', this.project.images[i])
            }
            for (let i = 0; i < this.project.uploaded_files.length; i++){
                if(this.project.uploaded_files[i])
                    formData.append('uploaded_images[' + i + ']', this.project.uploaded_files[i])
            }

            axios({
                method: 'post',
                url: '/api/projects/' + this.project.id,
                data: formData
            })
            .then((data) =>{
                this.resetEditData()

                notify('info', {title: 'Успешно!', message: 'Данные успешно обновлены.'});

                this.$emit('updateMyProjects');
            })
            .catch((err) => {
                let message =  (err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно сохранить проект, перепроверьте все поля, данные не заполнены, либо заполнены некоректно.';

                notify('info', {title: 'Внимание!', message: message});
                this.errors = err.response.errors;
            })
        },
        resetEditData(){
            this.$emit('resetEditData')
        },
        deleteFile(file){
            this.projectFiles = this.projectFiles.filter(_f => _f.link != file.link);
        },
        triggerUpload(){
            this.projectFiles.push({link: 'uploading', isUploaded: true});
        },
        uploadFile(event){
            var file = $(event.target)[0].files[0];

            this.projectFiles[this.projectFiles.length - 1].link = file.name;
            this.projectFiles[this.projectFiles.length - 1].file = file;
        },
    }
}
</script>
