<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UserFORM - User Data Management System</title>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>
<body>

    <div class="popupcookie">
    <p>This website uses cookies to improve your experience.</p>
    <button class="acceptcookie">Accept Cookies</button>
    <button class="rejectcookie">Reject Cookies</button>
    </div>

    <!-- Header -->
    <div class="landing-header">
        <div class="landing-header-inner">
            <h2>UserFORM_</h2>
            <div>
            <a href="{{ url('login') }}" class="landing-nav-link">Login</a>
            <span>|</span>
            <a href="{{ url('registration') }}" class="landing-nav-link">Registration</a>
            </div>
        </div>
    </div>


    <!-- Hero Section -->
    <div class="landing-hero">
        <div class="landing-hero-content">
            <h1>Simple User Data Management</h1>
            <p>Register, log in, and manage user information easily with a clean dashboard and search tools.</p>
            <a href="{{ url('registration') }}" class="landing-button">Get Started</a>
        </div>
    </div>


    <!-- Features Section -->
    <div class="landing-features">

        <h2 class="landing-title">What You Can Do</h2>

        <div class="landing-boxes">

            <div class="landing-box">
                <h3>Easy Registration</h3>
                <p>Create an account in seconds with a simple and secure sign up form.</p>
            </div>

            <div class="landing-box">
                <h3>Secure Login</h3>
                <p>Log in safely with validated credentials and password protection.</p>
            </div>

            <div class="landing-box">
                <h3>Dashboard Analytics</h3>
                <p>View total users, average age, and gender statistics at a glance.</p>
            </div>

            <div class="landing-box">
                <h3>Search &amp; View Data</h3>
                <p>Quickly search through submitted user data and view full details.</p>
            </div>

        </div>

    </div>


    <!-- Footer -->
    <div class="landing-footer">
        <p>&copy; 2026 UserForm. All rights reserved.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
    $(document).ready(function(){
    if(document.cookie.includes("cookie_consent=accepted")){
    $('.popupcookie').hide();
    }
    $('.acceptcookie').click(function(){
    document.cookie = "cookie_consent=accepted; max-age=10; path=/";
    $('.popupcookie').hide();
    })
    $('.rejectcookie').click(function(){
    $('.popupcookie').hide();
    })
    });
    </script>

</body>
</html>
