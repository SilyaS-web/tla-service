<div class="chat__chat-item item-chat" style="position:relative" data-id="{{$work->id}}"> {{--current--}}
    <div class="item-chat__img">
        <img src="{{ $work->getPartnerUser(auth()->user()->role)->getImageURL() }}" alt="">
    </div>
    <div class="item-chat__text">
        <div class="item-chat__title">{{ $work->getPartnerUser(auth()->user()->role)->name }}</div>
        <div class="item-chat__last-msg">
            <p>Проект:</p>
            <span>{{ $work->project->product_name }}</span>
        </div>
        <a href="#" class="item-chat__project-link {{ auth()->user()->role == 'seller' ? "item-chat__project-link--seller" : 'item-chat__project-link--blogger' }}" data-project-id = "{{$work->project->id}}">Перейти к проекту</a>
    </div>
    @php($new_messages_count = $work->messages()->where('viewed_at', null)->where('user_id', '<>', auth()->user()->id)->count())
    @if ($new_messages_count > 0)
        <div class="nav-menu__item-notifs notifs" style="">{{ $new_messages_count }}</div>
    @endif
</div>
