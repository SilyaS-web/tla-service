
@php($lost_seats = $project_work->quantity - $project_work->project->works()->where('project_work_id', $project_work->id)->count())
<div class="list-projects__item project-item" data-id="{{ $project_work->project->id }}">
    <div class="project-item__carousel">
        <div class="project-item__carousel--carousel owl-carousel">
            @foreach ($project_work->project->getImageURL() as $image)
            <div class="project-item__img" style="background-image:url({{ $image }})"></div>
            @endforeach
        </div>
        <div class="project-item__status active">
            {{ $project_work->project->active == 0 ? 'Активно' : 'Выполнено' }}
        </div>
        {{-- <div class="project-item__country">
            Россия
        </div> --}}
    </div>
    <div class="project-item__content">
        <div class="project-item__title">
            {{ $project_work->project->product_price }}₽
        </div>
        <div class="project-item__subtitle" title="{{ $project_work->project->product_name }}">
            {{ $project_work->project->product_name }}
        </div>
        <div class="project-item__left" style="margin-bottom: 12px;">
            <div class="line">
                <div class="line__val" style="width:{{ ($lost_seats / $project_work->quantity) * 100 }}%"></div>
            </div>
            Осталось мест на интеграцию <span style="font-weight: 700;">{{ $lost_seats }}/{{ $project_work->quantity }}</span>
        </div>
        <div class="project-item__format-tags card__row card__tags">
            <div class="card__tags-item">
                {{ $project_work->getProjectWorkName() }}
            </div>
        </div>
        <div class="project-item__btns">
            <a href="/apist/projects/{{$project_work->id}}/ban" class="btn btn-primary" style="width:100%">Заблокировать</a>
        </div>
    </div>
</div>
@empty
    Нет проектов
@endforelse

<script>
</script>
