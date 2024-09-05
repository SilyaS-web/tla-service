<template>
    <Header :user="user"></Header>
    <SellerProfile></SellerProfile>
</template>
<script>
    import {ref} from 'vue'

    import Header from '../components/layout/AppHeader.vue'
    import SellerProfile from './seller/AppSeller.vue'

    import User from '../../services/api/User.vue'

    export default{
        components:{SellerProfile, Header},
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
