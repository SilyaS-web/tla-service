<script>
import axios from 'axios'

const Blogger = {
    getItem: (id) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/bloggers/' + id,
            })
            .then((response) => {
                resolve(response.data.blogger)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно получить информацию по блогеру, напишите в поддержку или попробуйте позже'
                });

                resolve(false)
            })
        })
    },
    /**
     * @param bloggerID number
     * @param data = {
     *     name: string,
     *     email: string|null,
     *     image: file|null,
     *     old_password: string|null,
     *     password: string|null,
     *     country_id: number,
     *     description: string|null,
     *     sex: string,
     *     city: string,
     *     themes: array|null,
     *     from_moderation: boolean|null,
     * }
     * @returns {Promise<unknown>}
     */
    update: (bloggerID, data) => {
        return new Promise((resolve, reject) => {
            let formData = new FormData;

            for(let k in data){
                if(data[k] && !['themes'].includes(k))
                    formData.append(k, data[k])
            }

            if(data.themes){
                for (let i = 0; i < data.themes.length; i++){
                    formData.append('themes[' + i + ']', data.themes[i])
                }
            }

            axios({
                method: 'post',
                url: '/api/bloggers/' + bloggerID,
                data: formData
            })
            .then((response) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Данные успешно изменены.'
                });

                resolve(response.data)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно сохранить данные.'
                });

                reject(errors.response.data)
            })
        })
    },

    /**
    *
    * @param data = {
    *    status: [],
    *    name: '',
    *    platform: '',
    *    city: '',
    *    country: '',
    *    themes: [],
    *    sex: [],
    *    subscriber_quantity_min: false,
    *    subscriber_quantity_max: false,
    *    has_content: 0,
    *    limit: [from, count]
    * }
    * @returns {Promise<unknown>}
    */
    getList(data = {}){
        return new Promise((resolve, reject) => {
            let params = {}

            for (const key in data) {
                if(data[key]){
                    params[key] = data[key]
                }
            }

            axios({
                method: 'get',
                url: '/api/bloggers',
                params: params
            })
            .then(result => resolve(result.data.bloggers))
            .catch(error => {
                resolve([])
            })
        })
    },

    sendToModeration(blogger_id, data){
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/bloggers/' + blogger_id,
                data: data
            })
            .then((data) => {
                resolve(true)
            })
            .catch((err) =>{
                notify('error', {title: 'Ошибка', message: 'Не удалось сохранить данные, проверьте все поля, если все в порядке напишите в поддержку.'});

                reject(err.response.data)
            })
        })
    },
};

export default Blogger
</script>
