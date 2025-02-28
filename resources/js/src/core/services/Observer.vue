<template>
    <div class="observer"/>
</template>

<script>
let _page = 0;

export default {
    props: ['options', 'itemsCount'],
    data: () => ({
        observer: null,
    }),
    mounted() { },
    methods:{
        restoreLimit(){ _page = 0 },
        getPaginationData(){
            return {
                'itemsOnPage': this.itemsCount * _page,
                'itemsCount': this.itemsCount,
            }
        },
        startObserve(){
            const options = this.options || {};

            this.observer = new IntersectionObserver(([entry]) => {
                if (entry && entry.isIntersecting) {
                    _page++
                    this.$emit("intersect");
                }
            }, options);

            this.observer.observe(this.$el);
        },
        stopObserve(){ this.observer.disconnect() }
    },
    destroyed() {
        this.stopObserve();
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
