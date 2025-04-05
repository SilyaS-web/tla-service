<template>
    <popup-modal :id="'media-popup'" ref="popup">
        <div
            v-if="imageUrl"
            class="fullscreen-img">
            <img :src="imageUrl" alt="" class="fullscreen-img__img">
        </div>
        <div
            v-if="videoUrl"
            class="fullscreen-video">
            <video :src="videoUrl" class="fullscreen-video__video" controls>
                <source :src="videoUrl" type="video/mp4" />
            </video>
        </div>
    </popup-modal>
</template>
<script>
import { ref } from 'vue';

import PopupModal from '../AppPopup.vue';

export default {
    name: 'FullscreenAssetContentPopup',
    components: { PopupModal },
    data: () => ({
        imageUrl: ref(null),
        videoUrl: ref(null),

        resolvePromise: undefined,
        rejectPromise: undefined,
    }),
    methods: {
        show(opts = {}) {
            this.imageUrl = opts.imageUrl
            this.videoUrl = opts.videoUrl

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        _confirm() {
            this.$refs.popup.close()
            this.resolvePromise(true)
        },

        _cancel() {
            this.$refs.popup.close()
            this.resolvePromise(false)
        },
    },
}
</script>
<style>
#media-popup .popup__body:has(.fullscreen-img),
#media-popup .popup__body:has(.fullscreen-video){
    background-color: unset !important;
    max-width:unset !important;
}
#media-popup .popup__container:has(.fullscreen-img),
#media-popup .popup__container:has(.fullscreen-video){
    margin:0 auto;
}
</style>
<style scoped>
</style>
