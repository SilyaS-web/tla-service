<div class="blogers-list__list list-blogers">
    @forelse ($bloggers as $blogger)
    @include('blogger.card')
    @empty
    Нет блогеров
    @endforelse
</div>
