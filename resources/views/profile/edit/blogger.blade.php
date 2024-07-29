@extends('layout.layout')

@section('title', $title ?? 'Редактирование профиля')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <form class="edit-profile__content" enctype="multipart/form-data" method="POST" action="{{ route('edit-profile-post') }}">
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
                            <label for="city">Ваш город</label>
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
                    <label for="" class="tab-content__form--title">Изменить пароль</label>
                    <div style="width:100%">
                        <div class="form-group">
                            <label for="old_password">Старый пароль</label>
                            <input class="input" id="old_password" type="password" name="old_password">
                            @error('old_password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Новый пароль</label>
                            <input class="input" id="password" type="password" name="password">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
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
