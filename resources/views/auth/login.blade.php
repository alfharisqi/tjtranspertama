{{-- <x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Logins</title>
    <link rel="stylesheet" href="{{ asset('plugins/css-components-main/logins/login-1/loginsyz.css') }}">
  </head>


  <body>
    <div class="background"></div>
    <div class="card">
        <img class="logo" src="{{ asset('images/LogoSonic.png') }}" />
        <h2>Welcome Back</h2>      {{-- <x-guest-layout> --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                <x-text-input id="email" class="input-style" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                {{-- <x-input-label for="password" :value="__('Password')" /> --}}
                <x-text-input id="password" class="input-style"
                                type="password"
                                name="password"
                                required autocomplete="current-password" 
                                placeholder="Password"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
                            <x-primary-button class="btn">
                                {{ __('Log in') }}
                            </x-primary-button>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
   
            </div>
        </form>
      {{-- </x-guest-layout> --}}
      <footer>
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
        @endif
        <br>
        Need an account? Sign up
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
            {{ __('here') }}
        </a>
        {{-- <a href="#">here</a> --}}
      </footer>
    </div>
  </body>
</html>
