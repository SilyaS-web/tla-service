<div class="blogers-list__list list-blogers admin-view__content-wrap">
    @forelse ($sellers as $seller)
    @include('shared.admin.seller-card')
    @empty
    Нет селлеров
    @endforelse
</div>

