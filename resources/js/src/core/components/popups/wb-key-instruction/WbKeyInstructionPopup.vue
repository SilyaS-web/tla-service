<script>
import PopupModal from "../AppPopup.vue";

export default {
    name: "WbKeyInstructionPopup",
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
    <popup-modal id="wb-key-instruction" ref="popup">
        <div class="instruction__header popup__header">
            <div class="popup__title title">
                Где найти ключ API на ВБ?
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="instruction__body">
            <div class="instruction__content">
                <ul class="instruction__list">
                    <li class="instruction__list-item">Откройте личный кабинет партнера на сайте Wildberries по адресу <a href="https://seller-auth.wildberries.ru/ru/?redirect_url=https%3A%2F%2Fseller.wildberries.ru%2F" target="_blank">seller.wildberries.ru</a></li>
                    <li class="instruction__list-item">Войдите под главным пользователем аккаунта. Если не войти под ролью владельца, раздел будет вам недоступен</li>
                    <li class="instruction__list-item">Через название вашего кабинета в правом верхнем углу перейдите в настройки кабинета, выберите раздел “Доступ к API”.</li>
                    <li class="instruction__list-item">Назовите токен. Вы можете назвать токен именем сервиса, на котором будете его использовать или перечислить в названии права, которые хотите дать этому токену. Так как вы можете сгенерировать несколько активных ключей, выберите название. которое поможет вам найти нужный ключ среди прочих.</li>
                    <li class="instruction__list-item">Выберите методы API. На сервисах, где есть интеграция API, как правило, указывают, какие методы при генерации ключа нужно указать.</li>
                    <li class="instruction__list-item">Поставьте галочку “Только на чтение”.</li>
                    <li class="instruction__list-item">Нажмите кнопку "Создать токен".</li>
                    <li class="instruction__list-item">Скопируйте API ключ, нажав кнопку "Скопировать". Обратите внимание, ключ отображается только один раз!</li>
                    <li class="instruction__list-item">Вставьте ключ на странице "Личные данные" - "API"</li>
                    <li class="instruction__list-item instruction__list-item--img">
                        <img src="/img/wb-key-instruction.png" alt="">
                    </li>
                </ul>
            </div>
        </div>
    </popup-modal>
</template>
<style>
#wb-key-instruction .popup__body{
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
