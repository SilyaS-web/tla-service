<template>
    <div class="admin-view__content admin-blogers tab-content active" id="moderation">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Модерация блогеров • {{ bloggers.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="admin-blogers__blogers admin-view__content-wrap">
                <BloggerItem
                    v-for="blogger in bloggers"
                    :bloggers="bloggers"
                    :blogger="blogger"
                    v-on:update="update"
                    v-on:agree="acceptForm"
                    v-on:ban="ban"
                    v-on:unban="unban"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></BloggerItem>
            </div>
        </div>
    </div>
    <confirm-popup ref="confirmPopup"></confirm-popup>
    <accept-popup ref="acceptPopup"></accept-popup>
</template>
<script>
import BloggerItem from './BloggerCard';
import ConfirmPopup from '../../../core/components/popups/ConfirmationPopup';
import AcceptPopup from '../../../core/components/popups/blogger-moderation/BloggerAcceptPopup';

export default{
    props: ['bloggers'],
    components: {BloggerItem, ConfirmPopup, AcceptPopup},
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

        async acceptForm(id) {
            const isConfirmed = await this.$refs.acceptPopup.show({
                id: id
            });

            if (isConfirmed) {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Блогер одобрен!'
                });

                this.$emit('updateBloggers', id);
            }
        },

        accept(id){
            this.$emit('updateBloggers', id);
        },

        ban(id) {
            if(id){
                axios({
                    method: 'get',
                    url: '/api/users/' + id + '/ban',
                })
                    .then((response) => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Блогер заблокирован!'
                        });

                        this.$emit('updateBloggers', id);
                    })
            }
        },
        unban(id) {
            if(id){
                axios({
                    method: 'delete',
                    url: '/api/users/' + id,
                })
                    .then((response) => {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Блогер успешно разблокирован!'
                        });

                        this.$emit('updateBloggers', id);
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
                            message: 'Блогер удален!'
                        });

                        this.$emit('updateBloggers', id);
                    })
            }
        },
    }
}
</script>
