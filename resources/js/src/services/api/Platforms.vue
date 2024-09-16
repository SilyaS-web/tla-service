<script>
import axios from 'axios'


const Platforms = {
    getList: () => {
        return new Promise((resolve, reject) => {
            var platforms = localStorage.getItem('platforms') ? JSON.parse(localStorage.getItem('platforms')) : false;

            if(platforms && platforms.length > 0){
                resolve(platforms)
            }

            axios({
                method: 'get',
                url: 'api/platforms'
            })
            .then(response => {
                localStorage.setItem('platforms', JSON.stringify(response.data.platforms))
                resolve(response.data.platforms);
            })
            .catch((errors) => {
                console.log(errors);
                // notify('error', {
                //     title: 'Внимание!',
                //     message: 'Не удалось загрузить проекты, попробуйте зайти позже или обратитесь в поддержку.'
                // })

                resolve([])
            })
        })
    },

};

export default Platforms
</script>
