
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="/path/to/cropper.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>
<body>


    <!-- Cropper Overlay -->
    <div id="cropper_overlay">

        <div id="cropper_box">
            <!-- Header -->
            <div id="cropper_header">
                <h3>Edit Image</h3>
                <button type="button" id="close_cropper">&times;</button>
            </div>

            <!-- Image Area -->
            <div id="cropper_image_area">
                <img id="crop_image" src="" alt="Image">
            </div>

            <!-- Controls -->
            <div id="cropper_controls">
                <div id="crop_actions">
                    <button type="button" id="rotate_left">Rotate Left</button>
                    <button type="button" id="rotate_right">Rotate Right</button>
                    <button type="button" id="flip_horizontal">Flip Horizontal</button>
                    <button type="button" id="flip_vertical">Flip Vertical</button>
                </div>

                <!-- Aspect Ratio -->
                <div id="aspect_actions">
                    <button type="button" id="free_crop">Free</button>
                    <button type="button" id="square_crop">1:1</button>
                    <button type="button" id="portrait_crop">4:3</button>
                    <button type="button" id="landscape_crop">16:9</button>
                </div>
            </div>

            <!-- Footer -->
            <div id="cropper_footer">
                <button type="button" id="cancel_crop">Cancel</button>
                <button type="button" id="save_crop">Save Crop</button>
            </div>
        </div>

    </div>


    <div class="auth-container">

        <div class="auth-content">

        <div class="auth-card">

            <div class="auth-heading">
                <h1>Create Account</h1>
                <p>Register a new account</p>
            </div>

            <hr>

            <form action="{{url('registration')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="profile-photo">
                    <label for="profile_photo" class="photo-circle">
                        <img id="photo-preview" src="" alt=""><span id="photo-plus">+</span>
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" hidden>
                    <div class="form-group"><br><label>Add Profile Picture</label></div>
                    <hr style="border: 2px solid rgb(1, 1, 1);">
                </div>
                
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
    <script src="/path/to/cropper.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>

    
    let cropper;

    $("#profile_photo").change(function(event){
    let img = this.files[0];
    if(img){
    let imgurl = URL.createObjectURL(img);
    $("#crop_image").attr("src",imgurl);
    $("#cropper_overlay").css("display","flex");
    cropper = new Cropper(document.getElementById("crop_image"));
    }
    $("#close_cropper").click(function(){
    $("#cropper_overlay").hide();
    })
    $("#cancel_crop").click(function(){
    $("#cropper_overlay").hide();
    })
    $("#rotate_left").click(function(){
    cropper.rotate(-90);
    })
  
    });

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
