<template>
    <div class="form-group" style="flex-direction: column; margin-bottom:25px">
        <label for="">Выберите тематику</label>
        <div class="form-formats">
            <div
                v-for="theme in themes"
                class="form__row form-format">
                <input
                    :id="'theme-' + theme.id"
                    :value="theme.id"
                    @click="chooseTheme($event)"
                    type="checkbox"
                    name=""
                    class="form-format__check">
                <label :for="'theme-' + theme.id">{{ theme.name }}</label>
            </div>
        </div>
        <span class="error" v-if="error">{{ error }}</span>
    </div>
</template>
<script>
export default{
    props:['themes', 'error'],
    data(){
        return{

        }
    },
    methods:{
        chooseTheme(e){
            var list = $('.form-format .form-format__check:checked');

            if(list.length > 3){
                $(e.target).prop('checked', false);
                notify('info', {title: 'Внимание', message: 'Нельзя выбрать больше 3-х тематик'});
            }
        },
    }
}
</script>
