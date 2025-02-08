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
        $('.project-item').find('.project-item__carousel--carousel').owlCarousel({
            margin: 5,
            nav: false,
            dots: true,
            responsive: {
                0:{
                    items: 1
                },
                1180: {
                    items:1
                }
            }
        });
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
