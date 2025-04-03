<template>
    <div
        :class="'list-blogers__item bloger-item card ' + (bloggersClasses)">
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
                        <div class="blogger-achives__item" title="Проверенный блогер" v-if="is_achievement">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/achive-icon.svg');">
                            </div>
                            Проверенный блогер
                        </div>
                        <div class="blogger-achives__item" title="Есть контент" v-else-if="content && content.length > 0">
                            <div class="blogger-achives__item-icon" style="background-image: url('/img/has-content-icon.svg');">
                            </div>
                            Есть контент
                        </div>
                        <p
                            v-else
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
                                <span>{{ countCPM(coverage, product_price) || '-' }}₽</span>
                            </div>
                        </div>
                    </div>
                </div>

<!--                <div v-if="is_achievement || (content && content.length > 0)"-->
<!--                    @click="toggleAchivements($event)"-->
<!--                    class="card__row blogger-item__achives">-->
<!--                    <div class="blogger-item__achives-title">-->
<!--                        Достижения-->
<!--                    </div>-->
<!--                    <div class="blogger-item__achives-icons">-->
<!--                        <div class="card__achive" title="Проверенный блогер" v-if="is_achievement">-->
<!--                            <img src="/img/achive-icon.svg" alt="">-->
<!--                        </div>-->
<!--                        <div class="card__achive" title="Есть контент" v-if="content && content.length > 0">-->
<!--                            <img src="/img/has-content-icon.svg" alt="">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blogger-item__achives-items blogger-achives">-->
<!--                        <div class="blogger-achives__item" title="Проверенный блогер" v-if="is_achievement">-->
<!--                            <div class="blogger-achives__item-icon" style="background-image: url('/img/achive-icon.svg');">-->
<!--                            </div>-->
<!--                            Проверенный блогер-->
<!--                        </div>-->
<!--                        <div class="blogger-achives__item" title="Есть контент" v-if="content && content.length > 0">-->
<!--                            <div class="blogger-achives__item-icon" style="background-image: url('/img/has-content-icon.svg');">-->
<!--                            </div>-->
<!--                            Есть контент-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

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
        content: {type: Array, required: false, default: false},
        is_achievement: {type: Boolean, required: false, default: false},
        subscriber_quantity: {type: Number, required: true},
        coverage: {type: Number, required: true},
        product_price: {type: [Number, Boolean], required: false},
        classList: {type: Array, required: false, default: []}
    },
    computed:{
        bloggersClasses(){ return this.classList.join(' ') }
    },
    methods:{
        toggleAchivements(e){
            const parent = e.target.closest('.blogger-item__achives');
            const parentHeight = parent.getBoundingClientRect().height;
            const itemsHeight = parent.querySelector('.blogger-item__achives-items')
                .getBoundingClientRect().height;

            if(parent.classList.contains('opened')){
                parent.style.height = `${parentHeight - itemsHeight}px`
            }
            else{
                parent.style.height = `${parentHeight + itemsHeight}px`
            }

            parent.classList.toggle('opened')
        },
        countER, countCPM,
    },
}
</script>
<style scoped>
    .list-blogers__item.card {
        /* box-shadow: 0px 0px 36px 42px rgba(0, 0, 0, .02); */
        min-width: 337px;
        border: 1px solid #F5F5F5;
        /*background-color: rgba(62, 66, 77, .03);*/
        width: calc(100% / 3 - 10px);
    }
    .blogger-item__achives{
        display: flex;
        background-color: #F5FCFF;
        border-radius: 6px;
        padding: 6px 10px;
        gap: 5px;
        width: -moz-fit-content;
        width: fit-content;
        position: relative;
        transition: all .2s linear;
        height: 43.9922px;
        overflow: hidden;
        flex-wrap: wrap;
        align-items: start;
    }
    .blogger-popup__body .blogger-item__achives{
        margin-bottom: 18px;
    }
    .blogger-item__achives::after{
        content:"";
        width: 14px;
        height: 25px;
        background-image: url("/img/arrow-alt.svg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        cursor: pointer;
        transform: rotate(-90deg);
        opacity: .5;
        transition: all .2s linear;
        position: absolute;
        right: 5px;
    }
    .blogger-item__achives-title{
        font-size: 14px;
        font-weight: 400;
        color: rgba(0, 0, 0, .6);
        cursor: pointer;
        line-height: 1.81;
    }
    .blogger-item__achives-icons{
        display: flex;
        cursor:pointer;
        transition: all .2s linear;
    }
    .card__achive {
        border: 1px solid #fff;
        border-radius: 50%;
        background-color: var(--primary);
        width: 25px;
        height: 25px;
        padding: 0 !important;
        position: relative;
        z-index: 1;
        transition: all .2s linear;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card__achive:not(:first-child){
        margin-left: -8px;
    }
    .card__achive img{
        width: 17px;
    }
    .card__header-achives{
        position: absolute;
        left:-3%;
        top:-5px;
        display:flex;
    }
    .blogger-item__achives-items{
        display: flex;
        gap: 6px;
        flex-direction: column;
        opacity: 0;
        transition: all .2s linear;
        width: 100%;
    }
    .blogger-achives__item{
        display: flex;
        align-items: center;
        gap: 3px;
        border-radius: 3px;
        font-size: 12px;
        color: rgba(0, 0, 0, .6);
        font-weight: 400;
        padding: 4px;
        border: 1px solid rgba(62, 66, 77, .07);
        width: 0;
        overflow: hidden;
    }
    .card__name .blogger-achives__item{
        overflow: visible;
        width: 100%;
        padding: 4px 4px 4px 0px;
        border: unset;
    }
    .blogger-achives__item-icon {
        border: 1px solid #fff;
        border-radius: 50%;
        background-color: var(--primary);
        width: 23px;
        height: 23px;
        padding: 0 !important;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 1;
        transition: all .2s linear;
        background-size: 70%;
        background-position: center;
        background-repeat: no-repeat;
    }


    .blogger-item__achives.opened:not(.single-achive){
        animation-name: bloggerAchivesOpen;
        animation-duration: .2s;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }
    .blogger-item__achives.opened::after{
        transform: rotate(0deg);
        margin-left: auto;
    }
    .blogger-item__achives.opened .blogger-item__achives-icons{
    }
    .blogger-item__achives.opened .card__achive{
        opacity: 0;
        margin-left: 0;
    }
    .blogger-item__achives.opened .blogger-item__achives-items{
        opacity: 1;
    }
    .blogger-item__achives.opened .blogger-achives__item{
        width: -moz-fit-content;
        width: fit-content;
    }

    .blogger-popup__body .blogger-item__achives{
        margin-bottom: 18px;
    }
    .blogger-popup__body .blogger-item__achives.opened{
        width: 100%!important;
        margin-left: 11%;
    }


    @keyframes bloggerAchivesOpen {
        0%{
            width: -moz-fit-content;
            width: fit-content;
            height: 43.9922px;
        }
        50%{
            width: 100%;
        }
        100% {
            width: 100%;
        }
    }
</style>
