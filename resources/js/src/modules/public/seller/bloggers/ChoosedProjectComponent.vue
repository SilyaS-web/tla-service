<template>
    <div
        v-if="project"
        class="projects-list__row projects-list__current-project current-project">
        <div class="current-project__main">
            <div class="current-project__row">
                <div class="current-project__img" :style="'background-image: url(' + (project.project_files && project.project_files[0] ? project.project_files[0].link : '/img/profile-icon.svg') + ')'"></div>
            </div>
            <div class="current-project__title">
                <p class="name"><b>{{ project.product_name }}</b></p>
                <p class="articul">Артикул товара: <span class="">{{ project.product_nm }}</span></p>
            </div>
        </div>
        <div class="current-project__col current-project__format">
            <div class="current-project__row">
                <div class="current-project__title">
                    <p class="name"><b>Формат рекламы</b></p>
                    <p class="articul"> {{ project.choosedWork.name }} </p>
                </div>
            </div>
        </div>
        <div class="current-project__btn">
            <button
                @click="switchToProjectsList"
                class="btn btn-secondary projects-list__choose-btn">Выбрать другой проект</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['project'],
    methods: {
        switchToProjectsList(){
            this.$emit('switchToProjectsList', true)
        }
    }
}
</script>
