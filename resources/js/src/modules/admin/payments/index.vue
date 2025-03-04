<template>
    <div class="admin-view__content payment-history tab-content" id="payment-history">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    История заказов • {{ orders.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="sellers-search" class="input" placeholder="Поиск">
                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="payment-history__body admin-view__content-wrap">
                <div class="payment-history__items">
                    <OrdersItem
                        v-for="order in orders"
                        :order="order">
                    </OrdersItem>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import OrdersItem from './PaymentCard.vue'

import Orders from '../../../core/services/api/Orders.vue'

import Loader from "../../../core/services/AppLoader.vue";

export default{
    data(){
        return {
            orders: ref([]),

            Orders, Loader
        }
    },
    components: {OrdersItem},
    mounted() {
        this.getOrders()
    },
    methods:{
        getOrders(data){
            this.Loader.loaderOn(this.$el)

            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            this.Orders.getList(data)
            .then(orders => {
                this.orders = orders
                this.Loader.loaderOff(this.$el)
            })
        }
    }
}
</script>
