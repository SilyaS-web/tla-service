<script>
    import axios from 'axios'
    import { useRouter } from 'vue-router'

    const User = {
        // need refactor
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
        getCurrentUser(){
            return new Promise((resolve, reject) => {
                axios({
                    method:'get',
                    url: '/api/users/current'
                })
                .then((response) => {
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                    resolve(response.data.user)
                })
            })
        },
        // need refactor

        //auth methods
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

        /**
         * @param userID
         * @param data = {
         *     image: file|null
         * }
         */
        update: (userID, data) => {
           return new Promise((resolve, reject) => {
                let formData = new FormData;

               for (const key in data) {
                   if(data[key]) formData.append(key, data[key])
                   if(key === 'image' && data[key] === null) formData.append(key, data[key])
               }

               axios({
                   method: 'patch',
                   url: '/api/users/' + userID,
                   data: formData
               })
               .then((response) => {
                   notify('info', {
                       title: 'Успешно!',
                       message: 'Пользователь успешно обновился.'
                   });

                   resolve(response.data)
               })
               .catch((errors) => {
                   notify('error', {
                       title: 'Внимание!',
                       message: 'Возникла ошибка, попробуйте позже.'
                   });

                   reject(errors)
               })
           })
        },
        banUser(user_id){
            return new Promise((resolve, reject) => {
                axios({
                    method: 'get',
                    url: '/api/users/' + user_id + '/ban',
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Пользователь заблокирован!'
                    });

                    resolve(response)
                })
                .catch(error => {
                    notify('info', {
                        title: 'Внимание',
                        message: 'Не удалось заблокировать пользователя'
                    });

                    reject(error)
                })
            })
        },
        unbanUser(user_id){
            return new Promise((resolve, reject) => {
                axios({
                    method: 'get',
                    url: '/api/users/' + user_id + '/unban',
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Пользователь разаблокирован!'
                    });

                    resolve(response)
                })
                .catch(error => {
                    notify('info', {
                        title: 'Внимание',
                        message: 'Не удалось разаблокировать пользователя'
                    });

                    reject(error)
                })
            })
        },
        deleteUser(user_id){
            return new Promise((resolve, reject) => {
                axios({
                    method: 'delete',
                    url: '/api/users/' + user_id,
                })
                .then((response) => {
                    notify('info', {
                        title: 'Успешно!',
                        message: 'Пользователь удален!'
                    });

                    resolve(response)
                })
                .catch(error => {
                    notify('info', {
                        title: 'Внимание',
                        message: 'Не удалось удалить пользователя'
                    });

                    reject(error)
                })
            })
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
                    url: '/api/users/' + user_id + '/works',
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
                    url: '/api/users/' + user_id + '/works/' + work_id + '/messages'
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
        getStatistics(id = null){
            if(!id){
                id = User.getCurrent().id
            }

            return new Promise((resolve, reject) => {
                axios({
                    method: 'get',
                    url: '/api/users/' + id + '/dashboard'
                })
                .then(response => {
                    resolve(response.data);
                })
                .catch((errors) => {
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Не удалось загрузить статистику, попробуйте зайти позже или обратитесь в поддержку.'
                    })

                    reject(false)

                    resolve({
                        total_feedbacks_count: 0,
                        avg_feedbacks_value: 0,
                        products_bad_feedbacks: [],
                        products_good_feedbacks: [],
                        products_great_feedbacks: [],
                        products_few_feedbacks_count: [],
                        products_normal_feedbacks_count: [],
                        unanswered_feedbacks_count: 0,
                        total_clicks: 0,
                        statistics: {},
                        is_wb_api_key: false,
                        feedback_ratio: 0
                    })
                })
            })
        },

        /**
         *
         * @param user_id
         * @param filterData = {
         *     project_type: string,
         *     product_name: string
         * }
         * @returns {Promise<unknown>}
         */
        getProjects: (user_id, filterData = {}) => {
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
    };

    export default User
</script>
