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
            <div
                v-else
                @click="isThemesOpen = !isThemesOpen"
                class="form-formats__empty"
            >
                Выбрать
            </div>

            <div class="format__icon">
                <select-arrow-icon></select-arrow-icon>
            </div>

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
import SelectArrowIcon from "../../icons/SelectArrowIcon.vue";

export default {
    components: {SelectArrowIcon},
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
<style>
.format__icon svg {
    width: 100%;
    transition: all .1s linear;
}
.format__icon svg path {
    fill: #B3B3B3;
    transition: all .1s linear;
}
.form-formats:hover svg path,
.form-formats--open svg path{
    fill:var(--text);
}
.form-formats--open .format__icon{
    transform: rotate(180deg);
}
</style>
<style scoped>
.form-formats{
    display: flex;
    flex-direction: column;
    cursor: pointer;
    position: relative;
}
.form-formats--pick{
    flex-direction: row;
    flex-wrap: wrap;
    border: 1px solid #F5F5F5;
    max-height:250px;
    overflow-y: auto;
    gap: 5px;
    padding: 5px;
}
.form-group label{
    margin-bottom: 20px;
}
.form-formats--pick::-webkit-scrollbar {
    width: 12px;               /* ширина scrollbar */
}
.form-formats--pick::-webkit-scrollbar-track {
    background: unset;        /* цвет дорожки */

}
.form-formats--pick::-webkit-scrollbar-thumb {
    background-color: #7A7674;    /* цвет плашки */
    border-radius: 20px;       /* закругления плашки */
    border: 3px solid #fff;  /* padding вокруг плашки */
}
.form-formats--pick .form-format{
    width: -moz-fit-content;
    width: fit-content;
}
.format__icon{
    width: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    right:12px;
    top: 19px;
    transition: all .1s linear;
}
.form-formats__current{
    color: var(--text);
    padding: 13px;
    padding-right: 21px;
    display: flex;
    gap: 3px;
    flex-wrap: wrap;
    font-size: 12px;
    position: relative;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 10px;
    transition: all .1s linear;
}
.form-formats__empty{
    font-weight: 500;
    color: var(--text-non-accent);
    padding: 13px;
    display: flex;
    gap: 3px;
    flex-wrap: wrap;
    font-size: 16px;
    position: relative;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: 10px;
    transition: all .1s linear;
}
.form-formats--open .form-formats__current,
.form-formats--open .form-formats__empty{
    border-color:var(--primary);
}
.form-formats:hover .form-formats__current,
.form-formats:hover .form-formats__empty{
    border-color:#544F4F;
}
.form-formats__current-item{
    font-size: 14px;
    padding: 3px;
    border: 1px solid rgba(0,0,0,.3);
    border-radius: 5px;
}
.form-formats__items{
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    max-height: 0;
    overflow-y: auto;
    transition: all .2s linear;
    border-radius: 0 0 10px 10px;
    padding-left: 13px;
    border:1px solid #F5F5F5;
}
.form-formats--open .form-formats__items{
    max-height: 250px;
}
.form-formats__items::-webkit-scrollbar {
    width: 12px;               /* ширина scrollbar */
}
.form-formats__items::-webkit-scrollbar-track {
    background: unset;        /* цвет дорожки */

}
.form-formats__items::-webkit-scrollbar-thumb {
    background-color: #7A7674;    /* цвет плашки */
    border-radius: 20px;       /* закругления плашки */
    border: 3px solid #fff;  /* padding вокруг плашки */
}
.form-format{
    background-color: var(--pale);
    padding: 5px;
    display: flex;
    gap: 5px;
    align-items: center;
    border: 1px solid #F5F5F5;
    border-radius: 6px;
    transition: all .1s linear;
}
.form-format label{
    margin-bottom: 0;
    transition: all .1s linear;
}
.form-format input[type="checkbox"]{
    display: none;
}
.form-format:has(input[type="checkbox"]:checked){
    border-color:var(--primary)
}
.form-format:has(input[type="checkbox"]:checked) label{
    color: var(--primary);
}
</style>
