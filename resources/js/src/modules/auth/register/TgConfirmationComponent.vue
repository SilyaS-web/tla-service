<template>
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
</template>
<script>
import {ref} from "vue";

export default {
    data(){
        return{
            isConfirmed: ref(false),
        }
    },
    mounted(){
        var phoneConfirmationIntervalID = setInterval(() => {
            if (!this.isConfirmed) {
                axios({
                    method: 'get',
                    url: '/api/users/phone-confirmed?phone=' + this.user.phone,
                })
                    .then((response) => {
                        if(response.data.is_confirmed){
                            notify('info', {
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
                    })
            }
        }, 1000)
    }
}
</script>
