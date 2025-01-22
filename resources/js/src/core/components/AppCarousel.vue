<template>
    <div :class="(getWrapClassList()) + ' owl-carousel'" ref="Carousel">
        <div
            v-for="image in itemsList"
            :class="(getItemClassList())"
            :style="'background-image:url(' + (!image.link ? '/img/placeholder.webp' : `/${image.link}`) + ')'">
        </div>
    </div>
</template>
<script>
export default {
    props:['itemsList', 'listClassList', 'itemsClassList', 'props'],
    mounted(){
        if(this.itemsList && this.itemsList.length > 0){
            $('.owl-carousel').owlCarousel(this.props);
        }
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
