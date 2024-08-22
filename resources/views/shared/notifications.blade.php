@if (!isset($notifications))
<p style="font-size: 14px; color: rgba(0, 0, 0, 0.4)">Нет новых уведомлений</p>
@else
@forelse ($notifications as $notification)
@php($img = $notification->fromUser ? $notification->fromUser->getImageURL() : asset('img/profile-icon.svg'))
<div class="notif-header__col ">
    <div class="notif-header__row">
        <div class="notif-header__col notif-header__img">
            <img src="{{ $img }}" alt="">
        </div>
        <div class="notif-header__col">
            <div class="notif-header__title">
                {{ $notification->type ?? 'Новое уведомление' }}
            </div>
            <div class="notif-header__text">
                {{ $notification->text }}
            </div>
        </div>
    </div>
    <div class="notif-header__btns">
        @if($notification->work && $notification->work->status !== null)
            <a href="#" class="notif-header__goto" data-work-id="{{ $notification->work_id }}">Перейти</a>
        @endif
        <a href="#" class="notif-header__hide" data-id="{{ $notification->id }}">Скрыть</a>
    </div>
</div>
@empty
<p style="font-size: 14px; color: rgba(0, 0, 0, 0.4)">Нет новых уведомлений</p>
@endforelse
@endif
