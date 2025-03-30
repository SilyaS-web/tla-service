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
<style scoped>
.blogger-popup__body .card__img{
    cursor: pointer;
}
.user-view__container{
}
.info-profile__body{
    display: flex;
    gap: 35px;
    padding-top: 18px;
}
.info-profile__platforms-footer--mobile{
    display:none
}
.info-profile__row{
    display: flex;
    gap: 12px;
}
.info-profile__img{
    width: 100px;
    height: 100px;
    border-radius: 10px;
    overflow: hidden;
}
.info-profile__name{
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 6px;
}
.info-profile__id{
    font-size: 14px;
    color:rgba(0, 0, 0, .4)
}
.info-profile__tags{
    flex-direction: column;
}
.info-profile__tags-title{
    font-size: 18px;
    font-weight: 500;
}
.info-profile__tags-items{
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 12px;
    font-weight: 500;
}
.info-profile__tags-item{
    padding: 8px;
    background-color: var(--primary);
    color:#fff;
    font-size: 14px;
    border-radius: 5px;
    position: relative;
}
.info-profile__desc{
    font-size: 18px;
    font-weight: 400;
    max-width: 625px;
}
.user-view__projects:not(:last-child){
    margin-bottom: 35px;
}
.user-view .btn{
    text-align: center;
}
.user-view .profile-projects__title{
    font-size: 24px;
}
.user-view .profile-projects__body{
    max-width:unset
}
.info-profile__info{
    margin-bottom: 24px;
}
.info-profile__info-desc{
    margin-top: 8px;
    margin-bottom: 12px;
    font-size: 14px;
}
.blogger-platforms{
    display: flex;
    flex-direction: column;
    margin-bottom: 46px;
}
.blogger-platforms__body{
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.blogger-platforms__header{
    display: flex;
}
.blogger-platforms__btn{
    padding: 8px 16px;
    border-radius: 10px 10px 0px 0px;
    background-color: #F5FCFF;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all .2s linear;
    border: 1px solid #fff;
    border-bottom: 0;
}
.blogger-platforms__btn img{
    width: 24px;
    height: 24px;
    transition: all .2s linear;
}
.blogger-platforms__btn.active img{
    filter: brightness(0) invert(1);
}

.item-platforms{
    padding: 15px;
    background-color: var(--pale);
    border-radius: 0 10px 10px 10px;
    transition: all .2s linear;
    flex: 1 1 auto;
    max-width: 515px;
    opacity: 0;
    display: none;
    border: 1px solid unset;
    margin-left: 1px;
}

.blogger-platforms__btn--inst.active{
    background: #f09433;
    background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
}
.blogger-platforms:has(.blogger-platforms__btn--inst.active) .item-platforms.inst{
    display: block;
    opacity: 1;
    border: 1px solid #bc1888;
}
.blogger-platforms:has(.blogger-platforms__btn--inst.active) .item-platforms.inst .item-platforms__stat-value{
    color:#bc1888;
}
.blogger-platforms:has(.blogger-platforms__btn--inst.active) .item-platforms.inst .item-platforms__title{
    color:#bc1888;
}

.blogger-platforms__btn--vk.active{
    background: #5281B8;
}
.blogger-platforms__btn--vk.active img{
    filter:unset
}
.blogger-platforms:has(.blogger-platforms__btn--vk.active) .item-platforms.vk{
    display: block;
    opacity: 1;
    border: 1px solid #5281B8;
}
.blogger-platforms:has(.blogger-platforms__btn--vk.active) .item-platforms.vk .item-platforms__stat-value{
    color:#5281B8;
}
.blogger-platforms:has(.blogger-platforms__btn--vk.active) .item-platforms.vk .item-platforms__title{
    color:#5281B8;
}

.blogger-platforms__btn--yt.active{
    background: #FF0000;
}
.blogger-platforms:has(.blogger-platforms__btn--yt.active) .item-platforms.yt{
    display: block;
    opacity: 1;
    border: 1px solid #FF0000;
}
.blogger-platforms:has(.blogger-platforms__btn--yt.active) .item-platforms.yt .item-platforms__stat-value{
    color:#FF0000;
}
.blogger-platforms:has(.blogger-platforms__btn--yt.active) .item-platforms.yt .item-platforms__title{
    color:#FF0000;
}

.blogger-platforms__btn--tg.active{
    background: #1D94CF;
}
.blogger-platforms:has(.blogger-platforms__btn--tg.active) .item-platforms.tg{
    display: block;
    opacity: 1;
    border: 1px solid #1D94CF;
}
.blogger-platforms:has(.blogger-platforms__btn--tg.active) .item-platforms.tg .item-platforms__stat-value{
    color:#1D94CF;
}
.blogger-platforms:has(.blogger-platforms__btn--tg.active) .item-platforms.tg .item-platforms__title{
    color:#1D94CF;
}

.blogger-platforms__btn--dzen.active{
    background: #000;
}
.blogger-platforms:has(.blogger-platforms__btn--dzen.active) .item-platforms.dzen{
    display: block;
    opacity: 1;
    border: 1px solid #000;
}
.blogger-platforms:has(.blogger-platforms__btn--dzen.active) .item-platforms.dzen .item-platforms__stat-value{
    color:#000;
}
.blogger-platforms:has(.blogger-platforms__btn--dzen.active) .item-platforms.dzen .item-platforms__title{
    color:#000;
}

.blogger-platforms__btn--yappy.active{
    background: #00E2B8;
}
.blogger-platforms__btn--yappy.active img{
    filter:unset;
}
.blogger-platforms:has(.blogger-platforms__btn--yappy.active) .item-platforms.yappy{
    display: block;
    opacity: 1;
    border: 1px solid #00E2B8;
}
.blogger-platforms:has(.blogger-platforms__btn--yappy.active) .item-platforms.yappy .item-platforms__stat-value{
    color: #00E2B8;
}
.blogger-platforms:has(.blogger-platforms__btn--yappy.active) .item-platforms.yappy .item-platforms__title{
    color: #00E2B8;
}

.blogger-platforms__btn--rutube.active{
    background: #0B1D38;
}
.blogger-platforms__btn--rutube.active img{
    filter:unset;
}
.blogger-platforms:has(.blogger-platforms__btn--rutube.active) .item-platforms.rutube{
    display: block;
    opacity: 1;
    border: 1px solid #0B1D38;
}
.blogger-platforms:has(.blogger-platforms__btn--rutube.active) .item-platforms.rutube .item-platforms__stat-value{
    color: #0B1D38;
}
.blogger-platforms:has(.blogger-platforms__btn--rutube.active) .item-platforms.rutube .item-platforms__title{
    color: #0B1D38;
}

.blogger-platforms__btn--ok.active{
    background: #EE8208;
}
.blogger-platforms__btn--ok.active img{
    filter:unset;
}
.blogger-platforms:has(.blogger-platforms__btn--ok.active) .item-platforms.ok{
    display: block;
    opacity: 1;
    border: 1px solid #EE8208;
}
.blogger-platforms:has(.blogger-platforms__btn--ok.active) .item-platforms.ok .item-platforms__stat-value{
    color: #EE8208;
}
.blogger-platforms:has(.blogger-platforms__btn--ok.active) .item-platforms.ok .item-platforms__title{
    color: #EE8208;
}

.blogger-platforms__btn--tiktok.active{
    border: 1px solid #000;
    border-bottom: 0;
}
.blogger-platforms__btn--tiktok.active img{
    filter:unset;
}
.blogger-platforms:has(.blogger-platforms__btn--tiktok.active) .item-platforms.tiktok{
    display: block;
    opacity: 1;
    border: 1px solid #000;
}
.blogger-platforms:has(.blogger-platforms__btn--tiktok.active) .item-platforms.tiktok .item-platforms__stat-value{
    color: #000;
}
.blogger-platforms:has(.blogger-platforms__btn--tiktok.active) .item-platforms.tiktok .item-platforms__title{
    color: #000;
}

.item-platforms__title{
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    gap: 3px;
}

.item-platforms__stats{
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    flex: 1 1 auto;
    flex-direction: column;
}

.item-platforms:hover{
    box-shadow: 0px 0px 10px 6px rgba(181,76,219,.1);
}
.item-platforms__stats-row{
    display: flex;
    width: 100%;
    justify-content: space-between;
    gap: 3px;
}
.item-platforms__stats-row > *{
}
.item-platforms__stat.er{
    width: 85px;
}
.item-platforms__stat{
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.item-platforms__stat:hover{
}
.item-platforms__stat-title{
    font-size: 14px;
    color: rgba(0, 0, 0, .4);
}
.item-platforms__stat-value{
    font-weight: 700;
    color:var(--primary);
    font-size: 18px;
}
.info-profile__left{
    flex: 1 1 50%;
}
.info-profile__right{
    width: 100%;
    max-width:387px;
    position: relative;
}
.info-profile__content{
    display: flex;
    gap: 12px;
    justify-content: center;
    height: 570px;
}


.info-profile__tabs{
    display: flex;
    gap: 5px;
    margin-bottom: 12px;
}
.info-profile__tab{
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 15px;
    color:inherit;
    transition: all .2s linear;
    cursor: pointer;
    background-color: rgba(0,0,0,.05);
}
.info-profile__tab.current{
    background-color: var(--primary);
    color:#fff;
}

.info-profile__projects--empty,
.info-profile__videos--empty{
    background-color: rgba(0,0,0,.1);
    border-radius: 8px;
    height:100%;
}
.info-profile__projects--empty,
.info-profile__videos--empty{
    display: flex!important;
    justify-content: center;
    align-items: center;
    color:rgba(0,0,0,.4);
    font-size: 14px;
    font-weight: 500;
    text-align: center;
}

.info-profile__projects--empty::after{
    content:"Выполненные проекты отсутствуют"
}
.info-profile__videos--empty::after{
    content:"Контент отсутствует"
}
.info-profile__projects .owl-nav,
.info-profile__videos .owl-nav{
    top: calc(100% + 12px);
    justify-content: center;
    gap: 12px;
}
.info-profile__projects .owl-nav button,
.info-profile__videos .owl-nav button{
    font-size: 18px!important;
    width: 32px!important;
    height: 32px!important;
}
.info-profile__content-item{
    height: 570px;
}
.info-profile__content-item video{
    -o-object-fit: cover;
    object-fit: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 12px;
}
.info-profile__projects-item.project-item{
    width: 100% !important;
    padding: 5px;
}
.info-profile__projects .owl-stage{

}
.info-profile__projects .owl-item {
}
.info-profile__projects-item.project-item .project-item__img{
    padding-top: 331px;
}
</style>
