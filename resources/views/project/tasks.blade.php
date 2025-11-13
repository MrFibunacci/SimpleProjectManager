<x-app>
    <x-slot:title>Project: {{ $project->name }} - Tasks</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project">
            <div class="col">
                <x-newButton route="task.create" :routeParameters="['project'=>$project]" label="New Task"/>
            </div>
        </x-projectHeader>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Due date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
