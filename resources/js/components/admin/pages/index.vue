<template>
    <div class="burger-menu">
            <div class="admin-menu__body">
                <div class="admin-menu__title">
                    Выберите раздел
                </div>
                <nav class="nav admin-menu__nav">
                    <div class="nav__items">
                        <a href="" class="nav__link">
                            Модерация блогеров
                        </a>
                    </div>
                </nav>
                <a href="#" class="admin-menu__leave">Выйти</a>
            </div>
        </div>

        <admin-header></admin-header>

        <section class="admin-view">
            <div class="admin-view__container _container active-menu">
                <div class="admin-view__body">
                    <aside class="admin-menu">
                        <div class="admin-menu__container">
                            <div class="admin-menu__body">
                                <nav class="nav admin-menu__nav">
                                    <div class="nav__items">
                                        <a href="" class="nav__link tab active" data-content="moderation" title="Модерация блогеров">
                                            <img src="{{ asset('admin/img/blogers-list-icon.svg') }}" alt="" class="nav__link-img">
                                            Модерация блогеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="blogers-list" title="Список блогеров">
                                            <img src="{{ asset('admin/img/blog-icon.svg') }}" alt="" class="nav__link-img">
                                            Список блогеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="sellers-list" title="Список селлеров">
                                            <img src="{{ asset('admin/img/money-icon.svg') }}" alt="" class="nav__link-img">
                                            Список селлеров
                                        </a>
                                        <a href="" class="nav__link tab" data-content="projects-list" title="Модерация проектов">
                                            <img src="{{ asset('admin/img/list-icon.svg') }}" alt="" class="nav__link-img">
                                            Модерация проектов
                                        </a>
                                        <a href="" class="nav__link tab" data-content="payment-history" title="История заказов">
                                            <img src="{{ asset('admin/img/history-icon.svg') }}" alt="" class="nav__link-img">
                                            История заказов

                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </aside>
                    <admin-bloggers-moderation-page :bloggers="bloggers"></admin-bloggers-moderation-page>
                    <!-- <div class="admin-view__content admin-blogers tab-content active" id="moderation">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Модерация блогеров • {{ $unverified_users->count() }}
                                </div>
                                <div class="admin-blogers__search form-group">
                                    <input type="name" id="moderation-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary moderation-search-btn">Найти</button>
                                </div>
                            </div>

                            @include('shared.admin.unverified-users-list')
                        </div>
                    </div> -->
                    <div class="admin-view__content blogers-list tab-content" id="blogers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список блогеров • 3
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="blogers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary blogers-search-btn">Найти</button>
                                </div> -->
                            </div>
                            <!-- @include('shared.admin.bloggers-list') -->
                        </div>
                    </div>
                    <div class="admin-view__content blogers-list tab-content" id="sellers-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список селлеров • 1
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div>  -->
                            </div>
                            <!-- @include('shared.admin.sellers-list') -->
                        </div>
                    </div>
                    <div class="admin-view__content projects-list tab-content" id="projects-list">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    Список проектов • 1
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Введите название">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> -->
                            </div>
                            <!-- @include('project.admin-list') -->
                        </div>
                    </div>
                    <div class="admin-view__content payment-history tab-content" id="payment-history">
                        <div class="admin-blogers__body">
                            <div class="admin-blogers__header">
                                <div class="admin-blogers__title title">
                                    История заказов • 1
                                </div>
                                <!-- <div class="admin-blogers__search form-group">
                                    <input type="name" id="sellers-search" class="input" placeholder="Поиск">
                                    <button class="btn btn-primary sellers-search-btn">Найти</button>
                                </div> -->
                            </div>
                            <div class="payment-history__body admin-view__content-wrap">
                                <div class="payment-history__items">
                                    <div class="payment-history__row">
                                        <div href="" class="payment-history__row-title">
                                            <span>Заказ № 12</span>
                                            от 21.12.02
                                        </div>
                                        <div class="payment-history__row-status">
                                            <span>Статус</span>
                                            <strong>REJECTED</strong>
                                        </div>
                                        <div class="payment-history__row-summary">
                                            <span>Сумма</span>
                                            <strong>1234 <b class="rub">₽</b></strong>
                                        </div>
                                        <div class="payment-history__row-user">
                                            <span>Пользователь</span>
                                            <strong><a href="">ID </a></strong>
                                        </div>
                                        <div class="payment-history__row-tariff">
                                            <span>Тариф</span>
                                            <strong>123 — 123</strong>
                                        </div>
                                        <div class="payment-history__row-bank_id">
                                            <span>ID оплаты</span>
                                            <strong>1111</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="notification" style="display: none;">
            <div class="notification__body">
                <div class="notification__title">Внимание!</div>
                <div class="notification__text">
                    Проект успешно создан
                </div>
            </div>
        </div>
</template>
<script>
    import { ref } from 'vue'
    import axios from 'axios'

    export default{
        setup() {
            let bloggers = [
                    {
                        id: 1,
                        name: 'Илья Софронов',
                        phone: '+7(902)122-32-90',
                        email: 'ilya.sofron@mail.ru',
                        img: 'http://tla/img/profile-icon.svg',
                        created_at: '12.08.24',
                    },
                    {
                        id: 2,
                        name: 'Алексей Андреев',
                        phone: '+7(800)555-35-35',
                        email: 'leha.gagog@mail.ru',
                        img: 'http://tla/img/profile-icon.svg',
                        created_at: '12.08.32',
                    },
                ];
            return {
                bloggers: bloggers
            }
        },
        methods: {

        }
    }
</script>
