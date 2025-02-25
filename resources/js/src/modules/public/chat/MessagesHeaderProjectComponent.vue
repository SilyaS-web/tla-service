<template>
    <div class="projects-list__row projects-list__current-project current-project">
        <div class="current-project__main">
            <div class="current-project__row">
                <div class="current-project__img" :style="'background-image: url(' + (project.project_files && project.project_files[0] ? project.project_files[0].link : '/img/profile-icon.svg') + ')'"></div>
            </div>
            <div class="current-project__title">
                <p class="name"><b>{{ isMobile() && String(project.product_name).length > 45 ? String(project.product_name).substring(0, 45) + '...' : project.product_name }}</b></p>
                <p class="articul">Артикул товара: <span class="">{{ project.product_nm }}</span></p>
            </div>
        </div>
        <div class="current-project__col">
            <div class="current-project__title">
                <p class="name"><b>Формат рекламы</b></p>
                <p class="articul"> {{ workType }} </p>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['project', 'workType'],
    methods:{
        isMobile(){ return matchMedia('(max-width:475px)').matches }
    },
}
</script>
