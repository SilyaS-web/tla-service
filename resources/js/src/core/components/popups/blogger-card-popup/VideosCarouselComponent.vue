<template>
    <div
        :class="'info-profile__videos owl-carousel ' + (videos && videos.length > 0 ? '' : 'info-profile__videos--empty')">
        <div
            v-for="video in videos"
            class="info-profile__content-item">
            <video
                autoplay
                muted
                loop
                onloadstart="this.volume=0"
                :src="video.path"></video>
        </div>
    </div>
</template>
<script>
export default {
    props:['videos'],
    mounted() {
        if(!$('.info-profile__videos').hasClass('owl-loaded') && this.videos.length > 0){
            $('.info-profile__videos').owlCarousel({
                margin: 5,
                nav: true,
                dots: false,
                items: 1,
                responsive: {
                    0:{
                        items: 3,
                        center: true,
                        margin:10,
                        startPosition: 2,
                        autoWidth: true,
                        loop: true
                    },
                    688:{
                        items: 1
                    },
                    1180: {
                        items:1
                    }
                }
            });
        }
    },
    updated(){
        if(!$('.info-profile__videos').hasClass('owl-loaded')){
            $('.info-profile__videos').owlCarousel({
                margin: 5,
                nav: true,
                dots: false,
                items: 1,
                responsive: {
                    0:{
                        items: 3,
                        center: true,
                        margin:10,
                        startPosition: 2,
                        autoWidth: true,
                        loop: true
                    },
                    688:{
                        items: 1
                    },
                    1180: {
                        items:1
                    }
                }
            });
        }
    }
}
</script>
