@forelse ($projects as $project)
@foreach ($project->projectWorks as $project_work)
@php($lost_seats = $project_work->quantity - $project->works()->where('project_work_id', $project_work->id)->count())
<div class="list-projects__item project-item" data-id="{{ $project->id }}">
    <div class="owl-carousel project-item__carousel">
        <div class="project-item__img">
            <img src="{{ $project->getImageURL(true) }}" alt="">
        </div>
        <div class="project-item__status active">
            {{ $project->active == 0 ? 'Активно' : 'Выполнено' }}
        </div>
        {{-- <div class="project-item__country">
            Россия
        </div> --}}
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
                <div class="line__val" style="width:{{ ($lost_seats / $project_work->quantity) * 100 }}%"></div>
            </div>
            Осталось мест на интеграцию <span style="font-weight: 700;">{{ $project_work->quantity }}/{{ $lost_seats }}</span>
        </div>
        <div class="project-item__format-tags card__row card__tags">
            <div class="card__tags-item">
                {{ $project_work->getProjectWorkName() }}
            </div>
        </div>
        <div class="project-item__btns">
            @switch($type)

            @case('all')
            <a href="/apist/works?project_work_id={{ $project_work->id }}&" class="btn btn-primary">Откликнуться</a>
            @break

            @case('start')
            <a href="/apist/work/{{ $project_work->id }}/accept" class="btn btn-primary" id="accept-btn">Начать работу</a>
            @break

            @case('finish')
            <a href="" class="btn btn-primary" id="confirm-completion-blogger-btn" data-work-id="{{ $project_work->id }}>">Подтвердить выполнение</a>
            @break

            @endswitch
        </div>
    </div>
</div>
@endforeach
@empty
Нет проектов
@endforelse
