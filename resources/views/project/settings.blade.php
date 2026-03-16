<x-app>
    <x-slot:title>Project: {{ $project->name }} - Settings</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project"/>
    </div>

    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col">
                <h1>Settings</h1>
                <form action="">
                    @csrf

                    <x-form.input name="name" :value="$project->name" required autofocus>
                        Name
                    </x-form.input>

                    <x-form.textarea name="description" :value="$project->description" required>
                        Description
                    </x-form.textarea>

                    <x-form.input name="due_date" type="date" :value="$project->due_date" required>
                        Due date
                    </x-form.input>

                    <x-form.select name="status" label="Status">
                        @foreach(\App\Models\Status::all() as $status)
                            <option value="{{ $status->id }}"  @if($status->id == $project->status->id)selected @endif>{{ $status->name }}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.submit>
                        Save
                    </x-form.submit>
                </form>
            </div>
            <div class="col">
                <h1>Users</h1>

                <div class="alert alert-warning" role="alert">
                    Under construction!
                </div>

                <form>
                    @csrf

                    @foreach($project->users as $user)
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ $user->name }}</span>
                            <select class="form-select" aria-label="Default select example">
                                @foreach(\App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    <x-form.input name="newUser">
                        New user
                    </x-form.input>

                    <x-form.submit>
                        Add
                    </x-form.submit>
                </form>
            </div>
        </div>
    </div>
</x-app>
