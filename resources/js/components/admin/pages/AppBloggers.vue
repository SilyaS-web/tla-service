<template>
    <div class="admin-view__content blogers-list tab-content" id="blogers-list">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Список блогеров • {{ bloggers.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="blogers-list__list list-blogers admin-view__content-wrap">
                <BloggerItem
                    v-for="blogger in bloggers"
                    :bloggers="bloggers"
                    :blogger="blogger"
                    v-on:ban="userBanned"
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
        methods:{
            userBanned(){
                this.$emit('changedBloggersList');
            }
        }
        // setup(props) {
        //     bloggers = props.bloggers
        // }
    }
</script>
