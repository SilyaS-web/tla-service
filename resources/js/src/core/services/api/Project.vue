<script>
import axios from 'axios'

const Project = {
    /**
     *
     * @param data = {
     *    project_type: String,
     *    product_name: String,
     *    category: String,
     *    is_blogger_access: Number,
     *    statuses: Array,
     * }
     * @returns {Promise<unknown>}
     */
    getList: (data) => {
        return new Promise((resolve, reject) => {
            let params = {};

            for (const key in data) {
                if(data[key]) params[key] = data[key]
            }

            axios({
                method: 'get',
                url: '/api/projects',
                params: params
            })
            .then(response => {
                resolve(response.data.projects);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Не удалось загрузить проекты, попробуйте зайти позже или обратитесь в поддержку.'
                })

                resolve([])
            })
        })
    },
    /**
     *
     * @param data = { }
     * @returns {Promise<unknown>}
     */
    create: (data) => {
        return new Promise((resolve, reject) => {
            if(!data){
                resolve(false)
            }

            let formData = new FormData;

            for (const key in data) {
                if(!['images', 'integration_types'].includes(key))
                    formData.append(key, data[key])
            }
            for( let i = 0; i < data.images.length; i++ ){
                let file = data.images[i];

                file && formData.append('images[' + i + ']', file);
            }
            for( let i = 0; i < data.integration_types.length; i++ ){
                formData.append('integration_types[' + i + ']', data.integration_types[i]);
            }

            axios({
                method: 'post',
                url: '/api/projects',
                data: formData,
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                resolve(response.data)
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
    /**
     *
     * @param data = { }
     * @returns {Promise<unknown>}
     */
    update: (projectID, data) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/projects/' + projectID,
                data: data
            })
            .then((data) =>{
                notify('info', {title: 'Успешно!', message: 'Данные успешно обновлены.'});
                resolve(data)
            })
            .catch((err) => {
                let message =  (err.response.data && err.response.data.message) ?
                    err.response.data.message :
                    'Невозможно сохранить проект, перепроверьте все поля, данные не заполнены, либо заполнены некоректно.';

                notify('info', {title: 'Внимание!', message: message});

                reject(err.response.data)
            })
        })
    },
    delete: (projectID) => {
        return new Promise((resolve, reject) => {
            if(!projectID){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно удалить проект.'
                });

                resolve(false)
            }

            axios({
                method: 'delete',
                url: '/api/projects/' + projectID,
            })
            .then((response) => {
                resolve(true)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Ошибка на сервере, попробуйте позже.'
                });

                resolve(false)
            })
        })
    },
    stop: (projectID) => {
        return new Promise((resolve, reject) => {
            if(!projectID){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + projectID + '/stop',
            })
            .then((response) => {
                resolve(true)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Ошибка на сервере, попробуйте позже.'
                });
                resolve(false)
            })
        })
    },
    start: (projectID) => {
        return new Promise((resolve, reject) => {
            if(!projectID){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + projectID + '/start',
            })
            .then((response) => {
                resolve(true)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Ошибка на сервере, попробуйте позже.'
                });

                resolve(false)
            })
        })
    },
    activate: (projectID) => {
        return new Promise((resolve, reject) => {
            if(!projectID){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + projectID + '/activate',
            })
            .then((response) => {
                resolve(true)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: errors.response.data.message ? errors.response.data.message : 'Что-то пошло не так. Ошибка на сервере, попробуйте позже.'
                });

                resolve(false)
            })
        })
    },
    getStatistics: (projectID) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/projects/' + projectID + '/statistics',
            })
                .then(result => {
                    resolve(result)
                })
                .catch(error => {
                    reject(false)
                })
        })
    },
};

export default Project
</script>
