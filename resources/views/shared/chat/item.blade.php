<div class="chat__chat-item item-chat" style="position:relative" data-id="{{$work->id}}"> {{--current--}}
    <div class="item-chat__img">
        <img src="{{ $work->getPartnerUser(auth()->user()->role)->getImageURL() }}" alt="">
    </div>
    <div class="item-chat__text">
        <div class="item-chat__title">{{ $work->getPartnerUser(auth()->user()->role)->name }}</div>
        <div class="item-chat__last-msg">
            <p>Последнее сообщение:</p>
            <span>{{ $work->messages()->latest()->first() ? date_format($work->messages()->latest()->first()->created_at, 'd.m.y H:i') : 'Нет сообщений'}}</span>
        </div>
        <a href="#" class = "item-chat__project-link {{ auth()->user()->role == 'seller' ? "item-chat__project-link--seller" : 'item-chat__project-link--blogger' }}" data-project-id = "{{$work->project->id}}">Перейти к проекту</a>
    </div>
    <div class="nav-menu__item-notifs notifs" style="">1</div>
</div>
