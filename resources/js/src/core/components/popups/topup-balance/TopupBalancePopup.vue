<template>
    <popup-modal id="topup-balance" ref="popup">
        <div
            v-if="showNotification"
            class="topup-balance__notify">
            На вашем балансе недостаточно средств
        </div>
        <div class="popup__header">
            <div class="popup__title title">
                Сумма пополнения
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="topup-balance__body">
            <div class="topup-balance__content">
                <p class="topup-balance__balance">
                    13600 ₽
                </p>
                <div class="topup-balance__btns">
                    <button class="btn btn-primary">
                        Пополнить картой
                    </button>
                    <button
                        @click="openInvoiceIssue"
                        class="btn btn-secondary green">
                        Выставить счет
                    </button>
                </div>
            </div>
            <InvoiceIssuePopup ref="invoiceIssuePopup"></InvoiceIssuePopup>
        </div>
    </popup-modal>
</template>
<script>
import {ref} from "vue";

import PopupModal from '../AppPopup.vue';

import Work from '../../../services/api/Work.vue';
import InvoiceIssuePopup from "../invoice-issue/InvoiceIssuePopup.vue";

export default {
    components: {InvoiceIssuePopup, PopupModal },
    data(){
        return{
            showNotification: ref(false),
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
        toggleNotification(){ this.showNotification = !this.showNotification },
        openInvoiceIssue(){ this.$refs.invoiceIssuePopup.show()  },
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
<style>
#topup-balance .popup__body{
    max-width:782px;
    padding: 24px;
}
</style>
<style scoped>
#topup-balance .popup__title{
    text-align: center;
    font-size: 16px;
    font-weight: 500;
    color:#2E2E2E;
    margin-bottom: 8px;
}
#topup-balance .popup__header{
    margin-bottom: 0;
}
.topup-balance__balance{
    font-size: 64px;
    font-weight: 300;
    text-align: center;
    margin-bottom: 32px;
    color:#2E2E2E;
}
.topup-balance__btns{
    display: flex;
    gap: 24px;
}
.topup-balance__btns > .btn{
    flex:1 1 50%;
}
.topup-balance__notify{
    color:#2E2E2E;
    font-size: 28px;
    font-weight: 400;
    margin-bottom: 32px;
}
</style>
