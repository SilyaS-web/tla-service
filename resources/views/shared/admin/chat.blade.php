@extends('layout.layout')

@section('content')
<section class="profile" id="seller">
    <div class="profile__container _container">
        <div class="profile__body">
            <div class="profile-chat__body">
                <div class="profile-projects__title title">
                    Переписка
                </div>
                <div class="profile-tabs__content-item">
                    <div class="tab-content__chat chat">
                        <div class="chat__body">
                            <div class="chat__right">
                                <div class="chat__messages messages-chat">
                                    @include('shared.chat.messages')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    <div>
</section>


@endsection
