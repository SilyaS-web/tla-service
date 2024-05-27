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
                                <div class="list-projects__item project-item">
                                    <div class="owl-carousel project-item__carousel">
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-item__content">
                                        <div class="project-item__title">
                                            Цена — 1120 ₽
                                        </div>
                                        <div class="project-item__left" style="margin-bottom: 12px;">
                                            Осталось выполнить отзывов <span style="font-weight: 600; color:#FE5E00">5</span>
                                        </div>
                                        <a class="project-item__participants" title="Гель для душа парфюмированный, 1000 мл.">
                                            Dk-studio / Гель для душа парфюмированный, 1000 мл.
                                        </a>
                                        <div class="project-item__format-tags card__row card__tags">
                                            <div class="card__tags-item">
                                                <span>Рекламный пост</span>
                                            </div>
                                            <div class="card__tags-item">
                                                <span>Обзор на канале</span>
                                            </div>
                                            <div class="card__tags-item">
                                                <span>Другое</span>
                                            </div>
                                        </div>
                                        <div class="project-item__btns">
                                            <a href="#" class="btn btn-primary">Отправить</a>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="list-projects__item project-item">
                                    <div class="owl-carousel project-item__carousel">
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                        <div class="project-item__img">
                                            <img src="../img/projects-list/1.webp" alt="">
                                            <div class="project-item__status active">
                                                Активно
                                            </div>
                                            <div class="project-item__country">
                                                Россия
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-item__content">
                                        <div class="project-item__title">
                                            Цена — 1120 ₽
                                        </div>
                                        <div class="project-item__left" style="margin-bottom: 12px;">
                                            Осталось выполнить отзывов <span style="font-weight: 600; color:#FE5E00">5</span>
                                        </div>
                                        <a class="project-item__participants" title="Гель для душа парфюмированный, 1000 мл.">
                                            Dk-studio / Гель для душа парфюмированный, 1000 мл.
                                        </a>
                                        <div class="project-item__format-tags card__row card__tags">
                                            <div class="card__tags-item">
                                                <span>Рекламный пост</span>
                                            </div>
                                            <div class="card__tags-item">
                                                <span>Обзор на канале</span>
                                            </div>
                                            <div class="card__tags-item">
                                                <span>Другое</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="profile-chat__body">
                            <div class="profile-projects__title title">
                                Переписка с селлерами
                            </div>
                            <div class="profile-tabs__content-item">
                                <div class="tab-content__chat chat">
                                    <div class="chat__body">
                                        <div class="chat__left">
                                            <div class="chat__chat-items">
                                                <div class="chat__chat-item item-chat current">
                                                    <div class="item-chat__img">
                                                        <img src="../img/profile-icon.svg" alt="">
                                                    </div>
                                                    <div class="item-chat__text">
                                                        <div class="item-chat__title">Vysokoff SEO - продвижение и заработок</div>
                                                        <div class="item-chat__last-msg">
                                                            <p>Последнее сообщение:</p>
                                                            <span> 12.04.24 - 12:20</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__right">
                                            <div class="chat__messages messages-chat">
                                                <div class="messages-chat__item messages-chat__item--author">
                                                    <div class="messages-chat__item-header">
                                                        <div class="messages-chat__item-title">
                                                            Иван Иванов
                                                        </div>
                                                        <div class="messages-chat__item-date">
                                                            12.04.24 12:20
                                                        </div>
                                                    </div>
                                                    <div class="messages-chat__item-msg">
                                                        Здравствуйте! Какие у нас результаты по проекту?
                                                    </div>
                                                </div>
                                                <div class="messages-chat__item">
                                                    <div class="messages-chat__item-header">
                                                        <div class="messages-chat__item-title">
                                                            Vysokoff SEO - продвижение и заработок
                                                        </div>
                                                        <div class="messages-chat__item-date">
                                                            12.04.24 12:20
                                                        </div>
                                                    </div>
                                                    <div class="messages-chat__item-msg">
                                                        Здравствуйте! Все отлично, сегодня в 6 вечера по мск скину результаты!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat__messages messages-create">
                                                <div class="textarea-w">
                                                    <div class="textarea-upload">
                                                        <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" class="base-0-2-1" ie-style=""><path clip-rule="evenodd" d="m14.9502 3.80108c-1.0653-1.06811-2.7917-1.06811-3.857 0l-5.53401 5.54845c-1.74559 1.75017-1.74559 4.58847 0 6.33867 1.7445 1.7491 4.57211 1.7491 6.31661 0l.0025-.0026 2.8799-2.8595c.294-.2918.7688-.2901 1.0607.0038.2918.2939.2901.7688-.0038 1.0606l-2.8773 2.857-.0013.0013c-2.3307 2.3354-6.1092 2.3349-8.43936-.0013-2.32952-2.3356-2.32952-6.1216 0-8.45724l5.53396-5.54845c1.6514-1.65575 4.3297-1.65575 5.9811 0 1.6504 1.65465 1.6504 4.33657 0 5.99123l-5.5339 5.54846c-.97226.9748-2.54938.9748-3.52162 0-.97115-.9737-.97115-2.5516 0-3.5253l.0024-.0024 3.10232-3.08243c.2939-.29195.7688-.29042 1.0607.00341.292.29383.2904.7687-.0034 1.06065l-3.09997 3.08007-.00102.001c-.38619.3883-.38586 1.0178.00102 1.4057.38613.3872 1.01136.3872 1.3975 0l5.53397-5.54844c1.0664-1.06918 1.0664-2.80349 0-3.87268z" fill="currentColor" fill-rule="evenodd"></path></svg>
                                                        <div class="textarea-upload__text">
                                                            Прикрепите файл
                                                        </div>
                                                    </div>
                                                    <textarea name="" id="" placeholder="Напишите сообщение" class = "messages-create__textarea textarea"></textarea>
                                                </div>
                                                <div class="chat__btns" style="display: flex; flex-wrap: wrap; gap:8px;">
                                                    <button class="btn btn-primary">Отправить</button>
                                                    <a href="" class="btn btn-secondary">Подтвердить выполнение проекта</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
@endsection
