<div class="chat__chat-item item-chat current">
    <div class="item-chat__img">
        <img src="img/profile-icon.svg" alt="">
    </div>
    <div class="item-chat__text">
        <div class="item-chat__title">{{ $work->$role->user->name }}</div>
        <div class="item-chat__last-msg">
            <p>Последнее сообщение:</p>
            <span>{{ $work->messages()->latest()->first() ? date_format($work->messages()->latest()->first()->created_at, 'd.m.y H:i') : 'Нет сообщений'}}</span>
        </div>
    </div>
</div>
