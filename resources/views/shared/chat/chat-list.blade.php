<div class="chat__chat-items">
    @forelse ($works as $work)
    @include('shared.chat.item')
    @empty
    <p class="chat__chat-empty">Переписка пустая, <span style="color:var(--primary); cursor:pointer" onclick="(function(){ $(document).find('.nav-menu__item.project-link').click() })();">создайте проект</span> и начните работу с блогерами</p>
    @endforelse
</div>
