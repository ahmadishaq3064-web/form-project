
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>
<body>

    <div class="auth-container">

        <div class="auth-content">

        <div class="auth-card">

            <div class="auth-heading">
                <h1>Create Account</h1>
                <p>Register a new account</p>
            </div>

            <hr>

            <form action="{{url('registration')}}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name')}}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter your name"
                        maxlength="20" 
                        minlength="3"
                        onkeydown="return /[a-zA-Z ]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
                        @error('name')
                        <span class = "text-danger"><small>{{ $message }}</small></span>
                        @enderror
                    </div>


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
                    <label>Phone Number</label>
                    <select name="phone[]"  id="phonecode" >
                    </select>
                    <input
                        type="tel"
                        id="phone"
                        name="phone[]"
                        value="{{ old('phone.1')}}"
                        class="form-control @error('phone.1') is-invalid @enderror"
                        placeholder="3XXXXXXXXX"
                        maxlength="10"
                        minlength="10"
                        onkeydown="return /[0-9]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
                        @error('phone.1')
                        <span class = "text-danger"><small>The phone field is required.</small> </span>
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
                        <input type="checkbox" onclick="showpassword('password')"><span> Show Password</span>
                        </div>
                        @error('password')
                        <span class = "text-danger"><small>Your password must contain at least 8 characters, including one uppercase letter, one number, and one special character.</small></span>
                        @enderror
                </div>


                <div class="form-group">
                    <label>
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Confirm your password"
                        minlength="8">
                        <div id="show-password">
                        <input type="checkbox" onclick="showpassword('password_confirmation')"><span> Show Password</span>
                        </div>
                        @error('password_confirmation')
                        <span class = "text-danger"><small>{{ $message }}</small></span>
                        @enderror
                </div>


                <div class="auth-button">
                    <button type="submit" class="form-control">
                        Register
                    </button>
                </div>

            </form>


            <div class="auth-footer">
                <p>
                    Already have an account?
                    <a href="{{ url('login') }}">Login</a>
                </p>
            </div>

        </div>

        </div>

    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>

    storephonecode("{{url('phonecode')}}");
    async function storephonecode(url){
    let cacheopen = await caches.open('phonecode');
    let cachechecked = await cacheopen.match(url);
    if(cachechecked){
    let response = await cachechecked.json();
    showphonecode(response);
    }
    $.ajax({
    url:url,
    type:'GET',
    success:async function(response){
    showphonecode(response);
    await cacheopen.put(url,new Response(JSON.stringify(response)));
    }
    })
    }

    function showphonecode(countries){
    let dropdown = $("#phonecode");
    dropdown.html('<option value="PK +92">PK +92</option>');
    countries.forEach(function(country){
    dropdown.append('<option value="'+ country.alpha2Code+ ' +'+ country.callingCodes[0]+ '">' + country.alpha2Code + ' +' + country.callingCodes[0] +'</option>');
    });
    
    
    }



    function showpassword(id){
    var password = document.getElementById(id);
    if(password.type === "password"){
    password.type = "text";
    }else{
    password.type = "password";
    }
    }
    </script>

</body>
</html>
