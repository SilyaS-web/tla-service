<template>
    <div :class="'popup__form-row popup__form-stat form-stat ' + (isPlatformFilled() ? 'fill ' : ' ') + (isPlatformFieldActive ? 'active' : '')">
        <div class="form-stat__title" v-on:click="isPlatformFieldActive = !isPlatformFieldActive">
            {{ platform.name }}
        </div>
        <div
            class="form-stat__content">
            <div class="form-stat__row">
                <div class="form-group" style="width:100%; max-width:100%">
                    <label v-bind:for="platform.prefix + '_link'">Ссылка</label>
                    <input
                        v-bind:id="platform.prefix + '_link'"
                        v-model="platform.blogger_platform.link"
                        type="text"
                        class="input"
                        name=""
                        style="width:100%; max-width:100%"
                    >
                </div>
            </div>
            <div class="form-stat__row">
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_subs'">Подписчики</label>
                    <input
                        v-bind:id="platform.prefix + '_subs'"
                        v-model="platform.blogger_platform.subscriber_quantity"
                        type="text"
                        class="input"
                        name="">
                </div>
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_cpm'">CPM</label>
                    <input
                        v-bind:id="platform.prefix + '_cpm'"
                        v-model="platform.blogger_platform.cost_per_mille"
                        type="text"
                        class="input"
                        name="">
                </div>
            </div>
            <div class="form-stat__row">
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_cover'">{{ (platformAdditFields[platform.key] && platformAdditFields[platform.key].coverage) || 'Просмотры' }}</label>
                    <input
                        v-bind:id="platform.prefix + '_cover'"
                        v-model="platform.blogger_platform.coverage"
                        v-on:input="calculateER"
                        type="text"
                        class="input"
                        name="">
                </div>
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_er'">ER %</label>
                    <input
                        v-bind:id="platform.prefix + '_er'"
                        v-model="platform.blogger_platform.engagement_rate"
                        type="text"
                        class="input"
                        name="">
                </div>
            </div>

            <div v-if="platformAdditFields[platform.key] && platformAdditFields[platform.key].additional_coverage" class="form-stat__row">
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_additional_cover'">{{ platformAdditFields[platform.key].additional_coverage }}</label>
                    <input
                        v-bind:id="platform.prefix + '_additional_cover'"
                        v-model="platform.blogger_platform.additional_coverage"
                        v-on:input="calculateAdditER"
                        type="text"
                        class="input"
                        name="">
                </div>
                <div class="form-group">
                    <label v-bind:for="platform.prefix + '_additional_er'">ER %</label>
                    <input
                        v-bind:id="platform.prefix + '_additional_er'"
                        v-model="platform.blogger_platform.additional_engagement_rate"
                        type="text"
                        class="input"
                        name="">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue'

    export default{
        props: ['platformAdditFields', 'platform'],
        data(){
            return{
                isPlatformFieldActive: ref(false)
            }
        },
        methods: {
            calculateER(){
                var subs = this.platform.blogger_platform.subscriber_quantity,
                    cover =  this.platform.blogger_platform.coverage,
                    val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                this.platform.blogger_platform.engagement_rate = (Math.round(val * 100) / 100).toFixed(2);
            },
            calculateAdditER(){
                var subs = this.platform.blogger_platform.subscriber_quantity,
                    cover =  this.platform.blogger_platform.additional_coverage,
                    val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                this.platform.blogger_platform.additional_engagement_rate = (Math.round(val * 100) / 100).toFixed(2);
            },

            isPlatformFilled(){
                return this.platform.blogger_platform && this.platform.blogger_platform.link
            }
        }
    }
</script>
<style scoped>
    .form-stat{
        padding: 15px;
        border: 1px solid rgba(0, 0, 0, .05);
        border-radius: 10px;
        margin-bottom: 15px;
    }
    .form-stat__title{
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
    }
    .form-stat__title::after{
        content:"";
        width: 18px; height: 18px;
        background-image: url(/images/arrow-alt.svg?be58a60f09e579d727825ab3744892e9);
        background-position: center;
        background-size: contain;
        transition: transform .1s linear;
    }
    .form-stat__row{
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0 10px;
    }
    .form-stat__row>.form-group{
        width:calc(50% - 4px);
    }
    .form-stat__row label{
        font-size: 14px;
    }
    .form-stat__content{
        height: 0;
        overflow: hidden;
    }
    .form-stat.active .form-stat__content{
        height: 100% !important;
    }
    .form-stat.active .form-stat__title{
        margin-bottom: 20px;
    }
    .form-stat.active .form-stat__title::after{
        transform: rotate(180deg);
    }
</style>
