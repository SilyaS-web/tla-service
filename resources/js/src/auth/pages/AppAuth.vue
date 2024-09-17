<template>
    <div class="auth__container _container">
        <div class="auth__body">
            <div class="auth__title title">
                Авторизуйтесь
            </div>
            <div class="form auth__form">
                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <InputPhone v-model="user.phone"></InputPhone>
                    <span class="error" v-if = "errors.phone">{{ errors.phone }}</span>
                </div>
                <div class="form-group">
                    <label for="pass">Пароль</label>
                    <input type="password" v-model="user.password" name="password" id="pass" placeholder="Введите ваш пароль" class="input input--password">
                    <span class="error" v-if = "errors.password">{{ errors.password }}</span>
                </div>
                <p class="form-addit">
                    <a href="#" id="change-password-btn">Восстановить пароль</a>
                </p>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary" type="submit" v-on:click="login">
                        Войти
                    </button>
                    <router-link :to="{name: 'Register'}">
                        <button class="btn btn-secondary"  style="cursor: pointer">
                            Зарегистрируйтесь
                        </button>
                    </router-link>
                </div>
                <p class="form-addit">Авторизуясь, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy" target="_blank">Политики конфиденциальности.</a> </p>
            </div>
        </div>
    </div>
</template>
<script>
    import InputPhone from '../ui/InputPhone.vue'
    import User from '../../services/api/User.vue'
    import {ref} from 'vue'

    export default{
        components:{InputPhone},
        data(){
            return {
                user: ref({
                    phone: null,
                    password: null
                }),
                errors: ref({
                    phone: null,
                    password: null
                }),
                User
            }
        },
        created(){
        },
        methods:{
            login(){
                this.User.auth(this.user).then(data => {
                    if(data.errors){
                        this.errors = data.errors;
                        return
                    }

                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');

                    this.$router.replace('/profile')
                })
            },
        }
    }
</script>
