<script>
import PopupModal from "../AppPopup.vue";

export default {
    name: "OzonClientIdInstructionsPopup",
    components: {PopupModal},
    methods:{
        show() {
            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },
        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(true)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    }
}
</script>

<template>
    <popup-modal ref="popup" id="ozon-client-id-instructions">
        <div class="instruction__header popup__header">
            <div class="popup__title title">
                Где найти API-ключ «Озона»?
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="instruction__body">
            <div class="instruction__content">
                <ul class="instruction__list">
                    <li class="instruction__list-item">Заходим в личный кабинет поставщика на Ozon.</li>
                    <li class="instruction__list-item">Открываем «Настройки» и выбираем раздел API-ключи.</li>
                    <li class="instruction__list-item">На вкладке «Seller API» нажимаем «Сгенерировать ключ».</li>
                    <li class="instruction__list-item">Заходим в личный кабинет поставщика на Ozon.</li>
                    <li class="instruction__list-item instruction__list-item--img">
                        <img src="/img/ozon-id-instruction1.png" alt="">
                    </li>
                    <li class="instruction__list-item">В открывшемся боковом меню выбираем токен Admin — он в самом низу списка.</li>
                    <li class="instruction__list-item instruction__list-item--img">
                        <img src="/img/ozon-id-instruction2.png" alt="">
                    </li>
                    <li class="instruction__list-item">Даём ключу название, например — «ADSWAP». Нажимаем «Сгенерировать».</li>
                    <li class="instruction__list-item">Копируем появившийся ключ и Client ID.</li>
                    <li class="instruction__list-item">Переходим в личные данные → API и вставить ключ и Client ID.</li>
                </ul>
            </div>
        </div>
    </popup-modal>
</template>
<style>
#ozon-client-id-instructions .popup__body{
    max-width:782px!important;
}
</style>
<style scoped>
.instruction__header{
    margin-bottom: 32px;
}
.popup__title{
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 0;
}
.instruction__list{
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding-left: 18px;
}
.instruction__list-item{
    list-style-type: decimal;
    font-size: 16px;
    font-weight: 400;
    line-height: 1;
}
.instruction__list-item--img{
    list-style-type: none;
    margin-left: -18px;
}
.instruction__list-item--img img{
    width: 100%;
    max-width:545px;
}
</style>
