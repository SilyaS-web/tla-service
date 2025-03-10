<template>
    <div class="admin-view__content data-table" id="data-table">
        <div class="">
            <textarea
                name=""
                id=""
                cols="30"
                rows="10"
                v-model="speechRecognitionResult"
            ></textarea>
            <button
                @click="listenToSpeech"
                class="btn btn-primary">play</button>
            <button
                @click="getSql"
                class="btn btn-primary">get</button>
        </div>
    </div>
</template>
<script>
import {ref} from "vue";
import OpenAI from 'openai'

export default {
    name: "index",
    data(){
        return{
            openAI: null,
            speechRecognition: null,
            speechRecognitionResult:  ref('')
        }
    },
    mounted(){
        this.openAI = new OpenAI({
            baseURL: 'https://api.deepseek.com/beta',
            apiKey: '',
            dangerouslyAllowBrowser: true
        });
    },
    methods:{
        listenToSpeech(){
            if(this.speechRecognition) {
                this.speechRecognition.stop()
                return
            }

            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.speechRecognition = new SpeechRecognition();

            this.speechRecognition.lang = "ru-RU";

            const self = this;

            this.speechRecognition.onresult = function(event) {
                console.log(event.results[0][0].transcript)
                self.speechRecognitionResult = event.results[0][0].transcript
                self.speechRecognition = null
                self.getSql()
            };

            this.speechRecognition.start();
        },
        async getSql(){
            const response = await this.openAI.completions.create({
                model: 'deepseek-chat',
                prompt: `Преврати эту строку на обычном языке в SQL запрос: ${this.speechRecognitionResult}.`,

            });

            console.log(response)
        },
    }
}
</script>

<style scoped>

</style>
