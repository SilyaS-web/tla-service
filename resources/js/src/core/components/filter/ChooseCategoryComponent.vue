<script>
import {ref} from "vue";
import Categories from "../../services/api/Categories.vue";
import InputComponent from "../form/InputComponent.vue";

export default {
    name: "ChooseCategoryComponent",
    components: {InputComponent},
    props:['modelValue'],
    data(){
        return{
            currentCategory: ref(''),
            categories: ref([]),

            Categories
        }
    },
    methods:{
        getCategories(event){
            const value = event.target.value;

            this.Categories.getList(value)
                .then((categories) => this.categories = categories)
        },
        chooseCategory(category){
            this.currentCategory = category.theme;
            this.$emit('update:modelValue', this.currentCategory)
        },
        clearCategories(){
            window.setTimeout(() => {this.categories = []}, 150)
        }
    }
}
</script>

<template>
    <div class="form-group filter__item">
        <div class="form-group__header">
            <label for="filter-category">Категория</label>
        </div>
        <input-component
            v-bind:value="modelValue"
            v-on:input="getCategories"
            v-on:focusout="clearCategories"
            :type="'text'"
            :name="'filer-category'"
            :id="'filer-category'"
            :placeholder="'Введите категорию'"
            :class="[]"
        ></input-component>
        <div class="filter-tooltip _scrollable" v-if="categories && categories.length">
            <div class="filter-tooltip__items">
                <div
                    v-for="category in categories"
                    @click="chooseCategory(category)"
                    class="filter-tooltip__row">
                    {{ category.theme }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.filter-tooltip{
    width: 100%;
    margin: 10px 0px;
    border-radius: 10px;
    border: 1px solid rgba(0, 0, 0, .05);
    background-color: var(--pale);
    padding:10px;
    overflow-y: auto;
    max-height: 250px;
    flex: 1 1 auto;
}
.filter-tooltip__items{
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 100%;
}
.filter-tooltip__row{
    font-size: 14px;
    color:rgba(0, 0, 0, .4);
    background-color: #fff;
    border-radius: 5px;
    text-wrap: nowrap;
    padding: 10px 5px;
    text-overflow: ellipsis;
    overflow-x: hidden;
    transition: all .1s linear;
    cursor: pointer;
}

.filter-tooltip__row:hover{
    color: #000;
    font-weight:500;
}
</style>
