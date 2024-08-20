<template>
        <div class="list-blogers__item seller-item card" data-id="{{ seller.id }}">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img" v-bind:style="'background-image:url(' + (!seller.user.image ? '/img/profile-icon.svg' : `/storage/profile/${seller.user.image}`) + ')'">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name">
                            {{ seller.user.name }}
                        </p>
                        <p class="card__name-tag">
                            {{ seller.is_agent ? 'Посредник' : 'Селлер'}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Телефон</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.user.phone }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Тип организации</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.organization_type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Почта</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.user.email }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ИНН</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ seller.inn }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__row" style="text-align: center; justify-content:center">
                    <a v-bind:href="'/seller/' + seller.user.id" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -20px;">Подробнее</a>
                </div>

                <div v-if="seller.user.status == -1" class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="unbanUser" v-bind:id="seller.user.id">
                        Разблокировать
                    </button>
                </div>
                <div v-else class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="banUser" v-bind:id="seller.user.id">
                        Заблокировать
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import axios from 'axios'

    export default{
        props: ['seller', 'sellers'],
        methods:{
            unbanUser(e) {
                var el = e.currentTarget;
                var id = $(el).attr('id');

                axios({
                    method: 'get',
                    url: '/api/users/' + id + '/unban/',
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Селлер успешно разблокирован!'
                    });
                    this.$emit('ban', id);
                })
            },
            banUser(e) {
                var el = e.currentTarget;
                var id = $(el).attr('id');

                axios({
                    method: 'get',
                    url: '/api/users/' + id + '/ban/',
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Селлер заблокирован!'
                    });
                    this.$emit('ban', id);
                })
            },
        }
    }
</script>
