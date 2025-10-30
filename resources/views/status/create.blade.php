<x-app>
    <x-slot:title>Create new Status</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <x-card>
                    <x-card.header>Create a new status</x-card.header>
                    <x-card.body>
                        <form method="POST" action="{{ route('status.store') }}">
                            @csrf

                            <x-form.input name="name" required autofocus>
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
