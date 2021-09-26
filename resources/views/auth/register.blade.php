<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo"></x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        {{-- @if(count($errors) > 0)
<div class="p-1">
    @foreach($errors->all() as $error)
    <div class="alert alert-warning alert-danger fade show" role="alert">{{$error}} <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>
    @endforeach
</div>
@endif --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                @if ($errors->has('name'))
                <span class="text-danger"role="alert">
                    <p>{{ $errors->first('name') }}.</p>
                </span>
                 @endif
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                @if ($errors->has('email'))
                <span class="text-danger"role="alert">
                    <p>{{ $errors->first('email') }}.</p>
                </span>
                 @endif
            </div>

            <!-- Date of birth -->
            <div class="mt-4">
                <x-label for="DOB" :value="__('DOB')" />

                <x-input id="date_of_birth" class="block mt-1 w-full {{ $errors->has('dob') ? ' is-invalid' : '' }}" type="date" name="dob" :value="old('dob')" required />
                 @if ($errors->has('dob'))
                <span class="text-danger"role="alert">
                    <p>{{ $errors->first('dob') }}.</p>
                </span>
                 @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                @if ($errors->has('password'))
                    <span class="text-danger"role="alert">
                        <p>{{ $errors->first('password') }}.</p>
                    </span>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger"role="alert">
                        <p>{{ $errors->first('password_confirmation') }}.</p>
                    </span>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
