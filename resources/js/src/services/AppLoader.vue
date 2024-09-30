<script>
    const Loader = {
        // Принимает селлектор элемента, куда нужно вставить загрузку
        loaderOn: (node) => {
            const loaderTemplate = `<div class="loader-wrap">
                                        <span class="loader"></span>
                                    </div>`;

            $(document).find(node).append(loaderTemplate)
            // $(document).find(node).css('height', '100vh')
            // $(document).find(node).css('overflow', 'hidden')
        },
        loaderOff: (node = '') => {
            // $(document).find(node).css('height', '100%')
            // $(document).find(node).css('overflow', 'unset')

            node += ' .loader-wrap'
            $(document).find(node).remove()
        }
    };

    export default Loader
</script>
