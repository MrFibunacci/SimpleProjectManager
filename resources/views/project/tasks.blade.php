<x-app>
    <x-slot:title>Project: {{ $project->name }} - Tasks</x-slot:title>

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

        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Due date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
