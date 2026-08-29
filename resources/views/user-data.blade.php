@extends('layouts/mainlayout')

@section("content")

 <!-- Success popup -->
    <div id="overlay" style="display:none;">
        <div id="successmessage" class="alert alert-success fade show" role="alert">
            <strong>✓ Success!</strong> <span id="successtext"></span>
            <button id="okbutton" type="button" class="btn btn-success btn-sm ms-3">OK</button>
        </div>
    </div>
    
    <!-- Form section -->
    <div class="row">
        
        <div class="container">
            <!-- Page heading -->
            <form id="userform" action="{{ url('user-data') }}" method="post">
                
                <div class="heading">
                <h1>Add Personal Info.</h1>
                </div>

                <hr>
                @csrf
                <!-- Name -->
                <div class="input-one">
                    <label>Name:</label>
                    <br>
                    <input maxlength="20" minlength="3" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" onkeydown="return /[a-zA-Z ]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)" type="text" placeholder="enter your name" name="name">
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <!-- Email -->
                <div class="input-two">
                    <label>Email:</label>
                    <br>
                    <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="text" placeholder="enter your email" name="email">
                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <!-- Age -->
                <div class="input-three">
                    <label>Age:</label>
                    <br>
                    <input id="age" maxlength="3" value="{{ old('age') }}" name="age" class="form-control @error('age') is-invalid @enderror" onkeydown="return /[1-9]/.test(event.key) || (this.value && /[0-9]/.test(event.key)) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
                    <span class="text-danger">@error('age'){{$message}}@enderror</span>
                </div>
                <!-- Country -->
                <div class="input-four">
                    <label>Country:</label>
                    <br>
                    <select name="country" class="form-control">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            @if (isset($country['names']['common']))
                                <option value="{{ $country['names']['common'] }}">
                                    {{ $country['names']['common'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">@error('country'){{$message}}@enderror</span>
                </div>
                <!-- Skills -->
                <div class="input-five">
                    <label>Skills:</label>
                    <br>
                    <label>PHP </label>
                    <input type="checkbox" {{ old('skills') == "php" ? 'checked' : '' }} name="skills[]" value="php">
                    <label>Laravel </label>
                    <input type="checkbox" {{ old('skills') == "laravel" ? 'checked' : '' }} name="skills[]" value="laravel">
                    <label>MYSQL </label>
                    <input type="checkbox" {{ old('skills') == "mysql" ? 'checked' : '' }} name="skills[]" value="mysql">
                    <span class="text-danger"><br>@error('skills'){{$message}}@enderror</span>
                </div>
                <!-- Gender -->
                <div class="input-six">
                    <label>Gender:</label>
                    <br>
                    <label>Male </label>
                    <input type="radio" {{ old('gender') == "male" ? 'checked' : '' }} name="gender" value="male">
                    <label>Female </label>
                    <input type="radio" {{ old('gender') == "female" ? 'checked' : '' }} name="gender" value="female">
                    <span class="text-danger"><br>@error('gender'){{$message}}@enderror</span>
                </div>
                <!-- Favorite color -->
                <div class="input-seven">
                    <label>Select your favorite color:</label>
                    <input class="form-control" value="{{ old('color', '#000000') }}" type="color" name="color">
                </div>
                <!-- Salary -->
                <div class="input-eight">
                    <label>What is your Salary expectations?</label>
                    <br>
                    <input type="range" value="{{ old('salary', 50000) }}" name="salary" class="slider" min="10000" max="100000" id="range">
                    <div class="slider-values">
                        <span>10000</span>
                        <span id="rangevalue">{{ old('salary', 50000) }}</span>
                        <span>100000</span>
                    </div>
                    <span class="text-danger"><br>@error('range'){{$message}}@enderror</span>
                </div>
                <!-- Submit button -->
                <div class="input-nine">
                    <input class="form-control" type="submit" name="submit" value="Save">
                    
                </div>

            </form>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Update salary value when slider moves
        const slider = document.getElementById('range');
        const rangevalue = document.getElementById('rangevalue');
        slider.addEventListener('input', function () {
            rangevalue.textContent = this.value;
        });
        // Check age and prevent values greater than 120
        const age = document.getElementById('age');
        age.addEventListener('input', function() {
            let value = age.value;
            if (value > 120) {
                this.value = 120;
                alert("age should be less than 120");
            }
        });
        // Handle form submission using jQuery AJAX
        $(document).ready(function() {
            $("#userform").submit(function(event) {
                // Prevent normal page reload
                event.preventDefault();
                // Send form data to Laravel using AJAX
                $.ajax({
                    url: "{{ url('user-data') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Show success popup
                        $("#successtext").text(response.message);
                        $("#overlay").show();
                        // Clear the form
                        $("#userform")[0].reset();
                        // Reset salary display
                        $("#rangevalue").text("50000");
                    },
                    error: function() {
                        // Show simple error message
                        alert("Something went wrong. Please try again.");
                    }
                });
            });
            // Remove success popup when OK is clicked
            $("#okbutton").click(function() {
            $("#overlay").remove();
            });
        });
    </script>
        

@endsection



   
