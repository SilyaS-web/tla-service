<template>
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
</template>
<script>
import axios from "axios";

export default {
    data(){
        return{
            offer: ref({})
        }
    },
    methods:{
        show(info = {}){

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

            this.offer.blogger_id = this.user.blogger_id;

            axios({
                method: 'post',
                url: '/api/works',
                data: this.offer
            })
            .then((response) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заявка отправлена.'
                });


            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно обновить данные.'
                });
            })
        },
        _confirm() {
            if(!this.userData.phone){
                notify('error', {
                    title: 'Ошибка!',
                    message: 'Заполните номер'
                });
            }

            this.$refs.popup.close()
            this.resolvePromise(this.userData)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    }
}
</script>
