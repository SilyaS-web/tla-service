<div class="profile-chat__body">
    <div class="profile-projects__title title">
        <? if(auth()->user()->role == 'seller'): ?>
            Переписка с блогерами
        <?else:?>
            Переписка с селлерами
        <?endif?>
    </div>
    <div class="profile-tabs__content-item">
        <div class="tab-content__chat chat">
            <div class="chat__body">
                <div class="chat__left">
                    <div class="chat__chat-items">
                        @forelse ($works as $work)
                            @include('shared.chat.item')
                        @empty
                            <p class="chat__chat-empty">Переписка пустая, <span style="color:var(--primary); cursor:pointer" onclick="(function(){ $(document).find('.nav-menu__item.project-link').click() })();">создайте проект</span> и начните работу с блогерами</p>
                        @endforelse

                    </div>
                </div>
                <div class="chat__right">
                    <div class="chat__overflow chat__overflow--completed" style="z-index: 1; display:none">
                        <div class="chat__overflow-text">
                            Проект завершен
                        </div>
                    </div>
                    <div class="chat__overflow chat__overflow--tariff" style="z-index: 1; display:none">
                        <div class="chat__overflow-text">

                        </div>
                    </div>
                    <div class="chat__back">
                        <img src="{{asset('img/arrow-alt.svg')}}" alt="">
                        <span> Вернуться </span>
                    </div>
                    <div class="chat__messages messages-chat">

                    </div>

                    <div class="chat__messages messages-create">
                        <div class="textarea-w">
                            <div class="textarea-upload">
                                <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg" class="base-0-2-1" ie-style="">
                                    <path clip-rule="evenodd" d="m14.9502 3.80108c-1.0653-1.06811-2.7917-1.06811-3.857 0l-5.53401 5.54845c-1.74559 1.75017-1.74559 4.58847 0 6.33867 1.7445 1.7491 4.57211 1.7491 6.31661 0l.0025-.0026 2.8799-2.8595c.294-.2918.7688-.2901 1.0607.0038.2918.2939.2901.7688-.0038 1.0606l-2.8773 2.857-.0013.0013c-2.3307 2.3354-6.1092 2.3349-8.43936-.0013-2.32952-2.3356-2.32952-6.1216 0-8.45724l5.53396-5.54845c1.6514-1.65575 4.3297-1.65575 5.9811 0 1.6504 1.65465 1.6504 4.33657 0 5.99123l-5.5339 5.54846c-.97226.9748-2.54938.9748-3.52162 0-.97115-.9737-.97115-2.5516 0-3.5253l.0024-.0024 3.10232-3.08243c.2939-.29195.7688-.29042 1.0607.00341.292.29383.2904.7687-.0034 1.06065l-3.09997 3.08007-.00102.001c-.38619.3883-.38586 1.0178.00102 1.4057.38613.3872 1.01136.3872 1.3975 0l5.53397-5.54844c1.0664-1.06918 1.0664-2.80349 0-3.87268z" fill="currentColor" fill-rule="evenodd"></path>
                                </svg>
                                <label for = "chat-upload" class="textarea-upload__text">
                                    Прикрепите файл
                                </label>
                                <input type="file" id = "chat-upload" hidden>
                            </div>
                            <textarea name="" id="" placeholder="Введите текст" class="messages-create__textarea textarea"></textarea>
                        </div>
                        <div class="chat__btns" style="display: flex; flex-wrap: wrap; gap:8px;">
                            <button class="btn btn-primary btn-send-msg">Отправить</button>
                            <a href="" class="btn btn-secondary btn-action" id="">Подтвердить выполнение проекта</a>
                        </div>
                    </div>

                    <div class="chat__overflow">
                        <div class="chat__overflow-text">
                            @if(count($works) == 0)
                                @if(auth()->user()->role == 'seller')
                                    Сейчас у вас нет возможности переписываться с блогерами. Чтобы отправлять сообщения создайте проек
                                @else
                                    Сейчас у вас нет возможности переписываться. Чтобы начать переписываться, начните работу с селлерами.
                                @endif
                            @else
                                Выберите чат, чтобы начать переписку
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
