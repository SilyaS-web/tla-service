<template>
    <SellerProfile v-if="user && user.role == 'seller'"></SellerProfile>
    <BloggerProfile v-if="user && user.role == 'blogger'"></BloggerProfile>
</template>
<script>
    import {ref} from 'vue'

    import SellerProfile from './seller/AppSeller.vue'
    import BloggerProfile from './blogger/AppBlogger.vue'

    import User from '../../services/api/User.vue'

    export default{
        components:{SellerProfile, BloggerProfile},
        data(){
            return {
                user: ref(null),
                User
            }
        },
        mounted(){
            this.user = User.getCurrent();
        },
        methods:{
        }
    }

</script>
