<script>
    const Loader = {
        // Принимает селлектор элемента, куда нужно вставить загрузку
        loaderOn: (node) => {
            const loaderTemplate = `<div class="loader" v-if="isLoading">
                                        <img src="/img/loading.gif" alt="">
                                    </div>`;

            $(document).find(node).append(loaderTemplate)
        },
        loaderOff: () => {
            $(document).find('.loader').remove()
        }
    };

    export default Loader
</script>
