<script>
import axios from 'axios'


const Platforms = {
    getList: () => {
        return new Promise((resolve, reject) => {
            var platforms = localStorage.getItem('platforms') ? JSON.parse(localStorage.getItem('platforms')) : false;

            if(platforms && platforms.length > 0){
                resolve(platforms)
                return;
            }

            axios({
                method: 'get',
                url: '/api/platforms'
            })
            .then(response => {
                var platforms = response.data.platforms || [];
                localStorage.setItem('platforms', JSON.stringify(platforms))
                resolve(platforms);
            })
            .catch((errors) => {
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
