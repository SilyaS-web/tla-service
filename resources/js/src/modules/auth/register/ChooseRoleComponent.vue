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
<style scoped>
.roles-cards{
    margin-bottom: 20px;
}
.roles-cards__items{
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.roles-cards__card{
    width:150px;
    padding:5px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    border:1px solid rgba(0,0,0,0);
    border-radius: 5px;
    transition: border .2s linear;
}
.roles-cards__card img{
    margin-bottom: 10px;
    height:100px;
    margin-bottom: 10px;
    transition: opacity .2s linear;
}
.roles-cards__card p{
    font-size: 14px;
    font-weight: 600;
}
.roles-cards__card:hover{
    border:1px solid var(--primary)
}
.roles-cards__card:hover img{
    /* filter: brightness(0) saturate(100%) invert(48%) sepia(99%) saturate(3278%) hue-rotate(358deg) brightness(100%) contrast(109%); */
}
.roles-cards__card.active{
    border:1px solid var(--primary)
}
.roles-cards__card.active img{
    /* filter: brightness(0) saturate(100%) invert(48%) sepia(99%) saturate(3278%) hue-rotate(358deg) brightness(100%) contrast(109%); */
}
</style>
