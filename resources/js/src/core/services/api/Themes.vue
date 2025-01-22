<script>
import axios from 'axios'


const Themes = {
    getList: () => {
        return new Promise((resolve, reject) => {
            var themes = localStorage.getItem('themes') ? JSON.parse(localStorage.getItem('themes')) : false;

            if(themes && themes.length > 0){
                resolve(themes)
            }

            axios({
                method: 'get',
                url: '/api/themes'
            })
            .then(response => {
                var themes = response.data.themes || [];
                localStorage.setItem('themes', JSON.stringify(themes))
                resolve(themes);
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

export default Themes
</script>
