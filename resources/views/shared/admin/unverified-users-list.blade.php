<div class="admin-blogers__blogers admin-view__content-wrap">
    <div class="blogers-list__list list-blogers">
        @forelse ($unverified_users as $unverified_user)
            @include('shared.admin.unverified-user-card')
        @empty
        Нет заявок на модерацию
        @endforelse
    </div>
</div>
