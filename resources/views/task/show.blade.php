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
                    <dd class="col-sm-9">{!! nl2br($task->description) !!}</dd>
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
                    @foreach($task->comments as $comment)
                        <div class="card ps-1 mb-1">
                            <div class="card-body p-1">
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <p class="card-text">{!! nl2br($comment->text) !!}</p>
                                    </div>
                                    <div class="col-auto text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Edit <i class="bi bi-pencil-square"></i></a></li>
                                                <li><a class="dropdown-item" href="#">Delete <i class="bi bi-trash"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <footer class="blockquote-footer text-end mb-1">from <b>{{ $comment->user->name }}</b> {{ $comment->created_at->ago() }}</footer>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app>
