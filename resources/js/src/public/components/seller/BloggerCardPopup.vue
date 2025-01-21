<template>
    <popup-modal ref="popup">
        <div class="user-view" :id="'user-view_' + blogger.id">
            <div class="user-view__container">
                <div class="user-view__header">
                    <div class="popup__title">
                        {{ title }}
                    </div>
                    <div class="popup__subtitle">
                        {{ subtitle }}
                    </div>
                </div>
                <div class="user-view__body">
                    <div
                        :class="'info-profile__body ' + (isMoreInfoClicked ? 'show-more' : '')">
                        <div class="info-profile__left">
                            <div class="info-profile__info card__col">
                                <div class="card__row card__header">
                                    <div class="card__img" :style="'background-image: url(' + blogger.user.image + ')'"></div>
                                    <div class="card__name">
                                        <p class="card__name-name" title="">{{ blogger.user.name }}</p>
                                    </div>
                                    <div class="card__header-achives">
                                        <div class="card__achive" title="Проверенный блогер" v-if="blogger.is_achievement">
                                            <img src="img/achive-icon.svg" alt="">
                                        </div>
                                        <div class="card__achive" title="Есть контент" v-if="blogger.content && blogger.content.length > 0">
                                            <img src="img/has-content-icon.svg" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    @click="isMoreInfoClicked = !isMoreInfoClicked"
                                    class="card__row card__more">
                                    {{ (isMoreInfoClicked ? 'Скрыть' : 'Подробнее о блогере') }}
                                </div>

                                <div class="card__row card__tags">
                                    <div
                                        v-for="theme in blogger.themes"
                                        class="card__tags-item">
                                        <span>{{ theme.name }}</span>
                                    </div>
                                </div>
                                <div class="card__row card__desc">
                                    <p>{{ blogger.description }}</p>
                                </div>
                            </div>
                            <div
                                class="info-profile__platforms blogger-platforms">
                                <div
                                    v-for="platform in (getSortedPlatforms(blogger.platforms))"
                                    class="blogger-platforms__item item-platforms">
                                    <a target="_blank"
                                       :href="platform.link"
                                       :class="'item-platforms__title item-platforms__title--' + (getPlatformFieldPrefix(platform))">
                                        {{ platform.title }}
                                    </a>

                                    <div class="item-platforms__stats">
                                        <div class="item-platforms__stats-row">
                                            <div class="item-platforms__stat">
                                                <div class="item-platforms__stat-title">
                                                    Подписчики
                                                </div>
                                                <div class="item-platforms__stat-value">
                                                    {{ platform.subscriber_quantity }}
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            v-if="platform.additional_coverage"
                                            class="item-platforms__stats-row">
                                            <div class="item-platforms__stat">
                                                <div class="item-platforms__stat-title">
                                                    {{ bloggerAdditPlatformsTitles[platform.title] }}
                                                </div>
                                                <div class="item-platforms__stat-value">
                                                    {{ platform.additional_coverage }}
                                                </div>
                                            </div>
                                            <div class="item-platforms__stat er">
                                                <div class="item-platforms__stat-title">
                                                    ER %
                                                </div>
                                                <div class="item-platforms__stat-value">
                                                    {{ platform.additional_engagement_rate }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-profile__right">
                            <div class="info-profile__tabs">
                                <div
                                    @click="currentTab = 'content'"
                                    :class="'info-profile__tab ' + (currentTab === 'content' ? 'current' : '')">
                                    Контент
                                </div>
                                <div
                                    @click="currentTab = 'projects'"
                                    :class="'info-profile__tab ' + (currentTab === 'projects' ? 'current' : '')">
                                    Выполненные проекты
                                </div>
                            </div>
                            <div class="info-profile__content">
                                <ProjectsCarousel
                                    v-if="currentTab === 'projects'"
                                    :projects="bloggerWorks"
                                ></ProjectsCarousel>
                                <VideosCarousel
                                    v-if="currentTab === 'content'"
                                    :videos="bloggerContent"
                                ></VideosCarousel>
                            </div>
                            <div
                                v-if="isContentLoading"
                                class="loader-wrap">
                                <span class="loader"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </popup-modal>
</template>
<script>
    import { ref } from 'vue'
    import axios from "axios";
    import User from "../../../services/api/User";
    import PopupModal from '../../../services/AppPopup.vue';
    import VideosCarousel from './BloggerCardVideosCarousel';
    import ProjectsCarousel from './BloggerCardProjectsCarousel';
    import Loader from '../../../services/AppLoader';

    export default {
        name: 'BloggerCardPopup',
        components: { PopupModal, VideosCarousel, ProjectsCarousel },
        data(){
            return {
                title: 'Профиль блогера',
                subtitle: '',

                resolvePromise: undefined,
                rejectPromise: undefined,

                isContentLoading: ref(false),

                user: ref(null),
                blogger: ref({}),
                bloggerContent: ref([]),
                bloggerWorks: ref([]),

                currentTab: ref('content'),
                isMoreInfoClicked: ref(false),

                bloggerPlatformFields:[
                    {
                        name: 'Telegram',
                        key: 'Telegram',
                        prefix: 'tg',
                        id: 1
                    },
                    {
                        name: 'Ins',
                        key: 'Instagram',
                        prefix: 'inst',
                        id: 3
                    },
                    {
                        name: 'Ytube',
                        key: 'Youtube',
                        prefix: 'yt',
                        id: 2
                    },
                    {
                        name: 'Одноклассники',
                        key: 'OK',
                        prefix: 'ok',
                        id: 7
                    },
                    {
                        name: 'Дзен',
                        key: 'Dzen',
                        prefix: 'dzen',
                        id: 6
                    },
                    {
                        name: 'Rutube',
                        key: 'Rutube',
                        prefix: 'rutube',
                        id: 8
                    },
                    {
                        name: 'Yappy',
                        key: 'Yappy',
                        prefix: 'yappy',
                        id: 5
                    },
                    {
                        name: 'VK',
                        key: 'VK',
                        prefix: 'vk',
                        id: 123
                    },
                ],
                bloggerAdditPlatformsTitles: {
                    'Instagram': 'Просмотры reels',
                    'Youtube': 'Просмотры shorts',
                    'VK': 'Просмотры постов',
                    'default': 'Просмотры',
                },

                User, Loader
            }
        },
        mounted(){
            this.user = this.User.getCurrent();
        },
        methods: {
            show(blogger){
                this.$refs.popup.open()

                this.blogger = blogger

                this.isContentLoading = true

                axios({
                    method: 'get',
                    url: '/api/users/' + this.blogger.user.id + '/projects',
                    data: {
                        work_statuses: ['completed']
                    }
                })
                .then(result => {
                    this.bloggerWorks = (result.data.projects || []);
                    this.bloggerContent = this.blogger.content;

                    this.isContentLoading = false
                })
                .catch(error => { })

                return new Promise((resolve, reject) => {
                    this.resolvePromise = resolve
                    this.rejectPromise = reject
                })
            },

            getPlatformFieldPrefix(platform){
                let platformField = this.bloggerPlatformFields.find(item => item.key === platform.title);
                return platformField ? platformField.prefix : ''
            },

            getSortedPlatforms(platforms){
                let sortedList = platforms.sort((a, b) => {
                    if(a.additional_coverage) return 1
                    if(b.additional_coverage) return -1

                    return 0
                })

                return sortedList.filter(platform => platform.subscriber_quantity && platform.subscriber_quantity > 0)
            },

            closePopup(){
                this.$refs.popup.close()
                this.resolvePromise(false)
            },

            _confirm() {
                this.$refs.popup.close()
                this.resolvePromise(true)
            },

            _cancel() {
                this.$refs.popup.close()
                this.resolvePromise(false)
            },
        },
    }
</script>
