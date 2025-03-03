<script>
import axios from 'axios'

const Work = {
    getProjectsList: (project, status = false) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/projects/' + project.id +  '/works' + (status ? '?status=' + status : '')
            })
            .then(response => {
                resolve(response.data.works);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                })

                resolve([])
            })
        })
    },

    /**
     * @param user_id Number
     * @param data = {
     *     created_by: String | Boolean,
     *     is_active: Number [0,1],
     *     product_name: String,
     *     project_type: String,
     *     category: String,
     *     _with: Array,
     *     order_by_last_message: String
     * }
     * @returns {Promise<unknown>}
     */
    getUserWorksList: (user_id, data = {}) => {
        return new Promise((resolve, reject) => {
            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            axios({
                method: 'get',
                url: '/api/users/' + user_id +  '/works',
                params: params
            })
            .then(response => {
                resolve(response.data.works);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                })

                resolve([])
            })
        })
    },

    /**
     * @param data = {
     *     blogger_ids: Array | Null,
     *     project_work_id: Number | Null,
     *     project_work_names: Array | Null,
     *     message: String | Null,
     * }
     * @returns {Promise<boolean>}
     */
    sendOffer: (data) => {
        return new Promise((resolve, reject) => {
            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            axios({
                url: '/api/works',
                method: 'post',
                data: params
            })
            .then((data) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заявка отправлена.'
                });

                resolve(true)
            })
            .catch(errors => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Попробуйте позже.'
                })

                reject(false)
            })
        })
    },
    deny(work_id){
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/works/' + work_id + '/deny'
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заявка от блогера отклонена.'
                })

                resolve(true);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                })

                resolve(false)
            })
        })
    },
    cancel(work_id){
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/works/' + work_id + '/cancel'
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Статус работы поменялся.'
                })

                resolve(true);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                })

                resolve(false)
            })
        })
    },
    accept(work_id){
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/works/' + work_id + '/accept'
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заявка принята.'
                })

                resolve(true);
            })
            .catch((errors) => {
                let text = 'Невозможно создать проект. Проверьте все поля, если все в порядке, напишите в поддержку.';

                if(errors.response.data.message)
                    text = errors.response.data.message;

                notify('error', {
                    title: 'Внимание!',
                    message: text
                });

                reject(errors)
            })
        })
    },
};

export default Work
</script>
