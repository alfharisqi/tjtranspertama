<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #ffffff;
            display: flex;
            flex-direction: row;
            width: 90%;
            max-width: 900px;
            height: 500px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #66a6ff, #89f7fe);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            color: white;
        }

        .left-side img {
            width: 120px;
            margin-bottom: 20px;
        }

        .left-side h2 {
            font-size: 26px;
            text-align: center;
        }

        .right-side {
            flex: 1.5;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        form {
            width: 100%;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-style {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9fafb;
            font-size: 15px;
            transition: border 0.3s;
        }

        .input-style:focus {
            border-color: #66a6ff;
            background: #fff;
            outline: none;
        }

        .btn {
            width: 100%;
            background-color: #66a6ff;
            color: #fff;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #5588dd;
            transform: translateY(-2px);
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }

        footer a {
            color: #66a6ff;
            font-size: 14px;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .card {
                flex-direction: column;
                height: auto;
            }
            .left-side, .right-side {
                flex: unset;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="card">
    <div class="left-side">
        <img src="{{ asset('images/tjulogo.png') }}" alt="Logo">
        <h2>Register Your Account</h2>
    </div>

    <div class="right-side">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <x-text-input class="input-style" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="input-group">
                <x-text-input class="input-style" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-group">
                <x-text-input class="input-style" id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <x-text-input class="input-style" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="btn">
                {{ __('Register') }}
            </x-primary-button>
        </form>

        <footer>
            <a href="{{ route('login') }}">
                {{ __('Already registered? Login') }}
            </a>
        </footer>
    </div>
</div>

</body>
</html>
{{-- </x-guest-layout> --}}