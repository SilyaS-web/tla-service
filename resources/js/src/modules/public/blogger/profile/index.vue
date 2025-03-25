<template>
    <Header :user="user"></Header>
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
                        :blogger="blogger"
                        v-show="tab === 'main'"
                    ></main-component>

                    <password-component
                        :blogger="blogger"
                        v-show="tab === 'password'"
                    ></password-component>

                    <documents-component
                        :blogger="blogger"
                        v-show="tab === 'documents'"
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
    components:{DocumentsComponent, PasswordComponent, MainComponent, AppAside, Header, Footer, ContentPopup },
    data(){
        return{
            tab: ref('main'),
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

        this.Loader.loaderOff('.edit-profile');
    },
    methods:{
        switchTab(tab){ this.tab = tab },
        saveBlogger(){
            this.Loader.loaderOn('.edit-profile');

            const data = {
                name: this.blogger.user.name,
                email: this.blogger.user.email,
                sex: this.blogger.sex,
                country_id: this.blogger.country.id,
                city: this.blogger.city,
                password: this.blogger.password,
                old_password: this.blogger.old_password,
            };

            const image = $('.tab-content__profile-img').find('input[type="file"]')[0];

            if(image && image.files[0]) data['image'] = image.files[0];

            this.Blogger.update(this.blogger.id, data).then(
                response => {
                    const user = {
                        'id': this.user.id,
                        'name': this.blogger.user.name,
                        'email': this.blogger.user.email,
                        'seller_id': this.blogger.id,
                        'content': this.blogger.content,
                        'themes': this.blogger.themes,
                        'status': this.user.status,
                        'role': this.user.role,
                        'phone': this.user.phone,
                        'created_at': this.user.created_at,
                        'channel_name': this.user.channel_name,
                        'blogger_id': this.user.blogger_id,
                        'image': response.image ? response.image : this.user.image,
                    }

                    if(user){
                        this.user = user;
                        localStorage.setItem('user', JSON.stringify(user));
                    }

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
