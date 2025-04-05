<template>
    <Header :currentUser="user"></Header>
    <section class="edit-profile">
        <div class="edit-profile__container _container">
            <app-aside
                v-on:switchTab="switchTab"
                :tabs="[
                    {
                        tabName: 'Основное',
                        tabContent: 'main',
                        classList: ['main-link'],
                        isActive: tab === 'main'
                    },
                    {
                        tabName: 'Управление контентом',
                        tabContent: 'content-management',
                        classList: ['content-management-link'],
                        isActive: tab === 'content-management'
                    },
                    {
                        tabName: 'Пароль',
                        tabContent: 'password',
                        classList: ['password-link'],
                        isActive: tab === 'password'
                    },
                    {
                        tabName: 'Мои документы',
                        tabContent: 'documents',
                        classList: ['documents-link'],
                        isActive: tab === 'documents'
                    },
                ]"
            >
            </app-aside>

            <div class="edit-profile__body">
                <div class="edit-profile__content" >
                    <main-component
                        :userID="user.id"
                        :name="blogger.user.name"
                        :phone="blogger.user.phone"
                        :email="blogger.user.email"
                        :image="blogger.user.image"
                        :errors="errors"
                        @saveBlogger="saveBlogger"
                        @updateImage="updateImage"
                        v-if="tab === 'main'"
                    ></main-component>

                    <password-component
                        :errors="errors"
                        @saveBlogger="saveBlogger"
                        v-if="tab === 'password'"
                    ></password-component>

                    <documents-component
                        :blogger="blogger"
                        @saveBlogger="saveBlogger"
                        @updateBlogger="updateBlogger"
                        v-if="tab === 'documents'"
                    ></documents-component>
                </div>
            </div>
        </div>
    </section>
    <Footer></Footer>
    <ContentPopup
        ref="contentPopup"
    ></ContentPopup>
</template>
<script>
import {ref} from "vue";

import User from "../../../../core/services/api/User";
import Blogger from "../../../../core/services/api/Blogger";

import ContentPopup from "../../../../core/components/popups/blogger-add-content/BloggerAddContentPopup";

import Header from '../../../../core/components/layout/AppHeader.vue'
import Footer from '../../../../core/components/layout/AppFooter.vue'
import Loader from "../../../../core/services/AppLoader.vue";
import AppAside from "../../../../core/components/layout/tabs-aside/index.vue";
import MainComponent from "./MainInfoComponent.vue";
import PasswordComponent from "./PasswordComponent.vue";
import DocumentsComponent from "./DocumentsComponent.vue";

export default {
    components:{ DocumentsComponent, PasswordComponent, MainComponent, AppAside, Header, Footer, ContentPopup },
    data(){
        return{
            tab: ref(''),
            user: ref(null),
            Loader,
            User, Blogger,

            blogger: ref({
                user: {}
            }),
            errors: ref({}),

            imgSectionTitle: 'Загрузите изображение'
        }
    },
    async mounted(){
        this.Loader.loaderOn('.edit-profile');

        this.user = this.User.getCurrent();
        this.blogger = await this.Blogger.getItem(this.user.blogger_id)

        this.tab = 'main'

        this.Loader.loaderOff('.edit-profile');
    },
    methods:{
        switchTab(tab){
            if(tab === 'content-management'){
                this.contentEdit()
                return
            }

            this.tab = tab
        },
        updateImage(url){ this.user.image = url },
        updateBlogger(data){
            for (const dataKey in data) {
                this.blogger[dataKey] = data[dataKey]
            }
        },
        saveBlogger(saveData){
            this.Loader.loaderOn('.edit-profile');

            let data = {
                name: this.blogger.user.name,
                email: this.blogger.user.email,
                sex: this.blogger.sex,
                country_id: this.blogger.country.id,
                city: this.blogger.city,
                password: this.blogger.password,
                old_password: this.blogger.old_password,
            };

            for (const key in saveData) {
                data[key] = saveData[key]
            }

            this.Blogger.update(this.blogger.id, data).then(
                data => {
                    this.user = data.blogger.user
                    this.blogger = data.blogger

                    localStorage.setItem('user', JSON.stringify(this.user))

                    this.errors = {};

                    this.Loader.loaderOff('.edit-profile');
                },
                err => {
                    this.errors = err;
                    this.Loader.loaderOff('.edit-profile');
                }
            )
        },
        contentEdit(){
            this.$refs.contentPopup.show();
        }
    }
}
</script>
<style>
.tab-content__form{
    margin-bottom: 56px;
}
</style>
