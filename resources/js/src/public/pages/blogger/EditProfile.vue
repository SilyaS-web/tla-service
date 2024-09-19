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
                        <img :src="blogger.user && blogger.user.image ? blogger.user.image : '/img/profile-icon.svg'  " alt="">
                        <div class="tab-content__profile-img-text">
                            <p>Фото профиля</p>
                            <div class="form-group form-group--file">
                                <label class="tab-content__profile-img-upload input-file" for="profile-img">
                                    <span>{{ imgSectionTitle }}</span>
                                    <input
                                        @change="imgSectionTitle = 'Изображение загружено'"
                                        type="file" name="image" class="" id="profile-img">
                                </label>
                                <span v-if="errors.image" class="error">{{ errors.image }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Личные данные</label>
                        <div class="tab-content__form-col">
                            <div class="form-group">
                                <label for="">Имя</label>
                                <input type="text" class="input" name="name" id="name" v-model="blogger.user.name">
                                <span v-if = "errors.name" class="error">{{ errors.name }}</span>
                        </div>
                            <div class="form-group">
                                <label for="">E-mail</label>
                                <input type="email" class="input" id="email" name="email" v-model="blogger.user.email">
                                <span v-if = "errors.email" class="error">{{ errors.email }}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" v-model="blogger.user.phone" disabled>
                                <span v-if = "errors.phone" class="error">{{ errors.phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                        <label for="" class="tab-content__form--title">Изменить пароль</label>
                        <div class="tab-content__form-row" style="">
                            <div class="form-group">
                                <label for="old_password">Старый пароль</label>
                                <input class="input" id="old_password" type="password" name="old_password" v-model="blogger.old_password">
                                <span v-if = "errors.old_password" class="error">{{ errors.old_password }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Новый пароль</label>
                                <input class="input" id="password" type="password" name="password" v-model="blogger.new_password">
                                <span v-if = "errors.new_password" class="error">{{ errors.new_password }}</span>
                            </div>
                        </div>
                    </div>

                    <button
                        @click="saveBlogger"
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
import Blogger from "../../../services/api/Blogger";

import Loader from "../../../services/AppLoader";

export default {
    components:{ Header },
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
                if(k != 'user')
                    formdata.append(k, this.blogger[k])
            }

            for(let k in this.blogger.user){
                if(k != 'image')
                    formdata.append(k, this.blogger.user[k])
            }

            var image = $('.tab-content__profile-img').find('input[type="file"]')[0];

            formdata.append('image', image.files[0]);

            this.Blogger.put(this.blogger.id, formdata).then(
                data => {
                    var user = this.blogger.user;

                    if(user){
                        this.user = user;
                        localStorage.setItem('user', JSON.stringify(user));
                    }

                    this.Loader.loaderOff('.edit-profile');
                },
                err => {
                    this.errors = err.response.data;
                    this.Loader.loaderOff('.edit-profile');
                    return
                }
            )
        }
    }
}
</script>
