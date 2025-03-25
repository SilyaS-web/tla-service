<script>
import {ref} from "vue";

import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";

export default {
    name: "MainInfoComponent",
    props:['blogger'],
    components:{InputBlockComponent},
    data(){
        return{
            imgSectionTitle: ref('Изменить аватар'),
            errors: ref([]),
        }
    },
    methods:{
        save(){},
        ProfileImageUploaded(){}
    }
}
</script>

<template>
    <div class="tab-content">
        <div class="tab-content__form">
            <div class="tab-content__image">
                <img :src="blogger.user && blogger.user.image ? blogger.user.image : '/img/profile-icon.svg'  " alt="">
                <div class="tab-content__image-upload">
                    <div class="form-group form-group--file">
                        <label class="tab-content__profile-img-upload input-file" for="profile-img">
                            <span>Изменить аватар</span>
                            <input
                                @change="ProfileImageUploaded"
                                type="file" name="image" class="" id="profile-img">
                        </label>
                        <span v-if="errors['image']" class="error">{{ errors['image'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content__form">
            <input-block-component
                v-model="blogger.user.name"
                :label="'Имя'"
                :inputType="'text'"
                :inputPlaceholder="'Введите ваше имя'"
                :inputClassList="[]"
                :inputID="'profile-name'"
                :error="errors['name']"
            ></input-block-component>
            <input-block-component
                v-model="blogger.user.email"
                :label="'E-mail'"
                :inputType="'email'"
                :inputPlaceholder="'Введите E-mail'"
                :inputClassList="[]"
                :inputID="'profile-email'"
                :error="errors['email']"
            ></input-block-component>
            <input-block-component
                v-model="blogger.user.phone"
                :label="'Номер телефона'"
                :inputType="'phone'"
                :inputPlaceholder="'Введите номер телефона'"
                :inputClassList="[]"
                :inputID="'profile-phone'"
                :disabled="1"
                :error="errors['phone']"
            ></input-block-component>
            <button
                @click="save"
                class="btn btn-primary">Сохранить изменения</button>
        </div>
    </div>
</template>

<style scoped>
.tab-content__image{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.tab-content__image img{
    border-radius:50%;
    width: 172px;
    height: 172px;
    object-fit:cover
}
</style>
