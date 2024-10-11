<script>
    import axios from 'axios'
    import { useRouter } from 'vue-router'

    const User = {
        getCurrent: () => {
            let user = localStorage.getItem('user');

            const router = useRouter();

            if(!user){
                router.push({ name: 'Login' })
            }

            return JSON.parse(user);
        },
        getUser(){
            return new Promise((resolve, reject) => {
                let user = localStorage.getItem('user');

                const router = useRouter();

                if(!user){
                    router.push({ name: 'Login' })
                }

                user = JSON.parse(user);

                axios({
                    method:'get',
                    url: '/api/users/' + user.id
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    resolve(response.data.user)
                })
            })
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
                        user = response.data.user,
                        show_tariffs = response.data.show_tariffs;

                    localStorage.setItem('user', JSON.stringify(user));
                    localStorage.setItem('session_token', token);
                    localStorage.setItem('show_tariffs', show_tariffs);

                    resolve(user)
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно авторизоваться. Проверьте все поля, если все в порядке, напишите в поддержку.'
                    });

                    reject(errors)
                })
            })
        },

        register: (data) => {
            return new Promise((resolve, reject) => {
                axios({
                    method: 'post',
                    url: '/api/users',
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

                    resolve(response.data)
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Невозможно зарегистрироваться. Проверьте все поля, если все в порядке, напишите в поддержку.'
                    });

                    reject(errors)
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
        },

        getWorks(user_id, orderBy = 'desc', is_active = 1, _with = ['project']){
            return new Promise((resolve, reject) => {
                var params = {is_active: is_active};

                if(orderBy)
                    params.order_by_last_message = orderBy;

                if(_with)
                    params.with = _with;

                axios({
                    method: 'get',
                    url: 'api/users/' + user_id + '/works',
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

        getMessages(work_id, user_id){
            return new Promise((resolve, reject) => {
                axios({
                    method: 'get',
                    url: 'api/users/' + user_id + '/works/' + work_id + '/messages'
                })
                .then(response => {
                    resolve(response.data.messages);
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
    };

    export default User
</script>
