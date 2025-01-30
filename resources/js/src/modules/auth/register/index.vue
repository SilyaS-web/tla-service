<template>
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Зарегистрируйтесь
            </div>
            <div class="form auth__form">
                <Input
                    v-model="user.name"
                    :label="'Ваше имя'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите ваше имя'"
                    :inputClassList="['input--name']"
                    :inputID="'name'"
                    :error="(errors && errors.name ? errors.name[0] : '')"
                ></Input>
                <Input
                    v-model="user.email"
                    :label="'Ваш E-mail'"
                    :inputType="'email'"
                    :inputPlaceholder="'Введите почту'"
                    :inputClassList="['input--email']"
                    :inputID="'email'"
                    :error="(errors && errors.email ? errors.email[0] : '')"
                ></Input>
                <Input
                    v-model="user.phone"
                    :label="'Номер телефона'"
                    :inputType="'phone'"
                    :inputPlaceholder="'+79000000000'"
                    :inputClassList="['input--phone']"
                    :inputID="'phone'"
                    :error="(errors && errors.phone ? errors.phone[0] : '')"
                ></Input>
                <Input
                    v-model="user.password"
                    :label="'Введите ваш пароль'"
                    :inputType="'password'"
                    :inputPlaceholder="'Введите ваш пароль'"
                    :inputClassList="['input--password']"
                    :inputID="'password'"
                    :error="(errors && errors.password ? errors.password[0] : '')"
                ></Input>
                <Input
                    v-model="user.repeatPassword"
                    :label="'Повторите пароль'"
                    :inputType="'password'"
                    :inputPlaceholder="'Повторите пароль'"
                    :inputClassList="['input--password']"
                    :inputID="'repeat-pass'"
                    :error="(errors && errors.password ? errors.password[0] : '')"
                ></Input>

                <!-- Блок подтверждения личности в ТГ-->
                <TgConfirmationBlock></TgConfirmationBlock>

                <!-- Блок выбора роли пользователя-->
                <ChooseRole
                    :errors="errors"
                    :role="user.role"
                ></ChooseRole>

                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary next" type="submit" @click="registration">
                        Зарегистрироваться
                    </button>
                    <router-link :to="{path: '/login'}" class="btn btn-white">
                        У меня уже есть аккаунт
                    </router-link>
                </div>
                <p class="form-addit">
                    Регистрируясь, вы даёте на это согласие и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
                </p>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue'

import User from '../../../core/services/api/User'
import Input from '../../../core/components/form/InputBlockComponent'
import TgConfirmationBlock from './TgConfirmationComponent'
import ChooseRole from './ChooseRoleComponent'

export default{
    components:{
        Input, TgConfirmationBlock, ChooseRole
    },
    data(){
        return {
            user: ref({}),
            errors: ref({
                phone: null,
                password: null
            }),

            User
        }
    },
    mounted(){

    },
    methods:{
        async registration(){
            var isPasswordsMatches = (this.user.password === this.user.repeatPassword);

            if(!isPasswordsMatches){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Пароли не совпадают.'
                });

                $('#pass').addClass('no-correct');
                $('#repeat-pass').addClass('no-correct');

                return
            }

            this.User.register(this.user).then(
                data => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('session_token');

                    if(this.user.role == 'blogger'){
                        this.$router.replace('/blogger/register')
                        return
                    }

                    this.$router.replace('/profile')
                },
                err => {
                    this.errors = err.response.data;
                }
            )
        },
    }
}
</script>
