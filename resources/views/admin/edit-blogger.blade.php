@extends('layout.layout')

@section('title', $title ?? 'Редактирование профиля')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <form class="edit-profile__content" enctype="multipart/form-data" method="POST" action="{{ route('update-blogger', $user->id) }}">
                <div class="tab-content__profile-img">
                    <img src="{{ $user->getImageUrl() }}" alt="">
                    <div class="tab-content__profile-img-text">
                        <p>Фото профиля</p>
                        <div class="form-group form-group--file">
                            <label class="tab-content__profile-img-upload input-file" for="profile-img">
                                <span>Загрузите изображение</span>
                                <input type="file" name="image" class="" id="profile-img">
                            </label>
                            @error('image')
                            <span class="error">{{ $message }}</span>
                            @enderror
                            <script>
                                $(window).on('load', function() {
                                    $('#profile-img').on('change', function(e) {
                                        $(e.target).closest('.tab-content__profile-img-upload').addClass('uploaded');
                                        $(e.target).closest('.tab-content__profile-img-upload').find('span').text('Изображение загружено');
                                    })
                                })

                            </script>
                        </div>
                    </div>
                </div>
                <div class="tab-content__form tab-content__form--accent" style="flex-direction:column; max-width:680px;">
                    <label for="" class="tab-content__form--title">Личные данные</label>
                    <div class="tab-content__form-right" style="width:100%">
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" class="input" name="name" id="name" value="{{ $user->name }}">
                            @error('name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="input" id="email" name="email" value="{{ $user->email }}">
                            @error('email')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group filter__item">
                            <label for="city">Город</label>
                            <input type="city" class="input" id="city" name="city" value="{{ $user->blogger->city ?? '' }}">
                            @error('city')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group filter__item">
                            <label for="country_id">Страна</label>
                            <select name="country_id" id="country_id" name="country_id" class="input input--country select">
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == ($user->blogger->country_id ?? '') ? "selected"  : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" value="{{ $user->phone }}" disabled>
                            @error('phone')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-content__form tab-content__form--accent" style="flex-direction:column; max-width:680px;">
                    <div class="tab-content__form-right" style="width:100%">
                        <div class="form-group">
                            <label for="desc">Описание канала</label>
                            <textarea name="description" id="desc" cols="30" rows="10" class="textarea" placeholder="Введите текст">{{ $user->blogger->description }}</textarea>
                        </div>
                        <div class="form-row filter__item" style="display: flex; gap:10px;">
                            <div class="form-group">
                                <label for="gender_ratio">Мужчины, %</label>
                                <input id="gender_ratio" name="gender_ratio" type="number" class="input" max="100" value = "{{ $user->blogger->gender_ratio }}">
                            </div>
                            <div class="form-group">
                                <label for="gender_ratio_f">Женщины, %</label>
                                <input id="gender_ratio_f" name="gender_ratio_f" type="number" class="input" max="100" value = "{{ 100 - $user->blogger->gender_ratio }}">
                            </div>
                        </div>
                        <script>
                            $("#gender_ratio").on('change', function(e) {
                                $('#gender_ratio_f').val(100 - Number($(e.target).val()))
                            })
                            $("#gender_ratio_f").on('change', function(e) {
                                $('#gender_ratio').val(100 - Number($(e.target).val()))
                            })

                        </script>
                        <div class="form-row filter__item">
                            <div class="form-group">
                                <label for="sex">Пол блогера</label>
                                <select name="sex" id="sex" class="input">
                                    <option value="male" class="" {{ $user->blogger->sex == 'male' ? 'selected' : ''}}>Мужской</option>
                                    <option value="female" class="" {{ $user->blogger->sex == 'female' ? 'selected' : ''}}>Женский</option>
                                </select>
                            </div>
                            <label for="">Статистика по блогеру</label>
                            @foreach ($user->blogger->platforms as $platform)
                                <div class="form-stat">
                                    <div class="form-stat__title">
                                        {{ $platform->name }}
                                    </div>
                                    <div class="form-stat__content">
                                        <div class="form-stat__row">
                                            <div class="form-group" style="width:100%; max-width:100%">
                                                <label for="{{ $platform->name }}_link">Ссылка</label>
                                                <input id="{{ $platform->name }}_link" type="text" class="input" name="{{ $platform->name }}_link" style="width:100%; max-width:100%" value="{{ $platform->link }}">
                                            </div>
                                        </div>
                                        <div class="form-stat__row">
                                            <div class="form-group">
                                                <label for="{{ $platform->name }}_subs">Подписчики</label>
                                                <input id="{{ $platform->name }}_subs" type="text" class="input" name="{{ $platform->name }}_subs" value="{{ $platform->subscriber_quantity }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="{{ $platform->name }}_cover">Охваты</label>
                                                <input id="{{ $platform->name }}_cover" type="text" class="input" name="{{ $platform->name }}_cover" value="{{ $platform->coverage }}">
                                            </div>
                                        </div>
                                        <div class="form-stat__row">
                                            <div class="form-group">
                                                <label for="{{ $platform->name }}_er">ER %</label>
                                                <input id="{{ $platform->name }}_er" type="text" class="input" name="{{ $platform->name }}_er" value="{{ $platform->engagement_rate }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="{{ $platform->name }}_cpm">CPM</label>
                                                <input id="{{ $platform->name }}_cpm" type="text" class="input" name="{{ $platform->name }}_cpm" value="{{ $platform->cost_per_mille }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <div class="input-checkbox-w">
                                    <input name="is_achievement" type="checkbox" class="checkbox whois" id="is_achievement" {{ $user->blogger->is_achievement ? 'checked' : '' }}>
                                    <label for="">Проверенный блогер</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary desktop">Сохранить</button>
            </form>
        </div>
    </div>
</section>

@endsection


@section('scripts')
<script>
    $(function() {
        $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
        $("#phone").mask("+7 (h99) 999-99-99");
    });

</script>
@endsection