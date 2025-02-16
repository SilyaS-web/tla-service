<template>
    <div
        v-if="bloggers && bloggers.length > 0"
        class="bloggers-table">
        <div class="bloggers-table__content">
            <div class="bloggers-table__header">

            </div>
            <div class="bloggers-table__body">
                <div class="bloggers-table__col">
                    <div class="bloggers-table__title">
                        {{ 'Блогеры ' + bloggers.length + 'шт' }}
                    </div>
                    <div class="bloggers-table__bloggers-images table-images">
                        <div
                            @mouseover="slideBloggersList('right')"
                            @mouseout="stopSliding"
                            style="display: none"
                            class="table-images__left-slide--js"></div>
                        <div class="table-images__track">
                            <div
                                :style="'transform:translateX(' + bloggersListPosition + 'px)'"
                                class="table-images__body">
                                <div
                                    v-for="blogger in bloggers"
                                    class="table-images__img">
                                    <img
                                        :src="blogger.user.image"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div
                            @mouseover="slideBloggersList('left')"
                            @mouseout="stopSliding"
                            style="display: none"
                            class="table-images__right-slide--js"></div>
                    </div>
                </div>
                <div class="bloggers-table__col">
                    <div class="bloggers-table__title">
                        Общая статистика
                    </div>
                    <div class="bloggers-table__statistics">
                        <div class="bloggers-table__statistics-item">
                            <div class="bloggers-table__statistics-name">
                                Подписчики
                            </div>
                            <div class="bloggers-table__statistics-val">
                                {{ totalSubs }}
                            </div>
                        </div>
                        <div class="bloggers-table__statistics-item">
                            <div class="bloggers-table__statistics-name">
                                Охваты
                            </div>
                            <div class="bloggers-table__statistics-val">
                                {{ totalCover }}
                            </div>
                        </div>
                        <div class="bloggers-table__statistics-item">
                            <div class="bloggers-table__statistics-name">
                                ER, %
                            </div>
                            <div class="bloggers-table__statistics-val">
                                {{ countER(totalSubs, totalCover) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bloggers-table__col">
                    <div class="bloggers-table__btns">
                        <div class="btn btn-primary"> Отправить ТЗ</div>
                        <div
                            @click="cleanMassDistributionList"
                            class="btn btn-white"> Очистить список
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloggers-table__footer">

            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import {countER} from "../../../../../core/utils/countER";
import bloggersList from "../../../../admin/bloggers-list/index.vue";

export default {
    name: 'BloggersDistributionBoard',
    computed: {
        bloggersList() {
            return bloggersList
        }
    },
    data() {
        return {
            bloggers: ref([]),

            totalSubs: ref(0),
            totalCover: ref(0),

            bloggersListPosition: ref(1),

            slidesIntervalIDs: ref({
                left: null,
                right: null,
            })
        }
    },
    mounted() {
        window.addEventListener('massDistributionListChanged', (event) => {
            this.bloggers = this.executeBloggersFromLS();
            this.countStatistics()
            this.toggleSlideArrows()

            this.bloggersListPosition = 1;
        });
    },
    methods: {
        executeBloggersFromLS() {
            return localStorage.getItem('massDistributionList') ?
                JSON.parse(localStorage.getItem('massDistributionList'))
                : []
        },
        countStatistics() {
            this.totalSubs = this.bloggers
                .map(b => b.summaryPlatform.subscriber_quantity)
                .reduce((a, b) => a + b, 0);

            this.totalCover = this.bloggers
                .map(b => b.summaryPlatform.coverage)
                .reduce((a, b) => a + b, 0);
        },
        cleanMassDistributionList() {
            localStorage.setItem('massDistributionList', JSON.stringify([]));
            this.bloggers = [];
        },
        slideBloggersList(direction) {
            const _self = this;

            switch (direction) {
                case 'right':
                    this.slidesIntervalIDs.right = setInterval(function(){
                        if (_self.isPossibleToMoveRight()) _self.bloggersListPosition += 1;
                        _self.toggleSlideArrows()
                    }, 10);
                    break;
                case 'left':
                    this.slidesIntervalIDs.left = setInterval(function(){
                        if (_self.isPossibleToMoveLeft()) _self.bloggersListPosition -= 1;
                        _self.toggleSlideArrows()
                    }, 10);
                    break;
            }
        },
        stopSliding(){
            for(const id in this.slidesIntervalIDs){
                clearInterval(this.slidesIntervalIDs[id]);
            }
        },
        isPossibleToMoveRight() {
            return this.bloggersListPosition <= 0
        },
        isPossibleToMoveLeft() {
            const trackWidth = $('.table-images__body').width();
            const wrapWidth = $('.table-images').width() - 10;

            return (Math.abs(this.bloggersListPosition) + wrapWidth) <= trackWidth
        },
        toggleSlideArrows(){
            const isShowingLeftArrow = this.isPossibleToMoveLeft();
            const isShowingRightArrow = this.isPossibleToMoveRight();

            if(isShowingRightArrow){
                $('.table-images__left-slide--js').show();
            }
            else{
                $('.table-images__left-slide--js').hide();
            }

            if(isShowingLeftArrow){
                $('.table-images__right-slide--js').show();
            }
            else{
                $('.table-images__right-slide--js').hide();
            }
        },
        countER
    }
}
</script>

<style scoped>
.bloggers-table {
    position: fixed;
    z-index: 999;
    width: 100%;
    max-width: 1145px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px 6px rgba(0, 0, 0, .15);
    padding: 18px 55px;
    left: 0;
    right: 0;
    bottom: 15px;
    margin: auto;
    background: #fff;
}

.bloggers-table__content {
    display: flex;
    flex-direction: column;
}

.bloggers-table__body {
    display: flex;
    gap: 8px;
    justify-content: space-between;
}

.bloggers-table__col {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.bloggers-table__title {
    font-size: 21px;
    font-weight: 500;
    margin-bottom: 8px;
}
.table-images{
    width: 100%;
    position: relative;
    min-width: 280px;
}
.table-images__track {
    width: 100%;
    max-width: 280px;
    overflow: auto;
    position: relative;
    transition: all .1s linear;
}

.table-images__track::-webkit-scrollbar {
    display: none;
}

.table-images__body {
    display: flex;
    width: fit-content;
}

.table-images__img {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
}

.table-images__img:not(:first-child) {
    margin-right: -12px;
}

.table-images__img img {
    object-fit: cover;
    position: absolute;
    width: 100%;
    height: 100%;
}

.table-images__left-slide--js,
.table-images__right-slide--js {
    width: 75px;
    height: 75px;
    position: absolute;
    z-index: 1;
    top: 0;
    background-image: url("/img/arrow-alt.svg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 19px;
}

.table-images__left-slide--js {
    left: -45px;
    transform: rotate(90deg);
}
.table-images__right-slide--js {
    right: -45px;
    transform: rotate(-90deg);
}

.bloggers-table__statistics {
    display: flex;
    gap: 24px;
}

.bloggers-table__statistics-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.bloggers-table__statistics-name {
    font-weight: 500;
    color: rgba(0, 0, 0, .4);
    font-size: 16px;
}

.bloggers-table__statistics-val {
    font-size: 20px;
    font-weight: 600;
    color: var(--primary);
}

.bloggers-table__btns {
    display: flex;
    gap: 8px;
    margin-top: auto;
    margin-bottom: auto;
}

.bloggers-table__btns .btn {
    padding: 12px;
}

</style>
