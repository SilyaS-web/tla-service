<template>
    <div
        :id="carouselID || ''"
        :class="(getWrapClassList()) + ' owl-carousel'" ref="Carousel">
    </div>
</template>
<script>
export default {
    props:['carouselID', 'itemsList', 'listClassList', 'itemsClassList', 'props'],
    mounted(){
        if(this.itemsList && this.itemsList.length > 0){
            this.itemsList.forEach(item => {
                $('.owl-carousel#' + this.carouselID)
                    .append(`<div class="${this.getItemClassList()}" style="background-image:url('/${(!item.link ? '/img/placeholder.webp' : item.link)}')"></div>`)
            })

            $('.owl-carousel#' + this.carouselID).owlCarousel(this.props);
        }
    },
    updated(){
        $('.owl-carousel#' + this.carouselID).empty()
        $('.owl-carousel#' + this.carouselID).trigger('destroy.owl.carousel').removeClass('owl-loaded');

        this.itemsList.forEach(item => {
            $('.owl-carousel#' + this.carouselID)
                .append(`<div class="${this.getItemClassList()}" style="background-image:url('/${(!item.link ? '/img/placeholder.webp' : item.link)}')"></div>`)
        })

        $('.owl-carousel#' + this.carouselID).owlCarousel(this.props);
    },
    methods:{
        getWrapClassList(){
            return this.listClassList.join(' ')
        },
        getItemClassList(){
            return this.itemsClassList.join(' ')
        }
    },
    computed:{

    }
}
</script>
