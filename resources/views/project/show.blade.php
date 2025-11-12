<x-app>
    <x-slot:title>Project: {{ $project->name }}</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-auto">
                <h1>{{ $project->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a type="button" class="btn btn-primary" href="{{ route('project.tasks', $project) }}">tasks</a>
                    <a type="button" class="btn btn-primary disabled">docs</a>
                    <a type="button" class="btn btn-primary disabled">settings</a>
                </div>
            </div>
        </div>
    </div>
</x-app>
