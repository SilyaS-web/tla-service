<template>
    <div class="auth__container _container">
        <div class="auth__body">
            <div class="auth__title title">
                Авторизуйтесь
            </div>
            <div class="form auth__form">
                <Input
                    v-model="user.phone"
                    :label="'Номер телефона'"
                    :inputType="'phone'"
                    :inputPlaceholder="'+79000000000'"
                    :inputClassList="['input--phone']"
                    :inputID="'phone'"
                    :error="(errors && errors.phone ? errors.phone : '')"
                ></Input>
                <Input
                    v-model="user.password"
                    :label="'Пароль'"
                    :inputType="'password'"
                    :inputPlaceholder="'Введите ваш пароль'"
                    :inputClassList="['input--password']"
                    :inputID="'pass'"
                    :error="(errors && errors.password ? errors.password : '')"
                ></Input>
                <p class="form-addit">
                    <a
                        @click="openResetPasswordPopup"
                        href="#" id="change-password-btn">Восстановить пароль</a>
                </p>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary" type="submit" v-on:click="login">
                        Войти
                    </button>
                    <a
                        :href="'https://t.me/adswap_bot' + (referralCode ? `?start=${referralCode}` : '')" class="btn btn-white">
                        Нет аккаунта? Зарегистрируйтесь
                    </a>
                </div>
                <p class="form-addit">Авторизуясь, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy" target="_blank">Политики конфиденциальности.</a> </p>
            </div>
        </div>
    </div>
    <ResetPasswordPopup ref="resetPasswordPopup"></ResetPasswordPopup>
</template>
<script>
import Input from '../../../core/components/form/InputBlockComponent'
import User from '../../../core/services/api/User.vue'
import ResetPasswordPopup from '../../../core/components/popups/reset-password/ResetPasswordPopup'

import {ref} from 'vue'

export default{
    components:{
        Input, ResetPasswordPopup
    },
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

            referralCode: ref(''),

            User,
        }
    },
    mounted(){
        this.referralCode = this.findGetParameter('code')
    },
    methods:{
        login(){
            this.User.auth(this.user).then(
                data => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');

                    if(data.role === 'admin'){
                        window.location.href = '/profile/admin'
                    }

                    if(data.role === 'blogger'){
                        if(data.status === 0){
                            this.$router.replace('/blogger/registration')
                            return
                        }
                    }

                    this.$router.replace('/profile')
                },
                err => {
                    this.errors = err.response.data.errors
                }
            )
        },
        openResetPasswordPopup(){
            this.$refs.resetPasswordPopup.show()
        },
        findGetParameter(parameterName) {
            let result = null,
                tmp = [];

            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

    }
}
</script>
