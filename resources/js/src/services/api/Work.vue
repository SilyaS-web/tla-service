<script>
import axios from 'axios'

const Work = {
    getProjectsList: (project, status = false) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: 'api/projects/' + project.id +  '/works' + (status ? '?status=' + status : '')
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
    getUserWorksList: (user_id, created_by = false, is_active = 0, filterData = false) => {
        return new Promise((resolve, reject) => {
            var params = {is_active: is_active};

            if(created_by)
                params.created_by = created_by;

            if(filterData){
                for(let k in filterData){
                    if(filterData[k])
                        params[k] = filterData[k]
                }
            }

            axios({
                method: 'get',
                url: 'api/users/' + user_id +  '/works',
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
    deny(work_id){
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: 'api/works/' + work_id + '/deny'
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
    accept(work_id){
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: 'api/works/' + work_id + '/accept'
            })
            .then(response => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Заявка от блогера принята.'
                })

                resolve(true);
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Что-то пошло нет так, попробуйте зайти позже или обратитесь в поддержку.'
                })

                reject(false)
            })
        })
    },
};

export default Work
</script>
