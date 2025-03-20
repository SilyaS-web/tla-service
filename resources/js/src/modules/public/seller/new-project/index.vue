<template>
    <div class="profile-create-project" id="create-project">
        <div class="create-project__body">
            <div class="create-project__title title">
                Создать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <div class="quest__step-row">
                            <Input
                                v-model="project.product_nm"
                                :label="'Артикул товара'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите артикул'"
                                :inputClassList="['input--product_articul']"
                                :inputID="'product-articul'"
                                :error="(errors && errors.product_nm ? errors.product_nm[0] : null)"
                            ></Input>
                            <button
                                @click="getProductData"
                                :style="{flex:'unset', height: '47px', alignSelf: 'anchor-center'}"
                                class="btn btn-primary">
                                Загрузить данные
                            </button>
                        </div>
                        <div class="quest__step-row">
                            <Input
                                v-model="project.product_name"
                                :label="'Название товара'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите наименование товара'"
                                :inputClassList="['input--product_name']"
                                :inputID="'product-name'"
                                :error="(errors && errors.product_name ? errors.product_name[0] : null)"
                            ></Input>
                            <Input
                                v-model="project.product_price"
                                :label="'Цена товара'"
                                :inputType="'number'"
                                :inputPlaceholder="'Введите цену товара'"
                                :inputClassList="['input--product_price']"
                                :inputID="'product-price'"
                                :error="(errors && errors.product_price ? errors.product_price[0] : null)"
                            ></Input>
                        </div>

                        <FormatTypes
                            v-model="project.integration_types"
                            :id="'new-project'"
                            :label="'Выберите формат'"
                            :error="(errors && errors.integration_types ? errors.integration_types[0] : null)"
                        ></FormatTypes>

                        <UploadFiles
                            v-model="project.images"
                            ref="uploadFiles"
                            :id="'create-project-upload'"
                            :label="'Загрузите изображения товара'"
                            :error="errors.images && errors.images[0]"
                        ></UploadFiles>
                    </div>

                    <div class="quest__btns">
                        <button @click="createProject" class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

import { ref } from "vue";

import Project from '../../../../core/services/api/Project.vue'

import Input from '../../../../core/components/form/InputBlockComponent'
import UploadFiles from '../../../../core/components/form/PlusFilesUploadBlockComponent.vue'
import FormatTypes from '../../../../core/components/form/FormatChooseComponent.vue'

export default {
    components:{ Input, UploadFiles, FormatTypes },
    data(){
        return {
            project: ref({
                product_name: null,
                product_nm: null,
                product_price: null,
                // product_link: null,
                integration_types: [],
                images: [],
            }),
            errors: ref({
                product_name: null,
                product_nm: null,
                product_price: null,
                // product_link: null,
                project_type: null,
                images: null,
            }),

            Project
        }
    },
    mounted(){
    },
    updated(){
    },
    methods: {
        getProductData(){
            axios({
                method:'get',
                url:'http://127.0.0.1:3000/product/' + (this.project.product_nm.length > 9 ? 'ozon' : 'wb') + '/' + this.project.product_nm,
            })
            .then(async res => {
                this.project.product_name = res.data.title;

                let priceArr = res.data.price.replace(/[^a-zA-Z0-9]/g, "");
                this.project.product_price = parseFloat(priceArr);

                await axios({
                    method:'get',
                    url:res.data.imageUrl,
                    responseType: 'blob'
                }).then(blob => {
                    // const href = URL.createObjectURL(blob);
                    //
                    // const anchorElement = document.createElement('a');
                    // anchorElement.href = href;
                    // anchorElement.download = `${this.project.images.length + 1}.jpg`;
                    //
                    // document.body.appendChild(anchorElement);
                    // anchorElement.click();
                    //
                    // document.body.removeChild(anchorElement);
                    // window.URL.revokeObjectURL(href);

                    this.$refs.uploadFiles.resetFiles()
                    this.$refs.uploadFiles.appendFile({
                        file: blob.data,
                        link: `${this.project.images.length + 1}.jpg`
                    })
                })
            })
            .catch(err => {
                notify('error', {
                    title: 'Ошибка!',
                    message: 'К сожалению,  не удалось получить данные... Вы можете заполнить данные вручную, либо попробовать позже'
                });
            })
        },
        async createProject(){
            this.project.images = this.project.images.filter(obj => obj.file).map(obj => obj.file)

            this.Project.create(this.project).then(
                data => {
                    this.project = {
                        product_name: null,
                        product_nm: null,
                        product_price: null,
                        // product_link: null,
                        integration_types: [],
                        images: [],
                    }

                    this.$emit('switchTab', 'profile-projects')
                },
                err => {
                    this.errors = err.response.data
                }
            )
        },
    }
}
</script>
