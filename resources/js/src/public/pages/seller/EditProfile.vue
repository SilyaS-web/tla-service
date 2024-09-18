<template>
    <Header :user="user"></Header>
    <section class="edit-profile">
        <div class="edit-profile__container _container">
            <div class="edit-profile__body">
                <div class="edit-profile__title title">
                    Редактировать данные
                </div>
                <div class="edit-profile__content" >
                    <div class="tab-content__profile-img">
                        <img :src="seller.user && seller.user.image ? seller.user.image : '/img/profile-icon.svg'  " alt="">
                        <div class="tab-content__profile-img-text">
                            <p>Фото профиля</p>
                            <div class="form-group form-group--file">
                                <label class="tab-content__profile-img-upload input-file" for="profile-img">
                                    <span>Загрузите изображение</span>
                                    <input type="file" name="image" class="" id="profile-img">
                                </label>
                                <span v-if="errors.image" class="error">{{ errors.image }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Личные данные</label>
                        <div class="tab-content__form-row">
                            <div class="tab-content__form-right">
                                <div class="form-group">
                                    <label for="">Имя</label>
                                    <input type="text" class="input" name="name" id="name" v-model="seller.user.name">
                                    <span v-if = "errors.name" class="error">{{ errors.name }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="email" class="input" id="email" name="email" v-model="seller.user.email">
                                    <span v-if = "errors.email" class="error">{{ errors.email }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Номер телефона</label>
                                    <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" v-model="seller.user.phone" disabled>
                                    <span v-if = "errors.phone" class="error">{{ errors.phone }}</span>
                                </div>
                            </div>
                            <div class="tab-content__form-left">
                                <div class="form-group" style="">
                                    <label for="">Тип организации</label>
                                    <select class="input" id="type" name="organization_type" v-model="seller.organization_type">
                                        <option value="">Не выбрано</option>
                                        <option value="ООО">ООО</option>
                                        <option value="ИП">ИП</option>
                                        <option value="ОАО">ОАО</option>
                                    </select>
                                    <span v-if = "errors.phone" class="error">{{ errors.phone }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="organization_name">Название организации</label>
                                    <input type="text" class="input" id="organization_name" name="organization_name" v-model="seller.organization_name">
                                    <span v-if = "errors.organization_name" class="error">{{ errors.organization_name }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">ИНН</label>
                                    <input type="text" class="input" id="inn" name="inn" v-model="seller.inn">
                                    <span v-if = "errors.inn" class="error">{{ errors.inn }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Изменить пароль</label>
                        <div class="tab-content__form-row" style="">
                            <div class="tab-content__form-right">
                                <div class="form-group">
                                    <label for="old_password">Старый пароль</label>
                                    <input class="input" id="old_password" type="password" name="old_password" v-model="seller.old_password">
                                    <span v-if = "errors.old_password" class="error">{{ errors.old_password }}</span>
                                </div>
                            </div>
                            <div class="tab-content__form-left">
                                <div class="form-group">
                                    <label for="password">Новый пароль</label>
                                    <input class="input" id="password" type="password" name="password" v-model="seller.new_password">
                                    <span v-if = "errors.new_password" class="error">{{ errors.new_password }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent tab-content__form--api" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Работа с API</label>
                        <div class="tab-content__form-row" style="">
                            <div class="tab-content__form-right tab-content__form-right--wb">
                                <div class="form-group">
                                    <label for="">Ссылка на магазин WB</label>
                                    <input type="text" class="input" id="marketplace" name="wb_link" v-model="seller.wb_link">
                                    <span v-if = "errors.wb_link" class="error">{{ errors.wb_link }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">Ключ API WB</label>
                                    <input type="text" class="input" id="wb_api_key" name="wb_api_key" v-model="seller.wb_api_key">
                                    <span v-if = "errors.wb_api_key" class="error">{{ errors.wb_api_key }}</span>
                                </div>
                            </div>
                            <div class="tab-content__form-left tab-content__form-left--ozon">
                                <div class="form-group">
                                    <label for="ozon_link">Ссылка на магазин OZON</label>
                                    <input type="text" class="input" id="ozon_link" name="ozon_link" v-model="seller.ozon_link">
                                    <span v-if = "errors.ozon_link" class="error">{{ errors.ozon_link }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="ozon_client_id">Client ID OZON</label>
                                    <input type="text" class="input" id="ozon_client_id" name="ozon_client_id" v-model="seller.ozon_client_id">
                                    <span v-if = "errors.ozon_client_id" class="error">{{ errors.ozon_client_id }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="ozon_api_key">Ключ API OZON</label>
                                    <input type="text" class="input" id="ozon_api_key" name="ozon_api_key" v-model="seller.ozon_api_key">
                                    <span v-if = "errors.ozon_api_key" class="error">{{ errors.ozon_api_key }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button
                        @click="saveSeller"
                        class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import {ref} from "vue";

    import User from "../../../services/api/User";
    import Header from '../../components/layout/AppHeader.vue'
    import Seller from "../../../services/api/Seller";

    import Loader from "../../../services/AppLoader";

    export default {
        components:{ Header },
        data(){
            return{
                user: ref(null),
                Loader,
                User, Seller,

                seller: ref({
                    user: {}
                }),
                errors: ref({})
            }
        },
        async mounted(){
            this.user = this.User.getCurrent();
            this.seller = await this.Seller.getItem(this.user.seller_id)
        },
        methods:{
            saveSeller(){
                this.Loader.loaderOn('.edit-profile');

                this.Seller.save(this.seller).then(data => {
                    if(data.errors){
                        this.errors = data.errors;
                        this.Loader.loaderOff('.edit-profile');
                        return
                    }

                    var user = this.seller.user;

                    if(user){
                        this.user = user;
                        localStorage.setItem('user', JSON.stringify(user));
                    }

                    this.Loader.loaderOff('.edit-profile');
                })
            }
        }
    }
</script>
