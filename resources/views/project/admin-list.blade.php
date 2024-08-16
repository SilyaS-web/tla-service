<div class='list-projects__items admin-view__content-wrap'>
    @forelse ($all_projects as $project)
    <div class="list-projects__item project-item" data-id="{{ $project->id }}">
        <div class="project-item__carousel">
            <div class="project-item__carousel--carousel owl-carousel">
                @foreach ($project->getImageURL() as $image)
                <div class="project-item__img" style="background-image:url({{ $image }})"></div>
                @endforeach
            </div>
            <div class="project-item__status active">
                {{ $project->getStatusName() }}
            </div>
        </div>
        <div class="project-item__content">
            <div class="project-item__title">
                {{ number_format($project->product_price, 0, '', ' ')  }}₽
            </div>
            <div class="project-item__subtitle" title="{{ $project->product_name }}">
                {{ $project->product_name }}
            </div>
            <div class="project-item__format-tags card__row card__tags">
                @foreach ($project->projectWorks as $project_work)
                    <div class="card__tags-item" data-id="{{ $project_work->id }}">
                        <span>{{ $project->getProjectWorkNames($project_work->type) }} - {{ $project_work->quantity - $project->works()->where('project_work_id', $project_work->id)->where('status', '<>', null)->count() }}/{{ $project_work->quantity }}</span>
                    </div>
                @endforeach
            </div>
            <div class="project-item__btns">
            @if ($project->status == -2)
                <a href="/apist/projects/{{$project->id}}/unban" class="btn btn-primary" style="width:100%">Разблокировать</a>
            @else
                <a href="/apist/projects/{{$project->id}}/ban" class="btn btn-primary" style="width:100%">Заблокировать</a>
            @endif
            </div>
        </div>
    </div>
    @empty
        Нет проектов
    @endforelse
</div>
