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
                                Индивидуальные условия
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует по договоренности
                            </div>
                        </div>
                        <div class="tariff-card__text">
                            Индивидуальный тариф позволяет клиентам свободно выбирать количество интеграций и отзывов в своем плане.
                            <br>
                            <b>Рассматривается только от 100 заявок.</b>
                        </div>
                        <div class="tariff-card__btns">
                            <button
                                @click="callUsPopup"
                                class="btn btn-primary">Оставить заявку</button>
                        </div>
                        <div class="tariff-card__star">
                            <img src='/img/star-icon.svg' alt="">
                        </div>
                    </div>
                    <div class="tariff__col tariff-card">
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
                        <div class="form-group quantity-w" data-max="100">
                            <div
                                class="quantity-minus"
                                style="opacity: .6">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input type="number" class="input" value="1" name="start-quantity">
                            </div>
                            <div
                                class="quantity-plus"
                                style="opacity: .6">
                                <img src="img/plus-icon.svg" alt="">
                            </div>
                        </div>
<!--                        <div class="tariff-card__select form-group">-->
<!--                            <select name="" id="" class = "select">-->
<!--                                <option value="2">Отзывы на WB, OZON - 10 шт</option>-->
<!--                                <option value="5">Интеграции Ins - 10 шт</option>-->
<!--                                <option value="11">Интеграции VK - 10 шт</option>-->
<!--                                <option value="14">Интеграции Telegram - 10 шт</option>-->
<!--                                <option value="8">Интеграции YTube - 10 шт</option>-->
<!--                            </select>-->
<!--                        </div>-->
                        <div class="tariff-card__btns">
                            <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            01
                        </div>
                    </div>
                    <div class="tariff__col tariff-card">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Отзывы
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует 30 дней
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="tariff-card__total">
                                100 руб
                            </div>
                            <div class="tariff-card__single">
                                от 10 шт
                            </div>
                        </div>
                        <div class="form-group quantity-w" data-max="100">
                            <div class="quantity-minus">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input type="number" class="input" value="10" name="feedback-quantity">
                            </div>
                            <div class="quantity-plus">
                                <img src="img/plus-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
                        </div>
                        <div class="tariff-card__count">
                            02
                        </div>
                    </div>
                    <div class="tariff__col tariff-card">
                        <div class="tariff-card__header">
                            <div class="tariff-card__title">
                                Компания
                            </div>
                            <div class="tariff-card__subtitle">
                                Действует 30 дней
                            </div>
                        </div>
                        <div class="tariff-card__prices">
                            <div class="tariff-card__total">
                                200 руб
                            </div>
                            <div class="tariff-card__single">
                                от 10 шт
                            </div>
                        </div>
                        <div class="form-group quantity-w" data-max="100">
                            <div class="quantity-minus">
                                <img src="img/minus-icon.svg" alt="">
                            </div>
                            <div class="quantity-input">
                                <input type="number" class="input" value="10" name="integration-quantity">
                            </div>
                            <div class="quantity-plus">
                                <img src="img/plus-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="tariff-card__btns">
                            <button class="btn btn-primary btn-tariffs-payment">Оплатить</button>
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

import User from "../../../services/api/User";
import Header from '../../components/layout/AppHeader.vue'

import CallUsPopup from '../../../ui/CallUsPopupComponent.vue'

export default {
    components:{ Header, CallUsPopup },
    data(){
        return{
            user: ref(null),
            User,

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
            }).then(() => {

            })
        }
    }
}
</script>
