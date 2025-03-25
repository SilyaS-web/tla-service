<script>
import InputBlockComponent from "../../../../core/components/form/InputBlockComponent.vue";
import {ref} from "vue";
import SelectBlockComponent from "../../../../core/components/form/SelectBlockComponent.vue";

export default {
    name: "DocumentsComponent",
    components: {SelectBlockComponent, InputBlockComponent},
    data(){
        return {
            data: ref({
                fio:'',
                sex:null,
                birthDate:null,

                passport:'',
                issueDate:null,
                unitCode:'',
                issuedBy:'',
                region:'',
                city:'',
                index:'',
                street:'',
                house:'',
                apartment:'',

                bank:'',
                phone:'',
                email:'',
                inn:'',
            }),
            errors: ref({}),
            step: ref(1),
            stepDescription: [
                'Заполните контактную информацию',
                'Введите паспортные данные',
                'Заполните данные для выплат',
                'Заполните информацию или дождитесь автоматического получения',
                'Следуйте инструкциям',
            ]
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
                    @click="step = 1"
                    :class="[
                        'documents-content__tab',
                        (step >= 1 ? 'active' : '')
                    ]">
                    Контакты
                </a>
                <a
                    href="#"
                    @click="step = 2"
                    :class="[
                        'documents-content__tab',
                        (step >= 2 ? 'active' : '')
                    ]">
                    Паспорт
                </a>
                <a
                    href="#"
                    @click="step = 3"
                    :class="[
                        'documents-content__tab',
                        (step >= 3 ? 'active' : '')
                    ]">
                    Платежи
                </a>
                <a
                    href="#"
                    @click="step = 4"
                    :class="[
                        'documents-content__tab',
                        (step >= 4 ? 'active' : '')
                    ]">
                    Проверка ИНН
                </a>
                <a
                    href="#"
                    @click="step = 5"
                    :class="[
                        'documents-content__tab',
                        (step >= 5 ? 'active' : '')
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
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <input-block-component
                            v-model="data.fio"
                            :label="'ФИО'"
                            :inputType="'text'"
                            :inputPlaceholder="'Введите ваше ФИО'"
                            :inputClassList="[]"
                            :inputID="'profile-fio'"
                            :error="errors['fio']"
                        ></input-block-component>
                        <select-block-component
                            v-model="data.sex"
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
                            v-model="data.birthDate"
                            :label="'Дата рождения'"
                            :inputType="'date'"
                            :inputClassList="[]"
                            :inputID="'profile-birth-date'"
                            :error="errors['birthDate']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="step++"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 2"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data.passport"
                                :label="'Серия и номер паспорта'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите серию и номер вашего паспорта'"
                                :inputClassList="[]"
                                :inputID="'profile-passport'"
                                :error="errors['passport']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data.issueDate"
                                :label="'Дата выдачи'"
                                :inputType="'date'"
                                :inputClassList="[]"
                                :inputID="'profile-issue-date'"
                                :error="errors['issueDate']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data.unitCode"
                                :label="'Код подразделения'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите код подразделения указанный в вашем паспорте'"
                                :inputClassList="[]"
                                :inputID="'profile-unit-code'"
                                :error="errors['unitCode']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data.issuedBy"
                                :label="'Кем выдан'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-issued-by'"
                                :error="errors['issuedBy']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data.region"
                                :label="'Регион'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш регион'"
                                :inputClassList="[]"
                                :inputID="'profile-region'"
                                :error="errors['region']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data.city"
                                :label="'Город'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-city'"
                                :error="errors['city']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data.index"
                                :label="'Индекс'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш индекс'"
                                :inputClassList="[]"
                                :inputID="'profile-index'"
                                :error="errors['index']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data.street"
                                :label="'Улица'"
                                :inputType="'text'"
                                :inputClassList="[]"
                                :inputID="'profile-street'"
                                :error="errors['street']"
                            ></input-block-component>
                        </div>
                        <div class="documents-content__form-row">
                            <input-block-component
                                v-model="data.house"
                                :label="'Дом'"
                                :inputType="'text'"
                                :inputPlaceholder="'Введите ваш дом'"
                                :inputClassList="[]"
                                :inputID="'profile-house'"
                                :error="errors['house']"
                            ></input-block-component>
                            <input-block-component
                                v-model="data.apartment"
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
                            @click="step++"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 3"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <select-block-component
                            v-model="data.bank"
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
                            v-model="data.phone"
                            :label="'Номер телефона'"
                            :inputType="'text'"
                            :inputClassList="[]"
                            :inputID="'profile-phone'"
                            :error="errors['phone']"
                        ></input-block-component>
                        <input-block-component
                            v-model="data.email"
                            :label="'E-mail'"
                            :inputType="'email'"
                            :inputClassList="[]"
                            :inputID="'profile-email'"
                            :error="errors['email']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="step++"
                            class="btn btn-primary">Дальше</button>
                    </div>
                </div>

                <div
                    v-show="step === 4"
                    class="documents-content__form">
                    <div class="documents-content__form-body">
                        <input-block-component
                            v-model="data.inn"
                            :label="'ИНН'"
                            :inputType="'inn'"
                            :inputClassList="[]"
                            :inputID="'profile-inn'"
                            :error="errors['inn']"
                        ></input-block-component>
                    </div>
                    <div class="documents-content__form-footer">
                        <button
                            @click="step++"
                            class="btn btn-primary">Проверить данные</button>
                    </div>
                </div>

                <div
                    v-show="step === 5"
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
        cursor: pointer;
        text-decoration: none;
        color: #B3B3B3;
        border-bottom: 1px solid #B3B3B3;
        padding: 8px;
        flex: 1 1 auto;
        text-align: center;
    }
    .documents-content__tab.active{
        color:#000;
        border-bottom-color: #000;
    }
    .documents-content__description{
        color:#666666;
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
        flex: 1 1 782px;
        max-width: 782px;
    }
</style>
