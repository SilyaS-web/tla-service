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
    put: (id, formData) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/bloggers/' + id,
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

                reject(errors)
            })
        })
    },

    update: (data) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/bloggers/' + data.id + '/update/',
                data: data
            })
            .then((response) => {
                resolve(response.data)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно обновить данные.'
                });

                resolve(response.data)
            })
        })
    },

    getList(status = [], filterData = {}){
        return new Promise((resolve, reject) => {
            var params = {
                statuses: status || [],
            };

            if(filterData){
                var keys = Object.keys(filterData);

                keys.forEach(k => {
                    params[k] = filterData[k]
                })
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
