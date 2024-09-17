<template>
    <section class="profile" id="blogger">
        <div class="profile__container _container">
            <div class="profile__body">
                <Aside @switchTab="switchTab"></Aside>
                <div class="profile__content">
                    <div class="profile__content-inner">
                        <div class="profile-projects tab-content active" id = "my-projects">
                            <div class="profile-projects__body">
                                <div class="projects-list__header">
                                    <div class="list-projects__title title">
                                        Принятые проекты
                                    </div>
                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    </div>
                                </div>
                                <div class="list-projects__items">

                                </div>
                            </div>
                            <div class="profile-projects__filters">
                                <div class="projects-list__filter filter">
                                    <div class="filter__body">
                                        <div class="filter__top">
                                            <p class = "filter__title">
                                                Фильтр
                                            </p>
                                            <a href="#" class="filter__reset">
                                                Сбросить
                                            </a>
                                        </div>
                                        <div class="filter__items">
                                            <div class="form-group filter__item">
                                                <input type="text" class="input" name="filter-name" id="" placeholder="Поиск по названию">
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="filter-category">Категория</label>
                                                <input type="text" class="input" name="filter-category" id="filter-category" placeholder="Введите категорию">
                                                <input type="text" id = "" hidden>
                                                <div class="filter-tooltip" style="display: none">
                                                    <div class="filter-tooltip__items">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="">Формат рекламы</label>
                                                <select name="filter-format" id="filter-format" class = "input">
                                                    <option value="" class="">Выберите формат</option>
                                                    <option value="feedback" class="">Отзыв на товар</option>
                                                    <option value="inst" class="">Интеграция Ins</option>
                                                    <option value="youtube" class="">Интеграция YTube</option>
                                                    <option value="vk" class="">Интеграция VK</option>
                                                    <option value="telegram" class="">Интеграция Telegram</option>
                                                </select>
                                            </div>

                                            <div class="filter__btns">
                                                <button class="btn btn-primary btn-filter-send">Применить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-projects tab-content" id = "profile-projects">
                            <div class="profile-projects__body">
                                <div class="projects-list__header">
                                    <div class="list-projects__title title">
                                        Все проекты
                                    </div>
                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    </div>
                                </div>
                                <div class="profile-projects__items list-projects__items">
<!--                                    @include('project.all-blogger-list', ['all_projects' => $all_projects, 'type' => 'all'])-->
                                </div>
                            </div>
                            <div class="profile-projects__filters">
                                <div class="projects-list__filter filter">
                                    <div class="filter__body">
                                        <div class="filter__top">
                                            <p class = "filter__title">
                                                Фильтр
                                            </p>
                                            <a href="#" class="filter__reset">
                                                Сбросить
                                            </a>
                                        </div>
                                        <div class="filter__items">
                                            <div class="form-group filter__item">
                                                <input type="text" class="input" name="filter-name" id="" placeholder="Поиск по названию">
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="filter-category">Категория</label>
                                                <input type="text" class="input" name="filter-category" id="" placeholder="Введите категорию">
                                                <input type="text" id = "" hidden>
                                                <div class="filter-tooltip" style="display: none">
                                                    <div class="filter-tooltip__items">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="">Формат рекламы</label>
                                                <select name="filter-format" id="" class = "input">
                                                    <option value="" class="">Выберите формат</option>
                                                    <option value="feedback" class="">Отзыв на товар</option>
                                                    <option value="inst" class="">Интеграция Ins</option>
                                                    <option value="youtube" class="">Интеграция YTube</option>
                                                    <option value="vk" class="">Интеграция VK</option>
                                                    <option value="telegram" class="">Интеграция Telegram</option>
                                                </select>
                                            </div>

                                            <div class="filter__btns">
                                                <button class="btn btn-primary btn-filter-send">Применить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-projects tab-content" id = "avail-projects">
                            <div class="profile-projects__body">
                                <div class="projects-list__header">
                                    <div class="list-projects__title title">
                                        Заявки от селлеров
                                    </div>
                                    <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                    </div>
                                </div>
                                <div class="list-projects__items">
<!--                                    @include('project.blogger-list', ['project_works' => $application_works, 'type' => 'applications'])-->
                                </div>
                            </div>
                            <div class="profile-projects__filters">
                                <div class="projects-list__filter filter">
                                    <div class="filter__body">
                                        <div class="filter__top">
                                            <p class = "filter__title">
                                                Фильтр
                                            </p>
                                            <a href="#" class="filter__reset">
                                                Сбросить
                                            </a>
                                        </div>
                                        <div class="filter__items">
                                            <div class="form-group filter__item">
                                                <input type="text" class="input" name="filter-name" id="" placeholder="Поиск по названию">
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="filter-category">Категория</label>
                                                <input type="text" class="input" name="filter-category" id="" placeholder="Введите категорию">
                                                <input type="text" id = "" hidden>
                                                <div class="filter-tooltip" style="display: none">
                                                    <div class="filter-tooltip__items">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group filter__item">
                                                <label for="">Формат рекламы</label>
                                                <select name="filter-format" id="" class = "input">
                                                    <option value="" class="">Выберите формат</option>
                                                    <option value="feedback" class="">Отзыв на товар</option>
                                                    <option value="inst" class="">Интеграция Ins</option>
                                                    <option value="youtube" class="">Интеграция YTube</option>
                                                    <option value="vk" class="">Интеграция VK</option>
                                                    <option value="telegram" class="">Интеграция Telegram</option>
                                                </select>
                                            </div>

                                            <div class="filter__btns">
                                                <button class="btn btn-primary btn-filter-send">Применить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-chat tab-content" id = "chat">
<!--                            @include('shared.chat.index')-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    import Aside from '../../components/blogger/AppAside.vue'

    export default{
        component: [Aside],
        data(){

        },
        methods:{
            switchTab(tab){
                switch(tab){
                    case 'moderation':
                        this.loaderOn('#moderation')
                        this.getBloggers([0]).then(list => {
                            this.unverifiedBloggers = (list || []).map(_b => this.findBiggestPlatform(_b));
                            setTimeout(()=>{
                                this.loaderOff()
                            }, 500)
                        })
                        break;
                }
            }
        }
    }
</script>
