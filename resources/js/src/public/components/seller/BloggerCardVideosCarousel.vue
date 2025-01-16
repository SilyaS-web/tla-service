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
                :src="video.path"></video>
        </div>
    </div>
</template>
<script>
export default {
    props:['videos'],
    updated(){
        $('.info-profile__videos').owlCarousel({
            margin: 5,
            nav: true,
            dots: false,
            items: 1,
            responsive: {
                0:{
                    items: 1
                },
                1180: {
                    items:1
                }
            }
        });
    }
}
</script>
