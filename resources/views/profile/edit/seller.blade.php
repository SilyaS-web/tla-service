@extends('layout.layout')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <div class="edit-profile__content">
                <div class="tab-content__profile-img">
                    <img src="{{ $user->getImageUrl() }}" alt="">
                    <div class="tab-content__profile-img-text">
                        <p>Фото профиля</p>
                        <div class="form-group form-group--file">
                            <label class="tab-content__profile-img-upload input-file" for="profile-img">
                                Загрузите изображение
                                <input type="file" name="name" class="" id="profile-img">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="tab-content__form">
                    <div class="tab-content__form-right">
                        <div class="form-group">
                            <label for="">Имя</label>
                            <input type="text" class="input" name="name" id="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="input" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" valie="{{ $user->phone }}">
                        </div>
                        <script>
                            $(function() {
                                $("#phone").mask("8(999) 999-9999");
                            });

                        </script>
                        <div class="form-group">
                            <label for="">Ссылка на маркетплейс</label>
                            <input type="text" class="input" id="marketplace" name="marketplace_link" value="{{ $user->seller->marketplace_link }}">
                        </div>
                        <button class="btn btn-primary desktop">Сохранить</button>
                    </div>
                    <div class="tab-content__form-left">
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="">Тип организации</label>
                            <input type="text" class="input" id="type" name="marketplace_link">
                        </div>
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" class="input" id="inn">
                        </div>
                          <div class="form-group">
                            <label for="">Ключ API WB</label>
                            <input type="text" class="input" id="inn">
                        </div>
                    </div>
                    <button class="btn btn-primary mobile">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('scripts')
<script src="{{ asset("libs/meter/script.js") }}"></script>
@endsection
