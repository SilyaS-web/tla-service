<template>
    <div
        v-show="bloggers && bloggers.length > 0"
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
                        <div
                            @scroll="toggleSlideArrows"
                            class="table-images__track">
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
                        <div
                            @click="$emit('mass-distribution')"
                            class="btn btn-primary"> Отправить ТЗ</div>
                    </div>
                </div>
            </div>
            <div class="bloggers-table__footer">

            </div>
            <div class="close-popup" @click="cleanMassDistributionList"><img src="/img/close-icon.svg" alt=""></div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import {countER} from "../../../../core/utils/countER";

import DistributionList from "../../../../core/mixins/DistributionList.js";

export default {
    name: 'BloggersDistributionBoard',
    mixins:[DistributionList],
    data() {
        return {
            totalSubs: ref(0),
            totalCover: ref(0),

            bloggers: ref([]),

            bloggersListPosition: ref(1),

            slidesIntervalIDs: ref({
                left: null,
                right: null,
            })
        }
    },
    mounted() {
        window.addEventListener(this.distributionEventNames.add, (event) => {
            const blogger = event.detail.blogger;

            if(this.bloggers.indexOf(blogger) !== -1) {
                return
            }

            this.bloggers.push(blogger)

            this.countStatistics()
            this.toggleSlideArrows()

            this.bloggersListPosition = 1;
        });

        window.addEventListener(this.distributionEventNames.remove, (event) => {
            const blogger = event.detail.blogger;

            if(this.bloggers.indexOf(blogger) === -1) {
                return
            }

            this.bloggers = this.bloggers.filter(_blogger => _blogger.id !== blogger.id);

            this.countStatistics()
            this.toggleSlideArrows()

            this.bloggersListPosition = 1;
        });
    },
    methods: {
        countStatistics() {
            this.totalSubs = this.bloggers
                .map(b => b.summaryPlatform.subscriber_quantity)
                .reduce((a, b) => a + b, 0);

            this.totalCover = this.bloggers
                .map(b => b.summaryPlatform.coverage)
                .reduce((a, b) => a + b, 0);
        },
        cleanMassDistributionList() {
            this.bloggers = [];
            window.dispatchEvent(new CustomEvent(this.distributionEventNames.empty, { }));
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
            const wrapWidth = Math.abs($('.table-images').width() - 30);

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
    width: calc(100% - 20px);
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
    position: relative;
}

.bloggers-table__body {
    display: flex;
    gap:12px;
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
    margin-left: -12px;
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

.bloggers-table__btns .btn-primary {
    padding: 14px 80px;
    font-size: 18px;
}

.bloggers-table .close-popup{
    right: -45px;
    top: -8px;
}

@media(max-width:1030px){
    .bloggers-table__btns .btn-primary{
        padding: 12px ;
    }
    .bloggers-table .close-popup{
        right: -24px;
        top: -8px;
    }
    .bloggers-table__col:has(.bloggers-table__btns){
        flex: 1 1 285px;
    }
    .bloggers-table__btns .btn-primary{
        padding: 14px;
        font-size: 18px;
        width: 100%;
        text-align: center;
    }
}
@media(max-width:925px){
    .table-images__img{
        width: 60px;
        height: 60px;
    }
    .table-images__img:not(:first-child) {
        margin-left: -12px;
    }
    .table-images{
        min-width: 200px;
    }
    .table-images__track{
        max-width: 200px;
    }
    .table-images__left-slide--js,
    .table-images__right-slide--js{
        width: 60px;
        height: 60px;
        pointer-events: none;
    }
    .table-images__right-slide--js{
        right: -42px;
    }
    .table-images__left-slide--js{
        left: -42px;
    }
    .bloggers-table{
        padding: 18px 26px;
    }
    .bloggers-table__title{
        font-size: 19px;
        margin-bottom: 12px;
    }
    .bloggers-table__body{
        gap: 18px;
    }
    .bloggers-table__btns .btn-primary{
        padding: 12px;
        font-size: 16px;
    }
    .bloggers-table__statistics{
        gap: 12px;
    }
    .bloggers-table__col{
        gap: 0;
    }
    .bloggers-table__statistics-name{
        font-size: 14px;
        text-wrap: nowrap;
    }
    .bloggers-table__statistics-val{
        font-size: 18px;
    }
    .bloggers-table__col:has(.bloggers-table__btns) {
        max-width: 285px;
    }
}
@media(max-width:675px){
    .bloggers-table{
        padding: 20px 32px;
        bottom: 98px;
    }
    .bloggers-table__body{
        gap: 32px;
        flex-direction: column;
    }
    .bloggers-table__col:has(.bloggers-table__statistics){
        order:1
    }
    .bloggers-table__col:has(.table-images){
        order:2
    }
    .bloggers-table__col:has(.bloggers-table__btns){
        order:3
    }
    .bloggers-table__col:has(.bloggers-table__btns){
        flex:unset;
    }
    .bloggers-table__title{
        font-size: 23px;
        margin-bottom: 14px;
    }
    .bloggers-table__statistics{
        gap: 32px;
    }
    .bloggers-table__statistics-name{
        font-size: 17px;
    }
    .bloggers-table__statistics-val{
        font-size: 21px;
    }
    .table-images{
        min-width: unset;
    }
    .table-images__track{
        display: none;
    }
    .bloggers-table__btns .btn-primary{
        padding: 16px;
        font-size: 18px;
    }
    .table-images__img{
        width: 75px;
        height: 75px;
    }
}
@media(max-width:430px){
    .bloggers-table[data-v-cfdd2e12] {
        padding: 12px 24px;
        bottom: 72px;
    }

    .bloggers-table__title{
        font-size: 18px;
        margin-bottom: 10px;
    }

    .bloggers-table__body{
        gap: 24px;
    }

    .bloggers-table__statistics-item{
        gap: 4px;
    }
    .bloggers-table__statistics-name{
        font-size: 14px;
    }
    .bloggers-table__statistics-val{
        font-size: 18px;
    }

    .table-images__img{
        width: 60px;
        height: 60px;
    }

    .bloggers-table__statistics{
        flex-wrap: wrap;
    }

    .table-images__left-slide--js[data-v-cfdd2e12],
    .table-images__right-slide--js[data-v-cfdd2e12]{
        width: 25px;
        height: 60px;
    }
    .table-images__right-slide--js{
        right: -24px;
    }
    .table-images__left-slide--js{
        left: -24px;
    }

    .bloggers-table__btns .btn-primary{
        padding: 12px;
        font-size: 16px;
    }

    .bloggers-table .close-popup{
        right: -8px;
        top: -7px;
    }
}

</style>
