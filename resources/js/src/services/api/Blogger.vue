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
    }
};

export default Blogger
</script>
