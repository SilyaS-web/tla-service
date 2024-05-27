@if(session()->has('success'))

<div class="notification">
    <div class="notification__body">
        <div class="notification__title">Внимание!</div>
        <div class="notification__text">
            {{ session('success') }}
        </div>
    </div>
</div>

@endif
