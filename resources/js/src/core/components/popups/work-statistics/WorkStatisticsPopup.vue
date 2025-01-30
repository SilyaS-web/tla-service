<template>
    <popup-modal ref="popup">
        <div class="popup__header">
            <div class="popup__title title">
                {{ title }}
            </div>
            <div class="popup__subtitle">
                {{ subtitle }}
            </div>
        </div>
        <div class="popup__form">
            <Input
                v-model="statistics.views"
                :label="'Просмотры'"
                :inputType="'text'"
                :inputPlaceholder="''"
                :inputClassList="[]"
                :inputID="'views'"
                :error="''"
            ></Input>

            <div class="form-group">
                <label for="views">Просмотры</label>
                <input
                    v-model="statistics.views"
                    id="views" name="views" type="views" class="input">
            </div>
            <div class="form-group">
                <label for="likes">Лайки</label>
                <input
                    v-model="statistics.likes"
                    id="likes" name="likes" type="likes" class="input">
            </div>
            <div class="form-group">
                <label for="reposts">Репосты</label>
                <input
                    v-model="statistics.reposts"
                    id="reposts" name="reposts" type="reposts" class="input">
            </div>
            <div class="form-group">
                <label for="platform">Площадка</label>
                <select
                    v-model="statistics.platform_id"
                    id="platform" name="platform" class="input">
                    <option value="">Не выбрано</option>
                    <option
                        v-for="platform in platforms"
                        :value="platform.id">{{ platform.title }}</option>
                </select>
            </div>
            <div class="input-file input-file--stat tab-content__profile-img-upload" style="padding-left:0; margin-bottom:20px;">
                <label for="statistics-file">{{ uploadStatisticsFileTitle }}</label>
                <input
                    @change="uploadStatisticsFileTitle = 'Файлы загружены'"
                    id="statistics-file" type="file" multiple hidden>
            </div>
            <button
                @click="sendStatistics"
                class="btn btn-primary">
                Отправить
            </button>
        </div>
    </popup-modal>
</template>
<script>
import { ref } from 'vue';

import Platforms from '../../../services/api/Platforms.vue'

import PopupModal from '../AppPopup.vue';

import Input from '../../../components/form/InputBlockComponent';
import axios from "axios";

export default {
    name: 'StatisticsPopup',
    components: { PopupModal, Input },
    data: () => ({
        title: ref('Заполните статистику'),
        subtitle: ref('После того, как вы прикрепите статистику по интеграции, проект будет завершен'),

        statistics:ref({
            views: null,
            likes: null,
            reposts: null,
            platform_id: null,
        }),

        workID: ref(null),

        uploadStatisticsFileTitle: ref('Прикрепить отчет по статистике'),

        resolvePromise: undefined,
        rejectPromise: undefined,

        Platforms
    }),
    methods: {
        async show(workID) {
            this.workID = workID
            this.platforms = await this.Platforms.getList();

            this.$refs.popup.open()

            return new Promise((resolve, reject) => {
                this.resolvePromise = resolve
                this.rejectPromise = reject
            })
        },

        sendStatistics(){
            let formData = new FormData;

            for (let k in this.statistics){
                if(this.statistics)
                    formData.append(k, this.statistics[k])
            }

            let image = $('#statistics-file'),
                files = image[0].files;

            for(let i = 0; i < files.length; i++){
                if(files[0])
                    formData.append('images[' + i + ']', files[0])
            }

            axios({
                method: 'post',
                url: '/api/works/' + this.workID + '/stats',
                data: formData
            })
            .then(() => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Статистика отправлена.'
                })

                for (let k in this.statistics){
                    this.statistics[k] = null;
                }

                this.uploadStatisticsFileTitle = 'Прикрепить отчет по статистике'
                $('#statistics-file').val(null)

                this._confirm();
            })
            .catch(() => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Не удалось отправить статистику, попробуйте позже. Возможно какие-то поля не заполнены, либо заполнены некорректно.'
                })
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
