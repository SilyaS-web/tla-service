<script>
    const Tabs = {
        tabClick: (tab) => {
            $('.tab').removeClass('active');
            $('.tab-content').removeClass('active');

            $(`.tab [data-content="${tab}"]`).addClass('active');
            $(`#${tab}`).addClass('active')
        },
    }

    export default Tabs;
</script>
