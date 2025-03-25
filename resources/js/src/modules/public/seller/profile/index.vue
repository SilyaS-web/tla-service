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
                        tabName: 'Организация',
                        tabContent: 'organization',
                        classList: ['organization-link'],
                        isActive: tab === 'organization'
                    },
                    {
                        tabName: 'Пароль',
                        tabContent: 'password',
                        classList: ['password-link'],
                        isActive: tab === 'password'
                    },
                    {
                        tabName: 'API',
                        tabContent: 'api',
                        classList: ['api-link'],
                        isActive: tab === 'api'
                    },
                ]"
            >
            </app-aside>
            <div class="edit-profile__body">
                <div class="edit-profile__content">
                    <main-component
                        :seller="seller"
                        v-show="tab === 'main'"
                    ></main-component>
                    <organization-info-component
                        :seller="seller"
                        v-show="tab === 'organization'"
                    ></organization-info-component>
                    <password-component
                        :seller="seller"
                        v-show="tab === 'password'"
                    ></password-component>
                    <api-info-component
                        :seller="seller"
                        v-show="tab === 'api'"
                    ></api-info-component>
                </div>
            </div>
        </div>
    </section>
    <Footer></Footer>
</template>
<script>
import {ref} from "vue";

import User from "../../../../core/services/api/User";
import Seller from "../../../../core/services/api/Seller";

import Header from '../../../../core/components/layout/AppHeader'
import Footer from '../../../../core/components/layout/AppFooter'
import AppAside from "../../../../core/components/layout/tabs-aside/index.vue";
import MainComponent from "./MainInfoComponent.vue";
import Loader from "../../../../core/services/AppLoader.vue";
import OrganizationInfoComponent from "./OrganizationInfoComponent.vue";
import PasswordComponent from "./PasswordComponent.vue";
import ApiInfoComponent from "./ApiInfoComponent.vue";

export default {
    components:{
        AppAside, Header, Footer,
        MainComponent, OrganizationInfoComponent, PasswordComponent,
        ApiInfoComponent,
    },
    data(){
        return{
            tab: ref('main'),

            user: ref(null),
            Loader,
            User, Seller,

            seller: ref({
                user: {}
            }),
            errors: ref([]),

            imgSectionTitle: 'Загрузите изображение'
        }
    },
    async mounted(){
        this.Loader.loaderOn('.edit-profile');

        this.user = this.User.getCurrent();
        this.seller = await this.Seller.getItem(this.user.seller_id)

        this.Loader.loaderOff('.edit-profile');
    },
    methods:{
        switchTab(tab){
            this.tab = tab
        },
        saveSeller(){
            this.Loader.loaderOn('.edit-profile');

            const data = {
                name: this.seller.user.name,
                email: this.seller.user.email,
                inn: this.seller.inn,
                organization_name: this.seller.organization_name,
                organization_type: this.seller.organization_type,
                ozon_api_key: this.seller.ozon_api_key,
                ozon_client_id: this.seller.ozon_client_id,
                ozon_link: this.seller.ozon_link,
                wb_api_key: this.seller.wb_api_key,
                wb_link: this.seller.wb_link,
                password: this.seller.password,
                old_password: this.seller.old_password,
            };

            const image = $('.tab-content__profile-img').find('input[type="file"]')[0];

            if(image && image.files[0])
                data['image'] = image.files[0];

            this.Seller.update(this.seller.id, data).then(
                (response) => {
                    const user = {
                        'id': this.user.id,
                        'name': this.seller.user.name,
                        'email': this.seller.user.email,
                        'seller_id': this.seller.id,
                        'organization_name': this.seller.organization_name,
                        'status': this.user.status,
                        'role': this.user.role,
                        'phone': this.user.phone,
                        'created_at': this.user.created_at,
                        'channel_name': this.user.channel_name,
                        'blogger_id': this.user.blogger_id,
                        'tariffs': this.user.tariffs,
                        'image': response.image ? response.image : this.user.image,
                    }

                    localStorage.setItem('user', JSON.stringify(user));
                    this.user = user

                    this.Loader.loaderOff('.edit-profile');
                },
                err => {
                    this.errors = err.response.data

                    this.Loader.loaderOff('.edit-profile');
                }
            )
        }
    }
}
</script>
