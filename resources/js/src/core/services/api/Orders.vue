<script>
import axios from 'axios'

const Orders = {
    getList: () => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/payments',
            })
            .then(response => {
                resolve(response.data.payments)
            })
            .catch(error => {
                notify('error', {
                    title: 'Внимание',
                    message: 'Неудалось получить список оплат'
                });
                reject(error)
            })
        })
    },

};

export default Orders
</script>
