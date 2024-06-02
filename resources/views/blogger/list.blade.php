<div class="blogers-list__list list-blogers">
    @forelse ($bloggers as $blogger)
    @include('blogger.card')
    @empty
    Нет блогеров
    @endforelse
</div>
<script>
    function sendProjectToBlogger(user_id) {
        let project_input = document.getElementById('send-project-el');

        if (!project_input) {
            notify('info', {
                title: 'Ошибка'
                , message: 'Выберите проект!'
            });
        } else {
            let project_id = project_input.value;
            $.post('/apist/works', {
                seller_id: document.querySelector('[data-user-id]').dataset.userId
                , blogger_id: user_id
                , project_id: project_id
            }, function(res) {
                notify('info', {
                    title: 'Успешно!'
                    , message: 'Заявка успешно отправлена!'
                });
            })
        }
    }

</script>
