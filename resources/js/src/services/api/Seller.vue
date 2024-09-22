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
    save: (id, formData) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/api/sellers/' + id,
                data: formData
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

                reject(data)
            })
        })
    },
};

export default Seller
</script>
