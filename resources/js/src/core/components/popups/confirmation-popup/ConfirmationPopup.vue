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
            <div class="popup__form-btns">
                <button @click="_confirm" class="btn btn-primary">
                    {{ okButton }}
                </button>
                <button @click="_cancel" class="btn btn-white">
                    {{ cancelButton }}
                </button>
            </div>
        </div>
    </popup-modal>
</template>
<script>
import PopupModal from '../AppPopup.vue';

export default {
    name: 'ConfirmPopup',
    components: { PopupModal },
    data: () => ({
        title: 'Подтвердите действие',
        subtitle: 'После действие нельзя будет отменить',
        okButton: 'Подтвердить',
        cancelButton: 'Отмена',

        resolvePromise: undefined,
        rejectPromise: undefined,
    }),
    methods: {
        show(opts = {}) {
            opts.title && (this.title = opts.title)
            opts.subtitle && (this.subtitle = opts.subtitle)
            opts.okButton && (this.okButton = opts.okButton)
            opts.cancelButton && (this.cancelButton = opts.cancelButton)

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
    },
}
</script>

<style scoped>
.popup__title{
    font-size: 18px;
}
.popup__form-btns{
    display: flex;
    gap: 0 24px;
}
.popup__form-btns>.btn{
    flex:1 1 50%;
    padding: 8px;
}
@media (max-width:768px) {
    .popup__title{
        font-size: 18px;
    }
    .popup__form-btns{
        display: flex;
        gap: 0 12px;
    }
}
</style>
