<x-app>
    <x-slot:title>Login</x-slot:title>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <x-card.header>{{ __('Login') }}</x-card.header>

                    <x-card.body>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <x-form.input name="email" required autofocus>
                                {{ __('Email Address') }}
                            </x-form.input>

                            <x-form.input name="password" required>
                                {{ __('Password') }}
                            </x-form.input>

                            <x-form.checkbox name="remember" required>
                                {{ __('Remember Me') }}
                            </x-form.checkbox>

                            <x-form.submit>
                                <x-slot:additonalText>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </x-slot:additionalText>

                                {{ __('Login') }}

                            </x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
