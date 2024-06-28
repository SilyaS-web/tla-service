@extends('layout.layout')

@section('content')
<section class="edit-profile">
    <div class="edit-profile__container _container">
        <div class="edit-profile__body">
            <div class="edit-profile__title title">
                Редактировать данные
            </div>
            <form class="edit-profile__content" enctype="multipart/form-data" action="{{ route('edit-profile-post') }}" method="POST">
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
                <div class="tab-content__form">
                    <div class="tab-content__form-right">
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
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="phone" id="phone" placeholder="" name="phone" class="input input--phone" value="{{ $user->phone }}" disabled>
                            @error('phone')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-content__form-left">
                        <div class="form-group" style="">
                            <label for="">Тип организации</label>
                            <select class="input" id="type" name="organization_type">
                                <option value="ООО" {{ $user->seller->organization_type == "ООО" ? "selected" : ''}}>ООО</option>
                                <option value="ИП" {{ $user->seller->organization_type == "ИП" ? "selected" : ''}}>ИП</option>
                                <option value="ОАО" {{ $user->seller->organization_type == "ОАО" ? "selected" : ''}}>ОАО</option>
                            </select>
                            @error('organization_type')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organization_name">Название организации</label>
                            <input type="text" class="input" id="organization_name" name="organization_name" value="{{ $user->seller->platform }}">
                            @error('organization_name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">ИНН</label>
                            <input type="text" class="input" id="inn" name="inn" value="{{ $user->seller->inn }}">
                            @error('inn')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-content__form tab-content__form--accent" style="flex-direction:column;">
                    <label for="" class="tab-content__form--title">Работа с API</label>
                    <div class="tab-content__form-row" style="">
                        <div class="tab-content__form-right">
                            <div class="form-group">
                                <label for="">Ссылка на магазин WB</label>
                                <input type="text" class="input" id="marketplace" name="platform_link" value="{{ $user->seller->platform_link }}">
                                @error('platform_link')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ключ API WB</label>
                                <input type="text" class="input" id="wb_api_key" name="wb_api_key" value="{{ $user->seller->wb_api_key }}">
                                @error('wb_api_key')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-content__form-left">
                            <div class="form-group">
                                <label for="ozon_api_key">Ключ API OZON</label>
                                <input type="text" class="input" id="ozon_api_key" name="ozon_api_key" value="{{ $user->seller->ozon_api_key }}">
                                @error('ozon_api_key')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ozon_client_id">Client ID OZON</label>
                                <input type="text" class="input" id="ozon_client_id" name="ozon_client_id" value="{{ $user->seller->ozon_client_id }}">
                                @error('ozon_client_id')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="edit-profile__title title" style="font-size: 24px">
                    Изменить пароль
                </div>
                <div class="tab-content__form">
                    <div class="form-group">
                        <label for="old_password">Старый пароль</label>
                        <input type="text" class="input" id="old_password" name="old_password">
                        @error('old_password')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Новый пароль</label>
                        <input type="text" class="input" id="password" name="password">
                        @error('password')
                        <span class="error">{{ $message }}</span>
                        @enderror
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
