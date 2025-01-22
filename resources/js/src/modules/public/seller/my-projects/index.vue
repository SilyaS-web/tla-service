<template>
    <div
        class="profile-projects tab-content" id="profile-projects">
        <div
            v-if="!editingProject"
            class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список моих проектов
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                </div>
            </div>
            <div class="profile-projects__sort form-group" style="margin-bottom:32px;">
                <select
                    @click="extractBrands"
                    @change="sortByBrand"
                    name="projects-sort" id="projects-sort" style="border-radius:5px; border:1px solid rgba(0,0,0,.1); padding:0 8px; max-width:380px; height: 50px; font-size:18px">
                    <option value="">Выберите бренд</option>
                    <option value="">Все бренды</option>
                    <option
                        v-for="brand in brands"
                        :value="brand">
                        {{ brand }}
                    </option>
                </select>
            </div>
            <div class="profile-projects__items">
                <MyProjectsListItem
                    v-if="myProjects && myProjects.length > 0"
                    v-for="project in myProjects"
                    :project = "project"
                    v-on:switchTab="switchTab"
                    v-on:edit="editProject"
                ></MyProjectsListItem>
                <span v-else> Проектов нет </span>
            </div>
        </div>
        <div
            v-if="!editingProject"
            class="profile-projects__filters">
            <div class="projects-list__filter filter">
                <div class="filter__body">
                    <div class="filter__top">
                        <p class="filter__title">
                            Фильтр
                        </p>
                        <a
                            @click="resetFilter"
                            href="#" class="filter__reset">
                            Сбросить
                        </a>
                    </div>
                    <div class="filter__items">
                        <div class="form-group filter__item">
                            <input type="text" class="input" name="filter-name" id="filter-name" v-model="filter.product_name" placeholder="Поиск по названию">
                        </div>
                        <div class="form-group filter__item">
                            <label for="">Формат рекламы</label>
                            <select name="project_type" id="filter-format" class="input" v-model="filter.project_type">
                                <option value="" class="">Выберите формат</option>
                                <option value="integration" class="">Интеграция</option>
                                <option value="feedback" class="">Выкуп + отзыв</option>
                            </select>
                        </div>

                        <div class="filter__btns">
                            <button
                                @click="applyFilter"
                                class="btn btn-primary">Применить</button>
                            <button
                                @click=""
                                class="btn btn-secondary hide">Скрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="editingProject"
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
                                    v-model="editingProject.product_name"
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
                                        v-model="editingProject.product_nm"
                                        id="product-articul"
                                        name="product_nm"
                                        placeholder="Введите артикул" class="input input--product_price">
                                    <span class="error" v-if="errors.product_nm">{{ errors.product_nm }}</span>
                                </div>
                                <div class="form-group" style="flex:1 1">
                                    <label for="" style="display:unset">Цена товара</label>
                                    <div class="quantity-input">
                                        <input
                                            v-model="editingProject.product_price"
                                            type="number" class="input" value="0" name="product_price">
                                    </div>
                                </div>
                            </div>
                            <div class="quest__step-row">
                                <div class="form-group" style="flex:1 1 auto">
                                    <label for="project-link">Ссылка на товар</label>
                                    <input
                                        v-model="editingProject.product_link"
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
                                        v-for="(file, ind) in editingProjectFiles"
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
    </div>
</template>
<script>
import Project from "../../../../core/services/api/Project";
import {ref} from "vue";

import MyProjectsListItem from "./ListItem";

export default {
    components: {MyProjectsListItem},
    props: ['myProjects'],
    data(){
        return {
            brands: ref([]),
            filter: ref({
                project_type: null,
                product_name: null,
            }),
            editingProject: ref(false),
            editingProjectFiles: ref([]),
            errors: ref({}),
            Project
        }
    },
    updated(){
        if(this.editingProjectFiles.find(f => f.link == "uploading")){
            $(`.upload-files__item input[data-id=${this.editingProjectFiles.length - 1}]`).click();
        }
    },
    methods:{
        editProject(project){
            this.editingProject = project;
            this.editingProject.feedback = (project.project_works.find(w => w.type == 'feedback') != undefined);
            this.editingProject.integration = (project.project_works.find(w => w.type == 'integration') != undefined);

            this.editingProjectFiles = this.editingProject.project_files;
        },

        modifyProject(){
            this.editingProject.images = this.editingProjectFiles.filter(f => f.file).map(f => f.file);
            this.editingProject.uploaded_files = this.editingProjectFiles.filter(f => f.id).map(f => f.id);

            var formData = new FormData;

            formData.append('product_name', this.editingProject.product_name);
            formData.append('product_nm', this.editingProject.product_nm);
            formData.append('product_link', this.editingProject.product_link);
            formData.append('product_price', this.editingProject.product_price);
            formData.append('feedback', (this.editingProject.feedback ? 1 : 0));
            formData.append('integration', (this.editingProject.integration ? 1 : 0));

            for (let i = 0; i < this.editingProject.images.length; i++){
                if(this.editingProject.images[i])
                    formData.append('images[' + i + ']', this.editingProject.images[i])
            }
            for (let i = 0; i < this.editingProject.uploaded_files.length; i++){
                if(this.editingProject.uploaded_files[i])
                    formData.append('uploaded_images[' + i + ']', this.editingProject.uploaded_files[i])
            }

            axios({
                method: 'post',
                url: '/api/projects/' + this.editingProject.id,
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
            this.editingProject = false;
            this.editingProjectFiles = [];
        },
        deleteFile(file){
            this.editingProjectFiles = this.editingProjectFiles.filter(_f => _f.link != file.link);
        },
        triggerUpload(){
            this.editingProjectFiles.push({link: 'uploading', isUploaded: true});
        },
        uploadFile(event){
            var file = $(event.target)[0].files[0];

            this.editingProjectFiles[this.editingProjectFiles.length - 1].link = file.name;
            this.editingProjectFiles[this.editingProjectFiles.length - 1].file = file;
        },
        extractBrands(){
            if(!this.brands || this.brands.length === 0){
                var list = (this.myProjects || []).filter(_p => _p.marketplace_brand).map(_p => _p.marketplace_brand);
                this.brands = list.filter((value, index, array) => array.indexOf(value) === index)
            }
        },
        sortByBrand(){
            var sort = String($('#projects-sort').val()), counter = 0;

            if(sort.length === 0){
                $('.profile-projects__item').show()
                return
            }

            $('.profile-projects__item').each((i, v)=>{
                if( String($(v).data('brand')).toLowerCase() != sort.toLowerCase() ){
                    $(v).hide();
                    counter++;
                }
                else $(v).show()
            })

            if(counter === $('.profile-projects__item').length){
                notify('info', {title: 'Внимание!', message: 'Проектов с таким брендом не найдено.'});
            }
        },
        switchTab(work_id){
            this.$emit('switchTab', 'chat', {
                item: 'chat',
                id: work_id
            })
        },
        applyFilter(){
            this.$emit('applyFilter', this.filter);
        },
        resetFilter(){
            this.filter = {
                product_name: '',
                project_type: '',
            }
            this.$emit('applyFilter', false);
        },
    }
}
</script>
