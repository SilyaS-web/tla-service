<template>
    <div
        v-if="project"
        class="list-projects__item project-item" :data-id="project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in project.project_files"
                    class="project-item__img"
                    v-bind:style="'background-image:url(' + (!image.link ? '/img/profile-icon.svg' : `/${image.link}`) + ')'"></div>
            </div>
            <div class="project-item__status active">
                {{ project.status_name  }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                {{ project.product_price  }}₽
            </div>
            <div class="project-item__subtitle" title="">
                {{ project.product_name  }}
            </div>
            <div class="project-item__format-tags card__row card__tags">
               <div
                v-for="work in project.project_works"
                class="card__tags-item"
                v-bind:data-id="work.id">
                    <span>{{ work.name }} {{ work.lost_quantity + '/' + work.quantity }}</span>
                </div>
            </div>
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
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default{
        props: ['project'],
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
