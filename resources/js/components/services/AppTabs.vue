<script>
    const Tabs = {
        tabClick: (e) => {
            e.preventDefault()
            var curTab = $(e.target).closest('.tab');

            $('.tab').removeClass('active');
            $('.tab-content').removeClass('active');

            curTab.addClass('active');
            $(`#${curTab.data('content')}`).addClass('active')
        },
    }

    export default Tabs;
</script>
