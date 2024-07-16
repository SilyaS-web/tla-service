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
            <p>
                Перед началом общения и обсуждения условий обмена товарами на рекламу, пожалуйста, учитывайте следующие важные моменты:
            </p>
            <br>
            <p>
                Бартерные сделки: Наш сервис предполагает исключительно обмен товарами на рекламу и отзывы по бартерной основе. Мы не рекомендуем обмениваться товарами с доплатой или платить за рекламу. В случае обмена денежными средствами мы не несем ответственности за такие переводы.
            </p>
            <br>
            <p>
                Вежливость и уважение: Будьте вежливыми и уважительными при общении. Соблюдайте правила сайта и общение должно быть конструктивным и профессиональным.
            </p>
            <br>
            <p>
                Ясные условия: Четко обсуждайте условия обмена, чтобы избежать недоразумений. Убедитесь, что обе стороны согласны с условиями сделки перед отправкой товаров или публикацией рекламы.
            </p>
        </div>
    </div>
@endif
