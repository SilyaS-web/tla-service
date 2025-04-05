<script>
import {ref} from "vue";

import WbKeyInstructionPopup from "../../../../core/components/popups/wb-key-instruction/WbKeyInstructionPopup.vue";
import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import OzonClientIdInstructionsPopup
    from "../../../../core/components/popups/ozon-client-id-instructions/OzonClientIdInstructionsPopup.vue";

export default {
    name: "ApiInfoComponent",
    components: {OzonClientIdInstructionsPopup, InputBlockComponent, WbKeyInstructionPopup},
    props:[
        'wb_link',
        'wb_api_key',
        'ozon_link',
        'ozon_client_id',
        'ozon_api_key',
        'errors'
    ],
    data(){
        return {
            saveData: ref({
                 wbLink: null,
                 wbApiKey: null,
                 ozonLink: null,
                 ozonClientID: null,
                 ozonApiKey: null,
            }),
        }
    },
    methods:{
        openWbInstruction(){ this.$refs.wbInstructionPopup.show() },
        openOzonInstruction(){ this.$refs.ozonInstructionPopup.show() },
        save(){
            this.$emit('saveSeller', this.saveData)
        }
    }
}
</script>

<template>
    <div class="tab-content">
        <div class="tab-content__form tab-content__form--api" style="flex-direction:column;">
            <div class="tab-content__form-form" style="">
                <div class="tab-content__form-right--wb">
                    <input-block-component
                        v-model="saveData.wbLink"
                        :label="'Ссылка на магазин WB'"
                        :inputType="'text'"
                        :inputPlaceholder="'Введите ссылку на магазин WB'"
                        :inputClassList="[]"
                        :inputID="'profile-wb_link'"
                        :error="errors['wb_link']"
                    ></input-block-component>
                    <input-block-component
                        v-model="saveData.wbLink"
                        v-on:openWbInstruction="openWbInstruction"
                        :label="'Ключ API WB'"
                        :inputType="'text'"
                        :inputPlaceholder="'Введите ключ API WB'"
                        :inputClassList="[]"
                        :inputID="'profile-wb_api_key'"
                        :headerLink="{
                            name: 'Где найти ключ API Wildberries?',
                            eventName: 'openWbInstruction'
                        }"
                        :error="errors['wb_api_key'] ? errors['wb_api_key'][0] : ''"
                    ></input-block-component>
                </div>
                <div class="tab-content__form-left--ozon">
                    <input-block-component
                        v-model="saveData.wbLink"
                        :label="'Ссылка на магазин OZON'"
                        :inputType="'text'"
                        :inputPlaceholder="'Введите ссылку на магазин OZON'"
                        :inputClassList="[]"
                        :inputID="'profile-ozon_link'"
                        :error="errors['ozon_link'] ? errors['ozon_link'][0] : ''"
                    ></input-block-component>
                    <input-block-component
                        v-model="saveData.ozonClientID"
                        v-on:openOzonInstruction="openOzonInstruction"
                        :label="'Client ID OZON'"
                        :inputType="'text'"
                        :inputPlaceholder="'Введите Client ID OZON'"
                        :inputClassList="[]"
                        :inputID="'profile-ozon_client_id'"
                        :headerLink="{
                            name: 'Где найти Client ID и ключ API OZON?',
                            eventName: 'openOzonInstruction'
                        }"
                        :error="errors['ozon_client_id'] ? errors['ozon_client_id'][0] : ''"
                    ></input-block-component>
                    <input-block-component
                        v-model="saveData.ozonApiKey"
                        :label="'Ключ API OZON'"
                        :inputType="'text'"
                        :inputPlaceholder="'Введите ключ API Ozon'"
                        :inputClassList="[]"
                        :inputID="'profile-ozon_api_key'"
                        :error="errors['ozon_api_key'] ? errors['ozon_api_key'][0] : ''"
                    ></input-block-component>
                </div>
            </div>
        </div>
        <button
            @click="save"
            class="btn btn-primary">Сохранить изменения</button>
        <wb-key-instruction-popup ref="wbInstructionPopup"></wb-key-instruction-popup>
        <ozon-client-id-instructions-popup ref="ozonInstructionPopup"></ozon-client-id-instructions-popup>
    </div>
</template>
