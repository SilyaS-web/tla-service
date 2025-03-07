<template>
    <div class="list-blogers__item seller-item card" data-id="{{ seller.id }}">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img" v-bind:style="'background-image:url(' + (!seller.user.image ? '/img/profile-icon.svg' : `${seller.user.image}`) + ')'">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name">
                            {{ seller.user.name }}
                        </p>
                        <p class="card__name-tag">
                            {{ seller.is_agent ? 'Посредник' : 'Селлер'}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Телефон</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.user.phone }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Тип организации</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.organization_type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Почта</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.user.email }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ИНН</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.inn }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card__row" style="display: flex; gap: 5px; flex-wrap: wrap; align-items: center">
                    <button
                        v-if="seller.user.status === -1"
                        class="btn btn-primary" v-on:click="unban">
                        Разблокировать
                    </button>
                    <button
                        v-else
                        class="btn btn-primary" v-on:click="ban">
                        Заблокировать
                    </button>
                    <button class="btn btn-delete" v-on:click="deletionConfirmation">
                        Удалить
                    </button>
                    <app-tooltip @click="toggleTooltip" ref="appTooltip">
                        <a
                            href="#"
                            @click.prevent="showSellerData"
                        >Подробнее</a>
                        <a
                            href="#"
                            @click.prevent="copyData"
                        >Скопировать данные</a>
                    </app-tooltip>
                </div>
            </div>
        </div>
        <SellerCardPopup ref="sellerCardPopup"></SellerCardPopup>
    </div>

</template>
<script>
import SellerCardPopup from "../../../core/components/popups/admin/seller-card/SellerCardPopup.vue";

import AppTooltip from "../../../core/components/AppTooltip.vue";

export default{
    components: {AppTooltip, SellerCardPopup},
    props: ['seller', 'sellers'],
    methods:{
        deletionConfirmation() {
            this.$emit('deletionConfirmation', this.seller.user.id)
        },

        ban() {
            this.$emit('ban', this.seller.user.id)
        },

        unban() {
            this.$emit('unban', this.seller.user.id)
        },

        toggleTooltip(e){ this.$refs.appTooltip.show(e) },

        showSellerData(){
            this.$refs.sellerCardPopup.show(this.seller.id).then(() => this.$emit('updateList'))
        },
        copyData(){
            if(navigator.clipboard !== undefined){
                const sellerData = {
                    id: this.seller.id,
                    user_id: this.seller.user.id,
                    name: this.seller.user.name,
                    phone: this.seller.user.phone,
                    email: this.seller.user.email,
                }

                navigator.clipboard.writeText(JSON.stringify(sellerData)).then(function() {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Данные селлера скопированы в буфер обмена'
                    })
                });
            }
        }

    }
}
</script>
