<x-guest-layout>

    <x-auth-card>
        <div class="text-center site-logo-box   mb-2 rounded-lg">
            <img class="h-32 site-logo-pic mx-auto" src="{{ Storage::url('common/logo1.jpg') }}" alt="Image" />
        </div>
        @if(isset($message))
            <div class="" style="color: #db0606">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                {{$message}}
            </div>
        @endif
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="text-center ">
                <x-primary-button class=" sm:max-w-sm  ml-3 t" >
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </form>
        <div class="mt-12 ml-4 text-center ">
            <a href="{{route('register')}}" style="max-width: 150px;"
               class="mt-12 sm:max-w-sm bg-gray-50   px-6 py-3  text-sm text-white bg-green-600 rounded-md sm:mb-0 hover:bg-green-700 sm:w-auto">
                Register
            </a>
        </div>

    </x-auth-card>

</x-guest-layout>
