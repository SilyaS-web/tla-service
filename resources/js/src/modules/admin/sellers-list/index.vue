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
                    :seller="seller"
                    v-on:ban="ban"
                    v-on:unban="unban"
                    v-on:updateList="getSellers(defaultQueryData)"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></SellerItem>
            </div>
        </div>
        <confirm-popup ref="confirmPopup"></confirm-popup>
    </div>
</template>
<script>
import {ref} from "vue";

import Seller from "../../../core/services/api/Seller.vue";

import Loader from "../../../core/services/AppLoader.vue";

import SellerItem from './SellerCard'
import ConfirmPopup from '../../../core/components/popups/confirmation-popup/ConfirmationPopup';

export default{
    components: {SellerItem, ConfirmPopup},
    data(){
        return{
            sellers: ref([]),
            defaultQueryData: {},

            Seller, Loader
        }
    },
    mounted(){
        this.getSellers(this.defaultQueryData)
    },
    methods:{
        getSellers(data){
            this.Loader.loaderOn(this.$el)

            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            this.Seller.getList(params).then(sellers => {
                this.sellers = (sellers || [])
                this.Loader.loaderOff(this.$el)
            })
        },

        deletionConfirmation(id) {
            this.$refs.confirmPopup.show({
                title: 'Подтвердите действие',
                subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
            }).then(isConfirmed => {
                if (isConfirmed) {
                    this.delete(id)
                }
            })
        },

        ban(id) {
            if(!id){
                notify('danger', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.banUser(id).then(() => { this.getSellers(this.defaultQueryData) })
        },
        unban(id) {
            if(!id){
                notify('danger', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.unbanUser(id).then(() => { this.getSellers(this.defaultQueryData) })
        },
        delete(id) {
            if(!id){
                notify('danger', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.deleteUser(id).then(() => { this.getSellers(this.defaultQueryData) })
        },
    }
}
</script>
