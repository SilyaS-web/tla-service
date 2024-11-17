<script>
import axios from 'axios'


const Project = {
    create: (data) => {
        return new Promise((resolve, reject) => {
            if(!data){
                resolve(false)
            }

            var formData = new FormData;

            for (const key in data) {
                if(!['images'].includes(key))
                    formData.append(key, data[key])
            }
            for( var i = 0; i < data.images.length; i++ ){
                let file = data.images[i][0];

                file && formData.append('images[' + i + ']', file);
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
    delete: (project_id) => {
        return new Promise((resolve, reject) => {
            if(!project_id){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно удалить проект.'
                });

                resolve(false)
            }

            axios({
                method: 'delete',
                url: '/api/projects/' + project_id,
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
    stop: (project_id) => {
        return new Promise((resolve, reject) => {
            if(!project_id){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + project_id + '/stop',
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
    start: (project_id) => {
        return new Promise((resolve, reject) => {
            if(!project_id){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + project_id + '/start',
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
    activate: (project_id) => {
        return new Promise((resolve, reject) => {
            if(!project_id){
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло не так. Невозможно поменять статус проекта.'
                });

                resolve(false)
            }

            axios({
                method: 'get',
                url: '/api/projects/' + project_id + '/activate',
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

    getList: (filterData) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/projects',
                params: filterData
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

    getUsersProjectsList: (user_id, filterData = false) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/users/' + user_id + '/projects',
                params: filterData
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
    getProjectsList: () => {

    },
    getFeedbackWork(project){
        var feedbackWork = project.project_works ? project.project_works.filter(w => w.type == 'feedback') : {
            lost_quantity: 0,
            quantity: 0
        };

        if(!feedbackWork || feedbackWork.length == 0) {
            feedbackWork = {
                lost_quantity: 0,
                quantity: 0
            };
        }
        else{
            feedbackWork = {
                lost_quantity: feedbackWork[0].lost_quantity,
                quantity: parseInt(feedbackWork[0].quantity)
            }
        }

        return feedbackWork;
    },
    getIntegrationWork(project){
        var integrationWorks = project.project_works ? project.project_works.filter(w => w.type != 'feedback') : null,
            integrationWork = {
                lost_quantity: 0,
                quantity: 0
            };

        if(integrationWorks && integrationWorks.length > 0){
            integrationWork.lost_quantity = integrationWorks.map(w => w.lost_quantity).reduce((a, b) => a + b, 0);
            integrationWork.quantity = integrationWorks.map(w => parseInt(w.quantity)).reduce((a, b) => a + b, 0);
        }

        return integrationWork;
    },
};

export default Project
</script>
