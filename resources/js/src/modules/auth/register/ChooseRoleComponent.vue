<template>
    <div class="form-group">
        <label for="role">Выберите роль</label>
        <div class="roles-cards">
            <div class="roles-cards__items">
                <div
                    v-bind:class="'roles-cards__card' + (role == 'seller' ? ' active' : '')"
                    @click="changeRole('seller')"
                    data-role="seller">
                    <img src='img/seller-role.png' alt="">
                    <p>Селлер</p>
                </div>
                <div
                    v-bind:class="'roles-cards__card' + (role == 'blogger' ? ' active' : '')"
                    @click="changeRole('blogger')"
                    data-role="blogger">
                    <img src='img/blogger-role.png' alt="">
                    <p>Блогер</p>
                </div>
                <div
                    v-bind:class="'roles-cards__card' + (role == 'agent' ? ' active' : '')"
                    @click="changeRole('agent')"
                    data-role="agent">
                    <img src='img/agent-role.png' alt="">
                    <p title="Представитель бренда(Агенство)">Агенство</p>
                </div>
            </div>
            <input type="hidden" name="role" value="">
        </div>
        <span
            v-if="errors && errors.role"
            class="error">{{ errors.role[0] }}</span>
    </div>
</template>
<script>
import {ref} from 'vue'

export default{
    props: ['role', 'errors'],
    data(){
        return{
            user: ref({
                role: null
            })
        }
    },
    methods:{
        changeRole(role){
            this.$emit('update:modelValue', role)
        },
    }
}
</script>
