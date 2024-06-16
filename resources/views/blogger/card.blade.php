<div class="list-blogers__item bloger-item card" data-id="{{ $blogger->id }}">
    <div class="card__row card__content">
        <div class="card__col">
            <div class="card__row card__header">
                <div class="card__img">
                    <img src="img/profile-icon.svg" alt="">
                    @if($blogger->is_achievement)
                    <div class="card__achive">
                        <img src="{{ asset('img/achive-icon.svg') }}" alt="">
                    </div>
                    @endif
                </div>
                <div class="card__name">
                    <p class="card__name-name">
                        <a class="btn-add-to-project" href="{{ route('blogger-page', $blogger->id) }}" style="color:#000">
                            {{ $blogger->user->name}}
                        </a>
                        <p style="font-size: 12px">
                            {{ $blogger->country->name }}, {{ $blogger->city }}
                        </p>
                    </p>
                </div>
                <div class="card__platforms">
                    @foreach ($blogger->platforms as $platform)
                        <div class="card__platform {{ strtolower($platform->name) }}"><img src="{{ $platform->getIconURL() }}" alt=""></div>
                    @endforeach
                </div>
            </div>
            <div class="card__row card__tags">
                @php($themes = $blogger->themes)
                @foreach ($themes->take(3) as $theme)
                <div class="card__tags-item">
                    <span>{{ $theme->theme->theme }}</span>
                </div>
                @endforeach
                @if (count($themes) > 2)
                @php($themes = $themes->skip(3))
                <div class="card__tags-item card__tags-item--others">
                    <span>Посмотреть все +{{ count($themes) }}шт</span>
                    <div class="card__tags-item-w">
                        @foreach ($themes as $theme)
                        <div class="card__tags-item">
                            <span>{{ $theme->theme->theme }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="card__row card__desc">
                {{ $blogger->description }}
            </div>
        </div>
        <div class="card__col card__stats">
            <div class="card__col card__stats-stats">
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Подписчики</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->getSubscribers() }}</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>Охваты</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->getCoverage() }}</span>
                        </div>
                    </div>
                </div>
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>ER</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->getER() }}</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>CPM</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->getCPM() }}₽</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card__col card__column--gender">
                <div class="card__stats-title">
                    <span>Пол аудитории</span>
                </div>
                <div class="card__row" style="align-items: center; gap:5px">
                    <div class="card__diagram-icon"><img src="img/blogers-list/male-icon.svg" alt=""></div>
                    <div class="card__diagram-line"><span style="width:{{ $blogger->gender_ratio }}%;"></span></div>
                    <div class="card__diagram-icon"><img src="img/blogers-list/female-icon.svg" alt=""></div>
                </div>
            </div>
            <div class="card__row" style="text-align: center; justify-content:center">
                <a href="{{ route('blogger-page', $blogger->id) }}" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -20px;">Подробности</a>
            </div>
            <div class="card__row card__row" style="flex-direction: column; gap: 5px">
                <button class="btn btn-primary btn-add-to-project" onclick="sendProjectToBlogger({{ $blogger->id }})" data-project-id="">
                    Отправить заявку
                </button>
            </div>
        </div>
    </div>
</div>
