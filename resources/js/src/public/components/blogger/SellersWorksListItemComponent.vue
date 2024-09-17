<template>
    <div class="list-projects__item project-item" :data-id="work.project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in work.project.product_files"
                    class="project-item__img" :style="'background-image:url(' + image + ')'"></div>
            </div>
            <div class="project-item__status active">
                {{ work.project.status_name }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                {{ work.project.product_price }}₽
            </div>
            <div class="project-item__subtitle" :title="work.project.product_name">
                {{ work.project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val" style="'width:' + (work.project.lost_quantity / work.project.quantity) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ work.project.lost_quantity }}/{{ work.project.quantity }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div class="card__tags-item">
                    <span>{{ work.name }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button class="btn btn-primary" @click="acceptApplication">Принять заявку</button>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: ['work'],
    methods: {
        goToChat(){

        },
        acceptApplication(){

        }
    }
}
</script>
