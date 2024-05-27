<div class="list-blogers__item bloger-item card" data-id="{{ $blogger->id }}">
    <div class="card__row card__content">
        <div class="card__col">
            <div class="card__row card__header">
                <div class="card__img">
                    <img src="img/profile-icon.svg" alt="">
                    <div class="card__achive">
                        <img src="img/achive-icon.svg" alt="">
                    </div>
                </div>
                <div class="card__name">
                    <p class="card__name-name">
                        {{ $blogger->user->name}}
                    </p>
                </div>
                <div class="card__platform">
                    <img src="img/inst-icon.svg" alt="">
                </div>
            </div>
            {{-- <div class="card__row card__tags">
                <div class="card__tags-item">
                    <span>Животные и Природа</span>
                </div>
            </div> --}}
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
                            <span>Подписчики</span>
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
                            <span>{{ $blogger->coverage }}</span>
                        </div>
                    </div>
                </div>
                <div class="card__row card__stats-row">

                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>ER</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->engagement_rate }}</span>
                        </div>
                    </div>
                    <div class="card__col card__stats-item">
                        <div class="card__stats-title">
                            <span>CPM</span>
                        </div>
                        <div class="card__stats-val">
                            <span>{{ $blogger->cost_per_mille }}₽</span>
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
            <div class="card__row card__row">
                <button class="btn btn-primary btn-add-to-project" data-project-id="">
                    Добавить
                </button>
            </div>
        </div>
    </div>
</div>
