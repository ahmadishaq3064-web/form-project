
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>
<body>




    <div class="auth-container">

        <div class="auth-content">

        <div class="auth-card">

            <div class="auth-heading">
                <h1>Verify Your Account</h1>
            </div>

            <hr>

            <form action="{{url('verify-otp')}}" method="POST">

                @csrf

                
                
                <div class="form-group">
                    <label>OTP Verification</label>

                    <input
                        type="text"
                        id="otp"
                        name="otp"
                        value="{{ old('otp')}}"
                        class="form-control @error('otp') is-invalid @enderror"
                        placeholder="Enter Your Otp ..."
                        maxlength="6" 
                        minlength="6"
                        onkeydown="return /[0-9]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
                        @error('otp')
                        <span class = "text-danger"><small>{{ $message }}</small></span>
                        @enderror
                    </div>


                <div class="auth-button">
                    <button type="submit" class="form-control">
                        Verify OTP
                    </button>
                </div>

            </form>

            
            <form action="{{url('resend-otp')}}" method="POST">
            @csrf
            <div class="resendotp">
            <p id="timer">Resend OTP in 60 seconds</p>
            <button type="submit" id="resendotp" disabled >Resend OTP</button>
            </div>
            
            </form>
            
        </div>

        </div>

    </div>

<script>
let second = 60;
let timer = setInterval(() => {
document.getElementById('timer').innerHTML = 'Resend OTP in ' + second + ' seconds.';
second--;
if(second<0){
clearInterval(timer);
document.getElementById('timer').innerHTML = 'You can resend OTP now';
document.getElementById('resendotp').disabled = false;
}
}, 1000);
</script>

</body>
</html>
