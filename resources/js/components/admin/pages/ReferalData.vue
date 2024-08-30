<template>
    <div class="referal admin-view__content tab-content" id = "referral">
        <div class="referal__body admin-view__content-wrap">
            <div class="referal__tabs">
                <div
                    v-bind:class="'referal__tab ' +  (currentTab == 'company' ? 'active' : '')"
                    @click="switchTab"
                    data-content="company">
                    <span>
                        Компании
                    </span>
                </div>
                <div
                    v-bind:class="'referal__tab ' +  (currentTab == 'managers' ? 'active' : '')"
                    @click="switchTab"
                    data-content="managers">
                    <span>
                        Менеджеры
                    </span>
                </div>
            </div>
            <div class="referal__content">
                <div class="referal__content-wrap" v-if="currentTab == 'company'">
                    <div class="referal__summary summary-referal">
                        <div class="summary-referal__item">
                            <span>Кол-во зарегистрированных по ссылке: <b>{{ ref_data.company.summary.total_register }}</b></span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Общее кол-во селлеров: <b>{{ ref_data.company.summary.total_sellers }}</b></span><br>
                            <span>Общее кол-во блогеров: <b>{{ ref_data.company.summary.total_bloggers }}</b></span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Общая сумма всех оплат: <b>{{ ref_data.company.summary.total_received }}</b> руб.</span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Ссылка: <a href="#" v-on:click="copyLink">https://lk.adswap.ru/reg?code=12345</a></span>
                        </div>
                    </div>
                    <div class="referal__tabs">
                        <div
                            v-bind:class="'referal__tab ' +  (currentCompanyTab == 'users' ? 'active' : '')"
                            @click="switchCompanyTab"
                            data-content="users">
                            <span>
                                Пользователи
                            </span>
                        </div>
                        <div
                            v-bind:class="'referal__tab ' +  (currentCompanyTab == 'payments' ? 'active' : '')"
                            @click="switchCompanyTab"
                            data-content="payments">
                            <span>
                                Платежи
                            </span>
                        </div>
                    </div>
                    <div class="referal__content-wrap" v-if="currentCompanyTab == 'users'" id = "users">
                        <div class="table">
                            <div class="table__head">
                                <div class="table__row">
                                    <div href="" class="table__col w75px">
                                        <span>ID</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>ФИО</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>Номер</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>Роль</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>Дата регистрации</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>Оплата тарифа</span>
                                    </div>
                                </div>
                            </div>
                            <div class="table__body">
                                <div
                                    class="table__row"
                                    v-for="user in ref_data.company.list.users"
                                    :user="user">
                                    <div href="" class="table__col w75px">
                                        <span>{{ user.id }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.name }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.phone }}</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>{{ roles[user.role] }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.created_at }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.received || '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table__btns">
                            <a
                                v-bind:href="'/api/referrals/export?id=' + ref_data.company.id || 0"
                                download=""
                                class="btn btn-primary">
                                Скачать таблицу
                            </a>
                        </div>

                    </div>
                    <div class="referal__content-wrap" v-if="currentCompanyTab == 'payments'" id = "payments">
                        <div class="table">
                            <div class="table__head">
                                <div class="table__row">
                                    <div href="" class="table__col w75px">
                                        <span>ID</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>ID платежа</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>Дата регистрации</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>Сумма</span>
                                    </div>
                                </div>
                            </div>
                            <div class="table__body">
                                <div
                                    class="table__row"
                                    v-for="payment in ref_data.company.list.payments"
                                    :payment="payment">
                                    <div href="" class="table__col w75px">
                                        <span>{{ payment.id }}</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>{{ payment.payment_id }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ payment.created_at }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ payment.received }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table__btns">
                            <a
                                v-bind:href="'/api/referrals/export?payments=1&id=' + ref_data.company.id || 0"
                                download=""
                                class="btn btn-primary">
                                Скачать таблицу
                            </a>
                        </div>

                    </div>
                </div>
                <div class="referal__content-wrap" v-if="currentTab == 'managers'">
                    <div class="referal__summary summary-referal">
                        <div class="summary-referal__item">
                            <span>Кол-во зарегистрированных по ссылке: <b>{{ ref_data.managers.summary.total_register }}</b></span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Ссылка: <a href="#" v-on:click="copyLink">https://lk.adswap.ru/reg?code=54321</a></span>
                        </div>
                    </div>
                    <div class="table">
                        <div class="table__head">
                            <div class="table__row">
                                <div href="" class="table__col w75px">
                                    <span>ID</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>ФИО</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>Номер</span>
                                </div>
                                <div href="" class="table__col w150px">
                                    <span>Роль</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>Дата регистрации</span>
                                </div>
                            </div>
                        </div>
                        <div class="table__body">
                            <div class="table__body">
                                <div
                                    class="table__row"
                                    v-for="user in ref_data.managers.list.users"
                                    :user="user">
                                    <div href="" class="table__col w75px">
                                        <span>{{ user.id }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.name }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.phone }}</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>{{ roles[user.role] }}</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>{{ user.created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table__btns">
                        <a
                            v-bind:href="'/api/referrals/export?id=' + ref_data.managers.id || 0"
                            download=""
                            class="btn btn-primary">
                            Скачать таблицу
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {ref, reactive} from 'vue'

    export default{
        props: ['ref_data'],
        data(){
            return {
                roles: {
                    'seller': 'Селлер',
                    'blogger': 'Блогер',
                },
                currentTab: ref('company'),
                currentCompanyTab: ref('users')
            }
        },
        methods:{
            switchTab(event){
                this.currentTab = $(event.currentTarget).data('content')
            },
            switchCompanyTab(event){
                this.currentCompanyTab = $(event.currentTarget).data('content')
            },
            async copyLink(event){
                event.preventDefault();

                if(navigator.clipboard != undefined){
                    navigator.clipboard.writeText($(event.currentTarget).text()).then(function() {
                        notify('info', {
                            title: 'Успешно!',
                            message: 'Ссылка скопирована в буфер обмена'
                        })
                    });
                }
            }
        }
    }
</script>
