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
                <div class="user-view__body blogger-popup__body">
                    <div
                        :class="'info-profile__body '">
                        <div class="info-profile__left">
                            <div class="info-profile__info card__col">
                                <div class="card__row card__header">
                                    <div
                                        @click="openImage(blogger.user.image)"
                                        class="card__img" :style="'background-image: url(' + blogger.user.image + ')'"></div>
                                    <div class="card__name">
                                        <p class="card__name-name" title="">{{ blogger.user.name }}</p>
                                        <p class="card__name-tag" title="">Блогер</p>
                                    </div>
                                </div>

                                <p class="info-profile__info-desc">{{ blogger.description }}</p>

                                <div class="card__row card__tags">
                                    <div
                                        v-for="theme in blogger.themes"
                                        class="card__tags-item">
                                        <span>{{ theme.name }}</span>
                                    </div>
                                </div>

                                <div class="card__row card__tags card__tags--achives">
                                    <div
                                        v-if="blogger.content && blogger.content.length > 0"
                                        class="card__tags-item">
                                        <div class="card__tags-icon" style="background-image: url('/img/has-content-icon.svg');">
                                        </div>
                                        <span>Есть контент</span>
                                    </div>
                                    <div
                                        v-if="blogger.is_achievement"
                                        class="card__tags-item">
                                        <div
                                            class="card__tags-icon" style="background-image: url('/img/documents-ok-icon.svg');">
                                        </div>
                                        <span>Документы проверены</span>
                                    </div>
<!--                                    <div class="card__tags-item">-->
<!--                                        <div class="card__tags-icon" style="background-image: url('/img/star-icon-alt.svg');">-->
<!--                                        </div>-->
<!--                                        <span>Платформа рекомендует</span>-->
<!--                                    </div>-->
                                </div>
                            </div>
                            <div class="info-profile__platforms blogger-platforms">
                                <div class="blogger-platforms__header">
                                    <div
                                        v-for="platform in blogger.platforms"
                                        :class="'blogger-platforms__btn ' + (platform.title === currentPlatform ? 'active ' : '') + ('blogger-platforms__btn--' + getPlatformFieldPrefix(platform))"
                                        @click="currentPlatform = platform.title">
                                        <img
                                            :src="'/' + platform.image" alt="">
                                    </div>
                                </div>
                                <div class="blogger-platforms__body">
                                    <div
                                        v-for="platform in blogger.platforms"
                                        :class="'blogger-platforms__item item-platforms ' + (getPlatformFieldPrefix(platform))">
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
                                                v-if="platform.coverage"
                                                class="item-platforms__stats-row">
                                                <div class="item-platforms__stat">
                                                    <div class="item-platforms__stat-title">
                                                        {{ bloggerPlatformsTitles[platform.title] ? bloggerPlatformsTitles[platform.title] : bloggerPlatformsTitles['default'] }}
                                                    </div>
                                                    <div class="item-platforms__stat-value">
                                                        {{ platform.coverage }}
                                                    </div>
                                                </div>
                                                <div class="item-platforms__stat er">
                                                    <div class="item-platforms__stat-title">
                                                        ER, %
                                                    </div>
                                                    <div class="item-platforms__stat-value">
                                                        {{ platform.engagement_rate }}
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
                                                        ER, %
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

                            <div
                                v-if="user && user.role !== 'admin'"
                                @click="_confirm"
                                class="info-profile__platforms-footer">
                                <div class="info-profile__platforms-btns">
                                    <div class="btn btn-primary">
                                        Отправить заявку
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
                                    :projects="(bloggerWorks || [])"
                                ></ProjectsCarousel>
                                <VideosCarousel
                                    v-if="currentTab === 'content'"
                                    :videos="(bloggerContent || [])"
                                ></VideosCarousel>
                            </div>
                            <div
                                v-if="isContentLoading"
                                class="loader-wrap">
                                <span class="loader"></span>
                            </div>
                        </div>
                        <div
                            v-if="user && user.role !== 'admin'"
                            class="info-profile__platforms-footer info-profile__platforms-footer--mobile">
                            <div class="info-profile__platforms-btns">
                                <div
                                    @click="_confirm"
                                    class="btn btn-primary">
                                    Отправить заявку
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </popup-modal>
    <image-popup ref="imagePopup"></image-popup>
</template>
<script>
import { ref } from 'vue'
import axios from "axios";
import User from "../../../services/api/User";
import PopupModal from '../AppPopup.vue';
import VideosCarousel from './VideosCarouselComponent';
import ProjectsCarousel from './ProjectsCarouselComponent';
import ImagePopup from '../fullscreen-asset/AssetPopup.vue';
import Loader from '../../../services/AppLoader.vue';

export default {
    name: 'BloggerCardPopup',
    components: { PopupModal, VideosCarousel, ProjectsCarousel, ImagePopup },
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

            currentPlatform: ref('Instagram'),

            currentTab: ref('content'),

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
                    id: 4
                },
                {
                    name: 'Tiktok',
                    key: 'Tiktok',
                    prefix: 'tiktok',
                    id: 9
                },
            ],
            bloggerPlatformsTitles: {
                'Instagram': 'Просмотры reels',
                'Youtube': 'Просмотры выпусков',
                'VK': 'Просмотры постов',
                'default': 'Просмотры',
            },
            bloggerAdditPlatformsTitles: {
                'Youtube': 'Просмотры shorts',
                'VK': 'Просмотры клипов',
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
            this.currentPlatform = blogger.platforms[0].title
            this.isContentLoading = true

            axios({
                method: 'get',
                url: '/api/users/' + this.blogger.user.id + '/projects?work_statuses[]=completed',
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

        openImage(src){
            if(src)
                this.$refs.imagePopup.show({imageUrl: src})
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
