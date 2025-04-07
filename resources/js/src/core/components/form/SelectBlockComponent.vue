<template>
    <div
        :class="['form-group', selectWrapClassString]">
        <div
            v-if="label"
            class="form-group__header">
            <label :for="selectID">{{ label }}</label>
        </div>
        <div
            :id="selectID"
            :data-name="selectID"
            :class="['select', selectClassString, (isActive ? 'active' : '')]"
            @click="toggleSelect">
            <div class="select__selected">
                <div :class="['select__name', (selectedItem ? 'select__name--selected' : '')]">
                    {{ getSelectedTitle() }}
                </div>
                <div class="select__icon">
                    <select-arrow-icon></select-arrow-icon>
                </div>
            </div>
            <div class="select__items">
                <div
                    v-for="option in optionsList"
                    :data-value="option.value"
                    @click="selectItem(option)"
                    class="select__item"
                >
                    {{ option.name }}
                </div>
            </div>
        </div>
        <span v-if="error" class="error">{{ error }}</span>
    </div>
</template>
<script>
import {ref} from "vue";
import SelectArrowIcon from "../../icons/SelectArrowIcon.vue";

export default{
    components: {SelectArrowIcon},
    props:[
        'label', 'error', 'modelValue', 'selectClassList', 'wrapClassList',
        'selectID', 'optionsList', 'placeholder'
    ],
    data(){
        return {
            isActive: ref(false),
            selectedItem: ref(null),
        }
    },
    watch:{
        modelValue(){
            if(this.selectedItem.value !== this.modelValue){
                this.selectedItem = this.optionsList.find(item => item.value === this.modelValue);
            }
        }
    },
    computed:{
        selectClassString(){
            return this.selectClassList && this.selectClassList.length > 0 ? this.selectClassList.join(' ') : ''
        },
        selectWrapClassString(){
            return this.wrapClassList && this.wrapClassList.length > 0 ? this.wrapClassList.join(' ') : ''
        },
    },
    methods:{
        toggleSelect(){ this.isActive = !this.isActive },
        getSelectedTitle(){
            if(this.selectedItem) return this.selectedItem.name

            if(this.placeholder) return this.placeholder

            return 'Не выбрано'
        },
        selectItem(item){
            this.selectedItem = item
            this.$emit('update:modelValue', this.selectedItem.value)
        }
    }
}
</script>
<style>
.select:hover svg path{
    fill:var(--text);
}
.select.active svg{
    transform: rotate(180deg);
}
.select.active svg path{
    fill:var(--text);
}
.select__icon svg{
    width: 100%;
    transition: all .1s linear;
}
.select__icon svg path{
    fill:#B3B3B3;
    transition: all .1s linear;
}
</style>
<style scoped>
    .form-group:has(.select.active){
        z-index: 3;
    }

    .select{
        border-radius: 8px;
        border:1px solid rgba(0,0,0,.2);
        padding: 12px;
        width:auto;
        transition: all .1s linear;
        position: relative;
    }
    .select:hover{
        border-color:#544F4F;
    }

    .select.active{
        border-color:var(--primary);
    }

    .select__selected{
        display:flex;
        justify-content: space-between;
        align-items:center;
        gap: 8px;
    }
    .select__name{
        font-size: 16px;
        font-weight: 500;
        color:var(--text-non-accent);
        overflow: hidden;
        text-wrap: nowrap;
        text-overflow: ellipsis;
    }
    .select__name.select__name--selected{
        color:var(--text);
    }
    .select__icon{
        width: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .select__items{
        flex-direction: column;
        gap: 2px;
        position: absolute;
        left: -2px;
        top: calc(100% + 1px);
        width: calc(100% + 4px);
        background-color: #fff;
        opacity: 0;
        display: none;
        padding: 4px 2px;
        transition: all .1s linear;
        border-radius: 0 0 12px 12px;
    }
    .select.active .select__items{
        opacity:1;
        display:flex;
    }
    .select__item{
        padding: 10px;
        font-size: 16px;
        font-weight: 500;
        color:var(--text);
        border:1px solid rgba(0,0,0,.2);
        border-radius: 8px;
        transition:all .1s linear;
        cursor:pointer;
    }
    .select__item.selected,
    .select__item:hover
    {
        color:#fff;
        background-color: var(--primary);
        border-color: var(--primary);
    }

    @media(max-width:675px){
        .select__selected, .select__name, .select__item{
            font-size: 14px;
        }
    }
</style>
