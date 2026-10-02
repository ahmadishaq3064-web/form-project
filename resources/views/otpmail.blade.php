<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, sans-serif;">

<div style="max-width:500px; margin:40px auto; background:#ffffff; padding:30px; text-align:center; border-radius:8px;">

    <h2 style="margin-bottom:10px; color:#222;">
        Verify Your Email
    </h2>

    <p style="color:#555; font-size:15px;">
        Thank you for registering. Use the OTP below to verify your email address.
    </p>

    <div style="margin:25px 0; padding:15px; background:#f1f1f1; border-radius:6px;">
        <strong style="font-size:30px; letter-spacing:8px; color:#222;">
            {{ $otp }}
        </strong>
    </div>

    <p style="color:#777; font-size:14px;">
        This OTP is valid for 5 minutes.
    </p>

    <p style="color:#999; font-size:12px; margin-top:25px;">
        If you did not create an account, you can safely ignore this email.
    </p>

</div>

</body>
</html>
