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
                <button @click="_cancel" class="btn btn-secondary">
                    {{ cancelButton }}
                </button>
            </div>
        </div>
    </popup-modal>
</template>
<script>
    import PopupModal from '../services/AppPopup.vue';

    export default {
        name: 'ConfirmPopup',
        components: { PopupModal },
        data: () => ({
            // Parameters that change depending on the type of dialogue
            title: 'Подтвердите действие',
            subtitle: 'После действие нельзя будет отменить', // Main text content
            okButton: 'Подтвердить', // Text for confirm button; leave it empty because we don't know what we're using it for
            cancelButton: 'Отмена', // text for cancel button

            // Private variables
            resolvePromise: undefined,
            rejectPromise: undefined,
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
