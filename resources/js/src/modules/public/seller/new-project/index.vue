<template>
    <div class="profile-create-project tab-content" id="create-project">
        <div class="create-project__body">
            <div class="create-project__title title">
                Создать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <Input
                            v-model="project.product_name"
                            :label="'Название товара'"
                            :inputType="'text'"
                            :inputPlaceholder="'Введите наименование товара'"
                            :inputClassList="['input--product_name']"
                            :inputID="'product-name'"
                            :error="(errors && errors.product_name ? errors.product_name : null)"
                        ></Input>
                        <div class="quest__step-row">
                            <Input
                                v-model="project.product_nm"
                                :label="'Артикул товара'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите артикул'"
                                :inputClassList="['input--product_articul']"
                                :inputID="'product-articul'"
                                :error="(errors && errors.product_nm ? errors.product_nm : null)"
                            ></Input>

                            <Input
                                v-model="project.product_price"
                                :label="'Цена товара'"
                                :inputType="'number'"
                                :inputPlaceholder="'Введите цену товара'"
                                :inputClassList="['input--product_price']"
                                :inputID="'product-price'"
                                :error="(errors && errors.product_price ? errors.product_price : null)"
                            ></Input>
                        </div>
                        <div class="form-group marketing-format" style="z-index: 3;" >
                            <label for="format">Выберите формат</label>
                            <span class="error" v-if="errors && errors.project_type">{{ errors.project_type }}</span>

                            <div class="marketing-format__item input-checkbox-w">
                                <div class="checkbox">
                                    <input type="checkbox" id="feedback" class="checkbox__checkbox" v-model="project.feedback">
                                    <label for="feedback"></label>
                                </div>
                                <label for="product-feedback">Выкуп + отзыв
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="product-feedback">
                                        ?
                                        <div class="format-hint format-hint--text" id="product-feedback">
                                            <div class="format-hint__title">
                                                Рекламный пост
                                            </div>
                                            <div class="format-hint__body">
                                                Улучшайте рейтинг вашей ĸарточĸи, публиĸуя положительные отзывы.
                                                Это поможет переĸрыть негативные отзывы и повысить доверие
                                                поĸупателей. Получите выĸупы не опасаясь санĸций от марĸетплейса.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="format-tooltip" data-hint="feedback">
                                    ?
                                    <div class="format-hint format-hint--text" id="feedback">
                                        <div class="format-hint__title">
                                            Выкуп + отзыв
                                        </div>
                                        <div class="format-hint__body">
                                            Выкуп товара предполагает его приобретение блогером на маркетплейсе, после чего он публикует подробный отзыв, сопровождаемый фото или видео материалами.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <div class="checkbox">
                                    <input type="checkbox" id="integration" class="checkbox__checkbox" v-model="project.integration">
                                    <label for="integration"></label>
                                </div>
                                <label for="product-inst">
                                    Интеграция
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="product-inst">
                                        ?
                                        <div class="format-hint format-hint--text" id="product-inst">
                                            <div class="format-hint__title">
                                                Интеграция
                                            </div>
                                            <div class="format-hint__body">
                                                Интеграция подразумевает публикации блогером контента в социальной сети, с прикреплением ссылки либо упоминание артикула вашего товара.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="format-tooltip" data-hint="inst">
                                    ?
                                    <div class="format-hint format-hint--text" id="inst">
                                        <div class="format-hint__title">
                                            Интеграция
                                        </div>
                                        <div class="format-hint__body">
                                            Повышайте охваты, узнаваемость и доверие ĸ вашему бренду и товару, используя
                                            интеграции с лидерами мнений.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group--file create-project__files upload-files">
                            <div class="upload-files__title">
                                Загрузите изображения товара
                            </div>
                            <div class="upload-files__body">
                                <div class="upload-files__plus">

                                </div>
                            </div>
                            <span class="error" v-if="errors && errors.images">{{ errors.images }}</span>
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
    </div>
</template>
<script>
import { ref } from "vue";

import Project from '../../../../core/services/api/Project.vue'

import Input from '../../../../core/components/form/InputBlockComponent'

export default {
    components:{ Input },
    data(){
        return {
            project: ref({
                product_name: null,
                product_nm: null,
                product_price: null,
                product_link: null,
                feedback: false,
                integration: false,
                images: [],
            }),
            errors: ref({
                product_name: null,
                product_nm: null,
                product_price: null,
                product_link: null,
                project_type: null,
                images: null,
            }),
            Quest: ref(null),
            Project
        }
    },
    mounted(){
        this.Quest = new CreateProject('#create-project');
    },
    updated(){
        if(!this.Quest)
            this.Quest = new CreateProject('#create-project');
    },
    methods: {
        async createProject(){
            var images = $('.upload-files__body').find('input[type="file"]');

            images.each((i, v) => {
                if($(v)[0].files)
                    this.project.images.push($(v)[0].files)
            })

            this.project.feedback = this.project.feedback ? 1 : 0;
            this.project.integration = this.project.integration ? 1 : 0;

            this.Project.create(this.project).then(
                data => {
                    this.project = {
                        product_name: null,
                        product_nm: null,
                        product_price: null,
                        product_link: null,
                        feedback_quantity: 0,
                        inst_quantity: 0,
                        youtube_quantity: 0,
                        vk_quantity: 0,
                        telegram_quantity: 0,
                        images: [],
                    }

                    $('#create-project').find('.input').val('');
                    $('#create-project').find('.quest__step#step_1').addClass('current');
                    $('#create-project').find('.quest__step#step_2').removeClass('current');
                    $('.upload-files__body').find('.upload-files__item').remove();

                    this.Quest.destroy();
                    this.Quest = null;

                    this.$emit('switchTab', 'profile-projects')
                },
                err => {
                    this.errors = err.response.data
                }
            )
        },
        feedbackCheckbox(event){
            if($(event.target).is(':checked')){
                this.project.integration = false;
            }
        },
        integrationCheckbox(event){
            if($(event.target).is(':checked')){
                this.project.feedback = false;
            }
        },
    }
}
</script>
