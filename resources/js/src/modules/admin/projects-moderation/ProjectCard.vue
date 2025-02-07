<template>
    <ProjectCard
        :id="project.id"
        :name="project.product_name"
        :price="project.product_price"
        :works="project.project_works"
        :imgs="project.project_files"
    >
        <div class="project-item__btns">
            <a  v-if="project.status == -2"
                v-bind:data-id="project.id"
                v-on:click="unban"
                class="btn btn-primary"
                style="width:100%">Разблокировать</a>
            <a  v-else
                v-bind:data-id="project.id"
                v-on:click="ban"
                class="btn btn-primary"
                style="width:100%">Заблокировать</a>
        </div>
    </ProjectCard>
</template>
<script>
import axios from 'axios'

import Carousel from '../../../core/components/AppCarousel'
import ProjectCard from '../../../core/components/project-card/index'

export default{
    props: ['project'],
    components: { ProjectCard, Carousel },
    mounted(){
        if(this.project){
            $(`.list-projects__item[data-id="${this.project.id}"]`).find('.project-item__carousel--carousel').owlCarousel({
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
        }
    },
    methods:{
        unban() {
            var id = this.project.id

            axios({
                method: 'get',
                url: '/api/projects/' + id + '/unban',
            })
            .then((response) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Проект успешно разблокирован!'
                });
                this.$emit('statusManagement', id);
            })
        },
        ban() {
            var id = this.project.id;

            axios({
                method: 'get',
                url: '/api/projects/' + id + '/ban',
            })
            .then((response) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Проект заблокирован!'
                });
                this.$emit('statusManagement', id);
            })
        },
    }
}
</script>
