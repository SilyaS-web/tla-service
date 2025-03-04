<script>
import axios from 'axios'

const Statistics = {
    getStatistics: (startDate = null, endDate = null) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/stats',
                params:{
                    start: startDate,
                    end: endDate
                }
            })
            .then(response => {
                resolve(response.data.report)
            })
            .catch(error => {
                reject(error)
            })
        })
    },

};

export default Statistics
</script>
