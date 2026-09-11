<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>

<body>

    <div class="auth-container">

        <div class="auth-content">

        @if(session("success"))
        <div class="success-message">
        {{ session("success") }}
        </div>
        @endif


            <div class="auth-card">
                <div class="auth-heading">
                <h1>Welcome</h1>
                <p>Login to your account</p>
                </div>

                <hr>

                <form action="{{url('/')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Email</label>

                    <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email')}}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email">
                    @error('email')
                    <span class = "text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password" 
                    minlength="8">
                    <div id="show-password">
                    <input type="checkbox" onclick="showpassword()"><span> Show Password</span>
                    </div>
                    @error('password')
                    <span class = "text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>

                <div class="auth-button">
                <button type="submit" class="form-control" id="loginbutton">
                Login
                </button>
                </div>
                </form>


                <div class="auth-footer">
                <p>
                Don't have an account?
                <a href="{{ url('registration') }}">
                Register
                </a>
                </p>
                </div>

            </div>
        </div>
    </div>

    <script>
    // show password using checkbox
    function showpassword(){
    var password = document.getElementById('password');
    if(password.type === "password"){
    password.type = "text";
    }else{
    password.type = "password";
    }
    }
    

    </script>
</body>
</html>