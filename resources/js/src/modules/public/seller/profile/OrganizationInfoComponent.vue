<script>
import {ref} from "vue";

import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";

export default {
    name: "OrganizationInfoComponent",
    props:['seller'],
    components:{InputBlockComponent,SelectBlockComponent},
    data(){
        return {
            errors: ref({}),
        }
    },
    methods:{
        save(){},
    }
}
</script>

<template>
    <div class="tab-content">
        <div class="tab-content__form">
            <div class="tab-content__form-form">
                <select-block-component
                    v-model="seller.organization_type"
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
                    v-model="seller.user.organization_name"
                    :label="'Название организации'"
                    :inputType="'text'"
                    :inputPlaceholder="'Введите название организации'"
                    :inputClassList="[]"
                    :inputID="'profile-organization_name'"
                    :error="errors['organization_name']"
                ></input-block-component>
                <input-block-component
                    v-model="seller.user.inn"
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
