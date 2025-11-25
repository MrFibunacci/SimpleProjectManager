<x-app>
    <x-slot:title></x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <x-card>
                    <x-card.header>Create a new task</x-card.header>
                    <x-card.body>
                        <form action="{{ route('task.update', ['task'=>$task]) }}" method="post">
                            @csrf

                            <x-form.input name="{{ \App\Enum\Task::TITLE }}" :value="$task->title">Title</x-form.input>
                            <x-form.textarea name="{{ \App\Enum\Task::DESCRIPTION }}" :value="$task->description">Description</x-form.textarea>
                            <x-form.input name="{{ \App\Enum\Task::DUE_DATE }}" type="date" :value="$task->due_date_for_form()">Due Date</x-form.input>

                            <x-form.select name="{{ \App\Enum\Task::PROJECT_ID }}" label="Project">
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </x-form.select>

                            <x-form.select name="{{ \App\Enum\Task::STATUS_ID }}" label="Status">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" @if($status->id == $task->status->id)selected @endif>{{ $status->name }}</option>
                                @endforeach
                            </x-form.select>

                            <x-form.select name="{{ \App\Enum\Task::PARENT_TASK_ID }}" label="Parent Task">
                                <option value="" @if(!isset($task->parent_task))selected @endif>None</option>
                                @foreach($tasks as $parent_task)
                                    <option value="{{ $parent_task->id }}" @if(isset($task->parent_task) && $parent_task->id == $task->parent_task->id)selected @endif>{{ $parent_task->title }}</option>
                                @endforeach
                            </x-form.select>

                            <x-form.submit>Submit</x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
