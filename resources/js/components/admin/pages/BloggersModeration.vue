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
<script>
    import BloggerItem from '../BloggerItemComponent.vue'

    export default{
        props: ['bloggers'],
        components: {BloggerItem},
        // setup(props) {
        //     bloggers = props.bloggers
        // }
    }
</script>
