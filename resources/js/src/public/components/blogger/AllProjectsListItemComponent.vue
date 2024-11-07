<template>
    <div
        v-if="project"
        @click="openMoreInfo"
        class="list-projects__item project-item" :data-id="project.id">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div
                    v-for="file in project.project_files[0]"
                    class="project-item__img" :style="'background-image:url(' + file.link + ')'"></div>
            </div>
            <div class="project-item__status active">
                {{ project.status_name }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                <span class="project-item__price">{{ project.product_price }}</span>₽
            </div>
            <div class="project-item__subtitle" :title="project.product_name">
                {{ project.product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val" style="'width:' +
                    (project.works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) / project.works.map(_w => _w.quantity).reduce((a, b) => a + b, 0)) * 100 + '%'"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">{{ project.project_works.map(_w => _w.lost_quantity).reduce((a, b) => a + b, 0) }}/{{ project.project_works.map(_w => parseInt(_w.quantity)).reduce((a, b) => a + b, 0) }}</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div
                    v-if="project.feedbackWork && project.feedbackWork.quantity > 0"
                    class="card__tags-item">
                    <span>Отзыв - {{ project.feedbackWork.lost_quantity }}/{{ project.feedbackWork.quantity }}</span>
                </div>
                <div
                    v-if="project.integrationWork && project.integrationWork.quantity > 0"
                    class="card__tags-item">
                    <span>Интеграция - {{ project.integrationWork.lost_quantity }}/{{ project.integrationWork.quantity }}</span>
                </div>
            </div>
            <div class="project-item__btns">
                <button
                    v-if="!project.is_blogger_works"
                    @click="chooseWork($event, project.project_works)"
                    class="btn btn-primary" style="width:100%">Откликнуться</button>
                <button
                    v-else
                    class="btn btn-secondary" style="width:100%" disabled>Заявка отправлена</button>
            </div>
        </div>
    </div>
    <div
        v-if="projectInfo"
        id="project-item-info" class="popup">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__inner popup-project">
                    <div class="popup-project__left">
                        <div class="popup-project__carousel owl-carousel">
                            <div
                                v-for="file in projectInfo.imgs"
                                :style="'background-image:url(/' + (file.link || 'img/placeholder.webp') + ')'"
                                class="popup-project__img"></div>
                        </div>
                    </div>
                    <div class="popup-project__right">
                        <div class="popup-project__info">
                            <div class="popup-project__title">
                                {{ projectInfo.name }}
                            </div>
                            <div class="popup-project__row" style="line-height:1">
                                <div class="popup-project__mark">
                                </div>
                                <div class="popup-project__articul">
                                    <p>{{ projectInfo.articul ? 'Арт: ' + projectInfo.articul : 'Артикул отсутствует' }}</p>
                                </div>
                            </div>
                            <div class="popup-project__row popup-project__cost">
                                {{ projectInfo.price ? projectInfo.price + '₽' : '- ₽' }}
                            </div>
                            <div class="popup-project__addit characteristics">
                                <p class="popup-project__addit-title">Дополнительная информация</p>
                                <div class="characteristics__category">
                                    {{ projectInfo.contentEmptyText ? projectInfo.contentEmptyText : projectInfo.category }}
                                </div>
                                <div
                                    v-if="!projectInfo.contentEmptyText"
                                    class="characteristics-items">
                                    <div
                                        v-for="option in projectInfo.options"
                                        class="characteristics__row">
                                        <div class="characteristics__row-left">
                                            <div class="characteristics__title">
                                                {{ option.name }}
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="characteristics__row-right">
                                            <div class="characteristics__desc">
                                                {{ option.value }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="project-item__left" style="margin-bottom: 18px;">
                                <div class="line">
                                    <div
                                        :style="((projectInfo.worksInfo.lostQuantity * 100) / projectInfo.worksInfo.totalQuantity) + '%'"
                                        class="line__val"></div>
                                </div>
                                Осталось мест на интеграцию <span style="font-weight: 700;">{{ projectInfo.worksInfo.lostQuantity + '/' + projectInfo.worksInfo.totalQuantity }}</span>
                            </div>
                            <div class="project-item__btns">
                                <button
                                    v-if="!project.is_blogger_works"
                                    @click="chooseWork($event, project.project_works)"
                                    class="btn btn-primary btn-blogger-send-offer-popup">Откликнуться</button>
                                <a
                                    v-if="projectInfo.link"
                                    :href="projectInfo.link"
                                    class="btn btn-secondary btn-go-to-shop"
                                    target="_blank">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    @click="projectInfo = null"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div
        v-if="isSendOfferPopupOpen"
        class="popup" id="blogger-send-offer" style="">
        <div class="popup__container _container">
            <div class="popup__body">
                <div class="popup__header">
                    <div class="popup__title title">
                        Заполните данные
                    </div>
                    <div class="popup__subtitle">

                    </div>
                </div>
                <div class="popup__form">
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea
                            v-model="offer.message"
                            name="message" id="message" cols="30" rows="10" class="textarea" placeholder="Введите сообщение"></textarea>
                    </div>
                    <button
                        @click="sendOffer"
                        class="btn btn-primary">
                        Отправить
                    </button>
                </div>
                <div
                    @click="isSendOfferPopupOpen = false"
                    class="close-popup">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <choose-project-popup ref="chooseProjectPopup"></choose-project-popup>
</template>
<script>
    import {ref} from "vue";
    import axios from "axios";

    import ChooseProjectPopup from '../../../ui/ChooseProjectPopup.vue'
    import User from "../../../services/api/User";
    import Project from '../../../services/api/Project';

    export default{
        components: {ChooseProjectPopup},
        props:['project'],
        data(){
            return {
                isSendOfferPopupOpen: ref(false),
                offer:ref({
                    project_work_id: null,
                    message: null,
                    blogger_id: null,
                }),
                user: ref(null),
                projectInfo: ref(false),
                User, Project
            }
        },
        mounted() {
            this.user = this.User.getCurrent();

            if (!this.project) {
                return
            }

            this.project.feedbackWork = this.Project.getFeedbackWork(this.project);
            this.project.integrationWork = this.Project.getIntegrationWork(this.project);
        },
        updated(){
            if(this.projectInfo){
                $('#project-item-info').find('.popup-project__carousel').owlCarousel({
                    margin: 5,
                    nav: false,
                    dots: true,
                    responsive: {
                        0:{
                            items: 1
                        },
                        1180: {
                            items: 1
                        }
                    }
                })
            }

            if(this.project){
                var feedbackWork = this.Project.getFeedbackWork(this.project),
                    integrationWork = this.Project.getIntegrationWork(this.project);

                if(!this.project.feedbackWork || this.project.feedbackWork.quantity != feedbackWork.quantity || this.project.feedbackWork.lost_quantity != feedbackWork.lost_quantity)
                    this.project.feedbackWork = feedbackWork;

                if(!this.project.integrationWork || this.project.integrationWork.quantity != integrationWork.quantity || this.project.integrationWork.lost_quantity != integrationWork.lost_quantity)
                    this.project.integrationWork = integrationWork;
            }
        },
        methods:{
            async chooseWork(e, works){
                e.stopPropagation();

                const data = await this.$refs.chooseProjectPopup.show({
                    title: 'Выберите формат рекламы',
                    subtitle: 'Выберите из списка нужный формат рекламы, который вы хотите отправить селлеру',
                    okButton: 'Подтвердить',
                    cancelButton: 'Отмена',
                    works: works
                });

                if(data){
                    this.offer.project_work_id = data.id
                    this.isSendOfferPopupOpen = true;
                }
            },
            sendOffer(){
                this.isSendOfferPopupOpen = false;

                if(!this.offer.project_work_id){
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно отправить предложение, не выбран формат рекламы'
                    });

                    return
                }

                this.offer.blogger_id = this.user.blogger_id;

                axios({
                    method: 'post',
                    url: '/api/works',
                    data: this.offer
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Заявка отправлена.'
                    });

                    this.offer.project_work_id = null;
                    this.offer.message = null;
                    this.project.is_blogger_works = true;
                    this.projectInfo = false;
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно обновить данные.'
                    });
                })
            },
            openMoreInfo(){
                var options = this.project.marketplace_options ? JSON.parse(this.project.marketplace_options) : null,
                    contentEmptyText = '';

                if(!options && !this.project.marketplace_category){
                    contentEmptyText = 'К сожалению, информация о товаре в данный момент недоступна. Вы можете узнать подробности, нажав на кнопку «Подробнее».'
                }

                var worksInfo = {
                    lostQuantity: 0,
                    totalQuantity: 0,
                }

                if(this.project.project_works){
                    worksInfo.lostQuantity = this.project.project_works.map(w => w.lost_quantity).reduce((a, b) => a + b, 0);
                    worksInfo.totalQuantity = this.project.project_works.map(w => parseInt(w.quantity)).reduce((a, b) => a + b, 0);
                }

                this.projectInfo = {
                    name: this.project.product_name,
                    brand: this.project.marketplace_brand,
                    category: this.project.marketplace_category,
                    articul: this.project.product_nm,
                    imgs: this.project.project_files,
                    price: this.project.product_price,
                    rating: this.project.product_rating,
                    description: this.project.marketplace_description,
                    link: this.project.product_link,
                    contentEmptyText: contentEmptyText,
                    options: options,
                    worksInfo: worksInfo
                }
            }
        }
    }
</script>
