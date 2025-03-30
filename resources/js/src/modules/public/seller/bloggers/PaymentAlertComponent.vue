<script>
export default {
    name: "PaymentAlertComponent"
}
</script>

<template>
    <div class="not_paid-alert">
        <div class="not_paid-alert__body">
            <div class="not_paid-alert__title">
                Каталог блогеров недоступен
            </div>
            <div class="not_paid-alert__text">
                Необходимо оплатить тариф, чтобы иметь возможность просматривать<br> каталог блогеров и начать работу с ними
            </div>
        </div>
        <div class="not_paid-alert__footer">
            <router-link :to="{ path: '/tariffs' }" class="not_paid-alert__btn btn btn-primary">Разблокировать каталог</router-link>
        </div>
    </div>
</template>

<style scoped>
    .not_paid-alert{
        display: none;
    }
    .not_paid-alert__title{
        font-size: 21px;
        font-weight: 600;
        margin-bottom: 12px;
        text-align: center;
    }
    .not_paid-alert__text{
        font-size: 18px;
        color:rgba(0,0,0,.4);
        text-align: center;
    }
    .not_paid-alert__body:not(:last-child){
        margin-bottom: 24px;
    }
</style>
