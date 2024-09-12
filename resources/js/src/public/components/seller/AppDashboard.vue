<template>
    <div class="dashboard tab-content active" v-if="dashboard" id="dashboard">
        <div class="dashboard__body">
            <div class="dashboard__title title">
                Статистика
            </div>

            <div class="dashboard__items">
                <div class="dashboard__content active" id="wb">
                    <div
                        :style="!dashboard.is_wb_api_key ? 'padding: 0;' : ''"
                        class="dashboard__row dashboard__item--feedback feedback-dashboard">
                    <div
                        v-if="!dashboard.is_wb_api_key"
                        class="dashboard__placeholder" style="z-index: 9998">
                        <div class="dashboard__placeholder-text">
                            <router-link :to="{path: '/seller/edit-profile' }">Введите API ключ</router-link> в настройках профиля
                        </div>
                        <div class="dashboard__placeholder-overflow">

                        </div>
                    </div>

                    <div class="dashboard__col dashboard__item--sm dashboard-sm">
                        <div class="dashboard-sm__title">
                            Рейтинг на основе отзывов
                            <!--                                                <div class="dashboard__tabs">-->
                            <!--                                                    <div class="dashboard__tab active" data-content="wb">-->
                            <!--                                                        Wildberries-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="dashboard__tab disabled" data-content="ozon">-->
                            <!--                                                        OZON-->
                            <!--                                                    </div>-->
                            <!--                                                </div>-->
                        </div>

                        <div class="dashboard-sm__sm" id=wrapper>
                            <input
                                :value="dashboard.total_feedbacks_count"
                                id="wb_total" hidden>
                            <input
                                :value="dashboard.products_bad_feedbacks && dashboard.products_bad_feedbacks.length"
                                id="wb_low" hidden>
                            <input
                                :value="dashboard.products_good_feedbacks && dashboard.products_good_feedbacks.length"
                                id="wb_mid" hidden>
                            <input
                                :value="dashboard.products_great_feedbacks && dashboard.products_great_feedbacks.length"
                                id="wb_hig" hidden>
                            <input
                                :value="dashboard.avg_feedbacks_value"
                                id="wb_avg" hidden>
                            <svg id="meter">
                                <circle id="outline_curves" class="circle outline" cx="50%" cy="50%">
                                </circle>
                                <circle id="low" class="circle range" cx="50%" cy="50%" stroke="#FD6567">
                                </circle>
                                <circle id="avg" class="circle range" cx="50%" cy="50%" stroke="#F0C457">
                                </circle>
                                <circle id="high" class="circle range" cx="50%" cy="50%" stroke="#5CAD9A">
                                </circle>
                                <circle id="outline_ends" class="circle outline" cx="50%" cy="50%">
                                </circle>
                            </svg>
                            <div class="dashboard-sm__digits">
                                <div class="dashboard-sm__low">
                                    0
                                </div>
                                <div class="dashboard-sm__high">
                                    5
                                </div>
                            </div>
                            <img id="meter_needle" src="libs/meter/svg-meter-gauge-needle.svg" alt="">
                        </div>
                        <div class="dashboard-sm__desc">
                            Ваш средний балл по отзывам {{ dashboard.avg_feedbacks_value && dashboard.avg_feedbacks_value.toFixed(1) }}
                            <div class="dashboard-sm__quest">
                                ?
                                <div class="dashboard-sm__desc-inner">
                                    <p>4,8 - 5 — У вас отличные показатели, но можно улучшить</p>
                                    <p>4,5 - 4,7 — У вас показатели ниже среднего, требуется улучшить отзывы</p>
                                    <p>0 - 4,4 — Cрочно требуется работа по отзывам </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__col feedback-dashboard__fb">
                        <div class="feedback-dashboard__fb-title">
                            Отзывов без ответа — {{ dashboard.unanswered_feedbacks_count }}
                        </div>
                        <div class="feedback-dashboard__fb-items">
                            <div class="feedback-dashboard__fb-row feedback-item">
                                <div class="feedback-item__title">
                                    Статистика оценок по товарам
                                    <div class="feedback-item__quest">
                                        ?
                                        <div class="feedback-item__quest-desc">
                                            <p>Ваша оценка зависит от качества ваших отзывов, от количества плохих и хороших оценок, важно следить, чтобы количество плохих отзывов не становилось больше</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="feedback-item__stats">
                                    <div @click="toggleArticles" class="feedback-item__stat">
                                        <div class="feedback-item__stats-row">
                                            <div class="feedback-item__stat-quest danger">
                                                !
                                            </div>
                                            У вас {{ dashboard.products_bad_feedbacks && dashboard.products_bad_feedbacks.length }} товар(ов) с очень низкой оценкой

                                            <div class="feedback-item__stat-arrow">
                                                <img src="img/arrow-alt.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="feedback-item__stats-row">
                                            <div class="feedback-item__stat-products">
                                                <div class="" style="background-color: #fff">
                                                    <a
                                                        v-for="product_nm in dashboard.products_bad_feedbacks"
                                                        :href="'https://www.wildberries.ru/catalog/' + product_nm + '/detail.aspx'"
                                                        target="_blank" class="profile-projects__status">
                                                        Арт: {{ product_nm }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div @click="toggleArticles" class="feedback-item__stat">
                                        <div class="feedback-item__stats-row">
                                            <div class="feedback-item__stat-quest warning">
                                                !
                                            </div>
                                            У вас {{ dashboard.products_good_feedbacks && dashboard.products_good_feedbacks.length }} товаров с удовлетворительной оценкой, требуется улучшение

                                            <div class="feedback-item__stat-arrow">
                                                <img src="img/arrow-alt.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="feedback-item__stats-row">
                                            <div class="feedback-item__stat-products">
                                                <div class="" style="background-color: #fff">
                                                    <a
                                                        v-for="product_nm in dashboard.products_good_feedbacks"
                                                        :href="'https://www.wildberries.ru/catalog/' + product_nm + '/detail.aspx'"
                                                        target="_blank" class="profile-projects__status">
                                                        Арт: {{ product_nm }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-dashboard__fb-row">
                                <div class="feedback-dashboard__fb-row feedback-item">
                                    <div class="feedback-item__title">
                                        Статистика количества отзывов на товарах
                                        <div class="feedback-item__quest">
                                            ?
                                            <div class="feedback-item__quest-desc">
                                                <p>Для улучшения вашей оценки необходимо работать надо отзывами на маркетплейсах, очень важно следить за количеством отзывов и их обработкой</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feedback-item__stats">
                                        <div @click="toggleArticles" class="feedback-item__stat">
                                            <div class="feedback-item__stats-row">
                                                <div class="feedback-item__stat-quest danger">
                                                    !
                                                </div>
                                                На {{ dashboard.products_few_feedbacks_count && dashboard.products_few_feedbacks_count.length }} товаре(ах) очень мало отзывов, требуется исправить
                                                <div class="feedback-item__stat-arrow">
                                                    <img src="img/arrow-alt.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="feedback-item__stats-row">
                                                <div class="feedback-item__stat-products">
                                                    <div class="" style="background-color: #fff">
                                                        <a
                                                            v-for="product_nm in dashboard.products_few_feedbacks_count"
                                                            :href="'https://www.wildberries.ru/catalog/' + product_nm + '/detail.aspx'"
                                                            target="_blank" class="profile-projects__status">
                                                            Арт: {{ product_nm }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div @click="toggleArticles"  class="feedback-item__stat">
                                            <div class="feedback-item__stats-row">
                                                <div class="feedback-item__stat-quest warning">
                                                    !
                                                </div>
                                                У вас {{ dashboard.products_normal_feedbacks_count && dashboard.products_normal_feedbacks_count.length }} товар(ов) со средним количеством отзывов, требуется улучшение
                                                <div class="feedback-item__stat-arrow">
                                                    <img src="img/arrow-alt.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="feedback-item__stats-row">
                                                <div class="feedback-item__stat-products">
                                                    <div class="" style="background-color: #fff">
                                                        <a
                                                            v-for="product_nm in dashboard.products_normal_feedbacks_count"
                                                            :href="'https://www.wildberries.ru/catalog/' + product_nm + '/detail.aspx'"
                                                            @click="toggleArticules"
                                                            target="_blank" class="profile-projects__status">
                                                            Арт: {{ product_nm }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__item dashboard__item--cover">
                        <div class="dashboard__item-cover" :style="(dashboard.total_clicks < 10) ? 'text-align:center' : ''">
                            <div class="dashboard__item-title">
                                Переходы по интеграциям
                            </div>
                                <canvas
                                    v-if="dashboard.total_clicks > 10"
                                    class="graph" id="coverage-graph">
                                </canvas>
                            <span v-else>Недостаточно данных для отображения статистики</span>
                        </div>
                        <div class="dashboard__placeholder" style="z-index: 1; top:0; left:0;">
                            <div class="dashboard__placeholder-text">
                                Переверните экран, чтобы посмотреть статистику
                            </div>
                            <div class="dashboard__placeholder-overflow">

                            </div>
                        </div>
                    </div>
                    <div class="dashboard__col dashboard__item funnel-statistics" :style="(dashboard.total_clicks < 10) ? 'text-align:center' : ''">
                        <div class="dashboard__item-cover" :style="(dashboard.total_clicks < 10) ? 'justify-content:center' : ''">
                            <div
                                class="dashboard__item-title" >
                                Поĸазатели эффеĸтивности за 30 дней
                            </div>
                            <canvas
                                v-if="dashboard.total_clicks > 10"
                                id="funnel-graph"
                            ></canvas>
                            <span v-if="dashboard.total_clicks <= 10">
                                Недостаточно данных для отображения статистики
                            </span>
                        </div>
                    </div>
                </div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__item">
                        <img src="img/statistics-ph.png" alt="" class="">
                        <div class="dashboard__placeholder">
                            <div class="dashboard__placeholder-text">
                                Раздел статистики Вконтакте находится в разработке
                            </div>
                            <div class="dashboard__placeholder-overflow">

                            </div>
                        </div>
                    </div>
                    <div class="dashboard__col dashboard__item">
                        <img src="img/1_GZq1SvhxjrbQbqkag4XH3w.jpg" alt="" class="">
                        <div class="dashboard__placeholder">
                            <div class="dashboard__placeholder-text">
                                Раздел статистики Telegram находится в разработке
                            </div>
                            <div class="dashboard__placeholder-overflow">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
    import { ref } from 'vue'
    import { axios } from 'axios'

    import User from '../../../services/api/User.vue'
    import Loader from "../../../services/AppLoader"
    import Meter from "../../services/AppMeter";

    export default {
        props: ['dashboard'],
        data(){
            return {
                User, Loader, Meter
            }
        },
        updated(){
            if(this.dashboard && this.dashboard.total_clicks && this.dashboard.total_clicks > 10){
                var coverageGraph = document.getElementById("coverage-graph"),
                    data = this.dashboard.statistics;

                var month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

                var coverage_stats = new Chart(coverageGraph, {
                    type: 'scatter',
                    data: {
                        labels: data.map(item => `${item.dt.split("-")[2]} ${month[Number(item.dt.split("-")[1]) - 1]}`),
                        datasets: [
                            {
                                label: "Переходы",
                                data: data.map(item => item.coverage),
                                backgroundColor: data.map(() => {
                                    return "rgb(152,203,237, 1)"
                                }),
                                order:0,
                                type: "bar",
                            },
                            {
                                label: "Блоггеров завершило работу",
                                data: data.map(item => item.bloggers),
                                type: "bar",
                                backgroundColor: data.map(() => {
                                    return "rgb(254,94,0, 0.4)"
                                }),
                                order: 1,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        onResize: (chart, size) => {
                            var media = window.matchMedia('(max-width: 500px)');
                            if(media.matches){
                                chart.height = 200;
                            }
                        },
                        plugins: {
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            },
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                type: 'logarithmic',
                                ticks: {
                                    callback: (tick, index, array)=> {
                                        var newTick = '';

                                        if(Math.trunc(tick) === tick){
                                            newTick = tick
                                        }

                                        return tick === 0 ? 0 : newTick;
                                    }
                                },
                            }
                        }
                    }
                });

                var config = {
                    type: "funnel",
                    data: {
                        datasets: [{
                            data: [30, 60, 90],
                            backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ],
                            hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56"
                            ]
                        }],
                        labels: [
                            "Red",
                            "Blue",
                            "Yellow"
                        ]
                    }
                }

                var funnelChart = FunnelChart("funnel-graph", {
                    values: [
                        this.dashboard.total_clicks ,
                        Math.ceil(this.dashboard.er || 1 ).toFixed(2),
                        Math.ceil(this.dashboard.cpc || 1 ).toFixed(2),
                    ],
                    sectionColor: ["#98CBED", "#F0C457", "#FD6567"],
                    displayPercentageChange: false,
                    pSectionHeightPercent: 100,
                    font: "Inter, sans-serif",
                    labelWidthPercent: 30,
                    labelFontColor: "#000",
                    labels: [
                        "Переходы",
                        "ER, %",
                        "CPC, Руб.",
                    ],
                    maxFontSize: 18,
                });
            }

            this.Meter.init(this.dashboard && this.dashboard.feedback_ratio || 0);
        },
        methods:{
            toggleArticles(event){
                $(event.currentTarget).toggleClass('active')
            }
        }
    }
</script>
