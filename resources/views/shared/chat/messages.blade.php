@if ($work->messages->count() > 0)
    @foreach ($work->messages as $message)
        @php($is_author = $message->user_id == $user_id)
        @php($message_class = $message->user_id == 1 ? 'messages-chat__item--system' : ($message->user_id == $user_id ? 'messages-chat__item--author' : '' ) )
        <div class="messages-chat__item {{ $message_class }}">
            <div class="messages-chat__item-header">
                <div class="messages-chat__item-title">
                    {{ $message->user->name}}
                </div>
                <div class="messages-chat__item-date">
                    {{ date_format($message->created_at, 'd.m.y H:i') }}
                </div>
            </div>
            <div class="messages-chat__item-msg">
                @if($message->user_id == 1)
                {!! $message->message !!}
                @if($message->finishStats)
                <div class="messages-chat__item-stats">
                    Просмотры: {{ $message->finishStats->views }}
                    Репосты: {{ $message->finishStats->reposts }}
                    Лайки: {{ $message->finishStats->likes }}
                </div>
                @endif
                @else
                {{ $message->message }}
                @endif
                @foreach ($message->images as $image)
                <img src="{{ $image->getURL() }}" alt="" class="chat-img-popup" data-popup="#chat-img">
                @endforeach
            </div>
        </div>
    @endforeach
@else
    <div class="messages-chat__item messages-chat__item--system">
        <div class="messages-chat__item-msg">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
        </div>
    </div>
@endif
