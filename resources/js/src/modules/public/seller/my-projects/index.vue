<template>
    <div
        class="profile-projects" id="my-projects-list">
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
                    v-if="projects && projects.length > 0"
                    v-for="project in projects"

                    :project = "project"

                    v-on:switchTab="switchTab"
                    v-on:edit="editProject"
                ></ProjectsListItem>
                <span class="list-empty" v-else> Проектов нет </span>
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
            v-on:resetEditData="resetEditData"
            v-on:updateMyProjects="getProjects()"
        ></EditProject>
    </div>
</template>
<script>
import {ref} from "vue";

import ProjectsListItem from "./ProjectsListItem";
import Filter from "./FiltersComponent";
import EditProject from "./EditProjectComponent";

import User from "../../../../core/services/api/User.vue";

import Loader from "../../../../core/services/AppLoader.vue";

export default {
    components: {ProjectsListItem, Filter, EditProject},
    props:['currentItem'],
    data(){
        return {
            projects:ref([]),
            editingProject: ref(false),

            brands: ref([]),

            Loader, User
        }
    },
    mounted(){
        this.getProjects()
    },
    methods:{
        getProjects(){
            this.Loader.loaderOn(this.$el);

            const user = this.User.getCurrent();

            let params = {};

            for (const key in this.filterData) {
                if(this.filterData[key]){
                    params[key] = this.filterData[key]
                }
            }

            this.User.getProjects(user.id, params).then(data => {
                let list = data || [];

                if(this.currentItem){ //если мы перешли с другого модуля
                    if(this.currentItem.item === 'projects'){
                        list = list.map(_p => {
                            _p.currentProject = _p.id === this.currentItem.id

                            return _p;
                        });

                        this.currentItem = null
                    }
                }

                this.projects = list;

                setTimeout(()=>{
                    this.Loader.loaderOff(this.$el);
                }, 300)
            })
        },

        applyFilter(filterData){
            this.filterData = filterData;

            this.getProjects()
        },

        extractBrands(){
            if(!this.brands || this.brands.length === 0){
                const list = (this.projects || []).filter(_p => _p.marketplace_brand).map(_p => _p.marketplace_brand);
                this.brands = list.filter((value, index, array) => array.indexOf(value) === index)
            }
        },
        sortByBrand(){
            let counter = 0;

            const sort = String($('#projects-sort').val());
            const projects = $('.profile-projects__item');

            if(sort.length === 0){
                projects.show()
                return
            }

            projects.each((i, v)=>{
                if(String($(v).data('brand')).toLowerCase() !== sort.toLowerCase()){
                    $(v).hide();
                    counter++;
                }
                else $(v).show()
            })

            if(counter === projects.length){
                notify('info', {title: 'Внимание!', message: 'Проектов с таким брендом не найдено.'});
            }
        },

        editProject(project){
            this.editingProject = project;
        },
        resetEditData(){
            this.editingProject = false;
        },

        switchTab(work_id){
            this.$emit('switchTab', 'chat', {
                item: 'chat',
                id: work_id
            })
        },
    }
}
</script>
