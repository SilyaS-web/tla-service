<template>
    <div class="admin-view__content blogers-list" id="bloggers-list">
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
                    v-on:ban="ban"
                    v-on:unban="unban"
                    v-on:updateList="getBloggers(defaultQueryData)"
                    v-on:deletionConfirmation="deletionConfirmation"
                ></BloggerItem>
            </div>
        </div>
        <confirm-popup ref="confirmPopup"></confirm-popup>
    </div>
</template>
<script>
import {ref} from "vue";

import User from "../../../core/services/api/User.vue";
import Blogger from "../../../core/services/api/Blogger.vue";

import Loader from "../../../core/services/AppLoader.vue";

import BloggerItem from './BloggerCard';
import ConfirmPopup from '../../../core/components/popups/confirmation-popup/ConfirmationPopup';

export default{
    data(){
        return {
            bloggers: ref([]),
            defaultQueryData: {
                statuses: [1, -1]
            },

            Loader, Blogger, User
        }
    },
    components: { BloggerItem, ConfirmPopup },
    mounted() {
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
                this.bloggers = (bloggers || []).map(_b => this.findBiggestPlatform(_b));
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
            }).then(isConfirmed => {
                if (isConfirmed) {
                    this.delete(id)
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
        unban(id) {
            if(!id){
                notify('error', {
                    title: 'Внимание',
                    message: 'Невозможно получить айди пользователя'
                });
            }

            this.User.unbanUser(id).then(() => { this.getBloggers(this.defaultQueryData) })
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
