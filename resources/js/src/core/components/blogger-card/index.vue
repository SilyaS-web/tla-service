<template>
    <div class="list-blogers__item bloger-item card">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">

                    <div class="card__img" v-bind:style="'background-image:url(' + (!image ? '/img/profile-icon.svg' : `${image}`) + ')'">
                    </div>

                    <div
                        v-if="name"
                        class="card__name">
                        <p class="card__name-name" title="">
                            {{ name }}
                        </p>
                        <p
                            class="card__name-tag"
                            title="">
                            Блогер
                        </p>
                    </div>

                    <div
                        v-if="platforms && platforms.length > 0"
                        class="card__platforms">
                        <a
                            v-for="platform in platforms"
                            v-bind:class="'card__platform ' +  (platform.title ? platform.title.toLowerCase() : '')"
                            :href="platform.link"
                            target="_blank"
                        >
                            <img v-bind:src="platform.image || ''" alt="">
                        </a>
                    </div>
                </div>

                <div
                    v-if="themes && themes.length > 0"
                    class="card__row card__tags">
                    <div
                        v-for="theme in themes"
                        class="card__tags-item">
                        <span>{{ theme.name }}</span>
                    </div>
                </div>

                <div
                    v-if="description"
                    class="card__row card__desc">
                    <p>
                        {{ description }}
                    </p>
                </div>

                <div
                    v-if="work_message"
                    class="card__row card__desc-title">
                    <p style="font-weight: 500; font-size: 18px;"> Сообщение от блогера </p>
                </div>
                <div
                    v-if="work_message"
                    class="card__row card__desc">
                    <p>{{ work_message }}</p>
                </div>
            </div>

            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Подписчики</span>
                            </div>
                            <div class="card__stats-val" v-bind:title="subscriber_quantity">
                                <span>{{ subscriber_quantity }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Охваты</span>
                            </div>
                            <div class="card__stats-val" v-bind:title="coverage">
                                <span>{{ coverage }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ER %</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ countER(subscriber_quantity, coverage) }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>CPM</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ countCPM(coverage) || '-' }}₽</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="is_achievement || (content && content.length > 0)"
                    @click="$event.target.closest('.blogger-item__achives').classList.toggle('opened')"
                    class="card__row blogger-item__achives">
                    <div class="blogger-item__achives-title">
                        Достижения
                    </div>
                    <div class="blogger-item__achives-icons">
                        <div class="card__achive" title="Проверенный блогер" v-if="is_achievement">
                            <img src="/img/achive-icon.svg" alt="">
                        </div>
                        <div class="card__achive" title="Есть контент" v-if="content && content.length > 0">
                            <img src="/img/has-content-icon.svg" alt="">
                        </div>
                    </div>
                    <div class="blogger-item__achives-items blogger-achives">
                        <div class="blogger-achives__item" title="Проверенный блогер" v-if="is_achievement">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/achive-icon.svg');">
                            </div>
                            Проверенный блогер
                        </div>
                        <div class="blogger-achives__item" title="Есть контент" v-if="content && content.length > 0">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/has-content-icon.svg');">
                            </div>
                            Есть контент
                        </div>
                    </div>
                </div>

                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
import {countER} from "../../utils/countER.js";
import {countCPM} from "../../utils/countCPM.js";

export default {
    props: {
        id: { type: Number, required: true },
        image:{ type: String, required: false },
        name: { type: String, required: true },
        platforms: { type: Array, required:false },
        themes: { type: Array, required: false },
        description:{ type: String, required: false },
        work_message: { type: String, required: false },
        content: {type: Array, required: false},
        is_achievement: {type: Boolean, required: false},
        subscriber_quantity: {type: Number, required: true},
        coverage: {type: Number, required: true},
        product_price: {type: Number, required: false}
    },
    methods:{
        countER, countCPM,
    },
}
</script>
