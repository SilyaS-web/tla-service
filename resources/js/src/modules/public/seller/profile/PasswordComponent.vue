<script>
import {ref} from "vue";

import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";

export default {
    name: "PasswordComponent",
    props: ['saveErrors'],
    components:{InputBlockComponent},
    data(){
        return {
            oldPassword: '',
            newPassword: '',
            repeatPassword: '',
            errors:{},
        }
    },
    watch:{
        saveErrors(){
            this.errors = this.saveErrors
        }
    },
    methods:{
        save(){
            if(this.newPassword !== this.repeatPassword) {
                this.errors['new_password'] = 'Пароли не совпадают'
                this.errors['repeat_password'] = 'Пароли не совпадают'

                return
            }

            this.$emit('saveSeller', {
                old_password: this.oldPassword,
                new_password: this.newPassword
            })
        },
    }
}
</script>

<template>
    <div class="tab-content">
        <div class="tab-content__form" style="flex-direction:column;">
            <div class="tab-content__form-form" style="">
                <input-block-component
                    v-model="oldPassword"
                    :label="'Старый пароль'"
                    :inputType="'password'"
                    :inputID="'old_password'"
                    :inputPlaceholder="'Введите старый пароль'"
                    :error="errors['old_password']"
                ></input-block-component>
                <input-block-component
                    v-model="newPassword"
                    :label="'Новый пароль'"
                    :inputType="'password'"
                    :inputID="'password'"
                    :inputPlaceholder="'Введите новый пароль'"
                    :error="errors['password']"
                ></input-block-component>
                <input-block-component
                    v-model="repeatPassword"
                    :label="'Новый пароль(еще раз)'"
                    :inputType="'repeat_password'"
                    :inputID="'repeat_password'"
                    :inputPlaceholder="'Введите новый пароль еще раз'"
                    :error="errors['repeat_password']"
                ></input-block-component>
            </div>
            <button
                @click="save"
                class="btn btn-primary">Сохранить изменения</button>
        </div>
    </div>
</template>

<style scoped>

</style>
