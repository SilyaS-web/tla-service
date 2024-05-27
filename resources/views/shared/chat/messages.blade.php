@foreach ($work->messages as $message)
@php($is_author = $message->user_id == $user_id)
<div class="messages-chat__item {{ !$is_author ?: 'messages-chat__item--author' }}">
    <div class="messages-chat__item-header">
        <div class="messages-chat__item-title">
            {{ $message->user->name}}
        </div>
        <div class="messages-chat__item-date">
            {{ date_format($message->created_at, 'd.m.y H:i') }}
        </div>
    </div>
    <div class="messages-chat__item-msg">
        {{ $message->message }}
    </div>
</div>
@endforeach
