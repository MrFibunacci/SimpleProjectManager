<div class="row">
    <div class="col-auto">
        <h1>{{ $project->name }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-auto">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a type="button" class="btn btn-primary" href="{{ route('project.show', $project) }}">overview</a>
            <a type="button" class="btn btn-primary" href="{{ route('project.tasks', $project) }}">tasks</a>
            <a type="button" class="btn btn-primary disabled">docs</a>
            <a type="button" class="btn btn-primary disabled">settings</a>
        </div>
    </div>

    {{ $slot }}
</div>
