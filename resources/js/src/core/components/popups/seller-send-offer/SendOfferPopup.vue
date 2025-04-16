<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                Укажите детали
            </div>
            <div class="popup__subtitle">
            </div>
        </div>
        <div class="popup__form">
            <SelectBlockComponent
                v-model="offer.complete_till"
                :label="'Желаемый срок выполнения'"
                :placeholder="'Выберите желаемый срок выполнения'"
                :selectID="'seller-offer-time'"
                :optionsList="completeUntilArr.map((t, ind) => {
                    return {
                        name: t,
                        value: ind,
                    }
                })"
            ></SelectBlockComponent>
            <InputBlockComponent
                v-model.number="offer.price"
                :inputType="'number'"
                :label="'Бюджет'"
                :inputPlaceholder="'Введите бюджет'"
                :inputClassList="[]"
                :inputID="'seller-offer-price'"
                :error="null"
            ></InputBlockComponent>
            <TextareaBlockComponent
                v-model="offer.specification"
                :id="'seller-offer-text'"
                :label="'Опишите задание'"
                :placeholder="'Напишите, что требуется выполнить'"
                :cols="30"
                :rows="10"
                :classList="[]"
                :error="null"
            >
            </TextareaBlockComponent>
            <PlusFilesUploadBlockComponent
                v-model="offer.files"
                :id="'order-upload-files'"
                :label="'Загрузите файлы'"
                :files="[]"
                :error="null"
            ></PlusFilesUploadBlockComponent>
            <button
                @click="sendOffer"
                class="btn btn-primary">
                Предложить заказ
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
import PlusFilesUploadBlockComponent from "../../form/PlusFilesUploadBlockComponent.vue";

import PopupModal from '../AppPopup.vue';
import UploadFilesBlock from "../../form/PlusFilesUploadBlockComponent.vue";
import axios from "axios";

export default {
    components: {
        UploadFilesBlock,
        PopupModal, TextareaBlockComponent, InputBlockComponent,
        InputFileBlockComponent, SelectBlockComponent, PlusFilesUploadBlockComponent
    },
    data(){
        return{
            completeUntilArr: [
                '1 день', '2 дня', '3 дня', '4 дня',
                '5 дней', '6 дней', '7 дней', '9 дней',
                '10 дней', '2 недели', '3 недели'
            ],
            completeUntilDaysMap: [
                1,2,3,4,5,6,7,9,10,14,21
            ],

            offer: ref({
                specification: '',
                price: 0,
                files: [],
                complete_till: null,
            }),
        }
    },
    methods:{
        show(blogger_id = null, seller_id = null, workID = null){
            this.blogger_id = blogger_id;
            this.seller_id = seller_id;
            this.workID = workID;

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },
        sendOffer(){
            let formData = new FormData;

            const sendData = {
                specification: this.offer.specification,
                price: this.offer.price,
                complete_till: this.completeUntilDaysMap[this.offer.complete_till],
                work_id: this.workID,
            }
            const offerFiles = this.offer.files.filter(obj => obj.file).map(obj => obj.file);

            for (const key in sendData) {
                if(sendData[key]){
                    formData.append(key, sendData[key])
                }
            }

            for (let i = 0; i < offerFiles.length; i++) {
                formData.append('files[' + i + ']', offerFiles[i])
            }

            axios({
                method: 'post',
                url: '/api/orders',
                data: formData,
            })
            .then((result) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заказ успешно создан'
                })

                for (const key in this.offer) {
                    this.offer[key] = null
                }

                this._confirm()
            })
            .catch((err) =>{
                notify('info', {
                    title: 'Внимание!',
                    message: 'Невозможно создать заказ. Попробуйте позже'
                })

                for (const key in this.offer) {
                    this.offer[key] = null
                }

                this._cancel()
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
.popup__header{
    margin-bottom: 40px;
}
.popup__title{
    text-align:left;
    margin-bottom: 0;
    font-size: 18px;
}
.btn-primary{
    width: 100%;
}
</style>
