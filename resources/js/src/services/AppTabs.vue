<script>
    const Tabs = {
        tabClick: (tab) => {
            $(`.tab [data-content="${tab}"]`).addClass('active');
            $(`#${tab}`).addClass('active')

            $('.tab').not(`[data-content="${tab}"]`).removeClass('active');
            $('.tab-content').not(`#${tab}`).removeClass('active');
        },
    }

    export default Tabs;
</script>
