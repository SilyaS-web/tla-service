<script>
import axios from 'axios'

const Categories = {
    getList: (name = null) => {
        return new Promise((resolve, reject) => {
            axios({
                method: 'get',
                url: '/api/projects/categories',
                params:{
                    category: name
                }
            })
            .then(response => {
                resolve(response.data.categories)
            })
            .catch(error => {
                reject(error)
            })
        })
    },

};

export default Categories
</script>
