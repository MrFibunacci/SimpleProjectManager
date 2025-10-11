<x-app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <x-card.header>{{ __('Confirm Password') }}</x-card.header>

                    <x-card.body>
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <x-form.input name="password" autocomplete="current-password" required>
                                {{ __('Password') }}
                            </x-form.input>

                            <x-form.submit>
                                <x-slot:additonalText>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </x-slot:additonalText>

                                {{ __('Confirm Password') }}
                            </x-form.submit>
                        </form>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </div>
</x-app>
