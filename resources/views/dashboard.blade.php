<x-app>
    <x-slot:title>Home</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <x-card>
                    <x-card.header>Projects</x-card.header>
                    <x-card.body>
                        <div class="list-group list-group-flush">
                            @foreach($projects as $project)
                                <a href="{{ route('project.show', $project) }}" class="list-group-item list-group-item-action">{{ $project->name }}</a>
                            @endforeach
                        </div>
                    </x-card.body>
                </x-card>
            </div>
            <div class="col-md-auto">
                <x-card>
                    <x-card.header>Tasks</x-card.header>
                    <x-card.body>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Project</th>
                                    <th>Due date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    @if(!is_null($task->due_date) && \Carbon\Carbon::createFromTimeString($task->due_date)->eq(now()->toDateString()))
                                        <tr class="table-warning">
                                    @elseif(!is_null($task->due_date) && \Carbon\Carbon::createFromTimeString($task->due_date)->lt(now()))
                                        <tr class="table-danger">
                                    @else
                                        <tr>
                                    @endif
                                        <td><a href="{{ route('task.show', $task) }}">{{ $task->title }}</a></td>
                                        <td><a href="{{ route('project.show', $task->project) }}">{{ $task->project->name }}</a></td>
                                        <td>{{ $task->due_date_for_form() }}</td>
                                        <td>{{ $task->status->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
