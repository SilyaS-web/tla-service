<template>
    <popup-modal id="invoice-issue" ref="popup">
        <div class="invoice-issue__header popup__header">
            <div class="popup__title title">
                Укажите данные
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="invoice-issue__body">
            <div class="invoice-issue__form">
                <select-block-component
                    :label="'Банк'"
                    :error="false"
                    v-model="data.bank"
                    :selectClassList="[]"
                    :selectID="'issue-bank'"
                    :optionsList="[
                        {
                            name: 'Сбербанк',
                            value: 'sber'
                        },
                        {
                            name: 'Т-Банк',
                            value: 'tbank'
                        },
                        {
                            name: 'Альфа Банк',
                            value: 'alpha'
                        },
                        {
                            name: 'ВТБ',
                            value: 'vtb'
                        }
                    ]"
                ></select-block-component>
                <select-block-component
                    :label="'Тип организации'"
                    :error="false"
                    v-model="data.organizationType"
                    :selectClassList="[]"
                    :selectID="'issue-organization-type'"
                    :optionsList="[
                        {
                            name: 'ИП',
                            value: 'ip'
                        },
                        {
                            name: 'ООО',
                            value: 'ooo'
                        },
                        {
                            name: 'ОАО',
                            value: 'oao'
                        },
                    ]"
                ></select-block-component>
                <input-block-component
                    :label="'Название организации'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите название организации'"
                >
                </input-block-component>
                <input-block-component
                    :label="'ИНН'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите ИНН'"
                >
                </input-block-component>
                <input-block-component
                    :label="'БИК'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите БИК'"
                >
                </input-block-component>
                <input-block-component
                    :label="'Рассчётный счет'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите расчетный счет'"
                >
                </input-block-component>
            </div>
        </div>
        <div class="invoice-issue__footer">
            <button class="btn btn-primary">
                Отправить
            </button>
        </div>
    </popup-modal>
</template>
<script>
import {ref} from "vue";

import SelectBlockComponent from "../../form/SelectBlockComponent.vue";
import InputBlockComponent from "../../form/InputBlockComponent.vue";
import PopupModal from '../AppPopup.vue';

export default {
    components: { PopupModal, InputBlockComponent, SelectBlockComponent },
    data(){
        return{
            data: ref({
                bank: null,
                organizationType: null,
                organizationName: null,
                inn: null,
                bik: null,
                paymentAccount: null,
            }),
            errors: null,
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
</style>
