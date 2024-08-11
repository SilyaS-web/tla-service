<div class="blogers-list__list list-blogers admin-view__content-wrap">
    @forelse ($bloggers as $blogger)
    @include('shared.admin.blogger-card')
    @empty
    Нет блогеров
    @endforelse
</div>
