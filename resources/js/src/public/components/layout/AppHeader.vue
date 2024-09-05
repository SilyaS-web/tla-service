<template>
    <div class="burger-menu" v-if="user">
        <div class="burger-menu__body">
            <div class="header__col header__profile-items">
                <div class="header__row">
                    <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                        <a href="/">
                            <img
                                :src="user.image ? user.image : '/img/profile-icon.svg'"
                                alt="" class="header__profile">
                        </a>
                        <div class="header__profile-col">
                            <span class="header__profile-name">
                                {{ user.name }}
                            </span>
                            <span class="header__profile-org">
                                {{ user.organization_type || user.channel_name  }}
                            </span>
                        </div>
                        <div class="header__profile-settings">
                            <a href="/edit-profile" class="row">
                                Личные данные
                            </a>
                            <a
                                v-if="user.role == 'seller'"
                                href="/tariffs" class="row">
                                Тарифы
                            </a>
                            <a style="width:100%; text-align:left">Выход</a>
                        </div>
                    </div>
                    <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                        <div class="header__profile-notif header-notif-count" style="display: none">
                            0
                        </div>
                        <img src="/img/notif-icon.svg" alt="" class="">
                        <div class="header__notif-items notif-header">
                            <div class="notif-header__items header-notif-container">
                                @include('shared.notifications')
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    v-if="user.role == 'seller'"
                    class="header__col header__tarrif tarrif-header header__profile-item--js">
<!--                    @php($seller_tariffs = Auth()->user()->getActiveTariffs())-->
<!--                    Мои тарифы-->
<!--                    <div class="tarrif-header__items">-->
<!--                        <div class="tarrif-header__item tarrif-header__adv">-->
<!--                            {{ $seller_tariff->tariff->tariffGroup->title }} - <b><span class="counter">{{ $seller_tariff->quantity }}</span> шт.</b>-->
<!--                            <div class="tarrif-header__date">-->
<!--                                Действует до {{ date('d.m.Y', strtotime($seller_tariff->finish_date)) }}-->
<!--                            </div>-->
<!--                            <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="tarrif-header__item tarrif-header__adv">
                        Нет оплаченых тарифов
                        <a href="/tariffs" class="tarrif-header__buy">Выбрать тариф</a>
                    </div>
                </div>
            </div>
            <div class="burger-menu__nav nav-burger">
                <a href="/profile" class="nav-burger__link nav__link">
                    {{ user.role == 'seller' ? 'Дашборд' : 'Главная' }}
                </a>
                <a href="https://adswap.ru/instructions" class="nav-burger__link nav__link">Инструкции</a>
                <a href="https://adswap.ru/files" class="nav-burger__link nav__link">Файлы</a>
                <a href="https://adswap.ru/news" class="nav-burger__link nav__link">Новости</a>
            </div>
            <a href="#" class="burger-menu__close">
                <img src="/img/close-icon.svg" alt="">
            </a>

            <div class="burger-contacts">
                <div class="footer__contacts-contacts">
                    <div class="footer__contacts-item">
                        adswap.ru@ya.ru
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="header">
        <div class="header__container _container">
            <div class="header__body">
                <a href="/" class="logo header__logo-w">
                    <img src="/img/logo.svg" alt="" class="logo__logo header__logo">
                </a>
                <nav
                    v-if="user"
                    class="nav header__nav">
                    <div class="nav__items">
                        <a href="/profile" class="nav__link">
                            {{ user.role == 'seller' ? 'Дашборд' : 'Главная' }}
                        </a>
                        <a href="https://adswap.ru/instructions" class="nav__link">Инструкции</a>
                        <a href="https://adswap.ru/files" class="nav__link">Файлы</a>
                        <a href="https://adswap.ru/news" class="nav__link">Новости</a>
                    </div>
                </nav>


                <div
                    v-if="user"
                    class=" header__profile-items header__profile-items--desktop header__row">

                    <div
                        v-if="user.role == 'seller'"
                        href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">

                        Мои тарифы
                        <div class="tarrif-header__items">
<!--                            @forelse ($seller_tariffs as $seller_tariff)-->
<!--                            <div class="tarrif-header__item tarrif-header__adv">-->
<!--                                {{ $seller_tariff->tariff->tariffGroup->title }} - <b><span class="counter">{{ $seller_tariff->quantity }}</span> шт.</b>-->
<!--                                <div class="tarrif-header__date">-->
<!--                                    Действует до {{ date('d.m.Y', strtotime($seller_tariff->finish_date)) }}-->
<!--                                </div>-->
<!--                                <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>-->
<!--                            </div>-->

                            <div class="tarrif-header__item tarrif-header__adv">
                                Нет оплаченых тарифов
                                <a href="/tariffs" class="tarrif-header__buy">Выбрать тариф</a>
                            </div>
                        </div>
                    </div>

                    <a
                        v-if="user"
                        href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                        <div class="header__profile-notif header-notif-count" style="display: none">

                        </div>
                        <img src="/img/notif-icon.svg" alt="" class="">
                        <div class="header__notif-items notif-header">
                            <div class="notif-header__items header-notif-container" >
                                @include('shared.notifications')
                            </div>
                        </div>
                    </a>
                    <div
                        v-if="user"
                        href="#" class="header__profile-w header__profile-header header__profile-item--js">
                        <img
                            :src="user.image ? user.image : '/img/profile-icon.svg'"
                            alt="" class="header__profile">
                        <div class="header__profile-col">
                            <span
                                :data-user-id="user.id"
                                class="header__profile-name">
                                {{ user.name }}
                            </span>
                            <span class="header__profile-org">
                                {{ user.organization_type || user.channel_name  }}
                            </span>
                        </div>
                        <div class="header__profile-settings">
                            <a href="/profile" class="row">
                                Личные данные
                            </a>

                            <a href="/tariffs" class="row">
                                Тарифы
                            </a>

                            <a class = "row" style="width:100%; text-align:left">Выход</a>
                        </div>
                    </div>
                </div>
                <a
                    v-if="user"
                    href="#" class="header__menu burger">
                    <img src="/img/menu-icon.svg" alt="">
                </a>
            </div>
        </div>
    </header>
</template>
<script>
    export default {
        props:['user'],
        mounted(){

        }
    }
</script>
