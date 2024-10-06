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
                                    <span>{{ imgSectionTitle }}</span>
                                    <input
                                        @change="imgSectionTitle = 'Изображение загружено'"
                                        type="file" name="image" class="" id="profile-img">
                                </label>
                                <span v-if="errors['image']" class="error">{{ errors['image'] }}</span>
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
                                    <span v-if = "errors['name']" class="error">{{ errors['name'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="email" class="input" id="email" name="email" v-model="seller.user.email">
                                    <span v-if = "errors['email']" class="error">{{ errors['email'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Номер телефона</label>
                                    <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" v-model="seller.user.phone" disabled>
                                    <span v-if = "errors['phone']" class="error">{{ errors['phone'] }}</span>
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
                                    <span v-if = "errors['organization_type']" class="error">{{ errors['organization_type'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="organization_name">Название организации</label>
                                    <input type="text" class="input" id="organization_name" name="organization_name" v-model="seller.organization_name">
                                    <span v-if = "errors['organization_name']" class="error">{{ errors['organization_name'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">ИНН</label>
                                    <input type="text" class="input" id="inn" name="inn" v-model="seller.inn">
                                    <span v-if = "errors['inn']" class="error">{{ errors['inn'] }}</span>
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
                                    <span v-if = "errors['old_password']" class="error">{{ errors['old_password'] }}</span>
                                </div>
                            </div>
                            <div class="tab-content__form-left">
                                <div class="form-group">
                                    <label for="password">Новый пароль</label>
                                    <input class="input" id="password" type="password" name="password" v-model="seller.password">
                                    <span v-if = "errors['password']" class="error">{{ errors['password'] }}</span>
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
                                    <span v-if = "errors['wb_link']" class="error">{{ errors['wb_link'][0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="">Ключ API WB</label>
                                    <input type="text" class="input" id="wb_api_key" name="wb_api_key" v-model="seller.wb_api_key">
                                    <span v-if = "errors['wb_api_key']" class="error">{{ errors['wb_api_key'][0] }}</span>
                                </div>
                            </div>
                            <div class="tab-content__form-left tab-content__form-left--ozon">
                                <div class="form-group">
                                    <label for="ozon_link">Ссылка на магазин OZON</label>
                                    <input type="text" class="input" id="ozon_link" name="ozon_link" v-model="seller.ozon_link">
                                    <span v-if = "errors['ozon_link']" class="error">{{ errors['ozon_link'][0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="ozon_client_id">Client ID OZON</label>
                                    <input type="text" class="input" id="ozon_client_id" name="ozon_client_id" v-model="seller.ozon_client_id">
                                    <span v-if = "errors['ozon_client_id']" class="error">{{ errors['ozon_client_id'][0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="ozon_api_key">Ключ API OZON</label>
                                    <input type="text" class="input" id="ozon_api_key" name="ozon_api_key" v-model="seller.ozon_api_key">
                                    <span v-if = "errors['ozon_api_key']" class="error">{{ errors['ozon_api_key'][0] }}</span>
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
    <Footer></Footer>
</template>
<script>
    import {ref} from "vue";

    import User from "../../../services/api/User";
    import Header from '../../components/layout/AppHeader.vue'
    import Footer from '../../components/layout/AppFooter.vue'
    import Seller from "../../../services/api/Seller";

    import Loader from "../../../services/AppLoader";

    export default {
        components:{ Header, Footer },
        data(){
            return{
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
            saveSeller(){
                this.Loader.loaderOn('.edit-profile');

                var formdata = new FormData;

                var image = $('.tab-content__profile-img').find('input[type="file"]')[0];

                if(image.files[0])
                    formdata.append('image', image.files[0]);

                formdata.append('name', this.seller.user.name);
                formdata.append('email', this.seller.user.email);

                if(this.seller.old_password)
                    formdata.append('old_password', this.seller.old_password);

                if(this.seller.password)
                    formdata.append('password', this.seller.password);

                if(this.seller.wb_link)
                    formdata.append('wb_link', this.seller.wb_link);

                if(this.seller.wb_api_key)
                    formdata.append('wb_api_key', this.seller.wb_api_key);

                if(this.seller.ozon_link)
                    formdata.append('ozon_link', this.seller.ozon_link);

                if(this.seller.ozon_client_id)
                    formdata.append('ozon_client_id', this.seller.ozon_client_id);

                if(this.seller.ozon_api_key)
                    formdata.append('ozon_api_key', this.seller.ozon_api_key);

                if(this.seller.inn)
                    formdata.append('inn', this.seller.inn);

                if(this.seller.organization_type)
                    formdata.append('organization_type', this.seller.organization_type);

                if(this.seller.organization_name)
                    formdata.append('organization_name', this.seller.organization_name);

                this.Seller.save(this.seller.id, formdata).then(
                    (response) => {
                        var user = {
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
