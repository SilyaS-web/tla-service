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
                    v-on:ban="ban"
                    v-on:unban="unban"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></SellerItem>
            </div>
        </div>
    </div>
    <confirm-popup ref="confirmPopup"></confirm-popup>
</template>
<script>
    import SellerItem from '../SellerItemComponent.vue'
    import ConfirmPopup from '../ui/ConfirmationPopup.vue';

    export default{
        props: ['sellers'],
        components: {SellerItem, ConfirmPopup},
        methods:{
            async deletionConfirmation(id) {
                const isConfirmed = await this.$refs.confirmPopup.show({
                    title: 'Подтвердите действие',
                    subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                });

                if (isConfirmed) {
                    this.delete(id)
                }
            },

            unban(id) {
                if(id){
                    axios({
                        method: 'get',
                        url: '/api/users/' + id + '/unban/',
                    })
                    .then((response) => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Селлер успешно разблокирован!'
                        });
                        this.$emit('updateSellers', id);
                    })
                }
            },

            ban(id) {
                if(id){
                    axios({
                        method: 'get',
                        url: '/api/users/' + id + '/ban/',
                    })
                    .then((response) => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Селлер заблокирован!'
                        });
                        this.$emit('updateSellers', id);
                    })
                }
            },

            delete(id) {
                if(id){
                    axios({
                        method: 'delete',
                        url: '/api/users/' + id,
                    })
                    .then((response) => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Селлер удален.'
                        });

                        this.$emit('updateSellers', id);
                    })
                }
            },
        }
    }
</script>
