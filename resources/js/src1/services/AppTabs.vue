<script>
    const Tabs = {
        tabClick: (tab) => {
            $('.tab').not(`.tab [data-content="${tab}"]`).removeClass('active');
            $('.tab-content').not(`#${tab}`).removeClass('active');

            $(`.tab[data-content="${tab}"]`).addClass('active');
            $(`#${tab}`).addClass('active')
        },
    }

    export default Tabs;
</script>
