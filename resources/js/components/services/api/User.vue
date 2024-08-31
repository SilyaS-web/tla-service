<script>
    import axios from 'axios'

    const User = {
        getCurrent: () => {
            //local storage or request
        },
        auth: (data) => {
            return new Promise((resolve, reject) => {
                axios({
                    method: 'post',
                    url: '/api/users/login/',
                    data: data
                })
                .then((response) => {
                    resolve(response.data)
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно авторизоваться. Проверьте все поля, если все в порядке, напишите в поддержку.'
                    });

                    resolve(response.data)
                })
            })
        },

        register: (data) => {
            return new Promise((resolve, reject) => {
                axios({
                    method: 'post',
                    url: '/api/users/register/',
                    data: data
                })
                .then((response) => {
                    resolve(response.data)
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно зарегистрироваться. Проверьте все поля, если все в порядке, напишите в поддержку.'
                    });

                    resolve(response.data)
                })
            })
        }
    };

    export default User
</script>
