<template>
    <div :class="'banner ' + bannerClass">
        <div class="banner__content">
            <div class="banner__header">
                <div class="banner__title">
                    Распродажа 11.11<br> Двойная выгода 🎁
                </div>
                <div class="banner__close" @click="hide">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
            <div class="banner__body">
                <div class="banner__text">
                    Оплати подписку в ноябре – <br>получи 60 дней вместо 30!
                </div>
                <div class="banner__btns">
                    <router-link
                        :to="{path: '/tariffs'}"
                        class="btn">
                        Хочу приобрести!
                    </router-link>
                </div>
            </div>
        </div>
        <div class="banner__gift">
            <img src="img/percent-icon.svg" alt="">
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

export default{
    data(){
        return{
            bannerClass: ref('disabled')
        }
    },
    mounted(){
        var isBannerClosed = localStorage.getItem('is_banner_closed');

        if(isBannerClosed && isBannerClosed === 1){
            return
        }

        setTimeout(() => {
            this.bannerClass = ''
        }, 1500)

        setTimeout(() => {
            this.bannerClass = 'inactive'
        }, 6500)
    },
    methods: {
        hide(){
            this.bannerClass = 'disabled';
            localStorage.setItem('is_banner_closed', 1);
        }
    }
}
</script>
