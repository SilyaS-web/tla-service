<template>
    <div class="payment-history__row">
        <div href="" class="payment-history__row-title">
            <span>Заказ № {{ order.id }}</span>
            от {{ order.created_at }}
        </div>
        <div class="payment-history__row-status">
            <span>Статус</span>
            <strong>{{ order.status || '-' }}</strong>
        </div>
        <div class="payment-history__row-summary">
            <span>Сумма</span>
            <strong>{{ order.price || '-' }} <b class="rub">₽</b></strong>
        </div>
        <div class="payment-history__row-user">
            <span>Пользователь</span>
            <strong><a v-bind:href="'/sellers/' + order.seller_id" target="_blank">ID {{ order.seller_id || '-' }}</a></strong>
        </div>
        <div class="payment-history__row-tariff">
            <span>Тариф</span>
            <strong>{{ order.tariff }}</strong>
        </div>
        <div class="payment-history__row-bank_id">
            <span>ID оплаты</span>
            <strong>{{ order.payment_id || '-' }}</strong>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'

    export default{
        props: ['order'],
        methods:{
        }
    }
</script>
