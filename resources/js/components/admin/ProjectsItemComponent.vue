<template>
    <div class="list-projects__item project-item" data-id="1">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                <div class="project-item__img" style=""></div>
            </div>
            <div class="project-item__status active">
                Статус
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                1234₽
            </div>
            <div class="project-item__subtitle" title="">
                Название проекта
            </div>
            <div class="project-item__format-tags card__row card__tags">
               <div class="card__tags-item" data-id="1">
                    <span>Интеграций - 5/10</span>
                </div>
            </div>
            <div class="project-item__btns">
            <a href="/apist/projects/1/unban" class="btn btn-primary" style="width:100%">Разблокировать</a>
                <!-- <a href="/apist/projects/{{$project->id}}/ban" class="btn btn-primary" style="width:100%">Заблокировать</a> -->
            </div>
        </div>
    </div>
</template>
