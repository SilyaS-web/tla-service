<script>
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter();

const Seller = {
    getItem: (id) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/sellers/' + id,
            })
            .then((response) => {
                resolve(response.data.seller)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно получить информацию по селлеру, напишите в поддержку или попробуйте позже'
                });

                console.log(data)

                resolve(false)
            })
        })
    },
    save: (data) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'put',
                url: '/api/sellers/' + data.id,
                params: data
            })
            .then((response) => {
                resolve(response.data)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно сохранить информацию по селлеру, напишите в поддержку или попробуйте позже'
                });

                console.log(data)

                resolve(data)
            })
        })
    },
};

export default Seller
</script>
