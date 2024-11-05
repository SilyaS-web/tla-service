<template>
    <div class="profile-create-project tab-content" id="create-project">
        <div class="create-project__body">
            <div class="create-project__title title">
                Создать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <div class="form-group">
                            <label for="product-name">Название товара</label>
                            <input
                                v-model="project.product_name"
                                type="text"
                                id="product-name"
                                name="product_name"
                                placeholder="Введите наименование товара" class="input input--product_name">
                            <span class="error" v-if="errors && errors.product_name">{{ errors.product_name }}</span>
                        </div>
                        <div class="quest__step-row">
                            <div class="form-group">
                                <label for="project-articul">Артикул товара</label>
                                <input
                                    type="text"
                                    v-model="project.product_nm"
                                    id="product-articul"
                                    name="product_nm"
                                    placeholder="Введите артикул" class="input input--product_price">
                                <span class="error" v-if="errors && errors.product_nm">{{ errors.product_nm }}</span>
                            </div>
                            <div class="form-group" style="flex:1 1">
                                <label for="" style="display:unset">Цена товара</label>
                                <div class="quantity-input">
                                    <input
                                        v-model="project.product_price"
                                        type="number" class="input" value="0" name="product_price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group marketing-format">
                            <label for="format">Выберите формат рекламы</label>
                            <span class="error" v-if="errors && errors.project_type">{{ errors.project_type }}</span>

                            <div class="marketing-format__item input-checkbox-w">
                                <div class="checkbox">
                                    <input type="checkbox" id="feedback" class="checkbox__checkbox" v-on:change="feedbackCheckbox" v-model="project.feedback">
                                    <label for="feedback"></label>
                                </div>
                                <label for="product-feedback">Отзыв
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
                                            Отзыв
                                        </div>
                                        <div class="format-hint__body">
                                            Улучшайте рейтинг вашей ĸарточĸи, публиĸуя положительные отзывы.
                                            Это поможет переĸрыть негативные отзывы и повысить доверие
                                            поĸупателей. Получите выĸупы не опасаясь санĸций от марĸетплейса.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <div class="checkbox">
                                    <input type="checkbox" id="integration" class="checkbox__checkbox" v-on:change="integrationCheckbox" v-model="project.integration">
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
                                                Повышайте охваты, узнаваемость и доверие ĸ вашему бренду и товару, используя
                                                интеграции с лидерами мнений.
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

    import Project from '../../../services/api/Project.vue'

    export default {
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
