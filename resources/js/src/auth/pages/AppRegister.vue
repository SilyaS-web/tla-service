<template>
    <div class="auth__container _container">
        <div class="auth__body auth__steps">
            <div class="auth__title title">
                Зарегистрируйтесь
            </div>
            <div class="form auth__form">
                <div class="form-group">
                    <label for="name">Ваше имя</label>
                    <input type="text" v-model="user.name" id="name" name="name" placeholder="Введите ваше имя" class="input input--name" value="{{ old('name') }}">
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label for="email">Ваш E-mail</label>
                    <input type="email" v-model="user.email" id="email" name="email" placeholder="Введите почту" class="input input--email" value="{{ old('email') }}">
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <InputPhone v-model="user.phone"></InputPhone>
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label for="pass">Пароль</label>
                    <input type="password" v-model="user.password" id="pass" name="password" placeholder="Введите ваш пароль" class="input input--password">
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label for="repeat-pass">Повторите пароль</label>
                    <input type="password" v-model="user.repeatPassword" id="repeat-pass" name="password_confirmation" placeholder="Повторите пароль" class="input input--password">
                    <span class="error"></span>
                </div>
                <div class="form-group">
                    <label for="role">Выберите роль</label>
                    <div class="roles-cards">
                        <div class="roles-cards__items">
                            <div
                                v-bind:class="'roles-cards__card' + (user.role == 'seller' ? ' active' : '')"
                                @click="changeRole"
                                data-role="seller">
                                <img src='img/seller-role.png' alt="">
                                <p>Селлер</p>
                            </div>
                            <div
                                v-bind:class="'roles-cards__card' + (user.role == 'blogger' ? ' active' : '')"
                                @click="changeRole"
                                data-role="blogger">
                                <img src='img/blogger-role.png' alt="">
                                <p>Блогер</p>
                            </div>
                            <div
                                v-bind:class="'roles-cards__card' + (user.role == 'agent' ? ' active' : '')"
                                @click="changeRole"
                                data-role="agent">
                                <img src='img/agent-role.png' alt="">
                                <p title="Представитель бренда(Агенство)">Агенство</p>
                            </div>
                        </div>
                        <input type="hidden" name="role" value="">
                    </div>
                    <span class="error"></span>
                </div>
                <div class="form-group tg-confirmation">
                    <div class="tg-confirmation__row" id="tg-confirmation" v-if="!isConfirmed">
                        <div class="tg-confirmation__col">
                            <div class="tg-confirmation__title">
                                Подтвердите личность
                            </div>
                            <div class="tg-confirmation__text">
                                Перейдите в телеграмм и подтведите свою личность, чтобы получать уведомления о новостях на площадкке.
                            </div>
                            <div class="tg-confirmation__btn">
                                <a target="_blank" href="https://t.me/adswap_bot" class="">Перейти</a>
                            </div>
                        </div>
                        <div class="tg-confirmation__col">
                            <div class="tg-confirmation__qr" id="tg-qr">

                            </div>
                        </div>
                    </div>
                    <div class="tg-confirmation__block" id="tg-confirmation__block"  v-if="isConfirmed">
                        <div>
                            <img src='img/approved-aproved-confirm-2-svgrepo-com.svg' />
                        </div>
                        <div>Телеграм-аккаунт успешно подтверждён</div>
                    </div>
                </div>
                <div class="form-btns auth__form-btns">
                    <button class="btn btn-primary next" type="submit" @click="registration">
                        Зарегистрироваться
                    </button>
                    <router-link :to="{path: '/login'}" class="btn btn-secondary">
                        Войти
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
    import InputPhone from '../ui/InputPhone.vue'
    import User from '../../services/api/User.vue'
    import {reactive} from 'vue'

    export default{
        components:{InputPhone, User},
        data(){
            return {
                user: reactive({
                    phone: null,
                    password: null
                }),
                errors: reactive({
                    phone: null,
                    password: null
                }),
                isConfirmed: reactive(false),
                User
            }
        },
        mounted(){
            var phoneConfirmationIntervalID = setInterval(() => {
                if (!this.isConfirmed) {
                    axios({
                        method: 'get',
                        url: 'api/users/phone-confirmed?phone=' + this.user.phone,
                    })
                    .then((response) => {
                        if(response.data.is_confirmed){
                            notify('error', {
                                title: 'Успшено!',
                                message: 'Ваш номер подтвержден.'
                            });
                        }
                        this.isConfirmed = response.data === 'success'
                    })
                    .catch((errors) => {
                        // notify('error', {
                        //     title: 'Внимание!',
                        //     message: 'В данный момент сервер не отвечает. Напишите в поддержку и попробуйте позже.'
                        // });

                        console.log(errors)
                    })
                }
            }, 1000)
        },
        methods:{
            changeRole(e){
                this.user.role = $(e.currentTarget).data('role');
            },
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

                var response = await this.User.register(this.user);
            },
        }
    }
</script>
