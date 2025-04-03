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
<style scoped>
.tg-confirmation{
    margin-bottom: 32px;
}
.tg-confirmation__row{
    display: flex;
    gap: 12px;
    flex-wrap: wrap;

}
.tg-confirmation__col{
    width:calc(50% - 12px);
}
.tg-confirmation__title{
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
}
.tg-confirmation__text{
    font-size: 14px;
    margin-bottom: 18px;
}
.tg-confirmation__btn a{
    font-weight: 500;
    color: #fff;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
    background-color: #259CD8;
    padding:12px 20px;
    border-radius: 5px;
    width: -moz-fit-content;
    width: fit-content;
}
.tg-confirmation__btn a:hover{
    text-decoration: none;
}
.tg-confirmation__btn a::before{
    content:"";
    display: block;
    width:24px; height:24px;
    background-image: url(/images/telegram-icon.svg?4ad4af875ea736acef90835c6ee2e6a0);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    filter: brightness(0) saturate(100%) invert(99%) sepia(39%) saturate(172%) hue-rotate(274deg) brightness(119%) contrast(100%);
}
.tg-confirmation__block {
    display: flex;
    gap: 10px;
    align-items: center;
}
.tg-confirmation__block img{
    width: 32px;
    heiht: 32px;
    filter: brightness(0) saturate(100%) invert(46%) sepia(44%) saturate(6441%) hue-rotate(2deg) brightness(105%) contrast(102%);
}
.tg-confirmation__qr{
    display: flex;
    justify-content: center;align-items: center;
}

</style>
