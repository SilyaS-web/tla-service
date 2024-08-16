@php ($isSuccess = session()->has('success'))

<div class="notification" style="display:none">
    <div class="notification__body">
        <div class="notification__title">Внимание!</div>
        <div class="notification__text">
            {{ $isSuccess ? session('success') : "" }}
        </div>
    </div>
</div>
