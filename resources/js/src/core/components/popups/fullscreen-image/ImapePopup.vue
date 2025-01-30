<template>
    <popup-modal ref="popup">
        <div class="chat-img__w">
            <img :src="imageUrl" alt="" class="chat-img" style="width:100%">
        </div>
    </popup-modal>
</template>
<script>
import { ref } from 'vue';

import PopupModal from '../AppPopup.vue';

export default {
    name: 'ImagePopup',
    components: { PopupModal },
    data: () => ({
        imageUrl: ref(null),

        resolvePromise: undefined,
        rejectPromise: undefined,
    }),
    methods: {
        show(imageUrl) {
            this.imageUrl = imageUrl

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
