<template>
    <div class="form-group form-group--file">
        <label class="tab-content__profile-img-upload input-file" for="profile-img">
            <div class="input-file__col">
                <span class = "input-file__notify">{{ label }}</span>
                <span class = "input-file__file-name"></span>
            </div>
            <input
                @change="uploadImage"
                v-bind:value="modelValue"
                v-on:input="$emit('update:modelValue', $event.target.value)"
                type="file" name="image" class="" id="profile-img">
        </label>
        <span class="error" v-if="errors.image">{{ errors.image }}</span>
    </div>
</template>
<script>
export default{
    props: ['modelValue', 'label', 'uploadedLabel', 'error'],
    methods:{
        uploadImage(event){
            var file = event.currentTarget.files[0];

            $(event.currentTarget).closest('.tab-content__profile-img-upload').addClass('uploaded');
            $(event.currentTarget).closest('.tab-content__profile-img-upload').find('span.input-file__notify').text('Аватарка профиля загружена');
            $(event.currentTarget).closest('.tab-content__profile-img-upload').find('span.input-file__file-name').text(file.name);
        }
    }
}
</script>
