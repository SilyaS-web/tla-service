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

        return user;
    },
    auth: (data) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: 'api/login',
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

                    localStorage.setItem('user', user);
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

    updateGraphicsData(){

    }

};

export default User
</script>
