<template>
    <div
        class="profile-projects tab-content" id="profile-projects">
        <div
            v-if="!editingProject"
            class="profile-projects__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список моих проектов
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                </div>
            </div>
            <div class="profile-projects__sort form-group" style="margin-bottom:32px;">
                <select
                    @click="extractBrands"
                    @change="sortByBrand"
                    name="projects-sort" id="projects-sort" style="border-radius:5px; border:1px solid rgba(0,0,0,.1); padding:0 8px; max-width:380px; height: 50px; font-size:18px">
                    <option value="">Выберите бренд</option>
                    <option value="">Все бренды</option>
                    <option
                        v-for="brand in brands"
                        :value="brand">
                        {{ brand }}
                    </option>
                </select>
            </div>
            <div class="profile-projects__items">
                <MyProjectsListItem
                    v-if="myProjects && myProjects.length > 0"
                    v-for="project in myProjects"
                    :project = "project"
                    v-on:switchTab="switchTab"
                    v-on:edit="editProject"
                ></MyProjectsListItem>
                <span v-else> Проектов нет </span>
            </div>
        </div>
        <div
            v-if="!editingProject"
            class="profile-projects__filters">
            <div class="projects-list__filter filter">
                <div class="filter__body">
                    <div class="filter__top">
                        <p class="filter__title">
                            Фильтр
                        </p>
                        <a
                            @click="resetFilter"
                            href="#" class="filter__reset">
                            Сбросить
                        </a>
                    </div>
                    <div class="filter__items">
                        <div class="form-group filter__item">
                            <input type="text" class="input" name="filter-name" id="filter-name" v-model="filter.product_name" placeholder="Поиск по названию">
                        </div>
                        <div class="form-group filter__item">
                            <label for="">Формат рекламы</label>
                            <select name="project_type" id="filter-format" class="input" v-model="filter.project_type">
                                <option value="" class="" >Выберите формат</option>
                                <option value="feedback" class="">Отзыв на товар</option>
                                <option value="inst" class="">Интеграция Ins</option>
                                <option value="youtube" class="">Интеграция YTube</option>
                                <option value="vk" class="">Интеграция VK</option>
                                <option value="telegram" class="">Интеграция Telegram</option>
                            </select>
                        </div>

                        <div class="filter__btns">
                            <button
                                @click="applyFilter"
                                class="btn btn-primary">Применить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="editingProject"
            class="profile-create-project edit-project__quest" id="">
            <div class="create-project__body">
                <div class="create-project__title title">
                    Редактировать проект
                </div>
                <div class="create-project__quest quest">
                    <div class="quest__steps">
                        <div id="step_1" class="quest__step step current" style="margin-bottom:30px;">
                            <div class="form-group">
                                <label for="product-name">Название товара</label>
                                <input
                                    v-model="editingProject.product_name"
                                    type="text"
                                    id="product-name"
                                    name="product_name"
                                    placeholder="Введите наименование товара" class="input input--product_name">
                                <span class="error" v-if="errors.product_name">{{ errors.product_name }}</span>
                            </div>
                            <div class="quest__step-row">
                                <div class="form-group">
                                    <label for="project-articul">Артикул товара</label>
                                    <input
                                        type="text"
                                        v-model="editingProject.product_nm"
                                        id="product-articul"
                                        name="product_nm"
                                        placeholder="Введите артикул" class="input input--product_price">
                                    <span class="error" v-if="errors.product_nm">{{ errors.product_nm }}</span>
                                </div>
                                <div class="form-group" style="flex:1 1">
                                    <label for="" style="display:unset">Цена товара</label>
                                    <div class="quantity-input">
                                        <input
                                            v-model="editingProject.product_price"
                                            type="number" class="input" value="0" name="product_price">
                                    </div>
                                </div>
                            </div>
                            <div class="quest__step-row">
                                <div class="form-group" style="flex:1 1 auto">
                                    <label for="project-link">Ссылка на товар</label>
                                    <input
                                        v-model="editingProject.product_link"
                                        type="text" id="project-link" name="product_link" placeholder="Ссылка" class="input input--product_link">
                                    <span class="error" v-if="errors.product_link">{{ errors.product_link }}</span>
                                </div>

                            </div>
                            <div class="form-group form-group--file create-project__files upload-files">
                                <div class="upload-files__title">
                                    Загрузите изображения товара
                                </div>
                                <div class="upload-files__body">
                                    <div
                                        v-for="(file, ind) in editingProjectFiles"
                                        class="upload-files__item uploaded" :style="'display:' + (file.link != 'uploading' ? 'flex' : 'none')">
                                        <div class="upload-files__path" :title="file.link">{{ file.link }}</div>
                                        <div
                                            @click="deleteFile(file)"
                                            class="upload-files__delete">
                                        </div>
                                        <input
                                            @change="uploadFile"
                                            type="file" :data-id="ind" hidden="" name="images[]">
                                    </div>
                                    <div
                                        @click="triggerUpload"
                                        class="upload-files__plus">

                                    </div>
                                </div>
                                <span class="error" v-if="errors.images">{{ errors.images }}</span>
                            </div>
                        </div>
                        <div id="step_2" class="quest__step step current">
                            <div class="form-group marketing-format">
                                <label for="format">Выберите формат рекламы</label>
                                <span class="error" v-if="errors.project_type">{{ errors.project_type }}</span>

                                <div class="marketing-format__item input-checkbox-w">
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
                                    <div class="quantity-w" data-max="100">
                                        <div
                                            v-on:click="(function(e){ if(quantities.feedback_quantity > 0) quantities.feedback_quantity -= 1})()"
                                            class="quantity-minus">
                                            <img src="img/minus-icon.svg" alt="">
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" v-model="quantities.feedback_quantity" class="input" name="feedback-quantity" id="feedback-quantity">
                                        </div>
                                        <div
                                            v-on:click="(function(e){ if(quantities.feedback_quantity < 100) quantities.feedback_quantity += 1})()"
                                            class="quantity-plus">
                                            <img src="img/plus-icon.svg" alt="">
                                        </div>
                                    </div>
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
                                    <label for="product-inst">
                                        Интеграция Ins
                                        <div class="format-tooltip format-tooltip--mobile" data-hint="product-inst">
                                            ?
                                            <div class="format-hint format-hint--text" id="product-inst">
                                                <div class="format-hint__title">
                                                    Интеграция Ins
                                                </div>
                                                <div class="format-hint__body">
                                                    Увеличивайте продажи с помощью reels. Повышайте охваты,
                                                    узнаваемость и доверие ĸ вашему бренду и товару, используя
                                                    интеграции в Ins с лидерами мнений.
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="quantity-w" data-max="100">
                                        <div
                                            v-on:click="(function(e){ if(quantities.inst_quantity > 0) quantities.inst_quantity -= 1})()"
                                            class="quantity-minus">
                                            <img src="img/minus-icon.svg" alt="">
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" v-model="quantities.inst_quantity" class="input" name="inst-quantity" id="inst-quantity">
                                        </div>
                                        <div  v-on:click="(function(e){ if(quantities.inst_quantity < 100) quantities.inst_quantity += 1})()"
                                              class="quantity-plus">
                                            <img src="img/plus-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="format-tooltip" data-hint="inst">
                                        ?
                                        <div class="format-hint format-hint--text" id="inst">
                                            <div class="format-hint__title">
                                                Интеграция Ins
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью reels. Повышайте охваты,
                                                узнаваемость и доверие ĸ вашему бренду и товару, используя
                                                интеграции в Ins с лидерами мнений.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="marketing-format__item input-checkbox-w">
                                    <label for="product-youtube">
                                        Интеграция YTube
                                        <div class="format-tooltip format-tooltip--mobile" data-hint="product-youtube">
                                            ?
                                            <div class="format-hint format-hint--text" id="product-youtube">
                                                <div class="format-hint__title">
                                                    Интеграция YTube
                                                </div>
                                                <div class="format-hint__body">
                                                    Увеличивайте продажи с помощью нативных обзоров на товар и
                                                    shorts. Повышайте охваты, ĸачайте seo, узнаваемость и доверие ĸ
                                                    вашему бренду и товару, используя интеграции в YTube с лидерами
                                                    мнений.
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="quantity-w" data-max="100">
                                        <div
                                            v-on:click="(function(e){ if(quantities.youtube_quantity > 0) quantities.youtube_quantity -= 1})()"
                                            class="quantity-minus">
                                            <img src="img/minus-icon.svg" alt="">
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" v-model="quantities.youtube_quantity" class="input" name="youtube-quantity">
                                        </div>
                                        <div v-on:click="(function(e){ if(quantities.youtube_quantity < 100) quantities.youtube_quantity += 1})()" class="quantity-plus">
                                            <img src="img/plus-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="format-tooltip" data-hint="youtube">
                                        ?
                                        <div class="format-hint format-hint--text" id="youtube">
                                            <div class="format-hint__title">
                                                Интеграция YTube
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью нативных обзоров на товар и
                                                shorts. Повышайте охваты, ĸачайте seo, узнаваемость и доверие ĸ
                                                вашему бренду и товару, используя интеграции в YTube с лидерами
                                                мнений.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="marketing-format__item input-checkbox-w">
                                    <label for="product-vk">
                                        Интеграция VK
                                        <div class="format-tooltip format-tooltip--mobile " data-hint="product-vk">
                                            ?
                                            <div class="format-hint format-hint--text" id="product-vk">
                                                <div class="format-hint__title">
                                                    Интеграция VK
                                                </div>
                                                <div class="format-hint__body">
                                                    Увеличивайте продажи с помощью публиĸаций в ВК по вашей ЦА.
                                                    Получите узнаваемость и доверие ĸ вашему бренду и товару,
                                                    используя интеграции ВК в целевых паблиĸах.
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="quantity-w" data-max="100">
                                        <div
                                            v-on:click="(function(e){ if(quantities.vk_quantity > 0) quantities.vk_quantity -= 1})()"
                                            class="quantity-minus">
                                            <img src="img/minus-icon.svg" alt="">
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" class="input" v-model="quantities.vk_quantity" name="vk-quantity">
                                        </div>
                                        <div
                                            v-on:click="(function(e){ if(quantities.vk_quantity < 100) quantities.vk_quantity += 1})()"
                                            class="quantity-plus">
                                            <img src="img/plus-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="format-tooltip" data-hint="vk">
                                        ?
                                        <div class="format-hint format-hint--text" id="vk">
                                            <div class="format-hint__title">
                                                Интеграция VK
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью публиĸаций в ВК по вашей ЦА.
                                                Получите узнаваемость и доверие ĸ вашему бренду и товару,
                                                используя интеграции ВК в целевых паблиĸах.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="marketing-format__item input-checkbox-w">
                                    <label for="product-tg">
                                        Интеграция Telegram
                                        <div class="format-tooltip format-tooltip--mobile" data-hint="product-tg">
                                            ?
                                            <div class="format-hint format-hint--text" id="product-tg">
                                                <div class="format-hint__title">
                                                    Интеграция Telegram
                                                </div>
                                                <div class="format-hint__body">
                                                    Увеличивайте продажи с помощью публиĸаций в Телеграм по вашей
                                                    ЦА. Получите охват по узĸой ЦА, узнаваемость и доверие ĸ вашему
                                                    бренду и товару, используя интеграции Телеграм в целевых паблиĸах.
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <div class="quantity-w" data-max="100">
                                        <div
                                            v-on:click="(function(e){ if(quantities.telegram_quantity > 0) quantities.telegram_quantity -= 1})()"
                                            class="quantity-minus">
                                            <img src="img/minus-icon.svg" alt="">
                                        </div>
                                        <div class="quantity-input">
                                            <input type="number" class="input" v-model="quantities.telegram_quantity" name="telegram-quantity">
                                        </div>
                                        <div
                                            v-on:click="(function(e){ if(quantities.telegram_quantity > 0) quantities.telegram_quantity += 1})()"
                                            class="quantity-plus">
                                            <img src="img/plus-icon.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="format-tooltip" data-hint="tg">
                                        ?
                                        <div class="format-hint format-hint--text" id="tg">
                                            <div class="format-hint__title">
                                                Интеграция Telegram
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью публиĸаций в Телеграм по вашей
                                                ЦА. Получите охват по узĸой ЦА, узнаваемость и доверие ĸ вашему
                                                бренду и товару, используя интеграции Телеграм в целевых паблиĸах.
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <span class="error error-format"></span>
                            </div>
                            <div class="quest__btns">
                                <button @click="modifyProject" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Project from "../../../services/api/Project";
    import {ref} from "vue";

    import MyProjectsListItem from "./MyProjectsListItem";

    export default {
        components: {MyProjectsListItem},
        props: ['myProjects'],
        data(){
            return {
                brands: ref([]),
                filter: ref({
                    project_type: null,
                    product_name: null,
                }),
                editingProject: ref(false),
                editingProjectFiles: ref([]),
                quantities: ref({
                    feedback_quantity: 0,
                    inst_quantity: 0,
                    youtube_quantity: 0,
                    vk_quantity: 0,
                    telegram_quantity: 0,
                }),
                errors: ref({}),
                Project
            }
        },
        updated(){
            if(this.editingProjectFiles.find(f => f.link == "uploading")){
                $(`.upload-files__item input[data-id=${this.editingProjectFiles.length - 1}]`).click();
            }
        },
        methods:{
            editProject(project){
                this.editingProject = project;
                this.editingProject.project_works.forEach(w => {
                    this.quantities[`${w.type}_quantity`] = parseInt(w.quantity)
                })
                this.editingProjectFiles = this.editingProject.project_files;
            },

            modifyProject(){
                this.editingProject.images = this.editingProjectFiles.filter(f => f.file).map(f => f.file);
                this.editingProject.uploaded_files = this.editingProjectFiles.filter(f => f.id).map(f => f.id);

                var formData = new FormData;

                formData.append('product_name', this.editingProject.product_name);
                formData.append('product_nm', this.editingProject.product_nm);
                formData.append('product_link', this.editingProject.product_link);
                formData.append('product_price', this.editingProject.product_price);

                for (let k in this.quantities){
                    formData.append(k, this.quantities[k])
                }
                for (let i = 0; i < this.editingProject.images.length; i++){
                    if(this.editingProject.images[i])
                        formData.append('images[' + i + ']', this.editingProject.images[i])
                }
                for (let i = 0; i < this.editingProject.uploaded_files.length; i++){
                    if(this.editingProject.uploaded_files[i])
                        formData.append('uploaded_images[' + i + ']', this.editingProject.uploaded_files[i])
                }

                axios({
                    method: 'post',
                    url: '/api/projects/' + this.editingProject.id,
                    data: formData
                })
                .then((data) =>{
                    this.editingProject = false;
                    this.editingProjectFiles = [];

                    for (let k in this.quantities){
                        this.quantities[k] = 0
                    }

                    notify('info', {title: 'Успешно!', message: 'Данные успешно обновлены.'});

                    this.$emit('updateMyProjects');
                })
                .catch((err) => {
                    notify('info', {title: 'Внимание!', message: 'Невозможно сохранить проект, перепроверьте все поля, данные не заполнены, либо заполнены некоректно.'});
                    this.errors = err.response.errors;
                })
            },
            deleteFile(file){
                this.editingProjectFiles = this.editingProjectFiles.filter(_f => _f.link != file.link);
            },
            triggerUpload(){
                this.editingProjectFiles.push({link: 'uploading', isUploaded: true});
            },
            uploadFile(event){
                var file = $(event.target)[0].files[0];

                this.editingProjectFiles[this.editingProjectFiles.length - 1].link = file.name;
                this.editingProjectFiles[this.editingProjectFiles.length - 1].file = file;
            },
            extractBrands(){
                if(!this.brands || this.brands.length === 0){
                    var list = (this.myProjects || []).filter(_p => _p.marketplace_brand).map(_p => _p.marketplace_brand);
                    this.brands = list.filter((value, index, array) => array.indexOf(value) === index)
                }
            },
            sortByBrand(){
                var sort = String($('#projects-sort').val()), counter = 0;

                if(sort.length === 0){
                    $('.profile-projects__item').show()
                    return
                }

                $('.profile-projects__item').each((i, v)=>{
                    if( String($(v).data('brand')).toLowerCase() != sort.toLowerCase() ){
                        $(v).hide();
                        counter++;
                    }
                    else $(v).show()
                })

                if(counter === $('.profile-projects__item').length){
                    notify('info', {title: 'Внимание!', message: 'Проектов с таким брендом не найдено.'});
                }
            },
            switchTab(work_id){
                this.$emit('switchTab', 'chat', {
                    item: 'chat',
                    id: work_id
                })
            },
            applyFilter(){
                this.$emit('applyFilter', this.filter);
            },
            resetFilter(){
                this.filter = {
                    product_name: '',
                    project_type: '',
                }
                this.$emit('applyFilter', false);
            }
        }
    }
</script>
