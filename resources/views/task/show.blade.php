<x-app>
    <x-slot:title>Task: {{ $task->title }}</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-auto">
                <h1>
                    <a href="{{ route('project.tasks', $task->project) }}">{{ $task->project->name }}</a>
                    Task -> {{ $task->title }}

                    <x-actionLink.edit route="task" :param="$task"/>

                    @if($task->completed == null)
                        <a href="{{ route('task.complete', $task) }}"><i class="bi bi-check2-square"></i></a>
                    @endif
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <dl class="row">
                    <dt class="col-sm-3">Created:</dt>
                    <dd class="col-sm-9">{{ $task->created_at }}</dd>

                    <dt class="col-sm-3">Last updated:</dt>
                    <dd class="col-sm-9">{{ $task->updated_at }}</dd>

                    <dt class="col-sm-3">Due Date:</dt>
                    <dd class="col-sm-9">{{ $task->due_date }}</dd>

                    <dt class="col-sm-3">Completed:</dt>
                    <dd class="col-sm-9">{{ $task->completed }}</dd>

                    <dt class="col-sm-3">Parent task:</dt>
                    <dd class="col-sm-9">
                        @if(isset($task->parent_task))
                            <div class="list-group">
                                <a href="{{ route('task.show', $task->parent_task) }}"
                                   class="list-group-item list-group-item-action">
                                    {{ $task->parent_task->title }}
                                    <span class="badge bg-secondary">{{ $task->parent_task->status->name }}</span>
                                </a>
                            </div>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Child tasks:</dt>
                    <dd class="col-sm-9">
                        @if(isset($task->child_tasks))
                            <div class="list-group">
                                @foreach($task->child_tasks as $child_task)
                                    <a href="{{ route('task.show', $child_task) }}"
                                       class="list-group-item list-group-item-action">
                                        {{ $child_task->title }}
                                        <span class="badge bg-secondary">{{ $child_task->status->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9">{{ $task->status->name }}</dd>

                    <dt class="col-sm-3">Description:</dt>
                    <dd class="col-sm-9">
                        <div class="card">
                            <div class="card-body p-2">
                                {!! nl2br($task->description) !!}
                            </div>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <h2>Comments and Activity</h2>
                    <form action="#">
                        <div class="input-group mb-3">
                            <textarea
                                class="form-control"
                                rows="1"
                                placeholder="Write a comment"
                                aria-label="Recipient's username"
                                aria-describedby="comment"></textarea>
                            <button class="btn btn-primary" type="submit" id="comment"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    @foreach($commentsAndActivities as $element)
                        @dump($element)
                        @if(is_a($element, \App\Models\Comment::class))
                            <p>{{$element->text}} from {{ $element->user->name }}</p>
                        @elseif(is_a($element, \App\Models\Activity::class))
                            <p class="text-center mb-0">{{ $element->attribute->name }} {{ $element->action->name }} {{ $element->oldVal }} {{ $element->oldVal }} by {{ $element->user->name }}</p>
                            <p class="text-center mb-0">Description updated from ... to ... by user</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app>
