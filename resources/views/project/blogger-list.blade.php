@forelse ($projects as $project)
    <div class="list-projects__item project-item">
        <div class="owl-carousel project-item__carousel">
            <div class="project-item__img">
                <img src="{{ $project->getImageURL(true) }}" alt="">
                <div class="project-item__status active">
                    {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
                </div>
                <div class="project-item__country">
                    Россия
                </div>
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                Цена — {{ $project->product_price }}₽
            </div>
            {{-- <div class="project-item__left" style="margin-bottom: 12px;">
                Осталось выполнить отзывов <span style="font-weight: 600; color:#FE5E00">5</span>
            </div> --}}
            <a class="project-item__participants" title="{{ $project->product_name }}">
                {{ $project->seller->user->name }} / {{ $project->product_name }}
            </a>
            <div class="project-item__format-tags card__row card__tags">
                <div class="card__tags-item">
                    <span>Рекламный пост</span>
                </div>
            </div>
            {{-- <div class="project-item__btns">
                <a href="#" class="btn btn-primary">Отправить</a>
            </div> --}}
        </div>
    </div>

@empty
    Нет проектов
@endforelse
