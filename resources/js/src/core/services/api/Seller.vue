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

                    resolve(false)
                })
        })
    },
    getList: () => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/sellers',
            })
            .then((response) => {
                resolve(response.data.sellers)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно получить список селлеров. Попробуйте позже, либо обратитесь в поддержку'
                });

                resolve(false)
            })
        })
    },
    /**
     * @param sellerID number
     * @param data = {
     *     name: string,
     *     email: string|null,
     *     image: file|null,
     *     inn: string|null,
     *     old_password: string|null,
     *     password: string|null,
     *     organization_name: string|null,
     *     organization_type: string|null,
     *     ozon_api_key: string|null,
     *     ozon_client_id: string|null,
     *     wb_api_key: string|null,
     *     wb_link: string|null,
     * }
     * @returns {Promise<unknown>}
     */
    update: (sellerID, data) => {
        return new Promise((resolve, reject) => {
            let formData = new FormData;

            for(let k in data){
                if(data[k]) formData.append(k, data[k])
            }

            axios({
                method: 'post',
                url: '/api/sellers/' + sellerID,
                data: formData
            })
            .then((response) => {
                notify('info', {
                    title: 'Успешно!',
                    message: 'Данные успешно изменены.'
                });

                resolve(response.data)
            })
            .catch((data) => {
                notify('error', {
                    title: 'Внимание!',
                    message: 'Невозможно сохранить информацию по селлеру, напишите в поддержку или попробуйте позже'
                });

                reject(data)
            })
        })
    },
};

export default Seller
</script>
