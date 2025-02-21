<script>
    const Tabs = {
        tabClick: (tab) => {
            $('.tab').not(`.tab [data-content="${tab}"]`).removeClass('active');
            $('.tab-content').not(`#${tab}`).css('display', 'none');

            $(`.tab[data-content="${tab}"]`).addClass('active');
            $(`#${tab}`).css('display', 'flex')
        },
    }

    export default Tabs;
</script>
