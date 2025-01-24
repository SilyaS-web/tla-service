<template>
    <div
        :class="'profile-projects__row profile-projects__blogers projects-blogers owl-carousel ' + (getCarouselClassString())">
        <div
            v-if="works && works.length > 0"
            v-for="work in works"
            :data-id="work.blogger.id"
            class="list-blogers__item bloger-item card">
            <div class="card__row card__content">
                <div class="card__col">
                    <div class="card__row card__header">
                        <div
                            :style="'background-image:url(' + (work.blogger.user.image || '/img/profile-icon.svg') + ')'"
                            class="card__img">
                            <div v-if="work.blogger.is_achivement" class="card__achive">
                                <img src="img/achive-icon.svg" alt="">
                            </div>
                        </div>
                        <div class="card__name">
                            <p class="card__name-name">
                                {{ work.blogger.user.name }}
                            </p>
                            <p style="font-size: 12px">
                                {{ work.blogger.country.name }}, {{ work.blogger.city }}
                            </p>
                        </div>
                        <div class="card__platforms">
                            <a
                                v-for="platform in work.blogger.platforms"
                                :href="platform.link"
                                :class="'card__platform ' + platform.title + ')'"
                                target="_blank">
                                <img :src="platform.image" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="card__row card__desc-title">
                        <p style="font-weight: 500; font-size: 18px;">
                            Сообщение от блогера
                        </p>
                    </div>
                    <div class="card__row card__desc">
                        <p>
                            {{ work.message }}
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
                                <div class="card__stats-val">
                                    <span>{{ work.blogger.summaryPlatform.subscriber_quantity }}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>Просмотры</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ work.blogger.summaryPlatform.coverage }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card__row card__stats-row">

                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>ER %</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ work.blogger.summaryPlatform.engagement_rate }}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>CPM</span>
                                </div>
                                <div class="card__stats-val">
                                    <span> {{ (project.product_price / (work.blogger.summaryPlatform.coverage == 0 ? 1 : work.blogger.summaryPlatform.coverage) * 1000).toFixed(2)  }} ₽</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card__col card__column--gender">
                        <div class="card__stats-title">
                            <span>Пол аудитории</span>
                        </div>
                        <div class="card__row" style="align-items: center; gap:5px">
                            <div class="card__diagram-icon"><img src="img/blogers-list/male-icon.svg" alt=""></div>
                            <div class="card__diagram-line">
                                <span :style="'width:' + work.blogger.gender_ratio + '%;'"></span>
                            </div>
                            <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                        </div>
                    </div>
                    <div class="card__row" style="text-align: center;">
                        <a :href="'/bloggers/' + work.blogger.id" class="" style="width: 100%; color: var(--primary); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -10px;">Подробнее</a>
                    </div>
                    <div
                        v-if="cardsType === 'leads'"
                        class="card__row bloger-item--btns" style="gap:12px; width:100%; flex-wrap: wrap; justify-content: center">
                        <button class="btn btn-primary" @click="acceptWork(work)">
                            Принять
                        </button>
                        <button class="btn btn-secondary" @click="denyWork(work)">
                            Отклонить
                        </button>
                    </div>
                    <div
                        v-if="cardsType === 'in-work'"
                        class="card__row" style="gap:12px; width:100%; flex-wrap: wrap">
                        <button
                            v-if="work.status == null"
                            class="btn btn-secondary">
                            Заявка отправлена
                        </button>
                        <button
                            v-else
                            :data-work-id="work.id"
                            @click="goToChat(work)"
                            class="btn btn-primary">
                            Перейти в диалог
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-else
            class="">Список блогеров в данный момент пуст</div>
    </div>
</template>
<script>
export default{
    props:['works', 'carouselClassList', 'cardsType'],
    data(){
        return{

        }
    },
    updated(){
        $('.owl-carousel').owlCarousel('destroy')
        $('.owl-carousel').owlCarousel({
            margin: 5,
            nav: true,
            responsive: {
                0:{
                    items: 1
                },
                1180: {
                    items:2
                }
            }
        });
    },
    methods:{
        acceptWork(work){
            this.$emit('acceptWork', work)
        },
        denyWork(work){
            this.$emit('denyWork', work)
        },
        goToChat(work){
            this.$emit('goToChat', work)
        },

        getCarouselClassString(){
            return (this.carouselClassList || []).join(' ')
        }
    }
}
</script>
