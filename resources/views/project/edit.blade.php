@extends('layout.layout')

@section('title', $title ?? 'Редактирование проекта')

@section('content')
<section class="create-project" id="edit-project">
    <div class="create-project__container _container">
        <form enctype="multipart/form-data" class="create-project__body" action="{{ route('update-project', ['project' => $project->id]) }}" method="POST">
            @csrf
            <div class="create-project__title title">
                Редактировать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <div class="form-group">
                            <label for="product-name">Название товара</label>
                            <input type="text" id="product-name" name="product_name" placeholder="Введите наименование товара" class="input input--product_name" value="{{$project->product_name}}">
                            @error('product_name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quest__step-row">
                            <div class="form-group">
                                <label for="product_nm">Артикул товара</label>
                                <input type="text" id="product_nm" name="product_nm" placeholder="Введите артикул" class="input input--product_price" value="{{$project->product_nm}}">
                                @error('product_nm')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_price">Цена товара</label>
                                <input type="number" id="product_price" name="product_price" placeholder="Введите цену" class="input input--product_price" value="{{$project->product_price}}">
                                @error('product_price')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_link">Ссылка на товар</label>
                                <input type="text" id="product_link" name="product_link" placeholder="Ссылка" class="input input--product_link" value="{{$project->product_link}}">
                                @error('product_link')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group--file create-project__files upload-files">
                            <div class="upload-files__title">
                                Загрузите изображения товара
                            </div>
                            <div class="upload-files__body">
                                @foreach ($project->projectFiles as $key => $project_image)
                                    <div class="upload-files__item uploaded">
                                        <div class="upload-files__path">Изображение - {{ $key }}</div>
                                        <div class="upload-files__delete" onclick = '(function(){$(event.target).closest(".upload-files__item").remove()})()'>

                                        </div>
                                        <input name="uploaded_images[]" value="{{ $project_image->id }}" hidden="">
                                    </div>
                                @endforeach

                                <div class="upload-files__plus">

                                </div>
                            </div>
                            @error('images')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group marketing-format">
                            @error("project_type")
                            <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="marketing-format__item input-checkbox-w">
                                <label for="product-feedback">Отзыв
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="feedback">
                                        ?
                                        <div class="format-hint format-hint--text" id="feedback">
                                            <div class="format-hint__title">
                                                Рекламный пост
                                            </div>
                                            <div class="format-hint__body">
                                                Улучшайте рейтинг вашей ĸарточĸи, публиĸуя положительные отзывы.
                                                Это поможет переĸрыть негативные отзывы и повысить доверие
                                                поĸупателей. Получите выĸупы не опасаясь санĸций от марĸетплейса.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="quantity-w" data-max="100">
                                    <div class="quantity-minus">
                                        <img src="{{ asset("img/minus-icon.svg") }}" alt="">
                                    </div>
                                    <div class="quantity-input">
                                        <input type="number" class="input" name="feedback-quantity" id="feedback-quantity" value="{{ $project->projectWorks()->where('type', 'feedback')->first()->quantity ?? 0 }}">
                                    </div>
                                    <div class="quantity-plus">
                                        <img src="{{ asset("img/plus-icon.svg") }}" alt="">
                                    </div>
                                </div>
                                <div class="format-tooltip" data-hint="feedback">
                                    ?
                                    <div class="format-hint format-hint--text" id="feedback">
                                        <div class="format-hint__title">
                                            Отзыв
                                        </div>
                                        <div class="format-hint__body">
                                            Улучшайте рейтинг вашей ĸарточĸи, публиĸуя положительные отзывы.
                                            Это поможет переĸрыть негативные отзывы и повысить доверие
                                            поĸупателей. Получите выĸупы не опасаясь санĸций от марĸетплейса.
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <label for="product-inst">
                                    Интеграция Ins
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="inst">
                                        ?
                                        <div class="format-hint format-hint--text" id="inst">
                                            <div class="format-hint__title">
                                                Интеграция Ins
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью reels. Повышайте охваты,
                                                узнаваемость и доверие ĸ вашему бренду и товару, используя
                                                интеграции в Ins с лидерами мнений.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="quantity-w" data-max="100">
                                    <div class="quantity-minus">
                                        <img src="{{ asset("img/minus-icon.svg") }}" alt="">
                                    </div>
                                    <div class="quantity-input">
                                        <input type="number" class="input" name="inst-quantity" id="inst-quantity" value="{{ $project->projectWorks()->where('type', 'inst')->first()->quantity ?? 0 }}">
                                    </div>
                                    <div class="quantity-plus">
                                        <img src="{{ asset("img/plus-icon.svg") }}" alt="">
                                    </div>
                                </div>
                                <div class="format-tooltip" data-hint="inst">
                                    ?
                                    <div class="format-hint format-hint--text" id="inst">
                                        <div class="format-hint__title">
                                            Интеграция Ins
                                        </div>
                                        <div class="format-hint__body">
                                            Увеличивайте продажи с помощью reels. Повышайте охваты,
                                            узнаваемость и доверие ĸ вашему бренду и товару, используя
                                            интеграции в Ins с лидерами мнений.
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <label for="product-youtube">
                                    Интеграция YTube
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="youtube">
                                        ?
                                        <div class="format-hint format-hint--text" id="youtube">
                                            <div class="format-hint__title">
                                                Интеграция YTube
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью нативных обзоров на товар и
                                                shorts. Повышайте охваты, ĸачайте seo, узнаваемость и доверие ĸ
                                                вашему бренду и товару, используя интеграции в YTube с лидерами
                                                мнений.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="quantity-w" data-max="100">
                                    <div class="quantity-minus">
                                        <img src="{{ asset("img/minus-icon.svg") }}" alt="">
                                    </div>
                                    <div class="quantity-input">
                                        <input type="number" class="input" name="youtube-quantity" value="{{ $project->projectWorks()->where('type', 'youtube')->first()->quantity ?? 0 }}">
                                    </div>
                                    <div class="quantity-plus">
                                        <img src="{{ asset("img/plus-icon.svg") }}" alt="">
                                    </div>
                                </div>
                                <div class="format-tooltip" data-hint="youtube">
                                    ?
                                    <div class="format-hint format-hint--text" id="youtube">
                                        <div class="format-hint__title">
                                            Интеграция YTube
                                        </div>
                                        <div class="format-hint__body">
                                            Увеличивайте продажи с помощью нативных обзоров на товар и
                                            shorts. Повышайте охваты, ĸачайте seo, узнаваемость и доверие ĸ
                                            вашему бренду и товару, используя интеграции в YTube с лидерами
                                            мнений.
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <label for="product-vk">
                                    Интеграция VK
                                    <div class="format-tooltip format-tooltip--mobile " data-hint="vk">
                                        ?
                                        <div class="format-hint format-hint--text" id="vk">
                                            <div class="format-hint__title">
                                                Интеграция VK
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью публиĸаций в ВК по вашей ЦА.
                                                Получите узнаваемость и доверие ĸ вашему бренду и товару,
                                                используя интеграции ВК в целевых паблиĸах.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="quantity-w" data-max="100">
                                    <div class="quantity-minus">
                                        <img src="{{ asset("img/minus-icon.svg") }}" alt="">
                                    </div>
                                    <div class="quantity-input">
                                        <input type="number" class="input" name="vk-quantity" value="{{ $project->projectWorks()->where('type', 'vk')->first()->quantity ?? 0 }}">
                                    </div>
                                    <div class="quantity-plus">
                                        <img src="{{ asset("img/plus-icon.svg") }}" alt="">
                                    </div>
                                </div>
                                <div class="format-tooltip" data-hint="vk">
                                    ?
                                    <div class="format-hint format-hint--text" id="vk">
                                        <div class="format-hint__title">
                                            Интеграция VK
                                        </div>
                                        <div class="format-hint__body">
                                            Увеличивайте продажи с помощью публиĸаций в ВК по вашей ЦА.
                                            Получите узнаваемость и доверие ĸ вашему бренду и товару,
                                            используя интеграции ВК в целевых паблиĸах.
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="marketing-format__item input-checkbox-w">
                                <label for="product-tg">
                                    Интеграция Telegram
                                    <div class="format-tooltip format-tooltip--mobile" data-hint="tg">
                                        ?
                                        <div class="format-hint format-hint--text" id="tg">
                                            <div class="format-hint__title">
                                                Интеграция Telegram
                                            </div>
                                            <div class="format-hint__body">
                                                Увеличивайте продажи с помощью публиĸаций в Телеграм по вашей
                                                ЦА. Получите охват по узĸой ЦА, узнаваемость и доверие ĸ вашему
                                                бренду и товару, используя интеграции Телеграм в целевых паблиĸах.
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="quantity-w" data-max="100">
                                    <div class="quantity-minus">
                                        <img src="{{ asset("img/minus-icon.svg") }}" alt="">
                                    </div>
                                    <div class="quantity-input">
                                        <input type="number" class="input" name="telegram-quantity" value="{{ $project->projectWorks()->where('type', 'telegram')->first()->quantity ?? 0 }}">
                                    </div>
                                    <div class="quantity-plus">
                                        <img src="{{ asset("img/plus-icon.svg") }}" alt="">
                                    </div>
                                </div>
                                <div class="format-tooltip" data-hint="tg">
                                    ?
                                    <div class="format-hint format-hint--text" id="tg">
                                        <div class="format-hint__title">
                                            Интеграция Telegram
                                        </div>
                                        <div class="format-hint__body">
                                            Увеличивайте продажи с помощью публиĸаций в Телеграм по вашей
                                            ЦА. Получите охват по узĸой ЦА, узнаваемость и доверие ĸ вашему
                                            бренду и товару, используя интеграции Телеграм в целевых паблиĸах.
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <span class="error error-format">

                            </span>
                        </div>
                        <div class="quest__btns">
                            <button class="btn btn-primary send" type="submit">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
