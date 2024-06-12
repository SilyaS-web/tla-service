@extends('layout.layout')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <form class="edit-profile__content" action="{{ route('edit-profile-post') }}" method="POST">
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
                                $.mask.definitions['h'] = "[0|1|3|4|5|6|7|9]"
                                $("#phone").mask("+7 (h99) 999-99-99");
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
                            <input type="text" class="input" id="type" name="marketplace_link" name="marketplace_link" value="{{ $user->seller->marketplace_link }}">
                        </div>
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" class="input" id="inn" name="inn" value="{{ $user->seller->inn }}">
                        </div>
                        <div class="form-group">
                            <label for="">Ключ API WB</label>
                            <input type="text" class="input" id="inn" name="wb_api_key" value="{{ $user->seller->wb_api_key }}">
                        </div>
                    </div>
                    <button class="btn btn-primary mobile" type='submit'>Сохранить</button>
                </div>
        </div>
    </div>
    </div>
</section>

@endsection


@section('scripts')
<script src="{{ asset("libs/meter/script.js") }}"></script>
@endsection
