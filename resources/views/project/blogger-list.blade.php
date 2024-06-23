@forelse ($project_works as $work)
@if($type == 'applications')
    @php($project_work = $work->projectWork)
@else
    @php($project_work = $work)
@endif

{{-- @dd($work) --}}
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
            @switch($type)

            @case('all')
            <button class="btn btn-primary btn-blogger-send-offer" style="width:100%" data-project-work="{{ $project_work->id }}">Откликнуться</button>
            @break

            @case('applications')
            <button class="btn btn-primary" onclick="acceptApplication({{ $work->id }}, this)">Принять заявку</button>
            @break

            @case('active')
            <button class="btn btn-primary" onclick="goToChat({{ $project_work->id }})">Перейти в чат</button>
            @break
            {{--
            @case('finish')
            <a href="" class="btn btn-primary" id="confirm-completion-blogger-btn" data-work-id="{{ $project_work->id }}>">Подтвердить выполнение</a>
            @break --}}

            @endswitch
        </div>
    </div>
</div>
@empty
Нет проектов
@endforelse

<script>
    function acceptApplication(work_id, el) {
        el.innerHTML = '<div class="lds-dual-ring"></div>';
        $.post({
            url: '/apist/works/accept-application',
            data: {
                work_id: work_id
            },
            success: function(data, textStatus, jqXHR) {
                el.innerHTML = 'Заявка отправлена';
                el.disabled = true;
                notify('info', {
                    title: 'Успешно!',
                    message: 'Вы приняли заявку!'
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                el.innerHTML = 'Откликнуться';
                notify('error', {
                    title: 'Ошибка!',
                    message: 'Не удалось отправить заявку!'
                });
            }
        });
    }

    function sendProjectToSeller(project_work_id, el) {
        el.innerHTML = '<div class="lds-dual-ring"></div>';
        $.post({
            url: '/apist/works'
            , data: {
                project_work_id: project_work_id
            }
            , success: function(data, textStatus, jqXHR) {
                el.innerHTML = 'Заявка отправлена';
                el.disabled = true;
                notify('info', {
                    title: 'Успешно!'
                    , message: 'Ваша заявка была отправлена селлеру!'
                })
            }
            , error: function(jqXHR, textStatus, errorThrown) {
                el.innerHTML = 'Откликнуться';
                notify('error', {
                    title: 'Ошибка!'
                    , message: 'Не удалось отправить заявку!'
                });
            }
        });
    }

    function goToChat(project_work_id) {
        $('#blogger .chat-link').click();
        $(`.item-chat[data-id="${project_work_id}"]`).click();
    }
</script>
