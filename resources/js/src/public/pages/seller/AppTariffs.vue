<template>
    <Header :user="user"></Header>
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
                                Действует по договоренности
                            </div>
                        </div>
                        <div class="tariff-card__text">
                            Наши менеджеры возьмут на себя заботу о вашем бренде и обеспечат ему профессиональное сопровождение.
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
                                Стартовый
                            </div>
                            <div class="tariff-card__subtitle">
                                7 дней бесплатно
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="tariff-card__total">
                                0 руб
                            </div>
                            <div class="tariff-card__single">
                                1 шт
                            </div>
                        </div>
                        <div class="form-group quantity-w" data-max="100" data-min="10">
                            <div class="quantity-minus disabled">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input type="number" class="input disabled" value="1" name="start-quantity">
                            </div>
                            <div class="quantity-plus disabled">
                                <img src="img/plus-icon.svg" alt="">
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
                    <div class="tariff__col tariff-card tariff-card--feedback" data-id="17">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Отзывы
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует 30 дней
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="col">
                                <div class="tariff-card__total">
                                    <span class="tariff-card__total--price">1000</span> руб
                                </div>
                                <div class="tariff-card__total tariff-card__total--old" style="display: none">
                                    <span class="tariff-card__total--price">1000</span> руб
                                </div>
                            </div>
                            <div class="tariff-card__single">
                                100 р. за шт
                            </div>
                        </div>
                        <div class="form-group quantity-w" data-max="100" data-min="10">
                            <div
                                class="quantity-minus">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input
                                    type="number" class="input" value="10" min="10" max="100" name="feedback-quantity">
                            </div>
                            <div
                                class="quantity-plus">
                                <img src="img/plus-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                @click="buyFeedback"
                                class="btn btn-primary btn-tariffs-payment" style="margin-top: 15px">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            02
                        </div>
                    </div>
                    <div class="tariff__col tariff-card tariff-card--integration" data-id="18">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Интеграция
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует 30 дней
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="col">
                                <div class="tariff-card__total">
                                    <span class="tariff-card__total--price">2000</span> руб
                                </div>
                                <div class="tariff-card__total tariff-card__total--old" style="display: none">
                                    <span class="tariff-card__total--price">2000</span> руб
                                </div>
                            </div>
                            <div class="tariff-card__single">
                                200 р. за шт
                            </div>
                        </div>
                        <div class="form-group quantity-w" data-max="100" data-min="10">
                            <div class="quantity-minus">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input type="number" class="input" value="10" min="10" max="100" name="integration-quantity">
                            </div>
                            <div class="quantity-plus">
                                <img src="img/plus-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                @click="buyIntegration"
                                class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            03
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
import Seller from "../../../services/api/Seller";
import Header from '../../components/layout/AppHeader.vue'

import CallUsPopup from '../../../ui/CallUsPopupComponent.vue'

export default {
    components:{ Header, CallUsPopup },
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
                    notify('error', {
                        title: 'Успешно!',
                        message: 'Ваше обращение успешно доставлено'
                    });
                })
                .catch(data => {
                    console.log(data)

                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно отправить обращение, попробуйте позже или напишите в поддержку'
                    });
                })
            })
        },
        buyFeedback(){
            var quantity = $(document)
            axios({
                method: 'get',
                url: '/api/payment/17/init?quantity='
            })
            .then(data => {
                if(data){
                    window.location.href = data
                }
            })
            .catch(data => {
                console.log(data)

                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно купить тариф, попробуйте позже или напишите в поддержку'
                });
            })
        },
        // changeQuantity(e){
        //     var wrap = $(e.target).closest('.tariff-card');
        //
        //     if(wrap.hasClass('tariff-card--feedback')){
        //         var value = wrap.find('.quantity-input .input').val(),
        //             price = 0,
        //             priceWithoutPromo = (parseInt(value) * 100);
        //
        //         if(parseInt(value) >= 30){
        //             price += 10 * 80 + 10 * 80 + 10 * 80 + ((parseInt(value) - 30) * 80);
        //             wrap.find('.tariff-card__single').text('80 р. за шт')
        //             wrap.find('.tariff-card__total--old').show()
        //         }
        //         else if(parseInt(value) >= 20){
        //             price += 10 * 90 + 10 * 90 + ((parseInt(value) - 20) * 90)
        //             wrap.find('.tariff-card__single').text('90 р. за шт')
        //             wrap.find('.tariff-card__total--old').show()
        //         }
        //         else{
        //             wrap.find('.tariff-card__total--old').hide()
        //             wrap.find('.tariff-card__single').text('100 р. за шт')
        //             price += 10 * 100 + ((parseInt(value) - 10) * 100)
        //         }
        //
        //         wrap.find('.tariff-card__total--price').text(price)
        //         wrap.find('.tariff-card__total--old .tariff-card__total--price').text(priceWithoutPromo)
        //     }
        //     else if(wrap.hasClass('tariff-card--integration')){
        //         var value = wrap.find('.quantity-input .input').val(),
        //             price = 0,
        //             priceWithoutPromo = (parseInt(value) * 200);
        //
        //         if(parseInt(value) >= 30){
        //             wrap.find('.tariff-card__single').text('160 р. за шт')
        //             price += 10 * 160 + 10 * 160 + 10 * 160 + ((parseInt(value) - 30) * 160);
        //             wrap.find('.tariff-card__total--old').show()
        //         }
        //         else if(parseInt(value) >= 20){
        //             wrap.find('.tariff-card__single').text('180 р. за шт')
        //             price += 10 * 180 + 10 * 180 + ((parseInt(value) - 20) * 180)
        //             wrap.find('.tariff-card__total--old').show()
        //         }
        //         else{
        //             wrap.find('.tariff-card__single').text('200 р. за шт')
        //             wrap.find('.tariff-card__total--old').hide()
        //             price += 10 * 200 + ((parseInt(value) - 10) * 200)
        //         }
        //
        //         wrap.find('.tariff-card__total--price').text(price)
        //         wrap.find('.tariff-card__total--old .tariff-card__total--price').text(priceWithoutPromo)
        //     }
        // },
        // inputQuantity(quantName){
        //     var value = $(e.target).val(),
        //         min = $(e.target).closest('.quantity-w').data('min'),
        //         max = $(e.target).closest('.quantity-w').data('max');
        //
        //     if(parseInt(value) < parseInt(min)){
        //         $(e.target).val(min)
        //     }
        //     else if(parseInt(value) > parseInt(max)){
        //         $(e.target).val(max)
        //     }
        //
        //     $(this).closest('.quantity-w').click()
        //
        //     switch (quantName){
        //         case 'feedback':
        //             this.quantity.feedback = $(e.target).val()
        //             break
        //         case 'integration':
        //             this.quantity.integration = $(e.target).val()
        //             break
        //     }
        // }
    }
}
</script>
