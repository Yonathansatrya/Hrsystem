<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('css/Logo_S.png') }}" alt="Logo" class="logo">
            <h2>Login</h2>
        </div>

        @if (session('error'))
            <div class="error-messages">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus />
            </div>

            <!-- ID Number (as Password) -->
            <div class="form-group">
                <label for="id_number">Password</label>
                <input id="id_number" type="password" name="id_number" required />
            </div>

            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>
