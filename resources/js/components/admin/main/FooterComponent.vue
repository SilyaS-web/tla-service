<template>

</template>

<script>
    function banUser(user_id, el) {
        el.innerHTML = '<div class="lds-dual-ring"></div>';
        $.get({
            url: '/apist/admin/deny/' + user_id,
            success: function(data, textStatus, jqXHR) {
                el.innerHTML = 'Пользователь заблокирован';
                el.disabled = true;
                notify('info', {
                    title: 'Успешно!',
                    message: 'Пользователь заблокирован!'
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                el.innerHTML = 'Заблокировать';
                notify('error', {
                    title: 'Ошибка!',
                    message: 'Не удалось заблокировать пользователя!'
                });
            }
        });
    }
</script>
