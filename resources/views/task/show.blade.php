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
                    <dd class="col-sm-9">{{ $task->created_at }} ({{ $task->created_at->diffForHumans() }})</dd>

                    <dt class="col-sm-3">Last updated:</dt>
                    <dd class="col-sm-9">{{ $task->updated_at }} ({{ $task->updated_at->diffForHumans() }})</dd>

                    <dt class="col-sm-3">Due Date:</dt>
                    <dd class="col-sm-9">{{ $task->due_date }} @isset($task->due_date)({{ $task->due_date->diffForHumans() }})@endisset</dd>

                    <dt class="col-sm-3">Completed:</dt>
                    <dd class="col-sm-9">{{ $task->completed }} @isset($task->completed)({{ $task->completed->diffForHumans() }})@endisset</dd>

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
                    <form action="{{ route('comment.store', $task) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <textarea
                                class="form-control"
                                rows="1"
                                placeholder="Write a comment"
                                aria-label="Recipient's username"
                                name="text"
                                aria-describedby="comment"></textarea>
                            <button class="btn btn-primary" type="submit" id="comment"><i class="bi bi-send"></i></button>
                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="row">
                    @foreach($commentsAndActivities as $element)
                        @if(is_a($element, \App\Models\Comment::class))
                            <div class="card p-1 mb-1">
                                <div class="card-body p-1">
                                    <b>{{ $element->user->name }}, {{ $element->created_at->diffForHumans() }}</b> <br>
                                    {!! nl2br($element->text) !!}
                                </div>
                            </div>
                        @elseif(is_a($element, \App\Models\Activity::class))
                            <p class="text-center mb-0">
                                <b>{{ $element->attribute->name }}</b> {{ $element->action->name }} from <b>{{ $element->oldVal }}</b> to <b>{{ $element->newVal }}</b> by <b>{{ $element->user->name }}</b> at {{ $element->created_at }}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app>
