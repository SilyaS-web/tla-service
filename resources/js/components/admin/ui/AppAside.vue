<template>
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
</template>
<script>


</script>
