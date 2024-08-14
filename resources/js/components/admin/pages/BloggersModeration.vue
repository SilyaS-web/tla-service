<template>
    <div class="admin-view__content admin-blogers tab-content active" id="moderation">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Модерация блогеров • {{ bloggers.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="admin-blogers__blogers admin-view__content-wrap">
                <BloggerItem
                    v-for="blogger in bloggers"
                    :bloggers="bloggers"
                    :blogger="blogger"
                ></BloggerItem>
            </div>
        </div>
    </div>
</template>
<script setup>
    import BloggerItem from '../BloggerItemComponent.vue'
    import { ref } from 'vue'

    var bloggers = ref([
        {
            id: 1,
            name: 'Илья Софронов',
            phone: '+7(902)122-32-90',
            email: 'ilya.sofron@mail.ru',
            img: 'http://tla/img/profile-icon.svg',
            created_at: '12.08.24',
        },
        {
            id: 2,
            name: 'Алексей Андреев',
            phone: '+7(800)555-35-35',
            email: 'leha.gagog@mail.ru',
            img: 'http://tla/img/profile-icon.svg',
            created_at: '12.08.32',
        },
    ])

</script>
