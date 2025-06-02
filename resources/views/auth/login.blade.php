<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div style="
                font-size: 24px;
                font-weight: bold;
                background: linear-gradient(to right, #3b82f6, #8b5cf6);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
                text-align: center;
                font-family: 'Poppins', sans-serif;
            ">
                PKL STEMBAYO
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" style="font-family: 'Poppins', sans-serif;">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="email" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                         type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="password" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                         type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-purple-600 hover:text-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" 
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button
                    class="ms-4"
                    style="
                        background: linear-gradient(to right, #3b82f6, #8b5cf6);
                        color: white;
                        font-weight: bold;
                        border: none;
                        padding: 0.5rem 1.5rem;
                        border-radius: 0.5rem;
                        transition: background 0.3s ease;
                    "
                    onmouseover="this.style.background='linear-gradient(to right, #8b5cf6, #3b82f6)'"
                    onmouseout="this.style.background='linear-gradient(to right, #3b82f6, #8b5cf6)'"
                >
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
