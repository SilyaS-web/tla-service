<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                Заполните данные
            </div>
            <div class="popup__subtitle">

            </div>
        </div>
        <div class="popup__form">
            <div class="form-group">
                <label for="message">Сообщение</label>
                <textarea
                    v-model="offer.message"
                    name="message" id="message" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
            </div>
            <button
                @click="sendOffer"
                class="btn btn-primary">
                Отправить
            </button>
        </div>
    </popup-modal>
</template>
<script>
import axios from "axios";
import {ref} from "vue";

import PopupModal from '../AppPopup.vue';

import Work from '../../../services/api/Work.vue';

export default {
    components: { PopupModal },
    data(){
        return{
            offer: ref({}),
            Work
        }
    },
    methods:{
        show(info = {}){
            this.offer = info

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },
        sendOffer(){
            if(!this.offer.project_work_id){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно отправить предложение, не выбран формат рекламы'
                });

                return
            }

            this.Work.sendOffer(null, this.offer.project_work_id, null, this.offer.message)
                .then((response) => {
                    this._confirm()
                })
                .catch((errors) => {  })
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
