<template>
    <div class="observer"/>
</template>

<script>
const _itemsCount = 20;
let _page = 1;

export default {
    props: ['options'],
    data: () => ({
        observer: null,
    }),
    mounted() {
        const options = this.options || {};
        this.observer = new IntersectionObserver(([entry]) => {
            if (entry && entry.isIntersecting) {
                _page++
                this.$emit("intersect");
            }
        }, options);

        this.observer.observe(this.$el);
    },
    methods:{
        getPaginationData(){
            return {
                'itemsOnPage': _itemsCount * _page,
                'itemsCount': _itemsCount,
            }
        }
    },
    destroyed() {
        this.observer.disconnect();
    },
};
</script>
<style scoped>
    .observer{
        width: 100%;
        position: absolute;
        bottom:0;
        left:0;
    }
</style>
