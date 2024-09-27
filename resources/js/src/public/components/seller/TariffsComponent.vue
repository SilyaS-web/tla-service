<template>
    <section class="tariff">
        <div class="tariff__container  _container">
            <div class="tariff__body">
                <div class="tariff__header">
                    <div class="tariff__title title">Тарифы</div>
                    <div class="tariff__subtitle subtitle">Получайте отзывы на карточки и повышайте их рейтинг. Размещайте рекламу в обмен на товары  и анализируйте результаты интеграций у блогеров — все в одном сервисе.</div>
                </div>
                <div class="tariff__items" style="margin-bottom:40px;">
                    <div class="tariff__col tariff-card">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Индивидуальное сопровождение
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует по договоренности. <br>
                                Наши менеджеры возьмут на себя заботу о вашем бренде и обеспечат ему профессиональное сопровождение.
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                @click="callUsPopup"
                                class="btn btn-primary">Оставить заявку</button>
                        </div>
                        <div class="tariff-card__star">
                            <img src="img/star-icon.svg" alt="">
                        </div>
                    </div>
                    <div class="tariff__col tariff-card tariff-card--start" data-id="16">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Пробный
                            </div>
                            <div class="tariff-card__subtitle">
                                30 дней бесплатно
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="tariff-card__total">
                                0 руб
                            </div>
                            <div class="tariff-card__single">
                                \ 5 бартеров
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                class="btn btn-secondary">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            01
                        </div>
                    </div>
                    <div class="tariff__col tariff-card tariff-card--feedback" data-id="20">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Безлимит
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует 30 дней
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="tariff-card__total" style="text-wrap:nowrap">
                                4990 руб
                            </div>
                            <div class="tariff-card__single">
                                неограниченное количество бартеров
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                @click="buyUnlimited"
                                class="btn btn-primary" style="margin-top: 15px">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            02
                        </div>
                    </div>
                </div>
                <div class="tariff__row">
                    <p style="font-weight:500; font-size:18px; color:rgba(0,0,0,0.4)">Все тарифы действуют в течение 30 календарных дней после оплаты. Если вы не использовали свои отзывы и интеграции в течение оплаченного периода, они станут недоступными. Если вы общаетесь с блогерами в рамках открытых рекламных диалогов, то даже после окончания тарифа вы не потеряете доступ к сервису.</p>
                </div>
            </div>
        </div>
    </section>
    <call-us-popup ref="callUsPopup"></call-us-popup>
</template>
<script>
import {ref} from "vue";
import axios from "axios";

import User from "../../../services/api/User";

import CallUsPopup from '../../../ui/CallUsPopupComponent.vue'

export default {
    components:{ CallUsPopup },
    data(){
        return{
            user: ref(null),
            User,

            quantity:ref({
                start: 1,
                feedback: 10,
                integration: 10,
            }),

            tariffs: ref({}),
        }
    },
    mounted(){
        this.user = this.User.getCurrent();
    },
    methods:{
        callUsPopup(){
            this.$refs.callUsPopup.show({
                title: 'Оставьте свой номер',
                subtitle: 'Укажите свои контактные данные и наш менеджер свяжется с вами в течении 15 минут',
                okButton: 'Отправить',
                cancelButton: 'Отмена',
            }).then((data) => {
                axios({
                    method: 'get',
                    url: '/api/feedback',
                    params: data
                })
                .then(data => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Ваше обращение успешно доставлено'
                    });
                })
                .catch(data => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно отправить обращение, попробуйте позже или напишите в поддержку'
                    });
                })
            })
        },
        buyUnlimited(){
            axios({
                method: 'get',
                url: '/api/payment/20/init'
            })
            .then(response => {
                if(response.data && response.data.link){
                    window.location.href = response.data.link
                }
            })
            .catch(data => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно купить тариф, попробуйте позже или напишите в поддержку'
                });
            })
        },
    }
}
</script>
