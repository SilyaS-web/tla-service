@foreach ($work->messages as $message)
@php($is_author = $message->user_id == $user_id)
@php($message_class = $message->user_id == 0 ? 'messages-chat__item--system' : ($message->user_id == $user_id ? 'messages-chat__item--author' : '' ) )
<div class="messages-chat__item {{ $message_class }}">
    @if ($message->user_id == 0)
    <div class="messages-chat__item-header">
        <div class="messages-chat__item-title">
            {{ $message->user->name}}
        </div>
        <div class="messages-chat__item-date">
            {{ date_format($message->created_at, 'd.m.y H:i') }}
        </div>
    </div>
    @endif
    <div class="messages-chat__item-msg">
        {{ $message->message }}
    </div>
</div>
@endforeach
