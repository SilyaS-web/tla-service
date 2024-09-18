<template>
    <SellerProfile></SellerProfile>
</template>
<script>
    import {ref} from 'vue'

    import SellerProfile from './seller/AppSeller.vue'

    import User from '../../services/api/User.vue'

    export default{
        components:{SellerProfile},
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
