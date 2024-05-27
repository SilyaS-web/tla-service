@extends('layout.layout')

@section('content')
<section class="create-project">
    <div class="create-project__container _container">
        <form enctype="multipart/form-data" class="create-project__body" action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="create-project__title title">
                Редактировать проект
            </div>
            <div class="create-project__quest quest">
                <div class="quest__steps">
                    <div id="step_1" class="quest__step step current">
                        <div class="quest__step-title">
                            Шаг <span class="current-step">1</span>
                            <!-- <span class="quest__step-arrow next"></span> -->
                        </div>
                        <div class="form-group">
                            <label for="project-name">Название проекта</label>
                            <input type="text" id="project-name" name="project_name" placeholder="Введите наименование проекта" class="input input--project_name">
                            @error('project_name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product-name">Название товара</label>
                            <input type="text" id="product-name" name="product_name" placeholder="Введите наименование товара" class="input input--product_name">
                            @error('product_name')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quest__step-row">
                            <div class="form-group">
                                <label for="project-price">Артикул товара</label>
                                <input type="text" id="product-articul" placeholder="Введите артикул" class="input input--product_price">
                                @error('product-articul')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-price">Цена товара</label>
                                <input type="number" id="project-price" name="product_price" placeholder="Введите цену" class="input input--product_price">
                                @error('product_price')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="project-link">Ссылка на товар</label>
                                <input type="text" id="project-link" name="product_link" placeholder="Ссылка" class="input input--product_link">
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
                                <div class="upload-files__item">
                                    <div class="upload-files__path">
                                        123123123.jpg
                                    </div>
                                    <div class="upload-files__delete">

                                    </div>
                                    <input type="file" hidden>
                                    <input type="text" data-id="" hidden>
                                </div>
                                <div class="upload-files__plus">

                                </div>
                            </div>
                            @error('images')
                                <span class="error">{{ $message }}</span>
                            @enderror
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
                            @error('project_type')
                            <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="input-checkbox-w">
                                <input type="checkbox" class="checkbox" name="project_type" value="feedback" id="product-feedback">
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
                            <div class="input-checkbox-w disabled">
                                <input type="checkbox" class="checkbox" id="product-inst">
                                <label for="product-inst">Рекламная интеграция (Inst) - Бартер</label>
                                <div class="format-tooltip" data-hint="inst">
                                    ?
                                    <div class="format-hint format-hint--text" id="inst">
                                        <div class="format-hint__title">
                                            Рекламная интеграция (Inst) - Бартер
                                        </div>
                                        <div class="format-hint__body">
                                            ...
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
