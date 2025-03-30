<template>
    <div :class="'banner ' + bannerClass">
        <div class="banner__content">
            <div class="banner__header">
                <div class="banner__title">
                    Режем цены пополам!<br> Скидка 50% 🎁
                </div>
                <div class="banner__close" @click="hide">
                    <img src="img/close-icon.svg" alt="">
                </div>
            </div>
            <div class="banner__body">
                <div class="banner__text">
                    Выгода 50% при оплате платной подписки<br>Цена <span style="text-decoration: line-through">4990</span> 2490 рублей
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
            if(this.bannerClass !== 'disabled')
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
<style scoped>

.banner{
    position: fixed;
    border-radius: 12px;
    overflow: hidden;
    padding: 18px;
    width: 100%;
    max-width:380px;
    height:200px;
    left:20px;
    bottom:30px;
    z-index: 9998;
    box-shadow: 0px 0px 20px 12px rgba(181,76,219,.2);
    opacity: 1;
    transition: all .5s linear;
    background: #fff;
}
.banner__header{
    display: flex;
    justify-content: space-between;
    gap: 5px;
    align-items: flex-start;
    margin-bottom: 12px;
}
.banner__title{
    font-size: 20px;
    font-weight: 600;
    line-height: 1.3;
    transition: all .5s linear;
    color:#000;
}
.banner__close{
    width: 15px;
    height: 15px;
    cursor: pointer;
    opacity: 0;
    transition: all .5s linear;
    z-index: 1;
}
.banner__close img{
    width: 100%;
}
.banner__text{
    line-height: 1.3;
    font-size: 15px;
    font-weight: 500;
    color:rgba(0,0,0,.4);
    transition: all .5s linear;
}
.banner__gift{
    position: relative;
    width: 175px;
    height: 175px;
    top: -155px;
    left: 61%;
    opacity: .04;
    transition: all .5s linear;
}
.banner__btns .btn{
    padding: 10px;
    font-size: 15px;
    color:var(--primary);
    transition: all .5s linear;
    margin-top: 20px;
    display: block;
    width: -moz-fit-content;
    width: fit-content;
    border: 1px solid;
    background: rgba(252,74,0, .05);
    border-color:var(--primary);
}
.banner.disabled{
    opacity: 0;
    bottom:-100%;
}
.banner.inactive{
    box-shadow: 0px 0px 20px 12px rgba(181,76,219,.05);
}
.banner.inactive .banner__close{
    opacity: 1;
}
.banner.inactive .banner__btns .btn{
    background: #fff;
}
</style>
