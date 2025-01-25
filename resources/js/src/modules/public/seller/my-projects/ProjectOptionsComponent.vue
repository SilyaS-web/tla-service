<template>
    <div class="profile-projects__opts">
        <a
            @click="editProject"
            class="profile-projects__opts-item">
            <img src="img/pencil-icon.svg" alt="">
            <div class="profile-projects__opts-name">Редактировать</div>
        </a>

        <a
            v-if="status != -3"
            href="#"
            @click="hideProject"
            class="profile-projects__opts-item">
            <img src="img/hide-icon.svg" alt="">
            <div class="profile-projects__opts-name">Скрыть</div>
        </a>

        <a
            v-else
            href="#"
            @click="showProject"
            class="profile-projects__opts-item">
            <img src="img/show-icon.svg" alt="">
            <div class="profile-projects__opts-name">Показывать</div>
        </a>

        <a
            @click="deleteProject"
            href="#" class="profile-projects__opts-item">
            <img src="img/delete-icon.svg" alt="">
            <div class="profile-projects__opts-name">Удалить</div>
        </a>
    </div>
</template>
<script>
export default{
    props:['status'],
    data(){

    },
    methods:{
        editProject(event){
            event.preventDefault()
            this.$emit('editProject', true)
        },
        deleteProject(event){
            event.preventDefault()
            this.$emit('deleteProject', true)
        },
        showProject(event){
            event.preventDefault()
            this.$emit('showProject', true)
        },
        hideProject(event){
            event.preventDefault()
            this.$emit('hideProject', true)
        },
    }
}
</script>
