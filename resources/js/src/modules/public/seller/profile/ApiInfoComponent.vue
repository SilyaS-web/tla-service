<script>
import {ref} from "vue";

import WbKeyInstructionPopup from "../../../../core/components/popups/wb-key-instruction/WbKeyInstructionPopup.vue";

export default {
    name: "ApiInfoComponent",
    components: {WbKeyInstructionPopup},
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
                    <div class="form-group">
                        <label for="">Ссылка на магазин WB</label>
                        <input type="text" class="input" id="marketplace" name="wb_link" v-model="saveData.wbLink">
                        <span v-if = "errors['wb_link']" class="error">{{ errors['wb_link'][0] }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-group__header">
                            <label for="ozon_api_key">Ключ API WB</label>
                            <a href="#">
                                Где найти ключ API Wildberries?
                            </a>
                        </div>
                        <input type="text" class="input" id="wb_api_key" name="wb_api_key" v-model="saveData.wbApiKey">
                        <span v-if = "errors['wb_api_key']" class="error">{{ errors['wb_api_key'][0] }}</span>
                    </div>
                </div>
                <div class="tab-content__form-left--ozon">
                    <div class="form-group">
                        <label for="ozon_link">Ссылка на магазин OZON</label>
                        <input type="text" class="input" id="ozon_link" name="ozon_link" v-model="saveData.ozonLink">
                        <span v-if = "errors['ozon_link']" class="error">{{ errors['ozon_link'][0] }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-group__header">
                            <label for="ozon_api_key">Client ID OZON</label>
                            <a href="#">
                                Где найти Client ID и ключ API OZON?
                            </a>
                        </div>
                        <input type="text" class="input" id="ozon_client_id" name="ozon_client_id" v-model="saveData.ozonClientID">
                        <span v-if = "errors['ozon_client_id']" class="error">{{ errors['ozon_client_id'][0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="ozon_api_key">Ключ API OZON</label>
                        <input type="text" class="input" id="ozon_api_key" name="ozon_api_key" v-model="saveData.ozonApiKey">
                        <span v-if = "errors['ozon_api_key']" class="error">{{ errors['ozon_api_key'][0] }}</span>
                    </div>
                </div>
            </div>
        </div>
        <button
            @click="save"
            class="btn btn-primary">Сохранить изменения</button>
        <wb-key-instruction-popup ref="wbInstructionPopup"></wb-key-instruction-popup>
    </div>
</template>

<style scoped>
    .form-group__header{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .form-group__header a{
        font-size: 14px;
        font-weight: 400;
        color:var(--text-non-accent);
    }
</style>
