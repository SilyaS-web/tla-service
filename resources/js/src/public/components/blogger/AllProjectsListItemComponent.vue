<template>
    <div class="list-projects__item project-item" :data-id="project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in project.product_files"
                    class="project-item__img" :style="'background-image:url(' + image + ')'"></div>
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
                    <div class="line__val" style="'width:' +
                    (project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) / project.works.map(_w => _w.quantity).reduce((a, b) => a + b, 0)) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) }}/{{ project.works.map(_w => _w.quantity).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in project.works"
                    class="card__tags-item" :data-id="work.id">
                    <span>{{ work.name }} - {{ work.quantity - work.lost_quantity }}/{{ $project_work->quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button
                    v-if="!project.is_sended"
                    class="btn btn-primary btn-blogger-send-offer" style="width:100%" :data-project-work="project.id">Откликнуться</button>
                <button
                    v-else
                    class="btn btn-primary btn-blogger-send-offer" style="width:100%" disabled>Заявка отправлена</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:['project']
    }
</script>
