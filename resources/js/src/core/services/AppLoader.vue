<script>
const Loader = {
    // Принимает селлектор элемента, куда нужно вставить загрузку
    loaderOn: (node) => {
        const loaderTemplate = `<div class="loader-wrap">
                                        <span class="loader"></span>
                                    </div>`;

        $(node).append(loaderTemplate)
        $(node).addClass('loading')
    },
    loaderOff: (node) => {
        $(document).find(node).removeClass('loading')

        if(node) {
            $(document).find(node).find('.loader-wrap').remove()
        }
        else{
            $(document).find('.loader-wrap').remove()
        }
    }
};

export default Loader
</script>

