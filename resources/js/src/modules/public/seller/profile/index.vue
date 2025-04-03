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
                        :userID="user.id"
                        :name="seller.user.name"
                        :phone="seller.user.phone"
                        :email="seller.user.email"
                        :image="seller.user.image"
                        :errors="errors"
                        v-if="tab === 'main'"
                        @saveSeller="saveSeller"
                        @updateImage="updateImage"
                    ></main-component>
                    <organization-info-component
                        :organization_name="seller.organization_name"
                        :organization_type="seller.organization_type"
                        :inn="seller.inn"
                        :errors="errors"
                        @saveSeller="saveSeller"
                        v-if="tab === 'organization'"
                    ></organization-info-component>
                    <password-component
                        :errors="errors"
                        @saveSeller="saveSeller"
                        v-if="tab === 'password'"
                    ></password-component>
                    <api-info-component
                        :wb_link="seller.wb_link"
                        :wb_api_key="seller.wb_api_key"
                        :ozon_link="seller.ozon_link"
                        :ozon_client_id="seller.ozon_client_id"
                        :ozon_api_key="seller.ozon_api_key"
                        :errors="errors"
                        @saveSeller="saveSeller"
                        v-if="tab === 'api'"
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
import Loader from "../../../../core/services/AppLoader.vue";

import Header from '../../../../core/components/layout/AppHeader'
import Footer from '../../../../core/components/layout/AppFooter'
import AppAside from "../../../../core/components/layout/tabs-aside/index.vue";

import MainComponent from "./MainInfoComponent.vue";
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
            tab: ref(null),

            user: ref({}),
            seller: ref({user: {}}),

            errors: ref([]),

            Loader,
            User, Seller,
        }
    },
    async mounted(){
        this.Loader.loaderOn('.edit-profile');

        this.user = this.User.getCurrent();
        this.seller = await this.Seller.getItem(this.user.seller_id)

        this.tab = 'main'

        this.Loader.loaderOff('.edit-profile');
    },
    methods:{
        switchTab(tab){ this.tab = tab },
        updateImage(url){ this.user.image = url },
        saveSeller(saveData){
            this.Loader.loaderOn('.edit-profile');

            let data = {
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

            for (const key in saveData) {
                data[key] = saveData[key]
            }

            this.Seller.update(this.seller.id, data).then(
                (data) => {
                    this.user = data.seller.user
                    this.seller = data.seller

                    localStorage.setItem('user', JSON.stringify(data.seller.user))

                    this.errors = {};

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
