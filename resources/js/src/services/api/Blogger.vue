<script>
import axios from 'axios'

const Blogger = {
    getCurrent: () => {
        //local storage or request
    },
    put: (data) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/bloggers/',
                data: data
            })
            .then((response) => {
                resolve(response.data)
            })
            .catch((errors) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно сохранить данные.'
                });

                resolve(response.data)
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
            var filterString = '';

            if(filterData){
                var keys = Object.keys(filterData);

                keys.forEach(k => {
                    if(filterData[k])
                        filterString += `${k}=${filterData[k]}`
                })
            }

            axios({
                method: 'get',
                url: '/api/bloggers',
                params: {
                    statuses: status || [],
                    filter: filterData
                }
            })
            .then(result => resolve(result.data.bloggers))
            .catch(error => {
                console.log(error)
                resolve([])
            })
        })
    },
};

export default Blogger
</script>
