<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/"></a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" required autofocus />
               @if ($errors->has('email'))
                    <span class="text-danger"role="alert">
                        <p>{{ $errors->first('email') }}.</p>
                    </span>
                @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                @if ($errors->has('password'))
                    <span class="text-danger"role="alert">
                        <p>{{ $errors->first('password') }}.</p>
                    </span>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
            <p>Not yet registered? Please <a href="{{ route('register') }}">Register</a></p>
        </form>
    </x-auth-card>
</x-guest-layout>
