<template>
    <ProjectCard
        v-if="work.project"

        :id="work.project.id + work.id"
        :name="work.project.product_name"
        :price="work.project.product_price"
        :works="((work.project_works && work.project_works.length > 0) ? work.project_works : work.project.project_works)"
        :imgs="work.project.project_files"
    >
        <div class="project-item__btns">
            <button
                @click="acceptApplication"
                class="btn btn-primary">Принять</button>
            <button
                @click="denyApplication"
                class="btn btn-secondary">Отклонить</button>
        </div>
    </ProjectCard>
    <specification-popup ref="specificationPopup"></specification-popup>
</template>
<script>
import Work from '../../../../core/services/api/Work'
import Project from '../../../../core/services/api/Project'

import ProjectCard from '../../../../core/components/project-card/index'

import SpecificationPopup from '../../../../core/components/popups/specification-popup/SpecificationPopup.vue'

export default{
    props: ['work'],
    components:{ProjectCard, SpecificationPopup},
    data(){
        return {
            Project, Work
        }
    },
    mounted(){
    },
    updated(){
    },
    methods: {
        acceptApplication(){
            if(this.work.message || (this.work.files && this.work.files.length > 0)){
                this.$refs.specificationPopup.show({
                    specification:{
                        text: this.work.message,
                        files: this.work.files,
                        works_types: (this.work.project_works && this.work.project_works.length > 0) ? this.work.project_works : this.work.project.project_works
                    },
                    withConfirmation: true
                })
                .then(isConfirmed => {
                    if(isConfirmed){
                        this.Work.accept(this.work.id).then(
                            () => {
                                $(`#avail-projects .list-projects__item[data-id="${this.work.project.id + this.work.id}"]`).hide();
                            },
                            err => { }
                        )
                    }
                });
            }
            else{
                this.Work.accept(this.work.id).then(
                    () => {
                        $(`#avail-projects .list-projects__item[data-id="${this.work.project.id + this.work.id}"]`).hide();
                    },
                    err => { }
                )
            }
        },
        denyApplication(){
            this.Work.deny(this.work.id).then(
                () => {
                    $(`#avail-projects .list-projects__item[data-id="${this.work.project.id}"]`).hide();
                },
                err => {

                }
            )
        }
    }
}
</script>
