<script>
import axios from 'axios'

const Statistics = {
    getReferralsData: () => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/referrals',
            })
            .then(response => {
                resolve(response.data.referral_codes)
            })
            .catch(error => {
                notify('danger', {
                    title: 'Внимание',
                    message: 'Не удалось получить данные'
                })
                reject(error)
            })
        })
    },

};

export default Statistics
</script>
