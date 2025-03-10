<template>
    <transition name="fade">
        <div :id="id" class="popup _scrollable" style="" v-if="isVisible">
            <div class="popup__container _container">
                <div class="popup__body" style="max-width:600px">
                    <slot></slot>
                    <div class="close-popup" @click="close">
                        <img src='/img/close-icon.svg' alt="">
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    name: 'PopupModal',
    props:['id'],
    data: () => ({
        isVisible: false,
    }),

    methods: {
        open() {
            this.isVisible = true
        },

        close() {
            this.isVisible = false
        },
    },
}
</script>
