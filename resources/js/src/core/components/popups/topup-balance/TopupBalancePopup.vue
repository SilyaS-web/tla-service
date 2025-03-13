<template>
    <popup-modal id="topup-balance" ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                Ваш баланс
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="topup-balance__body">
            <div class="topup-balance__content">
                <p class="topup-balance__balance">
                    13600 ₽
                </p>
                <p class="popup__title">Пополнить баланс через:</p>
                <div class="topup-balance__payments">
                    <a href="#" class="topup-balance__payments-item">
                        ПС
                    </a>
                    <a href="#" class="topup-balance__payments-item">
                        ПС
                    </a>
                    <a href="#" class="topup-balance__payments-item">
                        ПС
                    </a>
                    <a href="#" class="topup-balance__payments-item">
                        ПС
                    </a>
                    <div class="topup-balance__payments-item topup-balance__payments-item--bill">
                        <input class="input" type="text" placeholder="Выставление счета для юр. лиц">
                    </div>
                </div>
            </div>
        </div>
    </popup-modal>
</template>
<script>
import {ref} from "vue";

import PopupModal from '../AppPopup.vue';

import Work from '../../../services/api/Work.vue';

export default {
    components: { PopupModal },
    data(){
        return{
            Work
        }
    },
    methods:{
        show(){
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

<style scoped>
#topup-balance .popup__title{
    text-align: center;
}
.topup-balance__balance{
    font-size: 62px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 18px;
}
.topup-balance__payments{
    display: flex;
    gap: 12px;
    justify-content: center;
}
.topup-balance__payments-item{
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border:1px solid rgba(0,0,0,.15);
    padding: 5px;
    font-size: 12px;
    font-weight: 600;
}
.topup-balance__payments-item--bill{
    width: 240px;
    height: 32px;
    border:0;
    padding: 0;
}
.topup-balance__payments-item--bill .input{
    height: 32px;
}
</style>
