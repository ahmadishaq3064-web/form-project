
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

            <form>

                @csrf

                
                
                <div class="form-group">
                    <label>OTP Verification via phone number (sms)</label>

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
                        <small class="text-danger" id="otp_error"></small>
                    </div>


                <div class="auth-button">
                    <button type="button" class="form-control" id="verify_phone_otp">
                        Verify OTP
                    </button>
                </div>

                

            </form>
            <hr>
            <div class="recaptcha">
            <p class="text-muted text-center mb-2">Please complete the reCAPTCHA to receive your OTP via SMS.</p>
            <div id="recaptcha-container"></div>
            </div>
           
            
        </div>

        </div>

    </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/12.19.0/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries
  import {
  getAuth,
  RecaptchaVerifier,
  signInWithPhoneNumber
  } from "https://www.gstatic.com/firebasejs/12.19.0/firebase-auth.js";
  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyB2TWoflaLPUgptuCCmx1PwG8sN8EoK2wg",
    authDomain: "phone-otp-testing-laravel.firebaseapp.com",
    projectId: "phone-otp-testing-laravel",
    storageBucket: "phone-otp-testing-laravel.firebasestorage.app",
    messagingSenderId: "522813193451",
    appId: "1:522813193451:web:48f3fdbd15f397b96312ae"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);

// firebase javascript
const phone_number = "{{session('phone_number')}}";
// yahan hum ny recapcha ki coding ki hai
window.recaptchaVerifier = new RecaptchaVerifier(auth,'recaptcha-container',{});
// yahan hum ny message send krny ki coding ki hai
signInWithPhoneNumber(auth,phone_number,window.recaptchaVerifier).then(function(confirmationResult){
window.confirmationResult = confirmationResult;
console.log("OTP Sent ..");
})
.catch(function(error){
console.log(error);
});

$("#verify_phone_otp").click(function(){
let otp = $("#otp").val();
// Jo OTP user ne enter kiya hai, usko Firebase ke bheje hue OTP ke saath verify kr rahy han
window.confirmationResult.confirm(otp).then(async function(result){
// Firebase successful OTP verification ke baad user ka Firebase .user object deta hai
// yahan hum ny token liya hai jis ko hum use kr ky laravel ko btain gay ky ye user verified hai
let token = await result.user.getIdToken();
$.ajax({
url:"{{url('verify-otp-sms')}}",
type:'POST',
data:{
otp:otp,
_token:"{{csrf_token()}}",
firebase_token:token
},
success:function(response){
// yahan ye agly page py bhej dy ga
window.location.href = "{{url('company-info')}}";
},
error:function(){
$("#otp_error").text("Phone Verification Failed.");
} 
});
})
.catch(function(error){
$("#otp_error").text("Invalid OTP.");
})
})

</script>

</body>
</html>
