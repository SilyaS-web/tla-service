<script>
const Loader = {
    // Принимает селлектор элемента, куда нужно вставить загрузку
    loaderOn: (node) => {
        const loaderTemplate = `<div class="loader-wrap">
                                        <span class="loader"></span>
                                    </div>`;
        $(document).find(node).append(loaderTemplate)
    },
    loaderOff: (node = '') => {
        node += ' .loader-wrap'
        $(document).find(node).remove()
    }
};

export default Loader
</script>
