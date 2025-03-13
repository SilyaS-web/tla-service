<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                Предложить заказ
            </div>
            <div class="popup__subtitle">
            </div>
        </div>
        <div class="popup__form">
            <InputBlockComponent
                v-model="offer.price"
                :label="'Бюджет'"
                :inputType="'number'"
                :inputPlaceholder="'Введите желаемый бюджет'"
                :inputClassList="[]"
                :inputID="'seller-offer-price'"
                :error="null"
            ></InputBlockComponent>
            <SelectBlockComponent
                v-model="offer.time"
                :selectID="'seller-offer-time'"
                :optionsList="timesArr.map(t => {
                        return {
                            name: t,
                            value: t,
                        }
                    })"
                :label="'Желаемый срок выполнения'"
            ></SelectBlockComponent>
            <TextareaBlockComponent
                v-model="offer.text"
                :id="'seller-offer-text'"
                :label="'Напишите, что требуется выполнить'"
                :placeholder="'Введите текст'"
                :cols="30"
                :rows="10"
                :classList="[]"
                :error="null"
            >
            </TextareaBlockComponent>
            <InputFileBlockComponent
                v-model="offer.file"
                :label="'Прикрепить файл'"
                :uploadedLabel="'Файл прикреплен'"
                :error="null"
            ></InputFileBlockComponent>
            <button
                @click="sendOffer"
                class="btn btn-primary">
                Отправить
            </button>
        </div>
    </popup-modal>
</template>
<script>
import {ref} from "vue";

import TextareaBlockComponent from "../../form/TextareaBlockComponent.vue";
import InputBlockComponent from "../../form/InputBlockComponent.vue";
import InputFileBlockComponent from "../../form/InputFileBlockComponent.vue";
import SelectBlockComponent from "../../form/SelectBlockComponent.vue";

import PopupModal from '../AppPopup.vue';

export default {
    components: {
        PopupModal, TextareaBlockComponent, InputBlockComponent,
        InputFileBlockComponent, SelectBlockComponent
    },
    data(){
        return{
            timesArr: [
                '1 день', '2 дня', '3 дня', '4 дня',
                '5 дней', '6 дней', '7 дней', '9 дней',
                '10 дней', '2 недели', '3 недели'
            ],
            offer: ref({
                text: '',
                price: 0,
                file: null,
                time: null,
            }),
        }
    },
    methods:{
        show(blogger_id = null, seller_id = null){
            this.blogger_id = blogger_id;
            this.seller_id = seller_id;

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },
        sendOffer(){
            console.log(this.offer)
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
