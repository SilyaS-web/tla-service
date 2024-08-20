<template>
    <div class="list-projects__item project-item" data-id="1">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in project.project_files"
                    class="project-item__img"
                    v-bind:style="'background-image:url(' + (!image.link ? '/img/profile-icon.svg' : `/storage/${image.link}`) + ')'"></div>
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
                v-for="work in project.project_works_with_quantity"
                class="card__tags-item"
                v-bind:data-id="work.id">
                    <span>{{ work.name }} {{ work.lost_quantity + '/' + work.total_quantity }}</span>
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
        methods:{
            unban(e) {
                var el = e.currentTarget;
                var id = $(el).data('id');

                axios({
                    method: 'get',
                    url: '/api/projects/' + id + '/unban/',
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Проект успешно разблокирован!'
                    });
                    this.$emit('statusManagement', id);
                })
            },
            ban(e) {
                var el = e.currentTarget;
                var id = $(el).data('id');

                axios({
                    method: 'get',
                    url: '/api/projects/' + id + '/ban/',
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
