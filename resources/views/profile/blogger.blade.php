@extends('layout.layout')

@section('content')
<section class="profile">
    <div class="profile__container _container">
        <div class="profile__body">
            <div class="profile__navigation nav-menu">
                <div class="nav-menu__body">
                    <div class="nav-menu__items">
                        <a href="#" class="nav-menu__item nav-menu__link tab projects-list-link active" data-content = "my-projects">
                            Мои проекты
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab projects-list-link" data-content = "profile-projects">
                            Список проектов
                        </a>
                        <a href="#" class="nav-menu__item nav-menu__link tab chat-link" data-content = "chat">
                            Чат с селлерами
                        </a>
                    </div>
                </div>
            </div>
            <div class="profile__content">
                <div class="profile__content-inner">
                    <div class="profile-projects tab-content active" id = "my-projects">
                        <div class="profile-projects__body">
                            <div class="projects-list__header">
                                <div class="list-projects__title title">
                                    Список моих проектов
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            <div class="list-projects__items">
                                @include('project.blogger-list', ['projects' => $projects, 'all' => false])
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
                                            <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Формат рекламы</label>
                                            <select name="filter-format" id="filter-format" class = "input">
                                                <option value="1" class="">Отзыв на товар</option>
                                                <option value="2" class="">Рекламная интеграция(Instagram)</option>
                                                <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                <option value="4" class="">Другие площадки для интеграций</option>
                                                <option value="5" class="">Платные интеграции</option>
                                            </select>
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Страна</label>
                                            <select name="filter-country" id="filter-country" class = "input">
                                                <option value="1" class="">Россия</option>
                                                <option value="2" class="">Казахстан</option>
                                                <option value="3" class="">Грузия</option>
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
                                    Список проектов
                                </div>
                                <div class="" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <button class="btn btn-primary projects-list__filter-btn">Фильтры</button>
                                </div>
                            </div>
                            <div class="list-projects__items">
                                @include('project.blogger-list', ['projects' => $all_projects, 'all' => true])
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
                                            <input type="text" class="input" name="filter-name" id="filter-name" placeholder="Поиск по названию">
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Формат рекламы</label>
                                            <select name="filter-format" id="filter-format" class = "input">
                                                <option value="1" class="">Отзыв на товар</option>
                                                <option value="2" class="">Рекламная интеграция(Instagram)</option>
                                                <option value="3" class="">Рекламная интеграция(Youtube)</option>
                                                <option value="4" class="">Другие площадки для интеграций</option>
                                                <option value="5" class="">Платные интеграции</option>
                                            </select>
                                        </div>
                                        <div class="form-group filter__item">
                                            <label for="">Страна</label>
                                            <select name="filter-country" id="filter-country" class = "input">
                                                <option value="1" class="">Россия</option>
                                                <option value="2" class="">Казахстан</option>
                                                <option value="3" class="">Грузия</option>
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
                        @include('shared.chat.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
@endsection
