<template>
    <div class="list-blogers__item bloger-item card" data-id="{{ blogger.id }}">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img" v-bind:style="'background-image:url(' + (!blogger.user.image ? '/img/profile-icon.svg' : `/storage/profile/${blogger.user.image}`) + ')'">
                    </div>
                    <div class="card__achive" title="Проверенный блогер"> <!--добавить проверку-->
                        <img src="img/achive-icon.svg" alt="">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name" title="">
                            {{ blogger.user.name }}
                        </p>
                    </div>
                    <div class="card__platforms">
                        <div
                            v-for="platform in blogger.platforms"
                            v-bind:class="'card__platform ' +  (platform.platform.title ? platform.platform.title.toLowerCase() : '')"
                            >
                            <img v-bind:src="platform.platform.image || ''" alt="">
                        </div>
                    </div>
                </div>
                <div class="card__row card__tags">

                    <div
                        v-for="theme in blogger.themes"
                        class="card__tags-item">
                        <span>{{ theme.theme.theme }}</span>
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
                        v-bind:href="'/blogger/' + blogger.id"
                        target="_blank"
                        class=""
                        style="color:rgba(0,0,0,.4);
                        font-size:16px;
                        font-weight:500;
                        text-decoration:underline;
                        margin-top: -20px;">Подробнее</a>
                </div>
                <div v-if="blogger.user.status === 0" class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="agree">
                        Принять
                    </button>
                    <button class="btn btn-secondary" v-on:click="ban">
                        Отклонить
                    </button>
                </div>
                <div v-else-if="blogger.user.status === 1" class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="ban">
                        Заблокировать
                    </button>
                    <button class="btn btn-delete" v-on:click="deletionConfirmation">
                        Удалить
                    </button>
                </div>
                <div v-else-if="blogger.user.status === -1" class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" v-on:click="unban">
                        Разблокировать
                    </button>
                    <button class="btn btn-delete" v-on:click="deletionConfirmation">
                        Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['blogger', 'bloggers'],
        components: { },
        methods:{
            deletionConfirmation() {
                this.$emit('deletionConfirmation', this.blogger.id)
            },

            ban() {
                let id = this.blogger.id;

                this.$emit('ban', id)
            },

            agree() {
                let id = this.blogger.id;
                this.$emit('agree', 3)
            },

            unban() {
                this.$emit('unban', this.blogger.id)
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
