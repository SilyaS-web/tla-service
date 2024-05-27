    <div class="list-blogers__item seller-item card" data-id="1">
        <div class="card__row card__content">
            <div class="card__col">
                <div class="card__row card__header">
                    <div class="card__img">
                        <img src="{{ asset('admin/img/profile-icon.svg') }}" alt="">
                    </div>
                    <div class="card__name">
                        <p class="card__name-name">
                            {{ $seller->user->name }}
                        </p>
                        <p class="card__name-tag">
                            {{ $seller->is_agent ? 'Посредник' : 'Селлер'}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card__col card__stats">
                <div class="card__col card__stats-stats">
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Телефон</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $seller->user->phone }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Тип организации</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $seller->organization_type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__row card__stats-row">

                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>Почта</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $seller->user->email }}</span>
                            </div>
                        </div>
                        <div class="card__col card__stats-item">
                            <div class="card__stats-title">
                                <span>ИНН</span>
                            </div>
                            <div class="card__stats-val">
                                <span>{{ $seller->inn }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card__row" style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <button class="btn btn-primary">
                        Заблокировать
                    </button>
                    <!-- <button class = "btn btn-secondary btn-achivments-form" data-project-id="">
                                                    Достижения
                                                </button> -->
                </div>
            </div>
        </div>
    </div>
