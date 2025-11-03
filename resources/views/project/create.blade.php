<x-app>

    <x-slot:title>Create Project</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <x-card.header>Create Project</x-card.header>

                    <x-card.body>
                        <form method="POST" action="{{ route('project.store') }}">
                            @csrf

                            <x-form.input name="name" required autofocus>
                                Name
                            </x-form.input>

                            <x-form.textarea name="description">
                                Description
                            </x-form.textarea>

                            <x-form.input name="due_date" type="date">
                                Due date
                            </x-form.input>

                            <x-form.select name="status" label="Status">
                                @foreach(\App\Models\Status::all() as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </x-form.select>


                            <x-form.submit>
                                Submit
                            </x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>

</x-app>
