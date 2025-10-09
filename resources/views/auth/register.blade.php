<x-app>
    <x-slot:title>Register</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <x-card.header>{{ __('Register') }}</x-card.header>

                    <x-card.body>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <x-form.input name="name" type="text" required autofocus>
                                {{ __('Name') }}
                            </x-form.input>

                            <x-form.input name="email" required>
                                {{ __('Email Address') }}
                            </x-form.input>

                            <x-form.input name="password" required>
                                {{ __('Password') }}
                            </x-form.input>

                            <x-form.input name="password_confirmation" type="password" required>
                                {{ __('Confirm Password') }}
                            </x-form.input>

                            <x-form.submit>
                                {{ __('Register') }}
                            </x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
