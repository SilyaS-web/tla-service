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
                formData.append('images[' + i + ']', file);
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
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно создать проект. Проверьте все поля, если все в порядке, напишите в поддержку.'
                });

                resolve(errors)
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

                console.log(errors)

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

                console.log(errors)

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

                console.log(errors)

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
                    message: 'Что-то пошло не так. Ошибка на сервере, попробуйте позже.'
                });

                console.log(errors)

                resolve(false)
            })
        })
    },

    getList: (filterData) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: 'api/projects',
                params: filterData
            })
            .then(response => {

                resolve(response.data.projects);
            })
            .catch((errors) => {
                console.log(errors);

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
                url: 'api/users/' + user_id + '/projects',
                params: filterData
            })
            .then(response => {
                resolve(response.data.projects);
            })
            .catch((errors) => {
                console.log(errors);

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
};

export default Project
</script>
