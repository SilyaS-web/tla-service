<script>
import {ref} from "vue";
import axios from "axios";

import Blogger from "../../../../core/services/api/Blogger.vue";
import Loader from "../../../../core/services/AppLoader.vue";

import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";

export default {
    name: "DocumentsComponent",
    props:['blogger'],
    components: {SelectBlockComponent, InputBlockComponent},
    data(){
        return {
            data: ref([
                {
                    fio:null,
                    sex:null,
                    birthDate:null,
                },
                {
                    passport:null,
                    issueDate:null,
                    unitCode:null,
                    issuedBy:null,
                    region:null,
                    city:null,
                    index:null,
                    street:null,
                    house:null,
                    apartment:null,
                },
                {
                    bank:null,
                    phone:null,
                    email:null,
                },
                {
                    inn:null,
                },
                {}
            ]),
            errors: ref({}),
            availableStep: ref(1),
            step: ref(1),
            stepDescription: [
                'Заполните контактную информацию',
                'Введите паспортные данные',
                'Заполните данные для выплат',
                'Заполните информацию или дождитесь автоматического получения',
                'Следуйте инструкциям',
            ],

            Blogger, Loader
        }
    },
    created() {
        this.data.forEach(step => {
            for (const key in step) {
                if(this.blogger[key]) step[key] = this.blogger[key]
            }
        })
    },
    methods:{
        saveStep(){
            for (const key in this.data[this.step - 1]) {
                if(!this.data[this.step - 1][key] || this.data[this.step - 1][key].length === 0){
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Заполните все поля.'
                    })

                    return
                }
            }

            let data = {
                name: this.blogger.user.name,
                sex: this.blogger.sex,
                country_id: this.blogger.country.id,
                city: this.blogger.city,
            };

            for (const key in this.data[this.step - 1]) {
                if(this.data[this.step - 1][key]) {
                    data[key] = this.data[this.step - 1][key]
                }
            }

            this.Blogger.update(this.blogger.id, data).then(
                data => {
                    this.$emit('updateBlogger', data)
                    this.step++
                    this.availableStep = this.step;
                },
                err => {
                    this.errors = err;
                    this.Loader.loaderOff('.edit-profile');
                }
            )
        },
        checkInn(){
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;
            let dd = today.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            const formattedToday = yyyy + '-' + mm + '-' + dd;
            const inn = this.data[this.step - 1].inn;

            axios({
                url: 'https://statusnpd.nalog.ru/api/v1/tracker/taxpayer_status',
                method:'POST',
                data:{
                    requestDate: formattedToday,
                    inn: inn,
                }
            })
            .then((res) => {
                const status = res.data.status;

                if(!status){
                    let uiMessage = '';

                    switch(res.status){
                        case 422:
                            uiMessage+='Неверный формат данных';
                            break;
                        case 400:
                            uiMessage+='Ошибка парсинга данных';
                            break;
                        case 500:
                            uiMessage+='Сервер не может обработать запрос';
                            break;
                    }

                    notify('error', {
                        title: 'Внимание!',
                        message: 'Статус самозанятого не подтвержден. ' + uiMessage
                    })

                    return
                }
                console.log('Статус самозанятого успешно проверен', res)

                this.saveStep();
            })
            .catch((err) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Статус самозанятого не подтвержден. Сервер не может обработать запрос, обратитесь в поддержку'
                })

                console.log(err.data)
            })
        }
    }
}
</script>

<template>
    <div class="tab-content documents-content">
        <div class="documents-content__header">
            <div class="documents-content__tabs">
                <a
                    href="#"
                    @click.prevent="step = 1"
                    :class="[
                        'documents-content__tab',
                        (step >= 1 ? 'active' : '')
                    ]">
                    Контакты
                </a>
                <a
                    href="#"
                    @click.prevent="availableStep >= 2 && (step = 2)"
                    :class="[
                        'documents-content__tab',
                        (availableStep >= 2 ? 'active' : '')
                    ]">
                    Паспорт
                </a>
                <a
                    href="#"
                    @click.prevent="availableStep >= 3 && (step = 3)"
                    :class="[
                        'documents-content__tab',
                        (availableStep >= 3 ? 'active' : '')
                    ]">
                    Платежи
                </a>
                <a
                    href="#"
                    @click.prevent="availableStep >= 4 && (step = 4)"
                    :class="[
                        'documents-content__tab',
                        (availableStep >= 4 ? 'active' : '')
                    ]">
                    Проверка ИНН
                </a>
                <a
                    href="#"
                    @click.prevent="availableStep >= 5 && (step = 5)"
                    :class="[
                        'documents-content__tab',
                        (availableStep >= 5 ? 'active' : '')
                    ]">
                    Подтверждение партнёра
                </a>
            </div>
            <div class="documents-content__description">
                {{ stepDescription[step - 1] }}
            </div>
        </div>
        <div class="documents-content__body">
            <div class="documents-content__forms">
                <div
                    v-show="step === 1"
                    id="step-1"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <input-block-component
                            v-model="data[0].fio"
                            :label="'ФИО'"
                            :inputType="'text'"
                            :inputPlaceholder="'Введите ваше ФИО'"
                            :inputClassList="[]"
                            :inputID="'profile-fio'"
                            :error="errors['fio']"
                        ></input-block-component>
                        <select-block-component
                            v-model="data[0].sex"
                            :label="'Пол'"
                            :selectID="'profile-sex'"
                            :selectClassList="[]"
                            :optionsList="[
                            {
                                name:'Не выбрано',
                                value:null,
                            },
                            {
                                name:'Мужской',
                                value:'male',
                            },
                            {
                                name:'Женский',
                                value:'female',
                            },
                        ]"
                            :error="errors['sex']"
                        ></select-block-component>
                        <input-block-component
                            v-model="data[0].birthDate"
                            :label="'Дата рождения'"
                            :inputType="'date'"
                            :inputClassList="[]"
                            :inputID="'profile-birth-date'"
                            :error="errors['birthDate']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="saveStep()"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 2"
                    id="step-2"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data[1].passport"
                                :label="'Серия и номер паспорта'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите серию и номер вашего паспорта'"
                                :inputClassList="[]"
                                :inputID="'profile-passport'"
                                :error="errors['passport']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data[1].issueDate"
                                :label="'Дата выдачи'"
                                :inputType="'date'"
                                :inputClassList="[]"
                                :inputID="'profile-issue-date'"
                                :error="errors['issueDate']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data[1].unitCode"
                                :label="'Код подразделения'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите код подразделения указанный в вашем паспорте'"
                                :inputClassList="[]"
                                :inputID="'profile-unit-code'"
                                :error="errors['unitCode']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data[1].issuedBy"
                                :label="'Кем выдан'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-issued-by'"
                                :error="errors['issuedBy']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data[1].region"
                                :label="'Регион'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш регион'"
                                :inputClassList="[]"
                                :inputID="'profile-region'"
                                :error="errors['region']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data[1].city"
                                :label="'Город'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-city'"
                                :error="errors['city']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data[1].index"
                                :label="'Индекс'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш индекс'"
                                :inputClassList="[]"
                                :inputID="'profile-index'"
                                :error="errors['index']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data[1].street"
                                :label="'Улица'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-street'"
                                :error="errors['street']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data[1].house"
                                :label="'Дом'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш дом'"
                                :inputClassList="[]"
                                :inputID="'profile-house'"
                                :error="errors['house']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data[1].apartment"
                                :label="'Квартира'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-apartment'"
                                :error="errors['apartment']"
                            ></input-block-component>
                        </div>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="saveStep()"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 3"
                    id="step-3"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <select-block-component
                            v-model="data[2].bank"
                            :label="'Банк'"
                            :selectID="'profile-bank'"
                            :selectClassList="[]"
                            :optionsList="[
                                {
                                    name:'Сбербанк',
                                    value:'sber',
                                },
                                {
                                    name:'Т-банк',
                                    value:'t-bank',
                                },
                                {
                                    name:'Альфабанк',
                                    value:'alpha',
                                },
                                {
                                    name:'ВТБ',
                                    value:'vtb',
                                },
                            ]"
                            :error="errors['bank']"
                        ></select-block-component>
                        <input-block-component
                            v-model="data[2].phone"
                            :label="'Номер телефона'"
                            :inputType="'text'"
                            :inputClassList="[]"
                            :inputID="'profile-phone'"
                            :error="errors['phone']"
                        ></input-block-component>
                        <input-block-component
                            v-model="data[2].email"
                            :label="'E-mail'"
                            :inputType="'email'"
                            :inputClassList="[]"
                            :inputID="'profile-email'"
                            :error="errors['email']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="saveStep()"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 4"
                    id="step-4"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <input-block-component
                            v-model="data[3].inn"
                            :label="'ИНН'"
                            :inputType="'inn'"
                            :inputClassList="[]"
                            :inputID="'profile-inn'"
                            :error="errors['inn']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="checkInn()"
                            class="btn btn-primary">Проверить данные</button>
                    </div>
                </div>

                <div
                    v-show="step === 5"
                    id="step-5"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <h3 class="documents-content__form-notready">Этап в разработке</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .documents-content{
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 40px;
        max-width:985px;
    }
    .documents-content__header{
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .documents-content__tabs{
        display: flex;
    }
    .documents-content__tab{
        text-decoration: none;
        color: #B3B3B3;
        border-bottom: 1px solid #B3B3B3;
        padding: 8px;
        flex: 1 1 auto;
        text-align: center;
    }
    .documents-content__tab.active{
        cursor: pointer;
        color:#000;
        border-bottom-color: #000;
    }
    .documents-content__description{
        color:var(--primary);
        font-size: 14px;
        font-weight: 400;
    }

    .documents-content__form{
        display: flex;
        flex-direction: column;
        gap: 56px;
    }
    .documents-content__form-body{
        display: flex;
        flex-direction: column;
        max-width:501px;
    }
    .documents-content__form-row{
        display: flex;
        gap: 32px;
    }
    .documents-content__form-row > div{
        flex:1 1 50%;
    }

    .documents-content__form-notready{
        font-size: 20px;
        font-weight: 600;
        color:#000;
    }

    .documents-content__form-footer{
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .documents-content__form-footer .btn{
        flex: 1 1 501px;
        max-width: 501px;
    }
    #step-2 .documents-content__form-body{
        max-width:100%;
    }
    #step-2 .documents-content__form-footer .btn{
        flex: 1 1 100%;
        max-width: 100%;
    }
</style>
