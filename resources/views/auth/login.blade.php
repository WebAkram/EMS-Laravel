<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/style.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <div class="container">
        <div class="img">
            <img src="{{ asset('auth/img/emp.png')}}">
        </div>
        <div class="login-content">
<form action="{{ route('login.post') }}" autocomplete="off" method="POST">
    @csrf
    <img src="{{ asset('auth/img/avatar.svg')}}">
    <h2 class="title">Welcome</h2>
    <div class="input-div one">
        <div class="i">
            <i class="fas fa-user" style="color:#333;"></i>
        </div>
        <div class="div">
            <h5>Email Address</h5>
            <input type="email" class="input" name="email" required autofocus>
        </div>
    </div>
    <div class="input-div pass">
        <div class="i">
            <i class="fas fa-lock" style="color:#333;"></i>
        </div>
        <div class="div">
            <h5>Password</h5>
            <input type="password" class="input" name="password" id="passwordInput" required>
            <span class="password-toggle" id="togglePassword">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
        </div>
    </div>
    @if ($errors->has('credentials'))
    <span style="font-size:13px; color:red;">
        {{ $errors->first('credentials') }}
    </span>
@endif
    <a style="font-size: 18px; color: #333;
    text-transform: uppercase;" href="{{ route('register') }}">Register
        here</a>

    <button type="submit" class="btn">Login</button>
</form>
</div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/main.js')}}"></script>
</body>
</html>
