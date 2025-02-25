<template>
    <ProjectCard
        v-if="work.project"

        :id="work.project.id"
        :name="work.project.product_name"
        :price="work.project.product_price"
        :works="work.project.project_works"
        :imgs="work.project.project_files"
    ></ProjectCard>
</template>
<script>
import Project from '../../../../core/services/api/Project'

import ProjectCard from '../../../../core/components/project-card/index'

export default{
    props: ['work'],
    components:{ ProjectCard },
    data(){
        return {
            Project
        }
    },
    mounted(){
    },
    updated(){
    },
    methods: {
        goToChat(){

        },
        acceptApplication(){

        }
    }
}
</script>
