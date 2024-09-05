<template>
    <div class="list-projects__item project-item" v-if="project.status != 'completed'">
        <div class="owl-carousel project-item__carousel">
            <div
                :style="'background-image: url(' + project.image + ')'"
                class="project-item__img">
            </div>
            <div class="project-item__status active">
                {{ project.status }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="project.product_name">
                {{ project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div
                        :style="'width:' + (project.lost_seats / (project.total_seats * 100)) + '%'"
                        class="line__val"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.lost_seats }}/{{ project.total_seats }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="project_work in project.project_works"
                    :data-id="project_work.id"
                    class="card__tags-item">
                    <span>{{ project_work.type }} - {{ project_work.quantity - project_work.lost_quantity }}/{{ project_work.quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <a
                    :data-project-id="project.id"
                    :data-articul="project.product_nm "
                    href="#" class="btn btn-primary btn-choose-project">Выбрать</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['project']
    }
</script>
