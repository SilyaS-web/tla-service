<template>
    <ClientStyles v-if = "(user && user.role != 'admin') || !user"></ClientStyles>
    <AdminStyles v-else-if = "(user && user.role == 'admin')"></AdminStyles>

    <SellerProfile v-if="user && user.role == 'seller'"></SellerProfile>
    <BloggerProfile v-if="user && user.role == 'blogger'"></BloggerProfile>
    <AdminProfile v-if="user && user.role == 'admin'"></AdminProfile>

    <ClientScripts v-if = "(user && user.role != 'admin') || !user"></ClientScripts>
    <AdminScripts v-else-if = "(user && user.role != 'admin')"></AdminScripts>
</template>
<script>
    import {ref} from 'vue'

    import SellerProfile from './seller/AppSeller.vue'
    import BloggerProfile from './blogger/AppBlogger.vue'
    import ClientStyles from '../../public/components/ClientStyles.vue'
    import ClientScripts from '../../public/components/ClientScripts.vue'

    import AdminProfile from '../../admin/pages/index.vue'
    import AdminStyles from '../../admin/components/AdminStyles.vue'
    import AdminScripts from '../../admin/components/AdminScripts.vue'

    import User from '../../services/api/User.vue'

    export default{
        components:{
            SellerProfile, BloggerProfile,
            ClientStyles, ClientScripts,

            AdminProfile,
            AdminStyles, AdminScripts
        },
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
