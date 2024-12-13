<x-guest-layout>
    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />

    <div class="justify-center login align-center">
        <form class="login-block" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="input">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class=""
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="space-between flex-row w-70">
                <label for="remember_me" class="justify-center">
                    <span class="">{{ __('Remember me') }}</span>
                    <input id="remember_me" type="checkbox" class="" name="remember">
                </label>
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
