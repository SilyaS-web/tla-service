@extends('layout.layout')

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
