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
import axios from 'axios'

export default {
    name: "index",
    data(){
        return{
            // openAI: null,
            speechRecognition: null,
            speechRecognitionResult:  ref('')
        }
    },
    mounted(){
        // this.openAI = new OpenAI({
        //     baseURL: 'https://api.deepseek.com/beta',
        //     apiKey: '',
        //     dangerouslyAllowBrowser: true
        // });
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
            axios({
                method: 'post',
                url: 'https://app.text2sql.co/api/v1/sql',
                headers: {
                    "Authorization": "Bearer"
                },
                data:{
                    "query": this.speechRecognitionResult,
                    "dialect": 'pg_sql',
                    "tables": [
                        {
                            "name": 'users',
                            "columns": [
                                'id', 'name', 'email',
                                'phone', 'image', 'role',
                                'status', 'created_at', 'updated_at'
                            ],
                        },
                        {
                            "name": 'sellers',
                            "columns": [
                                'id', 'user_id', 'organization_type',
                                'is_achievement', 'inn', 'is_agent',
                                'description', 'organization_name', 'finish_date',
                                'wb_link', 'wb_api_key', 'ozon_link',
                                'ozon_api_key', 'ozon_client_id', 'created_at',
                                'updated_at', 'deleted_at',
                            ],
                        },
                    ],
                }
            })
            .then(res => console.log(res))
        },
    }
}
</script>

<style scoped>

</style>
