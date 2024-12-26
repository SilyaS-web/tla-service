<template>
    <div :class="'profile-blogers tab-content ' + (isBlocked ? 'not-paid' : '')" id="profile-blogers-list">
        <!-- каталог блогеров-->
        <div v-if="!isChooseProjectList" class="profile-blogers__body">
            <div class="projects-list__header">
                <div class="list-projects__title title">
                    Список блогеров
                </div>
                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                    <button
                        v-if = "!currentProject"
                        class="btn btn-primary" @click="switchToProjectsList">Выберите проект</button>
                </div>
            </div>
            <div
                v-if="currentProject"
                class="projects-list__row projects-list__current-project current-project">
                <div class="current-project__main">
                    <div class="current-project__row">
                        <div class="current-project__img" :style="'background-image: url(' + (currentProject.project_files && currentProject.project_files[0] ? currentProject.project_files[0].link : '/img/profile-icon.svg') + ')'"></div>
                    </div>
                    <div class="current-project__title">
                        <p class="name"><b>{{ currentProject.product_name }}</b></p>
                        <p class="articul">Артикул товара: <span class="">{{ currentProject.product_nm }}</span></p>
                    </div>
                </div>
                <div class="current-project__col current-project__format">
                    <div class="current-project__row">
                        <div class="current-project__title">
                            <p class="name"><b>Формат рекламы</b></p>
                            <p class="articul"> {{ currentProject.choosedWork.name }} </p>
                        </div>
                    </div>
                </div>
                <div class="current-project__btn">
                    <button
                        @click="switchToProjectsList"
                        class="btn btn-secondary projects-list__choose-btn">Выбрать другой проект</button>
                </div>
            </div>
            <div class="blogers-list__list list-blogers">
                <BloggersListItem
                    v-if="bloggers && bloggers.length > 0"
                    v-for="blogger in bloggers"
                    :blogger="blogger"
                    :currentProject="currentProject">
                </BloggersListItem>
                <span v-else> В списке блогеров пусто </span>
            </div>
        </div>

        <!-- фильтры-->
        <div v-if="!isChooseProjectList" class="projects-list__filter filter blogers-list__filter">
            <div class="filter__body">
                <div class="filter__top">
                    <p class="filter__title">
                        Фильтр
                    </p>
                    <a
                        @click="resetBloggersFilter"
                        href="#" class="filter__reset">
                        Сбросить
                    </a>
                </div>
                <div class="filter__items">
                    <div class="form-group filter__item">
                        <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию" v-model="bloggerFilter.name">
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Платформа</label>
                        <select name="filter-platform" id="filter-platform" class="input" v-model="bloggerFilter.platform">
                            <option value="">Выберите платформу</option>
                            <option
                                v-for="platform in platforms"
                                :value="platform.id">
                                {{ platform.title }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group filter__item">
                        <label for="filter-country">Страна блогера</label>
                        <select name="filter-country" id="filter-country" class="input" v-model="bloggerFilter.country">
                            <option value="" class="">Выберите страну</option>
                            <option value="1" class="">Россия</option>
                        </select>
                    </div>
                    <div class="form-group filter__item">
                        <label for="filter-city">Город блогера</label>
                        <input type="text" class="input" name="filter-city" id="filter-city" placeholder="Введите город" v-model="bloggerFilter.city">
                    </div>
                    <div class="form-group" style="flex-direction: column;">
                        <label for="">Выберите тематику</label>
                        <div class="form-formats">
                            <div
                                v-for="theme in themes"
                                class="form__row form-format">
                                <input
                                    :id="'theme-' + theme.id"
                                    :value="theme.id"
                                    type="checkbox" name="themes[]" class="form-format__check"
                                    @change="setBloggersFilterThemes($event, theme.id)"
                                >
                                <label
                                    :for="'theme-' + theme.id">
                                    {{ theme.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Пол блогера</label>
                        <div class="filter__item--sex" id = "filter__item--sex">
                            <div class="input-checkbox-w">
                                <input
                                    @change="setBloggersFilterSex($event, 'male')"
                                    type="checkbox" class="checkbox" id="male" :checked="bloggerFilter.sex.includes('male')">
                                <label for="male">Мужской</label>
                            </div>
                            <div class="input-checkbox-w">
                                <input
                                    @change="setBloggersFilterSex($event, 'female')"
                                    type="checkbox" class="checkbox" id="female" :checked="bloggerFilter.sex.includes('female')">
                                <label for="female">Женский</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group filter__item">
                        <label for="">Количество подписчиков</label>
                        <div class="input-range-w">
                            <Slider
                                v-model="filterSubscribersQuantity.value"
                                v-bind="filterSubscribersQuantity"
                                :min="0"
                                :max="10000000"
                            ></Slider>
                        </div>
                        <div class="form-group row" style="margin-top: 10px; flex-direction:row; justify-content: space-between; display:flex; gap: 15px">
                            <input style="width:150px" type="number" class="input" v-model="filterSubscribersQuantity.value[0]">
                            <input style="width:150px" type="number" class="input" v-model="filterSubscribersQuantity.value[1]">
                        </div>
                    </div>
                    <div class="filter__btns">
                        <button
                            @click="applyBloggersFilter"
                            class="btn btn-primary">Применить</button>
                        <button
                            @click=""
                            class="btn btn-secondary hide">Скрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- каталог проектов-->
        <div
            v-if="isChooseProjectList"
            class="profile-projects" id="profile-projects-choose">
            <div class="profile-projects__body">
                <div class="projects-list__header">
                    <div class="list-projects__title title">
                        Список моих проектов
                    </div>
                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                        <button
                            v-if = "isChooseProjectList"
                            class="btn btn-primary" @click="isChooseProjectList = !isChooseProjectList">Вернуться</button>
                    </div>
                </div>
                <div class="profile-projects__items list-projects__items" style="max-width:1030px">
                    <div
                        v-if="projects.length > 0"
                        v-for="project in projects"
                        class="list-projects__item project-item">
                        <div class="owl-carousel project-item__carousel">
                            <div
                                v-for="file in project.project_files"
                                :style="'background-image: url(' + file.link + ')'"
                                class="project-item__img">
                            </div>
                        </div>
                        <div class="project-item__content">
                            <div class="project-item__title">
                                <span class="project-item__price">{{ project.product_price }}</span>₽
                            </div>
                            <div class="project-item__subtitle" :title="project.product_name">
                                {{ project.product_name }}
                            </div>
                            <div class="project-item__format-tags card__row card__tags">
                                <div
                                    v-for="work in project.project_works"
                                    class="card__tags-item">
                                    <span>{{ work.name }}</span>
                                </div>
                            </div>
                            <div class="project-item__btns">
                                <a
                                    @click="chooseProject(project)"
                                    href="#" class="btn btn-primary">Выбрать</a>
                            </div>
                        </div>
                    </div>
                    <span v-else>Проектов нет</span>
                </div>
            </div>
            <div class="profile-projects__filters profile-projects__filters--choose">
                <div class="projects-list__filter filter">
                    <div class="filter__body">
                        <div class="filter__top">
                            <p class="filter__title">
                                Фильтр
                            </p>
                            <a
                                @click="resetProjectsFilter"
                                href="#" class="filter__reset">
                                Сбросить
                            </a>
                        </div>
                        <div class="filter__items">
                            <div class="form-group filter__item">
                                <input
                                    v-model="projectsFilter.product_name"
                                    type="text" class="input" name="filter-name" placeholder="Поиск по названию">
                            </div>
                            <div class="form-group filter__item">
                                <label>Формат рекламы</label>
                                <select
                                    v-model="projectsFilter.project_type"
                                    name="project_type" id="filter-format" class="input">
                                    <option value="" class="">Выберите формат</option>
                                    <option value="feedback" class="">Отзыв на товар</option>
                                    <option value="inst" class="">Интеграция Ins</option>
                                    <option value="youtube" class="">Интеграция YTube</option>
                                    <option value="vk" class="">Интеграция VK</option>
                                    <option value="telegram" class="">Интеграция Telegram</option>
                                </select>
                            </div>

                            <div class="filter__btns" >
                                <button
                                    @click="applyProjectsFilter"
                                    class="btn btn-primary">Применить</button>
                                <button
                                    @click=""
                                    class="btn btn-secondary hide">Скрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- плашка об оплате тарифа-->
        <div class="not_paid-alert">
            <div class="not_paid-alert__body">
                <div class="not_paid-alert__title">
                    Каталог блогеров недоступен
                </div>
                <div class="not_paid-alert__text">
                    Необходимо оплатить тариф, чтобы иметь возможность просматривать<br> каталог блогеров и начать работу с ними
                </div>
            </div>
            <div class="not_paid-alert__footer">
                <router-link :to="{ path: '/tariffs' }" class="not_paid-alert__btn btn btn-primary">Разблокировать каталог</router-link>
            </div>
        </div>
    </div>
    <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
</template>
<script>
    import {ref} from "vue";

    import Slider from '@vueform/slider'

    import User from '../../../services/api/User.vue'
    import Themes from '../../../services/api/Themes.vue'
    import Platforms from '../../../services/api/Platforms.vue'
    import Project from '../../../services/api/Project.vue'
    import Loader from '../../../services/AppLoader.vue'

    import ProjectsList from "./ProjectsList.vue";
    import BloggersListItem from "./BloggersListItemComponent.vue";
    import ProjectsListItem from './ProjectsListItem.vue'

    import ChooseProjectPopup from '../../../ui/ChooseProjectPopup.vue'

    export default{
        props:['bloggers', 'user'],
        components:{
            ProjectsList, BloggersListItem, ProjectsListItem,
            ChooseProjectPopup, Slider
        },
        data(){
            return {
                platforms: ref([]),
                themes: ref([]),
                projects:ref([]),
                currentProject: ref(null),
                isChooseProjectList: ref(false),

                isBlocked: ref(false),

                bloggerFilter: ref({
                    name: '',
                    platform: '',
                    city: '',
                    country: '',
                    themes: [],
                    sex: [],
                    subscriber_quantity_min: 0,
                    subscriber_quantity_max: 10000000,
                }),

                projectsFilter: ref({
                    project_type: "",
                    product_name: '',
                }),

                filterSubscribersQuantity: ref({
                    value: [0, 10000000]
                }),

                Project, User, Themes, Platforms,
                Loader
            }
        },

        async mounted(){
            this.themes = await this.Themes.getList();
            this.platforms = await this.Platforms.getList();

            let user = this.User.getCurrent();

            this.isBlocked = !(user && (user.tariffs && user.tariffs.length > 0))
        },

        updated(){
            if(this.isChooseProjectList){
                $('.project-item').find('.project-item__carousel').owlCarousel({
                    margin: 5,
                    nav: false,
                    dots: true,
                    responsive: {
                        0:{
                            items: 1
                        },
                        1180: {
                            items:1
                        }
                    }
                });
            }
        },
        methods:{
            setBloggersFilterSex(e, value){
                if($(e.target).prop('checked')){
                   this.bloggerFilter.sex.push(value)
                }
                else{
                    this.bloggerFilter.sex.splice(this.bloggerFilter.sex.indexOf(value), 1);
                }
            },
            setBloggersFilterThemes(e, id){
                if($(e.target).prop('checked')){
                    this.bloggerFilter.themes.push(id)
                }
                else{
                    this.bloggerFilter.themes.splice(this.bloggerFilter.themes.indexOf(id), 1);
                }
            },
            async chooseProject(project){
                const data = await this.$refs.chooseProjectPopup.show({
                    title: 'Выберите формат рекламы',
                    subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите предложить блогеру, после выбора формата вы вернетесь к выбору блогера',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                    works: project.project_works,
                });

                if(data){
                    project.choosedWork = data
                    this.currentProject = project;

                    this.isChooseProjectList = false;
                }
            },
            switchToProjectsList(){
                this.isChooseProjectList = true;

                this.Loader.loaderOn('#profile-blogers-list');

                this.Project.getUsersProjectsList(this.user.id, {is_blogger_access: 1, statuses: [0]}).then(data => {
                    this.projects = data || [];

                    setTimeout(()=>{
                        this.Loader.loaderOff('#profile-blogers-list');
                    }, 300)
                })
            },
            applyBloggersFilter(){
                this.bloggerFilter.subscriber_quantity_min = this.filterSubscribersQuantity.value[0]
                this.bloggerFilter.subscriber_quantity_max = this.filterSubscribersQuantity.value[1]

                this.$emit('applyFilter', this.bloggerFilter);
            },
            resetBloggersFilter(){
                this.bloggerFilter = {
                    name: '',
                    platform: '',
                    city: '',
                    country: '',
                    themes: [],
                    sex: [],
                    subscriber_quantity_min: 0,
                    subscriber_quantity_max: 10000000,
                }
                this.filterSubscribersQuantity = {
                    value: [0, 10000000]
                }

                $('.form-format__check').prop('checked', false)
                $('.filter__item--sex').prop('checked', false)

                this.$emit('applyFilter', {})
            },
            applyProjectsFilter(){
                this.Loader.loaderOn('#profile-blogers-list');

                this.Project.getUsersProjectsList(this.user.id, this.projectsFilter).then(data => {
                    this.projects = data || [];
                    setTimeout(()=>{
                        this.Loader.loaderOff('#profile-blogers-list');
                    }, 300)
                })
            },
            resetProjectsFilter(){
                this.projectsFilter = {
                    product_name: '',
                    project_type: '',
                }

                this.Loader.loaderOn('#profile-blogers-list');

                this.Project.getUsersProjectsList(this.user.id, {}).then(data => {
                    this.projects = data || [];
                    setTimeout(()=>{
                        this.Loader.loaderOff('#profile-blogers-list');
                    }, 300)
                })
            }
        }
    }
</script>
