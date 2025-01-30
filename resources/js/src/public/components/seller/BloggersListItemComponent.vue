<template>
    <div
        :data-id="blogger.id"
        class="list-blogers__item bloger-item card">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img" v-bind:style="'background-image:url(' + (!blogger.user.image ? '/img/profile-icon.svg' : `${blogger.user.image}`) + ')'">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name" title="">
                            {{ blogger.user.name }}
                        </p>
                        <p
                            class="card__name-tag"
                            title="">
                            Блогер
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
                                <span>{{ countCPM(blogger.summaryPlatform.coverage) || '-' }}₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-if="blogger.is_achievement || (blogger.content && blogger.content.length > 0)"
                    @click="$event.target.closest('.blogger-item__achives').classList.toggle('opened')"
                    class="card__row blogger-item__achives">
                    <div class="blogger-item__achives-title">
                        Достижения
                    </div>
                    <div class="blogger-item__achives-icons">
                        <div class="card__achive" title="Проверенный блогер" v-if="blogger.is_achievement">
                            <img src="/img/achive-icon.svg" alt="">
                        </div>
                        <div class="card__achive" title="Есть контент" v-if="blogger.content && blogger.content.length > 0">
                            <img src="/img/has-content-icon.svg" alt="">
                        </div>
                    </div>
                    <div class="blogger-item__achives-items blogger-achives">
                        <div class="blogger-achives__item" title="Проверенный блогер" v-if="blogger.is_achievement">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/achive-icon.svg');">
                            </div>
                            Проверенный блогер
                        </div>
                        <div class="blogger-achives__item" title="Есть контент" v-if="blogger.content && blogger.content.length > 0">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/has-content-icon.svg');">
                            </div>
                            Есть контент
                        </div>
                    </div>
                </div>
                <div class="card__row card__btns">
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
                    <button
                        @click="openBloggerInfoPopup"
                        class="btn btn-secondary">
                        Подробнее
                    </button>
                </div>
            </div>
        </div>
    </div>
    <BloggerCardPopup ref="bloggerCardPopup"></BloggerCardPopup>
</template>
<script>
import {ref, toRaw} from "vue";
import axios from "axios";
import BloggerCardPopup from "./BloggerCardPopup";

    export default{
        props:['blogger', 'currentProject'],
        components: { BloggerCardPopup },
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
                    url: '/api/works',
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
            },
            countCPM(cover){
                if(!cover) return '-';

                if(!this.currentProject || !this.currentProject.product_price) return '-';

                let result = (this.currentProject.product_price / cover) * 1000;

                return Math.round(result) === 0 ? (result).toFixed(3) : Math.round(result);
            },

            openBloggerInfoPopup(){
                this.$refs.bloggerCardPopup.show(this.blogger).then(isConfirmed => {
                    if(!isConfirmed) return

                    this.sendOfferToBlogger()
                })
            }
        }
    }
</script>
