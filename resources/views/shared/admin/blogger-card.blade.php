    <div class="list-blogers__item bloger-item card" data-id="1">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img">
                         <img src="{{ $blogger->user->getImageURL() }}" alt="">
                        @if($blogger->is_achievement)
                            <div class="card__achive">
                                <img src="{{ asset('img/achive-icon.svg') }}" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="card__name">
                        <p class="card__name-name">
                            {{ $blogger->user->name }}
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
                </div>
                <div class="card__row card__desc">
                    <p>
                        {{ $blogger->description }}
                    </p>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>{{ number_format($blogger->getSubscribers(), 0, '', ' ') }}</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $blogger->subscriber_quantity }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Охваты</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ number_format(round($blogger->getCoverage()), 0, '', ' ') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ER %</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ number_format($blogger->getER(), 0, '', ' ') }}</span>
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
                        <div class="card__diagram-icon"><img src="{{ asset('admin/img/blogers-list/male-icon.svg') }}" alt=""></div>
                        <div class="card__diagram-line"><span style="width:{{ $blogger->gender_ratio }}%;"></span></div>
                        <div class="card__diagram-icon"><img src="{{ asset('admin/img/blogers-list/female-icon.svg') }}" alt=""></div>
                    </div>
                </div>
                <div class="card__row" style="text-align: center; justify-content:center">
                    <a href="{{ route('blogger-page', $blogger->id) }}" class="" style="color:rgba(0,0,0,.4); font-size:16px; font-weight:500; text-decoration:underline; margin-top: -20px;">Подробнее</a>
                </div>
                <div class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary" onclick="banUser({{$blogger->user->id}}, this)">
                        Заблокировать
                    </button>
                    <!-- <button class = "btn btn-secondary btn-achivments-form" data-project-id="">
                                                    Достижения
                                                </button> -->
                </div>
            </div>
        </div>
    </div>
