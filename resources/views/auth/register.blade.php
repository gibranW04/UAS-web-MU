<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f2f6;
        }
        .card {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #dcdde1;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #2f3640;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #2f3640;
            text-decoration: none;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

        <input type="hidden" name="role" value="user">

        <button type="submit">Register</button>
    </form>

    <a href="{{ route('login') }}">Sudah punya akun? Login</a>
</div>
</body>
</html>
