<x-app>
    <x-slot:title>Edit Status</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <x-card>
                    <x-card.header>Update status</x-card.header>

                    <x-card.body>
                        <form action="{{ route('status.update', $status) }}" method="post">
                            @method('patch')
                            @csrf

                            <x-form.input name="name" value="{{ old('name', $status->name) }}">
                                Name
                            </x-form.input>

                            <x-form.submit>Submit</x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
