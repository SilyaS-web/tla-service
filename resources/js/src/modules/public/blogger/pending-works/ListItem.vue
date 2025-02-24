<template>
    <ProjectCard
        v-if="work.project"

        :id="work.project.id"
        :name="work.project.product_name"
        :price="work.project.product_price"
        :works="work.project.project_works"
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
            this.$refs.specificationPopup.show({
                specification:{
                    text: this.work.message,
                    files: this.work.files
                }
            })
            .then(isConfirmed => {
                this.Work.accept(this.work.id).then(
                    () => {
                        $(`#avail-projects .list-projects__item[data-id="${this.work.id}"]`).hide();
                    },
                    err => { }
                )
            });
        },
        denyApplication(){
            this.Work.deny(this.work.id).then(
                () => {
                    $(`#avail-projects .list-projects__item[data-id="${this.work.id}"]`).hide();
                },
                err => {

                }
            )
        }
    }
}
</script>
