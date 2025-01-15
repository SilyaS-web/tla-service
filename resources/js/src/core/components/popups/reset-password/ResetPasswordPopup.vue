<template>
    <div
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
