<template>
    <div class="admin-view__content blogers-list tab-content" id="sellers-list">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Список селлеров • {{ sellers.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                </div>  -->
            </div>
            <div class="blogers-list__list list-blogers admin-view__content-wrap">
                <SellerItem
                    v-for="seller in sellers"
                    :sellers="sellers"
                    :seller="seller"
                    v-on:ban="userBanned"
                ></SellerItem>
            </div>
        </div>
    </div>
</template>
<script>
    import SellerItem from '../SellerItemComponent.vue'

    export default{
        props: ['sellers'],
        components: {SellerItem},
        methods:{
            userBanned(id){
                this.$emit('changedSellersList', id);
            }
        }
    }
</script>
