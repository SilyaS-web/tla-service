@if ($unverified_user->blogger)
<div class="list-blogers__item seller-item card" data-id="{{ $unverified_user->blogger->id }}">
    <div class="card__row card__content">
        <div class="card__col">
            <div class="card__row card__header">
                <div class="card__img" style="background-image: url('{{ $unverified_user->getImageURL() }}')">
                    {{-- <img src="{{ $unverified_user->getImageURL() }}" alt=""> --}}
                </div>
                <div class="card__name">
                    <p class="card__name-name">
                        {{ $unverified_user->name }}
                    </p>
                    <p class="card__name-tag">
                        {{ $unverified_user->created_at ? date_format($unverified_user->created_at, 'd.m.y') :  date('d.m.y', strtotime("2003-01-22")) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="card__row card__tags">
            @php($themes = $unverified_user->blogger->themes)
            @foreach ($themes->take(3) as $theme)
                <div class="card__tags-item">
                   <span>{{ $theme->theme->theme }}</span>
                </div>
            @endforeach
       </div>
        <div class="card__col card__stats">
            <div class="card__col card__stats-stats">
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Телефон</span>
                        </div>
                        <div class="card__stats-val" title = "{{ $unverified_user->phone }}">
                            <span>{{ $unverified_user->phone }}</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Почта</span>
                        </div>
                        <div class="card__stats-val" title="{{ $unverified_user->email }}">
                            <span>{{ $unverified_user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card__row" style="text-align: center; justify-content:center">
                <a href="{{ route('edit-blogger', $unverified_user->id) }}" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -20px;">Редактировать</a>
            </div>
            <div class="admin-bloger__btns">
                <a href="#" class="btn btn-primary btn-accept" data-id={{ $unverified_user->blogger->id }}>Принять</a>
                <button class="btn btn-secondary" onclick="banUser({{$unverified_user->id}}, this)">
                    Отклонить
                </button>
            </div>
        </div>
    </div>
    <div class="card__delete">
        <img src="{{ '/img/trash-icon.svg' }}" alt="">
    </div>
</div>
@endif
