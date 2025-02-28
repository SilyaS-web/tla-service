<script>
export default {
    props: {
        tabName: {type: String, required: true},
        tabContentName: {type: String, required: true},
        notifications: {type: Number, required: false, default: false},
        isActive: {type: Boolean, required: false, default: false},
        classList: {type: Array, required: false, default: []},
    },
    name: "ListItem",
    computed:{
        tabClassList(){ return this.classList.join(' ') }
    },
    methods:{
        switchTab(){
            this.$emit('switchTab', this.tabContentName)
        }
    }
}
</script>

<template>
    <a
        href="#"
        @click="switchTab"
        :id="`${tabContentName}-tab`"
        :class="'nav-menu__item nav-menu__link tab ' + (isActive ? 'active ' : '') + (tabClassList)"
    >
        {{ tabName }}
        <div class="nav-menu__item-notifs notifs notifs-chat" v-if="notifications && notifications > 0">
            {{ notifications }}
        </div>
    </a>
</template>

<style scoped>

</style>
