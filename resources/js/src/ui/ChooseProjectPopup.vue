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
            <div class="popup__formats">
                <div
                    v-for="work in works"
                    class="input-checkbox-w">
                    <input
                        :id="'format_' + work.id"
                        :name="'format_' + work.id"
                        @click="choose(work)"
                        :checked="work.id === (choosedWork && choosedWork.id)"
                        type="radio" class="checkbox">
                    <label :for="'format_' + work.id">{{ work.name }} - {{ work.lost_quantity }}/{{ work.quantity }}</label>
                </div>
            </div>
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
        title: 'Выберите формат рекламы',
        subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера',
        okButton: 'Подтвердить',
        cancelButton: 'Отмена',
        works: [],
        choosedWork: null,

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
            this.works = opts.works

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        choose(work){
            this.choosedWork = work;
        },

        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(this.choosedWork)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    },
}
</script>
