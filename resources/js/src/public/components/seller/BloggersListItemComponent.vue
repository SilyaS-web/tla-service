<template>
    <div
        :data-id="blogger.id"
        class="list-blogers__item bloger-item card">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img" v-bind:style="'background-image:url(' + (!blogger.user.image ? '/img/profile-icon.svg' : `${blogger.user.image}`) + ')'">
                    </div>
                    <div class="card__achive" title="Проверенный блогер" v-if="blogger.is_achievement">
                        <img src="img/achive-icon.svg" alt="">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name" title="">
                            {{ blogger.user.name }}
                        </p>
                    </div>
                    <div class="card__platforms">
                        <a
                            v-for="platform in blogger.platforms"
                            v-bind:class="'card__platform ' +  (platform.title ? platform.title.toLowerCase() : '')"
                            :href="platform.link"
                            target="_blank"
                        >
                            <img v-bind:src="platform.image || ''" alt="">
                        </a>
                    </div>
                </div>
                <div class="card__row card__tags">

                    <div
                        v-for="theme in blogger.themes"
                        class="card__tags-item">
                        <span>{{ theme.name }}</span>
                    </div>
                </div>
                <div class="card__row card__desc">
                    <p>
                        {{ blogger.description }}
                    </p>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Подписчики</span>
                            </div>
                            <div class="card__stats-val" v-bind:title="blogger.summaryPlatform.subscriber_quantity">
                                <span>{{ blogger.summaryPlatform.subscriber_quantity }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Охваты</span>
                            </div>
                            <div class="card__stats-val" v-bind:title="blogger.summaryPlatform.coverage">
                                <span>{{ blogger.summaryPlatform.coverage }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ER %</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ countER(blogger.summaryPlatform.subscriber_quantity, blogger.summaryPlatform.coverage) }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>CPM</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ blogger.summaryPlatform.cost_per_mille || '-' }}₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__col card__column--gender">
                    <div class="card__stats-title">
                        <span>Пол аудитории</span>
                    </div>
                    <div class="card__row" style="align-items: center; gap:5px">
                        <div class="card__diagram-icon"><img src='admin/img/blogers-list/male-icon.svg' alt=""></div>
                        <div class="card__diagram-line"><span v-bind:style="'width:' + blogger.gender_ratio + '%'"></span></div>
                        <div class="card__diagram-icon"><img src="admin/img/blogers-list/female-icon.svg" alt=""></div>
                    </div>
                </div>
                <div class="card__row" style="text-align: center; justify-content:center">
                    <a
                        v-bind:href="'/bloggers/' + blogger.id"
                        target="_blank"
                        class=""
                        style="color:rgba(0,0,0,.4);
                        font-size:16px;
                        font-weight:500;
                        text-decoration:underline;
                        margin-top: -20px;">Подробнее</a>
                </div>
                <div class="card__row card__row" style="flex-direction: column; gap: 5px">
                    <button
                        v-if="!isOfferSent"
                        @click="sendOfferToBlogger"
                        class="btn btn-primary">
                        Отправить заявку
                    </button>
                    <button
                        v-else
                        class="btn btn-secondary">
                        Заявка отправлена
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref, toRaw} from "vue";
import axios from "axios";

    export default{
        props:['blogger', 'currentProject'],
        data(){
            return{
                themes: ref([]),
                platforms: ref([]),
                isOfferSent: ref(false),
            }
        },
        methods:{
            sendOfferToBlogger(){
                if(!this.currentProject){
                    notify('info', {
                        title: 'Внимание!',
                        message: 'Сначала выберите проект.'
                    })
                    return
                }

                axios({
                    url: 'api/works',
                    method: 'post',
                    data: {
                        blogger_id: this.blogger.id,
                        project_work_id: this.currentProject.choosedWork.id
                    }
                })
                .then((data) => {
                    this.isOfferSent = true
                })
                .catch(errors => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Что-то пошло не так. Попробуйте позже.'
                    })
                })
            },
            countER(subs, cover){
                var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                if(val - 1 < 0) val = Math.round(val).toFixed(2);
                else val = Math.ceil(val);

                return val;
            }
        }
    }
</script>
