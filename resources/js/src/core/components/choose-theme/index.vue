<template>
    <div class="form-group" style="flex-direction: column;">
        <label for="">Выберите тематику</label>
        <div :class="'form-formats ' + (isThemesOpen ? 'form-formats--open' : '')">
            <div
                v-if="currentThemes.length > 0"
                @click="isThemesOpen = !isThemesOpen"
                class="form-formats__current">
                <div
                    v-for="theme in currentThemes"
                    class="form-formats__current-item">
                    {{ (themesList.find(_theme => theme == _theme.id).name) }}
                </div>
            </div>
            <span
                v-else
                @click="isThemesOpen = !isThemesOpen"
                class="form-formats__empty"
            >
                Выбрать
            </span>

            <div class="form-formats__items">
                <div
                    v-for="theme in themesList"
                    class="form__row form-format">
                    <input
                        :id="'theme-' + theme.id"
                        type="checkbox" name="themes[]" class="form-format__check"
                        :checked="currentThemes.includes(theme.id)"
                        @change="setFilterThemes(theme.id, $event)"
                    >
                    <label
                        :for="'theme-' + theme.id">
                        {{ theme.name }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";

import Themes from '../../services/api/Themes'

export default {
    props:{
        maxThemesLength: { type: Number, required: false },
        themes: {type: Array, required: false, default: null}
    },
    data(){
        return{
            isThemesOpen: ref(false),
            currentThemes: ref([]),
            themesList: ref([]),

            Themes
        }
    },
    watch:{
        themes:{
            handler(){
                if(this.themes && this.themes.length > 0) this.currentThemes = this.themes
            },
            once: true
        }
    },
    async mounted(){
        this.themesList = await this.Themes.getList();
    },
    methods:{
        setFilterThemes(themeID, event){
            if(!this.currentThemes.find(t => t === themeID)){
                if(this.maxThemesLength && this.currentThemes.length === this.maxThemesLength){
                    notify('info', {title: 'Внимание', message: 'Нельзя выбрать больше 3-х тематик'});
                    $(event.target).prop('checked', false)
                }
                else{
                    this.currentThemes.push(themeID)
                }
            }
            else{
                this.currentThemes.splice(this.currentThemes.indexOf(themeID), 1);
            }

            this.$emit('update:modelValue', this.currentThemes)
        },
    }
}
</script>
