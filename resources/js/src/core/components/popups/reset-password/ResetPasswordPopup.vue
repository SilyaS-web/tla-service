<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                Введите номер
            </div>
            <div class="popup__subtitle">
                Отправьте нам свой номер и наш телеграм-бот пришлёт вам новый пароль, который потом можно поменять в настройках профиля
            </div>
        </div>
        <div class="popup__form">
            <Input
                v-model="resetPasswordData.phone"
                :label="'Ваш номер'"
                :inputType="'phone'"
                :inputPlaceholder="'+79000000000'"
                :inputClassList="['input--phone']"
                :inputID="'phone'"
                :error="(errors && errors.phone ? errors.phone : '')"
            ></Input>
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
    </popup-modal>
</template>
<script>
import Input from '../../form/InputBlockComponent'
import PopupModal from '../AppPopup'
import {ref} from "vue";

export default{
    components: { PopupModal, Input },
    data(){
        return {
            resetPasswordData: ref({
                phone: null
            }),
            errors: null
        }
    },
    methods:{
        show(){
            this.$refs.popup.open()
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

                this.resetPasswordData.phone = null;
                this.$refs.popup.close();
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
