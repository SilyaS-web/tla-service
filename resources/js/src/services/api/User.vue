<script>
    import axios from 'axios'
    import { useRouter } from 'vue-router'

    const router = useRouter();

    const User = {
        getCurrent: () => {
            let user = localStorage.getItem('user');

            if(!user){
                router.push({ name: 'login' })
            }

            return JSON.parse(user);
        },
        auth: (data) => {
            return new Promise((resolve, reject) => {
                axios({
                    method: 'post',
                    url: '/api/login',
                    data: data
                })
                .then((response) => {
                    if(!response.data.token || !response.data.user){
                        notify('error', {
                            title: 'Внимание!',
                            message: 'Ошибка сервера, напишите в поддержку.'
                        });
                    }

                    let token = response.data.token,
                        user = response.data.user;

                    localStorage.setItem('user', JSON.stringify(user));
                    localStorage.setItem('session_token', token);

                    resolve(user)
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно авторизоваться. Проверьте все поля, если все в порядке, напишите в поддержку.'
                    });

                    resolve(errors)
                })
            })
        },

        register: (data) => {
            return new Promise((resolve, reject) => {
                axios({
                    method: 'post',
                    url: '/api/users/',
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

                    resolve(errors)
                })
            })
        },

        isBlogger: () => {
            let user = User.getCurrent();

            return user && user.role == 'blogger'
        },

        isSeller: () => {
            let user = User.getCurrent();

            return user && user.role == 'seller'
        }
    };

    export default User
</script>
