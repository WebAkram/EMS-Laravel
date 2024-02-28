<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/style.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    {{-- <img class="wave" src="{{ asset('auth/img/wave.png')}}"> --}}
    <div class="container">
        <div class="img">
            <img src="{{ asset('auth/img/emp.png')}}">
        </div>
        <div class="login-content">
    <form action="{{ route('register.post') }}" method="POST" autocomplete="off">
        @csrf
        <img src="{{ asset('auth/img/avatar.svg')}}">
        <h2 class="title">Welcome</h2>
        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Username</h5>
                <input type="text" class="input" name="name" required autofocus>
            </div>
        </div>
        @if ($errors->has('name'))
            <span style="font-size:13px; color:red;>{{ $errors->first('name') }}</span>
@endif
        <div class="input-div
                pass">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="email" class="input" name="email" required autofocus>
                </div>
                </div>
                @if ($errors->has('email'))
                    <span style="font-size:13px; color:red; margin-left:10px;">{{ $errors->first('email') }}</span>
                @endif
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" id="passwordInput" name="password" required>
                        <span class="password-toggle" id="togglePassword">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                @if ($errors->has('password'))
                    <span style="font-size:13px; color:red;">{{ $errors->first('password') }}</span>
                @endif
                <div class="already">
                    <h4 class="mt-2" style="display: inline;">Already a member? &nbsp; </h4>
                    <a style="text-decoration:none; color:#38d39f; font-size:16px; display: inline;"
                        href="{{ route('login') }}">Login here</a>
                </div>
                <input type="submit" class="btn" value="SIGN UP">
    </form>
</div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/main.js')}}"></script>
</body>
</html>
