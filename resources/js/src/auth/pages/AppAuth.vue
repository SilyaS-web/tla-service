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
                    <a
                        @click="resetPasswordPopup = true"
                        href="#" id="change-password-btn">Восстановить пароль</a>
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
    <div
        v-if="resetPasswordPopup"
        class="popup" id="change-password">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__header">
                    <div class="popup__title title">
                        Введите номер
                    </div>
                    <div class="popup__subtitle">
                        Отправьте нам свой номер и наш телеграм-бот пришлёт вам новый пароль, который потом можно поменять в настройках профиля
                    </div>
                </div>
                <div class="popup__form">
                    <div class="form-group">
                        <label for="phone">Ваш номер</label>
                        <input
                            v-model="resetPasswordData.phone"
                            id="phone" name="phone" type="phone" class="input">
                    </div>
                    <p class="form-addit">
                        Оставляя свои данные, вы даёте на это согласие <br>
                        и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                    </p>
                    <button
                        @click="resetPassword"
                        class="btn btn-primary">
                        Отправить
                    </button>
                </div>
                <div
                    @click="resetPasswordPopup=false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
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
                resetPasswordData: ref({
                    phone: null
                }),
                resetPasswordPopup: false,
                User,
            }
        },
        created(){
        },
        methods:{
            login(){
                this.User.auth(this.user).then(
                    data => {
                        if(data.errors){
                            this.errors = data.errors;
                            return
                        }

                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');

                        this.$router.replace('/profile')
                    },
                    err => {
                        this.errors = err.response.data.errors
                    }
                )
            },
            resetPassword(){
                if(!this.resetPasswordData.phone){
                    notify('error', {
                        title: 'Ошибка!',
                        message: 'Введите номер'
                    });
                }
                axios({
                    method: 'get',
                    url:'/api/users/reset-password?phone=' + this.resetPasswordData.phone,
                })
                .then(data => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Зайдите в ваш телеграм и введите новый пароль в форму авторизации'
                    });

                    this.resetPasswordData.phone = null
                })
                .catch(data=>{
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно поменять пароль, попробуйте позже или обратитесь в поддержку'
                    });
                })
            }
        }
    }
</script>
