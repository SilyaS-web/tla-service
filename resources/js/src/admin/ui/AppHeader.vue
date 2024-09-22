<template>
    <header class="header">
            <div class="header__container _container">
                <div class="header__body">
                    <div class="header__row">
                        <div class="header__title">
                            Панель управления
                        </div>
                        <div class="header__menu-btn">
                            <img src="/admin/img/menu-icon.svg" alt="">
                        </div>
                    </div>
                    <div class="header__col">
                        <div class="header__leave">
                            <a
                                @click="logout"
                                style="cursor:pointer"
                                type="header__leave">Выход</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
</template>
<script>
    import axios from "axios";

    export default{
        methods:{
            logout(event){
                event.preventDefault()

                localStorage.clear();

                axios.defaults.headers.common['Authorization'] = '';
                this.$router.replace('/login');
            },
        }
    }
</script>
