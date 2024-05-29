        <div class="list-blogers__item seller-item card" data-id="{{ $unverified_user->id }}">
            <div class="card__row card__content">
                <div class="card__col">
                    <div class="card__row card__header">
                        <div class="card__img">
                            <img src="{{ $unverified_user->getImageURL() }}" alt="">
                        </div>
                        <div class="card__name">
                            <p class="card__name-name">
                                {{ $unverified_user->name }}
                            </p>
                            <p class="card__name-tag">
                                {{ date_format($unverified_user->created_at, 'd.m.y') }}
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
                                    <span>{{ $unverified_user->phone }}</span>
                                </div>
                            </div>
                            <div class="card__col card__stats-item">
                                <div class="card__stats-title">
                                    <span>Почта</span>
                                </div>
                                <div class="card__stats-val">
                                    <span>{{ $unverified_user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="admin-bloger__btns">
                        <a href="#" class="btn btn-primary btn-accept" data-id={{ $unverified_user->id }}>Принять</a>
                        {{-- <a href="{{route('admin/deny' . $unverified_user->id)}}" class="btn btn-secondary">Отклонить</a> --}}
                        <a href="/admin/deny" class="btn btn-secondary">Отклонить</a>
                    </div>
                </div>
            </div>
        </div>
