<x-app>
    <x-slot:title>Create Task</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <x-card>
                    <x-card.header>Create a new task</x-card.header>
                    <x-card.body>
                        <form action="{{ route('task.store') }}" method="post">
                            @csrf

                            <x-form.input name="{{ \App\Enum\Task::TITLE }}">Title</x-form.input>
                            <x-form.textarea name="{{ \App\Enum\Task::DESCRIPTION }}">Description</x-form.textarea>
                            <x-form.input name="{{ \App\Enum\Task::DUE_DATE }}" type="date">Due Date</x-form.input>

                            <x-form.select name="{{ \App\Enum\Task::PROJECT_ID }}" label="Project">
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
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
