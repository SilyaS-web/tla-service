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
                        <UploadFilesBlock
                            v-model="projectFiles"
                            :id="'update-project-upload'"
                            :label="'Загрузите изображения товара'"
                            :files="project.project_files"
                            :error="errors.images"
                        ></UploadFilesBlock>
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

import UploadFilesBlock from '../../../../core/components/form/PlusFilesUploadBlockComponent.vue'

import Project from "../../../../core/services/api/Project";

export default{
    props:['project'],
    components:{UploadFilesBlock},
    data(){
        return {
            errors: ref({}),
            projectFiles: ref([]),
            Project
        }
    },
    mounted(){
    },
    updated(){
    },
    methods:{
        modifyProject(){
            if(this.projectFiles && this.projectFiles.length > 0) {
                this.project.images = this.projectFiles.filter(f => f.file && !f.id).map(f => f.file);
                this.project.uploaded_files = this.projectFiles.filter(f => f.id).map(f => f.id);
            }
            else{
                this.project.images = [];
                this.project.uploaded_files = this.project.project_files.map(p => p.id);
            }

            let formData = new FormData;

            formData.append('product_name', this.project.product_name);
            formData.append('product_nm', this.project.product_nm);
            formData.append('product_link', this.project.product_link);
            formData.append('product_price', this.project.product_price);

            if(this.project.project_works){
                for (let i = 0; i < this.project.project_works.length; i++){
                    formData.append('integration_types[' + i + ']', this.project.project_works[i].type);
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

            this.Project.update(this.project.id, formData)
                .then((data) => {
                    this.resetEditData()
                    this.$emit('updateMyProjects');
                })
                .catch(errors => this.errors = errors)
        },
        resetEditData(){
            this.$emit('resetEditData')
        },
    }
}
</script>
