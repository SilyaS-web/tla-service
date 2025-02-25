<template>
    <app-popup ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                {{ title }}
            </div>
            <div class="popup__subtitle">
            </div>
        </div>
        <div class="popup__specification specification-popup">
            <div
                v-if="specification.text"
                class="specification-popup__text">
                <div class="specification-popup__title">Описание</div>
                <div class="specification-popup__text-text">{{ specification.text }}</div>
            </div>
            <div
                v-if="images && images.length > 0"
                class="specification-popup__images">
                <div class="specification-popup__title">Изображения</div>
                <div class="specification-popup__images-body">
                    <div
                        v-for="img in images"
                        @click="openImageFullscreen(img.link)"
                        class="specification-popup__images-image">
                        <img :src="img.link" alt="">
                    </div>
                </div>
            </div>
            <div
                v-if="specification.works_types && specification.works_types.length > 0"
                class="specification-popup__tags">
                <div class="specification-popup__title">Форматы работы</div>
                <div class="card__tags">
                    <div
                        v-for="workType in specification.works_types"
                        class="card__tags-item"><span>{{ workType.name }}</span></div>
                </div>
            </div>
            <div
                v-if="documents && documents.length > 0"
                class="specification-popup__files">
                <div class="specification-popup__title">Файлы</div>
                <div class="specification-popup__files-body">
                    <a
                        v-for="document in documents"
                        :href="document.link"
                        target="_blank"
                        class="specification-popup__files-file specification-file">
                        <div class="specification-file__body">
                            <div class="specification-file__icon">
                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="6.3655" cy="3.91628" r="3.41628" fill="#D9D9D9" stroke="black"/>
                                    <line x1="4.4103" y1="6.5726" x2="0.851844" y2="11.1478" stroke="black"/>
                                </svg>
                            </div>
                            <span class="specification-file__title">{{ fileTitle(document) }}</span>
                        </div>
                    </a>
                </div>
            </div>
            <div
                v-if="withConfirmation"
                class="specification-popup__btns">
                <button
                    @click="_confirm"
                    class="btn btn-primary">
                    {{ okButton }}
                </button>
            </div>
        </div>
    </app-popup>
    <image-popup ref="imagePopup"></image-popup>
</template>

<script>
import {ref} from "vue";

import axios from "axios";

import AppPopup from "../AppPopup.vue";
import ImagePopup from "../../../components/popups/fullscreen-asset/AssetPopup.vue";

const imageTypes = [
    'jpg', 'jpeg', 'gif', 'pjpeg',
    'png', 'svg', 'webp', 'heif', 'heic', 'avif'
];

export default {
    name: "SpecificationPopup",
    components: {AppPopup, ImagePopup},
    data() {
        return {
            title: 'Техническое задание',
            okButton: 'Взять в работу',

            specification: ref({
                text: '',
                files: [],
                works_types: [],
            }),

            withConfirmation: ref(false),
        }
    },
    methods: {
        show(opts = {
            specification: {
                text: '',
                files: [],
                works_types: [],
            },
            withConfirmation: false
        }) {
            for (const optsKey in opts) {
                if (opts[optsKey])
                    this[optsKey] = opts[optsKey]
            }

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        openImageFullscreen(url) {
            this.$refs.imagePopup.show({imageUrl: url})
        },

        fileTitle(document) {
            const splitedLink = this._getSplitedFileLink(document.link, '/');

            return splitedLink[splitedLink.length - 1]
        },

        _isFileImage(link) {
            const splitedLink = this._getSplitedFileLink(link, '.');
            const fileType = splitedLink[splitedLink.length - 1];

            return imageTypes.includes(fileType)
        },

        _getSplitedFileLink(link, separator) {
            return link.split(separator);
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
    computed: {
        images() {
            return this.specification.files.filter(file => {
                return this._isFileImage(file.link)
            })
        },
        documents() {
            return this.specification.files.filter(file => {
                return !this._isFileImage(file.link)
            })
        },
    }
}
</script>

<style scoped>
.specification-popup {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.specification-popup__text {
    display: flex;
    flex-direction: column;
}

.specification-popup__title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.specification-popup__text-text {
    font-size: 16px;
    font-weight: 500;
}

.specification-popup__images-body,
.specification-popup__files-body {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.specification-popup__images-image {
    width: 150px;
    height: 150px;
    border-radius: 8px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.specification-popup__images-image img {
    object-fit: cover;
    position: absolute;
    width: 100%;
    height: 100%;
}

.specification-file {
    width: calc(100% / 3 - 8px);
    min-width: 180px;
    max-width: 420px;
}

.specification-file__body {
    border-radius: 6px;
    padding: 8px 12px;
    display: flex;
    gap: 6px;
    align-items: center;
    border: 1px solid rgba(0, 0, 0, .4);
    cursor: pointer;
}

.specification-file__icon {
    width: 100%;
    max-width: 17px;
    height: 17px;
    opacity: .6;
}

.specification-file__icon svg {
    width: 100%;
}

.specification-file__title {
    font-size: 14px;
    color: rgba(0, 0, 0, .6);
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
}

.specification-file:hover .specification-file__body {
    border-color: var(--primary)
}

.specification-file:hover .specification-file__icon {
    opacity: 1;
}

.specification-file:hover .specification-file__icon svg > * {
    stroke: var(--primary);
}

.specification-file:hover .specification-file__title {
    color: var(--primary);
    text-decoration: underline;
}

.specification-popup__btns {
    margin-top: 12px;
}
.specification-popup__tags .card__tags{
    margin-bottom: 0;
}

@media (max-width: 420px) {
    .specification-popup__images-image {
        width: 120px;
        height: 120px;
    }
}

@media (max-width: 375px) {
    .specification-popup__title {
        font-size: 16px;
    }

    .specification-popup__text-text {
        font-size: 14px;
    }

    .specification-file {
        width: calc(100% / 2 - 8px);
        min-width: unset;
    }
}
</style>
