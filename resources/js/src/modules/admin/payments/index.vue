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
                        :orders="orders"
                        :order="order">
                    </OrdersItem>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import OrdersItem from '../OrdersItemComponent.vue'

export default{
    props: ['orders'],
    components: {OrdersItem},
    methods:{
    }
}
</script>
