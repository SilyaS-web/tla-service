<template>
    <div class="admin-view__content blogers-list tab-content" id="blogers-list">
        <div class="admin-blogers__body">
            <div class="admin-blogers__header">
                <div class="admin-blogers__title title">
                    Список блогеров • {{ bloggers.length }}
                </div>
                <!-- <div class="admin-blogers__search form-group">
                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                </div> -->
            </div>
            <div class="blogers-list__list list-blogers admin-view__content-wrap">
                <BloggerItem
                    v-for="blogger in bloggers"
                    :bloggers="bloggers"
                    :blogger="blogger"
                    v-on:agree="agree"
                    v-on:ban="ban"
                    v-on:unban="unban"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></BloggerItem>
            </div>
        </div>
    </div>
    <confirm-popup ref="confirmPopup"></confirm-popup>
    <!-- <accept-popup ref="acceptPopup"></accept-popup> -->
</template>
<script>
    import BloggerItem from '../BloggerItemComponent.vue';
    import ConfirmPopup from '../ui/ConfirmationPopup.vue';
    // import AcceptPopup from '../ui/BloggerAcceptionPopup.vue';

    export default{
        props: ['bloggers'],
        components: {BloggerItem, ConfirmPopup},
        // mounted(){
        //     this.acceptionForm(2)
        // },
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

            agree(id){
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
                        method: 'get',
                        url: '/api/users/' + id + '/unban',
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
