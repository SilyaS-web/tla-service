@extends('layout.layout')

@section('content')
<section class="create-project">
    <div class="create-project__container _container">
        <form enctype="multipart/form-data" class="create-project__body" action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="create-project__title title">
                Создать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <div class="quest__step-title">
                            Шаг <span class="current-step">1</span>
                            <!-- <span class="quest__step-arrow next"></span> -->
                        </div>
                        <div class="form-group">
                            <label for="product-name">Название товара</label>
                            <input type="text" id="product-name" name="product_name" placeholder="Введите наименование товара" class="input input--product_name">
                            <span class="error error-product-name">

                            </span>
                        </div>
                        <div class="quest__step-row">
                            {{-- <div class="form-group">
                                <label for="project-price">Артикул товара</label>
                                <input type="text" id="product-articul" name="" placeholder="Введите артикул" class="input input--product_price">
                                <span class="error error-project-price">

                                </span>
                            </div> --}}
                            <div class="form-group">
                                <label for="project-price">Цена товара</label>
                                <input type="number" id="project-price" name="product_price" placeholder="Введите цену" class="input input--product_price">
                                <span class="error error-project-price">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="product-link">Ссылка на товар</label>
                                <input type="text" id="product-link" name="product_link" placeholder="Ссылка" class="input input--product_link">
                                <span class="error error-project-link">

                                </span>
                            </div>
                            {{-- <div class="form-group">
                                <label for="project-link">Ссылка на маркетплейс</label>
                                <input type="text" id="marketplace-link" name="marketplace_link" placeholder="Ссылка" class="input input--product_link">
                                <span class="error error-project-link">

                                </span>
                            </div> --}}
                        </div>
                        <div class="form-group form-group--file">
                            <label class="input-file" for="product-img">
                                <span>Загрузите изображение товара</span>
                                <input type="file" name="product_images[]" class="" id="product-img">
                            </label>
                            <span class="error error-product-img">

                            </span>
                        </div>
                        <div class="form-group form-group--file">
                            <label class="input-file" for="product-img2">
                                <span>Загрузите изображение товара</span>
                                <input type="file" name="product_images[]" class="" id="product-img2">
                            </label>
                            <span class="error error-product-img">

                            </span>
                        </div>
                        <div class="quest__btns">
                            <button class="btn btn-primary next" type="button">
                                Далее
                            </button>
                        </div>
                    </div>
                    <div id="step_2" class="quest__step step">
                        <div class="quest__step-title">
                            Шаг <span class="current-step">2</span>
                            <!-- <span class="quest__step-arrow send"></span> -->
                        </div>
                        <div class="form-group marketing-format">
                            <label for="format">Выберите формат рекламы</label>
                            <div class="input-checkbox-w">
                                <input type="checkbox" name="project_type" class="checkbox" value="feedback" id="product-feedback" checked>
                                <label for="product-feedback">Отзыв на товар - Бартер</label>
                                <div class="format-tooltip" data-hint="feedback">
                                    ?
                                    <div class="format-hint format-hint--text" id="feedback">
                                        <div class="format-hint__title">
                                            Рекламный пост
                                        </div>
                                        <div class="format-hint__body">
                                            Приятно, граждане, наблюдать, как акционеры крупнейших компаний формируют глобальную экономическую сеть и при этом — объявлены нарушающими общечеловеческие нормы этики и морали
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-checkbox-w">
                                <input type="checkbox" name="project_type" class="checkbox" value="feedback" id="product-feedback" checked>
                                <label for="product-feedback">Отзыв на товар - Бартер</label>
                                <div class="format-tooltip" data-hint="feedback">
                                    ?
                                    <div class="format-hint format-hint--text" id="feedback">
                                        <div class="format-hint__title">
                                            Рекламная интеграция (Inst) - Бартер
                                        </div>
                                        <div class="format-hint__body">
                                            Приятно, граждане, наблюдать, как акционеры крупнейших компаний формируют глобальную экономическую сеть и при этом — объявлены нарушающими общечеловеческие нормы этики и морали
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-checkbox-w disabled">
                                <input type="checkbox" class="checkbox" id="product-youtube">
                                <label for="product-youtube">Рекламная интеграция (YouTube) - Бартер</label>
                                <div class="format-tooltip" data-hint="youtube">
                                    ?
                                    <div class="format-hint format-hint--text" id="youtube">
                                        <div class="format-hint__title">
                                            Рекламная интеграция (YouTube) - Бартер
                                        </div>
                                        <div class="format-hint__body">
                                            ...
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-checkbox-w disabled">
                                <input type="checkbox" class="checkbox" id="product-other">
                                <label for="product-other">Другие площадки для интеграций - Бартер</label>
                                <div class="format-tooltip" data-hint="other">
                                    ?
                                    <div class="format-hint format-hint--text" id="other">
                                        <div class="format-hint__title">
                                            Другие площадки для интеграций - Бартер
                                        </div>
                                        <div class="format-hint__body">
                                            ...
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-checkbox-w disabled">
                                <input type="checkbox" class="checkbox" id="product-payment">
                                <label for="product-payment">Платные интеграции</label>
                                <div class="format-tooltip" data-hint="payment">
                                    ?
                                    <div class="format-hint format-hint--text" id="payment">
                                        <div class="format-hint__title">
                                            Платные интеграции
                                        </div>
                                        <div class="format-hint__body">
                                            ...
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <span class="error error-format">

                            </span>
                        </div>
                        <div class="quest__btns">
                            <button class="btn btn-secondary back" type="button">
                                Назад
                            </button>
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
