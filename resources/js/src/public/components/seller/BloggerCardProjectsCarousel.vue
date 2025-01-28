<template>
    <div
        :class="'info-profile__projects owl-carousel ' + (projects && projects.length > 0 ? '' : 'info-profile__projects--empty')">
        <div
            v-for="project in projects"
            class="info-profile__projects-item list-projects__item project-item">
            <div
                v-if="project.project_files" class="project-item__carousel">
                <div
                    class="project-item__img"
                    :style="'background-image:url(' + (project.project_files && project.project_files[0] ? project.project_files[0].link : '/img/placeholder.webp') + ')'"></div>
            </div>
            <div class="project-item__content">
                <div class="project-item__title">
                    {{ project.product_price }}₽
                </div>
                <div
                    class="project-item__subtitle"
                    :title="project.product_name">
                    {{ project.product_name }}
                </div>
                <div class="project-item__format-tags card__row card__tags">
                    <div
                        v-for="work in project.project_works"
                        class="card__tags-item">
                        <span>{{ work.name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:['projects'],
        mounted(){
            $('.info-profile__projects').addClass('owl-carousel').owlCarousel({
                margin: 5,
                nav: true,
                dots: false,
                items: 1,
                responsive: {
                }
            });
        },
        updated(){
            $('.info-profile__projects').addClass('owl-carousel').owlCarousel({
                margin: 5,
                nav: true,
                dots: false,
                items: 1,
                responsive: {
                }
            });
        }
    }
</script>
