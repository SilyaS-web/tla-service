<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                {{ title }}
            </div>
            <div class="popup__subtitle subtitle">
                {{ subtitle }}
            </div>
        </div>
        <div class="popup__form">
            <div class="form-group">
                <label for="">Ваше имя</label>
                <input
                    v-model="userData.name"
                    id="name" name="name" type="text" class="input">
            </div>
            <div class="form-group">
                <label for="phone">Ваш номер</label>
                <input
                    v-model="userData.phone"
                    id="phone" name="phone" type="phone" class="input" placeholder = "+7(900)800-00-00">
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea
                    v-model="userData.comment"
                    name="comment" id="comment" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
            </div>
            <p class="form-addit">
                Оставляя свои данные, вы даёте на это согласие <br>
                и принимаете условия <a href="https://adswap.ru/privacy">Политики конфиденциальности.</a>
            </p>
            <div class="popup__form-btns">
                <button @click="_confirm" class="btn btn-primary">
                    {{ okButton }}
                </button>
                <button @click="_cancel" class="btn btn-secondary">
                    {{ cancelButton }}
                </button>
            </div>
        </div>
    </popup-modal>
</template>
<script>
import PopupModal from '../AppPopup.vue';
import {ref} from "vue";

export default {
    name: 'ConfirmPopup',
    components: { PopupModal },
    data: () => ({
        title: 'Оставьте свой номер',
        subtitle: 'Укажите свои контактные данные и наш менеджер свяжется с вами в течении 15 минут',
        okButton: 'Отправить',
        cancelButton: 'Отмена',

        // Private variables
        resolvePromise: undefined,
        rejectPromise: undefined,

        userData: ref({
            name: null,
            phone: null,
            comment: null
        })
    }),
    methods: {
        show(opts = {}) {
            this.title = opts.title
            this.subtitle = opts.subtitle
            this.okButton = opts.okButton
            if (opts.cancelButton) {
                this.cancelButton = opts.cancelButton
            }

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        _confirm() {
            if(!this.userData.phone){
                notify('error', {
                    title: 'Ошибка!',
                    message: 'Заполните номер'
                });
            }

            this.$refs.popup.close()
            this.resolvePromise(this.userData)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    },
}
</script>
