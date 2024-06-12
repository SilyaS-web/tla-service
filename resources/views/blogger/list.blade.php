<div class="blogers-list__list list-blogers">
    @forelse ($bloggers as $blogger)
    @include('blogger.card')
    @empty
    Нет блогеров
    @endforelse
</div>
<script>
    function sendProjectToBlogger(user_id) {
        let p_id = $(document).find('.current-project').data('id') || null;

        if (!p_id) {
            notify('info', {
                title: 'Ошибка', message: 'Выберите проект!'
            });
        } else {
            $.post('/apist/works', {
                blogger_id: user_id,
                project_work_id: p_id
            }, function(res) {
                notify('info', {
                    title: 'Успешно!', message: 'Заявка успешно отправлена!'
                });
            })
        }
    }
</script>
