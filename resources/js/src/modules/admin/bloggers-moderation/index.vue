<template>
    <div class="admin-view__content admin-blogers" id="moderation">
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
                    :blogger="blogger"
                    v-on:agree="acceptForm"
                    v-on:ban="ban"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></BloggerItem>
            </div>
        </div>

        <!-- Подтвердите действие -->
        <confirm-popup ref="confirmPopup"></confirm-popup>

        <!-- Форма принятия блогера -->
        <accept-popup ref="acceptPopup"></accept-popup>
    </div>
</template>
<script>
import {ref} from "vue";

import BloggerItem from './BloggerCard';
import ConfirmPopup from '../../../core/components/popups/confirmation-popup/ConfirmationPopup';
import AcceptPopup from '../../../core/components/popups/blogger-moderation/BloggerAcceptPopup';

import Loader from "../../../core/services/AppLoader.vue";

import Blogger from "../../../core/services/api/Blogger.vue";
import User from "../../../core/services/api/User.vue";

export default{
    data(){
        return {
            bloggers: ref([]),
            defaultQueryData: {statuses: [0]},

            Blogger, User,
            Loader
        }
    },
    components: {
        BloggerItem, ConfirmPopup, AcceptPopup
    },
    mounted(){
        this.getBloggers(this.defaultQueryData)
    },
    methods:{
        getBloggers(data){
            this.Loader.loaderOn(this.$el)

            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            this.Blogger.getList(params)
            .then(bloggers => {
                this.bloggers = (bloggers || []).filter(b => b.user && b.user.is_blogger_on_moderation).map(_b => this.findBiggestPlatform(_b));
                this.Loader.loaderOff(this.$el)
            })
            .catch(error => {})
        },

        deletionConfirmation(id) {
            this.$refs.confirmPopup.show({
                title: 'Подтвердите действие',
                subtitle: 'После подтверждения пользователя нельзя будет восстановить',
                okButton: 'Подтвердить',
                cancelButton: 'Отмена',
            })
            .then(isConfirmed => {
                if (isConfirmed) {
                    this.delete(id)
                }
            })
        },

        acceptForm(id) {
            this.$refs.acceptPopup.show({
                id: id
            })
            .then(isConfirmed => {
                if (isConfirmed) {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Блогер одобрен!'
                    });

                    this.getBloggers(this.defaultQueryData)
                }
            })
        },

        ban(id) {
            if(!id){
                notify('error', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.banUser(id).then(() => { this.getBloggers(this.defaultQueryData) })
        },
        delete(id) {
            if(!id){
                notify('error', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.deleteUser(id).then(() => { this.getBloggers(this.defaultQueryData) })
        },

        findBiggestPlatform(blogger){
            let summaryPlatform = { subscriber_quantity: 0 };

            if(blogger.platforms){
                blogger.platforms.forEach(_p => {
                    if(summaryPlatform.subscriber_quantity < _p.subscriber_quantity)
                        summaryPlatform = _p
                });
            }

            blogger.summaryPlatform = summaryPlatform;

            return blogger;
        },
    }
}
</script>
