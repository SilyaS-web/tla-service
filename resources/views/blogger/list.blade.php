<div class="blogers-list__list list-blogers">
    @forelse ($bloggers as $blogger)
    @include('blogger.card')
    @empty
    Нет блогеров
    @endforelse
</div>
<script>
    function sendProjectToBlogger(user_id, el) {
        let p_id = $(document).find('.current-project').data('id') || null;

        if (!p_id) {
            notify('info', {
                title: 'Ошибка', message: 'Выберите проект!'
            });
        } else {
            el.innerHTML = '<div class="lds-dual-ring"></div>';
            $.post({
                url: '/apist/works',
                data: {
                    blogger_id: user_id,
                    project_work_id: p_id
                },
                success: function(data, textStatus, jqXHR) {
                    el.innerHTML = 'Заявка отправлена';
                    el.disabled = true;
                    notify('info', {
                        title: 'Успешно!', message: 'Заявка успешно отправлена!'
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    el.innerHTML = 'Отправить заявку';
                    notify('error', {
                        title: 'Ошибка!',
                        message: 'Не удалось отправить заявку!'
                    });
                }
            });
        }
    }
</script>
