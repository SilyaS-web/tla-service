<template>
    <header class="header">
        <div class="header__container _container">
            <div class="header__body">
                <a href="/" class="logo header__logo-w">
                    <img src='/img/logo.svg' alt="" class="logo__logo header__logo">
                </a>
                <nav class="nav header__nav">
                    <div class="nav__items">
                        <a href="{{ route('profile') }}" class="nav__link">
                            @if ( auth()->user()->role == 'seller')
                                Дашборд
                            @elseif (auth()->user()->blogger)
                                Главная
                            @endif
                        </a>
                        <a href="https://adswap.ru/instructions" class="nav__link">Инструкции</a>
                        <a href="https://adswap.ru/files" class="nav__link">Файлы</a>
                        <a href="https://adswap.ru/news" class="nav__link">Новости</a>
                    </div>
                </nav>


                <div class=" header__profile-items header__profile-items--desktop header__row">
                    @if ( auth()->user()->role == 'seller')
                    <div href="#" class="header__col header__tarrif tarrif-header header__profile-item--js">
                        @php($seller_tariffs = Auth()->user()->getActiveTariffs())
                        Мои тарифы
                        <div class="tarrif-header__items">
                            @forelse ($seller_tariffs as $seller_tariff)
                            <div class="tarrif-header__item tarrif-header__adv">
                                {{ $seller_tariff->tariff->tariffGroup->title }} - <b><span class="counter">{{ $seller_tariff->quantity }}</span> шт.</b>
                                <div class="tarrif-header__date">
                                    Действует до {{ date('d.m.Y', strtotime($seller_tariff->finish_date)) }}
                                </div>
                                <a href="{{ route('tariff') }}" class="tarrif-header__buy">Продлить</a>
                            </div>
                            @empty
                            <div class="tarrif-header__item tarrif-header__adv">
                                Нет оплаченых тарифов
                                <a href="{{ route('tariff') }}" class="tarrif-header__buy">Выбрать тариф</a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @endif
                    <a href="#" class="header__col header__notif header__profile-item--js" title="Уведомления">
                        <div class="header__profile-notif header-notif-count" style="display: none">

                        </div>
                        <img src="{{ asset('img/notif-icon.svg') }}" alt="" class="">
                        <div class="header__notif-items notif-header">
                            <div class="notif-header__items header-notif-container" >
                                @include('shared.notifications')
                            </div>
                        </div>
                    </a>
                    <div href="#" class="header__profile-w header__profile-header header__profile-item--js">
                        <img src="{{ auth()->user()->getImageURL() }}" alt="" class="header__profile">
                        <div class="header__profile-col">
                                <span class="header__profile-name" data-user-id="{{ auth()->user()->id }}">
                                    {{ auth()->user()->name }}
                                </span>
                            <span class="header__profile-org">
                                    @if ( auth()->user()->role == 'seller')
                                        @if (isset(auth()->user()->seller->organization_name) && !empty(auth()->user()->seller->organization_name))
                                            {{ auth()->user()->seller->organization_type }} "{{ auth()->user()->seller->organization_name }}"
                                        @endif
                                    @elseif (auth()->user()->blogger)
                                        {{ auth()->user()->blogger->name }}
                                    @endif
                                </span>
                        </div>
                        <div class="header__profile-settings">
                            <a href="{{ route('edit-profile') }}" class="row">
                                Личные данные
                            </a>
                            @if ( auth()->user()->role == 'seller')
                            <a href="{{ route('tariff') }}" class="row">
                                Тарифы
                            </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="row">
                                @csrf
                                <button type="submit" style="width:100%; text-align:left">Выход</button>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="#" class="header__menu burger">
                    <img src="{{ asset('img/menu-icon.svg') }}" alt="">
                </a>
            </div>
        </div>
    </header>
</template>
<script>
    import User from '../services/api/User.vue'

    export default {
        data(){
            return {
                User
            }
        },
    }
</script>
