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
                            <span>Кол-во зарегистрированных по ссылке: <b>5</b></span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Общее кол-во селлеров/блогеров: <b>3</b> / <b>2</b></span>
                        </div>
                        <div class="summary-referal__item">
                            <span>Общая сумма всех оплат: <b>20 000</b> руб.</span>
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
                                <div href="" class="table__col w150px">
                                    <span>Дата регистрации</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>Оплата тарифа</span>
                                </div>
                            </div>
                        </div>
                        <div class="table__body">
                            <div class="table__row">
                                <div href="" class="table__col w75px">
                                    <span>id</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>fio</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>fio</span>
                                </div>
                                <div href="" class="table__col w150px">
                                    <span>role</span>
                                </div>
                                <div href="" class="table__col w150px">
                                    <span>registration_date</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>received</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table__btns">
                        <div class="btn btn-primary">
                            Скачать таблицу
                        </div>
                        <div class="btn btn-secondary">
                            Печтать
                        </div>
                    </div>
                </div>
                <div class="referal__content-wrap" v-if="currentTab == 'managers'">
                    <div class="referal__summary summary-referal">
                        <div class="summary-referal__item">
                            <span>Кол-во зарегистрированных по ссылке: <b></b></span>
                        </div>
                    </div>
                    <div class="table">
                        <div class="table__head">
                            <div class="table__row">
                                <div href="" class="table__col w75px">
                                    <span>ID</span>
                                </div>
                                <div href="" class="table__col w300px">
                                    <span>ФИО</span>
                                </div>
                                <div href="" class="table__col w300px">
                                    <span>Номер</span>
                                </div>
                                <div href="" class="table__col w150px">
                                    <span>Роль</span>
                                </div>
                                <div href="" class="table__col w150px">
                                    <span>Дата регистрации</span>
                                </div>
                                <div href="" class="table__col w200px">
                                    <span>Оплата тарифа</span>
                                </div>
                            </div>
                        </div>
                        <div class="table__body">
                            <div class="table__body">
                                <div class="table__row">
                                    <div href="" class="table__col w75px">
                                        <span>id</span>
                                    </div>
                                    <div href="" class="table__col w300px">
                                        <span>fio</span>
                                    </div>
                                    <div href="" class="table__col w300px">
                                        <span>fio</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>role</span>
                                    </div>
                                    <div href="" class="table__col w150px">
                                        <span>registration_date</span>
                                    </div>
                                    <div href="" class="table__col w200px">
                                        <span>received</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table__btns">
                        <div class="btn btn-primary">
                            Скачать таблицу
                        </div>
                        <div class="btn btn-secondary">
                            Печтать
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {ref} from 'vue'

    export default{
        props: ['referal_data'],
        data(){
            return {
                currentTab: ref('company')
            }
        },
        mounted() {

        },
        methods:{
            switchTab(event){
                this.currentTab = $(event.currentTarget).data('content')
            }
        }
    }
</script>
