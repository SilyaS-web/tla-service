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
                <ProjectsListItem
                    v-if="myProjects && myProjects.length > 0"
                    v-for="project in myProjects"
                    :project = "project"
                    v-on:switchTab="switchTab"
                    v-on:edit="editProject"
                ></ProjectsListItem>
                <span v-else> Проектов нет </span>
            </div>
        </div>

        <Filter
            v-if="!editingProject"
            v-on:applyFilter="applyFilter"
        >
        </Filter>

        <EditProject
            v-if="editingProject"
            :project="editingProject"
            :projectFiles="editingProjectFiles"
            v-on:resetEditData="resetEditData"
        ></EditProject>

    </div>
</template>
<script>
import {ref} from "vue";

import ProjectsListItem from "./ProjectsListItem";
import Filter from "./FiltersComponent";
import EditProject from "./EditProjectComponent";

export default {
    components: {ProjectsListItem, Filter, EditProject},
    props: ['myProjects'],
    data(){
        return {
            editingProject: ref(false),
            editingProjectFiles: ref([]),

            brands: ref([]),
        }
    },
    methods:{
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

        editProject(project){
            this.editingProject = project;
            this.editingProject.feedback = (project.project_works.find(w => w.type == 'feedback') != undefined);
            this.editingProject.integration = (project.project_works.find(w => w.type == 'integration') != undefined);

            this.editingProjectFiles = this.editingProject.project_files;
        },
        resetEditData(){
            this.editingProject = false;
            this.editingProjectFiles = [];
        },

        switchTab(work_id){
            this.$emit('switchTab', 'chat', {
                item: 'chat',
                id: work_id
            })
        },

        applyFilter(filterData){
            this.$emit('applyFilter', filterData);
        },
    }
}
</script>
