<div class="blogers-list__list list-blogers">
    @forelse ($bloggers as $blogger)
    @include('shared.admin.blogger-card')
    @empty
    Нет блогеров
    @endforelse
</div>
