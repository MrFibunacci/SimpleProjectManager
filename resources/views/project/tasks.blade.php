<x-app>
    <x-slot:title>Project: {{ $project->name }} - Tasks</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project">
            <div class="col-auto">
                <x-newButton route="task.create" :routeParameters="['project'=>$project]" label="New Task"/>
            </div>
            <div class="col">
                @if(app('request')->input('show') == 'all')
                    <x-newButton type="btn-secondary" route="project.tasks" :routeParameters="['project'=>$project,]" label="show only active"/>
                @else
                    <x-newButton type="btn-secondary" route="project.tasks" :routeParameters="['project'=>$project, 'show'=>'all']" label="Show all"/>
                @endif

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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr
                                @isset($task->due_date)
                                    @if($task->completed == null)
                                        @if($task->due_date->isNowOrPast())
                                            class="table-danger"
                                        @elseif($task->due_date->isTomorrow())
                                            class="table-warning"
                                        @endif
                                   @endif
                                @endisset>
                                <td>{{ $task->id }}</td>
                                <td><a href="{{route('task.show', $task)}}">{{ $task->title }}</a></td>
                                <td>@isset($task->due_date){{ $task->due_date->diffForHumans() }}@endisset</td>
                                <td>{{ $task->status->name }}</td>
                                <td>
                                    <x-actionLink.edit route="task" :param="$task"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app>
