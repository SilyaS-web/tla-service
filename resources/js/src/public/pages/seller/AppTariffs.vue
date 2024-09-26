<template>
    <Header :user="user"></Header>
    <Tariffs></Tariffs>
    <Footer></Footer>
</template>
<script>
import {ref} from "vue";

import User from "../../../services/api/User";
import Tariffs from "../../components/seller/TariffsComponent";
import Header from '../../components/layout/AppHeader.vue'
import Footer from '../../components/layout/AppFooter.vue'

export default {
    components:{ Header, Footer, Tariffs },
    data(){
        return{
            user: ref(null),
            User,
        }
    },
    mounted(){
        this.user = this.User.getCurrent();
    },
    methods:{
    }
}
</script>
