@forelse ($projects as $project)
    <div class="list-projects__item project-item">
        <div class="owl-carousel project-item__carousel">
            <div class="project-item__img">
                <img src="{{ $project->getImageURL(true) }}" alt="">
            </div>
            <div class="project-item__status active">
                {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
            </div>
            <div class="project-item__country">
                Россия
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                {{ $project->product_price }}₽
            </div>
            <div class="project-item__subtitle" title="{{ $project->product_name }}">
                {{ $project->product_name }}
            </div>
            <div class="project-item__left" style="margin-bottom: 12px;">
                <div class="line">
                    <div class="line__val" style="width:65%"></div>
                </div>
                Осталось мест на интеграцию <span style="font-weight: 700;">5/10</span>
            </div>
            <div class="project-item__format-tags card__row card__tags">
                <div class="card__tags-item">
                    <span>Рекламный пост</span>
                </div>
            </div>
            <div class="project-item__btns">
                {{-- <a href="" class="btn btn-primary" id = "confirm-completion-blogger-btn" data-work-id = "<?=$project->id?>">Подтвердить выполнение</a> --}}
                <a href="#" data-project-id="<?=$project->id?>" data-articul="12333333" class="btn btn-primary btn-choose-project">Выбрать</a>
            </div>
        </div>
    </div>

@empty
    Нет проектов
@endforelse
