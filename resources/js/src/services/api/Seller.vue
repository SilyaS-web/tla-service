<script>
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter();

const Seller = {
    getItem: (id) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/seller/' + id,
            })
            .then((response) => {
                if(!response.data.id){
                    notify('error', {
                        title: 'Внимание!',
                        message: 'Ошибка сервера, напишите в поддержку.'
                    });
                }

                resolve(response.data)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Ошибка сервера, напишите в поддержку.'
                });

                console.log(data)

                resolve(false)
            })
        })
    },
};

export default Seller
</script>
