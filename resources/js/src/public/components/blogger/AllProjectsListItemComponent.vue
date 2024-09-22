<template>
    <div
        v-if="project"
        class="list-projects__item project-item" :data-id="project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="image in project.project_files"
                    class="project-item__img" :style="'background-image:url(' + image.link + ')'"></div>
            </div>
            <div class="project-item__status active">
                {{ project.status_name }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="project.product_name">
                {{ project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val" style="'width:' +
                    (project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) / project.works.map(_w => _w.quantity).reduce((a, b) => a + b, 0)) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.project_works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) }}/{{ project.project_works.map(_w => parseInt(_w.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-for="work in project.project_works"
                    class="card__tags-item" :data-id="work.id">
                    <span>{{ work.name }} - {{ parseInt(work.quantity) - work.lost_quantity }}/{{ work.quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button
                    v-if="!project.is_blogger_works"
                    @click="chooseWork(project.project_works)"
                    class="btn btn-primary" style="width:100%">Откликнуться</button>
                <button
                    v-else
                    class="btn btn-secondary" style="width:100%" disabled>Заявка отправлена</button>
            </div>
        </div>
    </div>
    <div
        v-if="isSendOfferPopupOpen"
        class="popup" id="blogger-send-offer" style="">
        <div class="popup__container _container">
            <div class="popup__body">
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
                <div
                    @click="isSendOfferPopupOpen = false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
</template>
<script>
    import {ref} from "vue";
    import axios from "axios";

    import ChooseProjectPopup from '../../../ui/ChooseProjectPopup.vue'
    import User from "../../../services/api/User";

    export default{
        components: {ChooseProjectPopup},
        props:['project'],
        data(){
            return {
                isSendOfferPopupOpen: ref(false),
                offer:ref({
                    project_work_id: null,
                    message: null,
                    blogger_id: null,
                }),
                user: ref(null),
                User
            }
        },
        mounted(){
            this.user = this.User.getCurrent();
        },
        methods:{
            async chooseWork(works){
                const data = await this.$refs.chooseProjectPopup.show({
                    title: 'Выберите формат рекламы',
                    subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите отправить селлеру',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                    works: works
                });

                if(data){
                    this.offer.project_work_id = data.id
                    this.isSendOfferPopupOpen = true;
                }
            },
            sendOffer(){
                this.isSendOfferPopupOpen = false;

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

                    this.offer.project_work_id = null;
                    this.offer.message = null;
                    this.project.is_blogger_works = true;
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно обновить данные.'
                    });
                })
            }
        }
    }
</script>
