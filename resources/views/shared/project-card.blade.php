<div class="list-projects__item project-item">
    <div class="project-item__img">
        <img src=" {{ $project->getImageURL() }}" alt="Картинка товара">
        <div class="project-item__status active">
            {{ $project->status == 0 ? 'Активно' : 'Завершено' }}
        </div>
        <div class="project-item__country">
            Россия
        </div>
    </div>
    <div class="project-item__content">
        <div class="project-item__title">
            {{ $project->product_price }}
        </div>
        <a class="project-item__participants" title="{{ $project->product_name }}">
            {{ $project->product_name }}
        </a>
        <div class="project-item__format-tags card__row card__tags">
            <div class="card__tags-item">
                <span>Рекламный пост</span>
            </div>
        </div>
        <div class="project-item__btns">
            <a href="{{ route('projects.show', [$project]) }}" class="btn btn-primary">Подробности</a>
        </div>
    </div>
</div>
