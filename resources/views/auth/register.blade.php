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
    ">
        PKL STEMBAYO
    </div>
</x-slot>


        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" style="font-family: 'Poppins', sans-serif;">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="name" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                         type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="email" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                         type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="password" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                         type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" style="color: #1c1c1c; font-weight: 600;" />
                <x-input id="password_confirmation" class="block mt-1 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                         type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 text-sm text-gray-600">
                    <x-label for="terms" class="flex items-center space-x-2">
                        <x-checkbox name="terms" id="terms" required />
                        <span>
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-purple-600 hover:text-purple-800">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-purple-600 hover:text-purple-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('login') }}" 
                   class="underline text-sm text-purple-600 hover:text-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                   {{ __('Already registered?') }}
                </a>

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
    {{ __('Register') }}
</x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
