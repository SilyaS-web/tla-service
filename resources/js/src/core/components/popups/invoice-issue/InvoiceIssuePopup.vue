<template>
    <popup-modal id="invoice-issue" ref="popup">
        <div class="invoice-issue__header popup__header">
            <div class="popup__title title">
                {{ popupTitle }}
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="invoice-issue__body">
            <div v-if="!isDataSentSuccessful" class="invoice-issue__form">
                <input-block-component
                    :label="'Название организации'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите название организации'"
                    v-model="data.payer_name"
                >
                </input-block-component>
                <input-block-component
                    :label="'ИНН'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите ИНН'"
                    v-model="data.payer_inn"
                >
                </input-block-component>
            </div>
            <div v-if="isDataSentSuccessful" class="invoice-issue__data">
                <div class="invoice-issue__data-item">
                    <p class="invoice-issue__data-title">
                        <b>Ссылка на PDF выставленного счета</b>
                    </p>
                    <a
                        @click.prevent="copyUrl(invoiceData.pdfUrl)"
                        href="#" class="invoice-issue__data-url">{{ invoiceData.pdfUrl }}</a>
                </div>
                <div class="invoice-issue__data-item">
                    <p class="invoice-issue__data-title">
                        <b>Ссылка на оплату через личный кабинет Т-Бизнеса</b>
                    </p>
                    <a
                        @click.prevent="copyUrl(invoiceData.incomingInvoiceUrl)"
                        href="#" class="invoice-issue__data-url">{{ invoiceData.incomingInvoiceUrl }}</a>
                </div>
            </div>
        </div>
        <div
            v-if="!isDataSentSuccessful"
            class="invoice-issue__footer">
            <button
                @click="createInvoice"
                class="btn btn-primary">
                Выставить счет
            </button>
        </div>
    </popup-modal>
</template>
<script>
import {ref} from "vue";

import SelectBlockComponent from "../../form/SelectBlockComponent.vue";
import InputBlockComponent from "../../form/InputBlockComponent.vue";
import PopupModal from '../AppPopup.vue';
import axios from "axios";

export default {
    components: { PopupModal, InputBlockComponent, SelectBlockComponent },
    data(){
        return{
            popupTitle: ref('Укажите данные'),
            data: ref({
                amount: 0,
                payer_name: null,
                payer_inn: null,
            }),
            invoiceData: ref({
                incomingInvoiceUrl:null,
                pdfUrl:null,
            }),
            isDataSentSuccessful: ref(false),
            errors: null,
        }
    },
    methods:{
        show(amount){
            this.data.amount = amount;

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },
        createInvoice(){
            let sendData = {};

            for (const key in this.data) {
                if(this.data[key]) sendData[key] = this.data[key]
            }

            axios({
                method: 'post',
                url: '/api/payments/init-invoice',
                data: sendData
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Выплата поставлена в очередь'
                });

                this.popupTitle = 'Данные для выставления счета'

                const pdfUrl = response.data.result.pdfUrl;
                const incomingInvoiceUrl = response.data.result.incomingInvoiceUrl;

                this.invoiceData.pdfUrl = pdfUrl
                this.invoiceData.incomingInvoiceUrl = incomingInvoiceUrl

                this.isDataSentSuccessful = true
            })
            .catch(error => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'В данный момент невозможно выставить счет. Попробуйте позже'
                });

                this._cancel()
            })
        },
        copyUrl(url){
            if(navigator.clipboard !== undefined){
                navigator.clipboard.writeText(url).then(function() {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Ссылка скопирована в буфер обмена'
                    })
                });
            }
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
<style>
#invoice-issue .popup__body{
    max-width:501px!important;
    padding: 32px!important;
}
</style>
<style scoped>
    .invoice-issue__header{
        margin-bottom: 40px;
    }
    .popup__title{
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0;
    }
    .invoice-issue__body{
        margin-bottom: 40px;
    }
    .invoice-issue__data{
        display:flex;
        flex-direction:column;
        gap: 16px;
    }
    .invoice-issue__data-title{
        font-size: 16px;
        color:var(--text);
    }
    .invoice-issue__data-title:not(:last-child){
        margin-bottom: 4px;
    }
    .invoice-issue__data-url{
        font-size: 16px;
        font-weight: 500;
        color:var(--primary);
        text-decoration:none;
        display:block;
        word-break: break-all;
    }
</style>
