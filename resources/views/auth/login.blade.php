<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('images/school.png') }}" alt="School Logo">
        </div>
        <div class="text-center mt-4 name">
            SMK BAGIMU NEGERIKU 
        </div>
        <form method="POST" action="{{ route('login') }}" class="p-3 mt-3">
            @csrf

            <!-- Email -->
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>

            <!-- Password -->
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="id_number" id="id_number" placeholder="Password" required>
            </div>

            <button type="submit" class="btn mt-3">Login</button>

          

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</body>
</html>
