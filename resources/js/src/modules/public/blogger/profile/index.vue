<template>
    <Header :user="user"></Header>
    <section class="edit-profile">
        <div class="edit-profile__container _container">
            <div class="edit-profile__body">
                <div class="edit-profile__content" >
                    <div class="tab-content__profile-img tab-content__form tab-content__form--accent">
                        <label for="" class="tab-content__form--title" style="text-align: center">Аватар профиля</label>
                        <div class="tab-content__profile-img-row">
                            <img :src="blogger.user && blogger.user.image ? blogger.user.image : '/img/profile-icon.svg'  " alt="">
                            <div class="tab-content__profile-img-text">
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
                    </div>
                    <div class="tab-content__form tab-content__form--accent content-management" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title" style="text-align: center">Управление контентом</label>
                        <button
                            @click="contentEdit"
                            class="btn btn-primary" style="width: fit-content">Перейти к управлению контентом</button>
                        <div class="content-management__text">
                            Загрузите пример своего контента, чтобы вас заметили топовые бренды и селлеры, получите специальное достижение, место в рекомендованных и больше предложений на сотрудничество!
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Личные данные</label>
                        <div class="tab-content__form-col">
                            <div class="form-group">
                                <label for="">Имя</label>
                                <input type="text" class="input" name="name" id="name" v-model="blogger.user.name">
                                <span v-if = "errors && errors['user.name']" class="error">{{ errors['user.name'][0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input type="email" class="input" id="email" name="email" v-model="blogger.user.email">
                                <span v-if = "errors && errors['user.email']" class="error">{{ errors['user.email'][0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" v-model="blogger.user.phone" disabled>
                                <span v-if = "errors && errors['user.email']" class="error">{{ errors['user.email'][0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Изменить пароль</label>
                        <div class="tab-content__form-form" style="">
                            <div class="form-group">
                                <label for="old_password">Старый пароль</label>
                                <input class="input" id="old_password" type="password" name="old_password" v-model="blogger.old_password">
                                <span v-if = "errors.old_password" class="error">{{ errors.old_password }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Новый пароль</label>
                                <input class="input" id="password" type="password" name="password" v-model="blogger.password">
                                <span v-if = "errors.password" class="error">{{ errors.password }}</span>
                            </div>
                        </div>
                    </div>

                    <button
                        @click="saveBlogger"
                        class="btn btn-primary">Сохранить изменения</button>
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

export default {
    components:{ Header, Footer, ContentPopup },
    data(){
        return{
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
        saveBlogger(){
            this.Loader.loaderOn('.edit-profile');

            var formdata = new FormData;

            for(let k in this.blogger){
                if(!['user', 'country', 'platforms', 'themes'].includes(k))
                    formdata.append(k, this.blogger[k])
            }

            formdata.append('country_id', this.blogger.country ? this.blogger.country.id : null)

            this.blogger.platforms && this.blogger.platforms.map((p, ind) => {
                formdata.append('platforms[' + ind + ']', p.platform_id)
            })

            this.blogger.themes && this.blogger.themes.map((p, ind) => {
                formdata.append('themes[' + ind + ']', p.theme_id)
            })

            for(let k in this.blogger.user){
                if(k != 'image')
                    formdata.append(k, this.blogger.user[k])
            }

            var image = $('.tab-content__profile-img').find('input[type="file"]')[0];

            if(image && image.files[0])
                formdata.append('image', image.files[0]);

            this.Blogger.put(this.blogger.id, formdata).then(
                response => {
                    var user = {
                        'id': this.user.id,
                        'name': this.blogger.user.name,
                        'email': this.blogger.user.email,
                        'seller_id': this.blogger.id,
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
                    this.errors = err.response.data;
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
