<template>
    <div class="list-projects__item project-item">
        <div class="owl-carousel project-item__carousel">
            <div
                :style="'background-image: url(' + project.project_files[0].link + ')'"
                class="project-item__img">
            </div>
            <div class="project-item__status active">
                {{ project.status_name }}
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
                    <div class="line__val"
                         :style="'width:' + ((project.project_works.map(_p => parseInt(_p.lost_quantity)).reduce((a, b) => a + b, 0) / project.project_works.map(_p => parseInt(_p.quantity)).reduce((a, b) => a + b, 0)) * 100) + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.project_works.map(_p => parseInt(_p.lost_quantity)).reduce((a, b) => a + b, 0) }} / {{ project.project_works.map(_p => parseInt(_p.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="project_work in project.project_works"
                    :data-id="project_work.id"
                    class="card__tags-item">
                    <span>{{ project_work.type }} - {{ project_work.lost_quantity }}/{{ project_work.quantity }}</span>
                </div>
            </div>
<!--            <div class="project-item__btns">-->
<!--                <a-->
<!--                    :data-project-id="project.id"-->
<!--                    :data-articul="project.product_nm"-->
<!--                    href="#" class="btn btn-primary btn-choose-project">Выбрать</a>-->
<!--            </div>-->
        </div>
    </div>
</template>
<script>
    export default {
        props: ['project']
    }
</script>
