<template>
    <div class="list-blogers__blogger seller-blogger card" data-id="{{ blogger.id }}">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img">
                        <img v-bind:src="blogger.img" alt="">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name">
                            {{ blogger.name }}
                        </p>
                        <p class="card__name-tag">
                            {{ blogger.created_at }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">
                        <div class="card__col card__stats-blogger">
                            <div class="card__stats-title">
                                <span>Телефон</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ blogger.phone }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-blogger">
                            <div class="card__stats-title">
                                <span>Почта</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ blogger.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-bloger__btns">
                    <a href="#" class="btn btn-primary btn-accept" data-id="{{ blogger.id }}">Принять</a>
                    <button class="btn btn-secondary" v-on:click="banUser" v-bind:id="blogger.id">
                        Отклонить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import axios from 'axios'

    defineProps(['blogger', 'bloggers'])

    // watch(bloggers, (bloggers, prevBloggers) => {
    //     this.$emit('updateBloggers', {
    //         bloggers: bloggers,
    //     })
    // })

    function banUser(e) {
        var el = e.currentTarget;
        var id = $(el).attr('id');

        axios({
            method: 'get',
            url: '/apist/admin/deny/' + id,
        })
        .then((response) => {
            notify('error', {
                title: 'Успешно!',
                message: 'Блогер успешно заблокирован!'
            });

            $(el).closest('.card').remove();
        })
        .catch((error) => {
            notify('error', {
                title: 'Ошибка!',
                message: 'Не удалось заблокировать пользователя!'
            });
        })
    }
</script>
