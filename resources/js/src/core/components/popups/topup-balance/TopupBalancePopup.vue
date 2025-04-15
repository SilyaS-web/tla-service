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
                <input
                    v-model="paymentSum"
                    type="number" class="topup-balance__balance" placeholder="Введите сумму">
                <div class="topup-balance__btns">
                    <button
                        @click="getPaymentLink"
                        class="btn btn-primary">
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
import axios from 'axios'

import PopupModal from '../AppPopup.vue';

import Work from '../../../services/api/Work.vue';
import InvoiceIssuePopup from "../invoice-issue/InvoiceIssuePopup.vue";

export default {
    components: {InvoiceIssuePopup, PopupModal },
    data(){
        return{
            showNotification: ref(false),
            paymentSum: ref(1000),
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
        getPaymentLink(){
            axios({
                method: 'get',
                url: '/api/payments/init',
                params:{
                    price: this.paymentSum,
                }
            })
            .then(response => {
                const link = response.data.link;

                if(!link){
                    notify('error', {
                        title: 'Внимание!',
                        message: 'В данный момент невозможно пополнить баланс, сервер не отвечает. Попробуйте позже'
                    });

                    return
                }

                window.location.href = link
            })
            .catch(error => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'В данный момент невозможно пополнить баланс. Попробуйте позже'
                });

                this._cancel()
            })
        },
        openInvoiceIssue(){ this.$refs.invoiceIssuePopup.show(this.paymentSum)  },
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
    padding: 12px;
    border:0;
    width: 100%;
}
.topup-balance__balance[type='number'] {
    -moz-appearance:textfield;
}
.topup-balance__balance::-webkit-outer-spin-button,
.topup-balance__balance::-webkit-inner-spin-button {
    -webkit-appearance: none;
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

@media(max-width:475px){
    .topup-balance__balance{
        font-size: 42px;
        margin-bottom: 21px;
    }
}
@media(max-width:375px){
    .topup-balance__balance{
        font-size: 38px;
        margin-bottom: 18px;
        padding: 8px;
    }
    .topup-balance__btns{
        gap: 8px;
        flex-direction: column;
    }
    .topup-balance__btns > .btn {
        flex: 1 1 100%;
        width: 100%;
    }
}
</style>
