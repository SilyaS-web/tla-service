<script>
import {ref} from "vue";

import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";

export default {
    name: "OrganizationInfoComponent",
    props:[
        'organization_name', 'organization_type', 'inn', 'errors'
    ],
    components:{InputBlockComponent,SelectBlockComponent},
    data(){
        return {
            saveData:ref({
                organization_name: null,
                organization_type: null,
                inn: null,
            }),
        }
    },
    created(){
        this.saveData = {
            organization_name: this.organization_name,
            organization_type: this.organization_type,
            inn: this.inn,
        }
    },
    methods:{
        save(){
            this.$emit('saveSeller', this.saveData)
        },
    }
}
</script>

<template>
    <div class="tab-content">
        <div class="tab-content__form">
            <div class="tab-content__form-form">
                <select-block-component
                    v-model="saveData.organization_type"
                    :label="'Тип организации'"
                    :error="errors['organization_type']"
                    :selectClassList="[]"
                    :selectID="'organization_type'"
                    :optionsList="[
                        {
                            name: 'ООО',
                            value: 'ООО',
                        },
                        {
                            name: 'ИП',
                            value: 'ИП',
                        },
                        {
                            name: 'ОАО',
                            value: 'ОАО',
                        },
                    ]"
                ></select-block-component>
                <input-block-component
                    v-model="saveData.organization_name"
                    :label="'Название организации'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите название организации'"
                    :inputClassList="[]"
                    :inputID="'profile-organization_name'"
                    :error="errors['organization_name']"
                ></input-block-component>
                <input-block-component
                    v-model="saveData.inn"
                    :label="'ИНН'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите ИНН'"
                    :inputClassList="[]"
                    :inputID="'profile-inn'"
                    :error="errors['inn']"
                ></input-block-component>
            </div>
        </div>
        <button
            @click="save"
            class="btn btn-primary">Сохранить изменения</button>
    </div>
</template>

<style scoped>

</style>
