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
                            {{ seller.agent ? 'Посредник' : 'Селлер'}}
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
                                <span>{{ seller.user.name }}</span>
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
                    <a v-bind:href="'/seller/' + seller.id" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -20px;">Подробнее</a>
                </div>
                <div class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="banUser" v-bind:id="seller.id">
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
            banUser(e) {
                var el = e.currentTarget;
                var id = $(el).attr('id');

                $(el).closest('.card').remove();
                this.$emit('ban', id);

                // axios({
                //     method: 'get',
                //     url: '/api/sellers/' + id + '/deny/',
                // })
                // .then((response) => {
                //     switch (response.data){
                //         case 'success':
                //             notify('info', {
                //                 title: 'Успешно!',
                //                 message: 'Селлер успешно заблокирован!'
                //             });

                //             $(el).closest('.card').remove();
                //             this.$emit('ban', id);
                //             break
                //         default:
                //             notify('erroe', {
                //                 title: 'Ошибка!',
                //                 message: 'Не удалось заблокировать селлера, попробуйте позже!'
                //             });
                //     }
                // })
            },
        }
    }
</script>
