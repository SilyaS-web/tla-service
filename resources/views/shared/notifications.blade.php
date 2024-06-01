@if (!isset($notifications))
<p style="font-size: 14px; color: rgba(0, 0, 0, 0.4)">Нет новых уведомлений</p>
@else
@forelse ($notifications as $notification)
<div class="notif-header__row ">
    <div class="notif-header__col notif-header__img">
        <img src="img/profile-icon.svg" alt="">
    </div>
    <div class="notif-header__col">
        <div class="notif-header__title">
            {{ $notification->text ?? 'Новая заявка' }}
        </div>
        <div class="notif-header__text">
            {{ $notification->text }}
        </div>
    </div>
</div>
@empty
<p style="font-size: 14px; color: rgba(0, 0, 0, 0.4)">Нет новых уведомлений</p>
@endforelse
@if($old_notifications->count() > 0)
<p style='font-size:8px'>просмотренные уведомления</p>
@endif
@forelse ($old_notifications as $notification)
<div class="notif-header__row ">
    <div class="notif-header__col notif-header__img">
        <img src="{{ asset('img/profile-icon.svg') }}" alt="">
    </div>
    <div class="notif-header__col">
        <div class="notif-header__title">
            {{ $notification->text ?? 'Новая заявка' }}
        </div>
        <div class="notif-header__text">
            {{ $notification->text }}
        </div>
    </div>
</div>
@empty

@endforelse
@endif
