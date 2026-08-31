@extends('layouts/mainlayout')

@section('title')
Add-Users
@endsection

@section("content")

<!-- Success popup -->
<div id="overlay" style="display:none;">
    <div id="successmessage" class="alert alert-success fade show" role="alert">
        <strong>✓ Success!</strong>
        <span id="successtext"></span>
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
                <p>Enter the user's information below</p>
            </div>

            <hr>

            @csrf

            <!-- Name -->
            <div class="input-one form-group">
                <label>Name:</label>
                <input maxlength="20" minlength="3"
                    value="{{ old('name') }}"
                    class="form-control"
                    onkeydown="return /[a-zA-Z ]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)"
                    type="text"
                    placeholder="Enter your name"
                    name="name">
            </div>

            <!-- Email -->
            <div class="input-two form-group">
                <label>Email:</label>

                <input class="form-control"
                    value="{{ old('email') }}"
                    type="text"
                    placeholder="Enter your email"
                    name="email">
            </div>

            <!-- Age -->
            <div class="input-three form-group">
                <label>Age:</label>

                <input id="age"
                    maxlength="3"
                    value="{{ old('age') }}"
                    name="age"
                     placeholder="Enter your age"
                    class="form-control"
                    onkeydown="return /[1-9]/.test(event.key) || (this.value && /[0-9]/.test(event.key)) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">

            </div>

            <!-- Country -->
                <div class="input-four form-group">
                <label>Country:</label>

                <select name="country" class="form-control">
                <option value="">Select Country</option>

                @foreach ($countries as $country)
                <option value="{{ $country['country'] }}">
                {{ $country['country'] }}
                </option>
                @endforeach

                </select>
                </div>

            <!-- Skills -->
            <div class="input-five form-group">
                <label>Skills:</label>

                <div class="options">
                    <label>
                        <input type="checkbox"
                            {{ old('skills') == "php" ? 'checked' : '' }}
                            name="skills[]"
                            value="php">
                        PHP
                    </label>

                    <label>
                        <input type="checkbox"
                            {{ old('skills') == "laravel" ? 'checked' : '' }}
                            name="skills[]"
                            value="laravel">
                        Laravel
                    </label>

                    <label>
                        <input type="checkbox"
                            {{ old('skills') == "mysql" ? 'checked' : '' }}
                            name="skills[]"
                            value="mysql">
                        MySQL
                    </label>
                </div>
            </div>

            <!-- Gender -->
            <div class="input-six form-group">
                <label>Gender:</label>

                <div class="options">
                    <label>
                        <input type="radio"
                            {{ old('gender') == "male" ? 'checked' : '' }}
                            name="gender"
                            value="male">
                        Male
                    </label>

                    <label>
                        <input type="radio"
                            {{ old('gender') == "female" ? 'checked' : '' }}
                            name="gender"
                            value="female">
                        Female
                    </label>
                </div>

            </div>

            <!-- Favorite color -->
            <div class="input-seven form-group">
                <label>Select your favorite color:</label>

                <input class="form-control color-input"
                    value="{{ old('color', '#000000') }}"
                    type="color"
                    name="color">
            </div>

            <!-- Salary -->
            <div class="input-eight form-group">
                <label>What is your Salary expectations?</label>

                <input type="range"
                    value="{{ old('salary', 55000) }}"
                    name="salary"
                    class="slider"
                    min="10000"
                    max="100000"
                    id="range">

                <div class="slider-values">
                    <span>10,000</span>
                    <span id="rangevalue">{{ old('salary', 55000) }}</span>
                    <span>100,000</span>
                </div>
            </div>

            <!-- Submit button -->
            <div class="input-nine">
                <input class="form-control"
                    type="submit"
                    name="submit"
                    value="Save">
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
            $("#overlay").hide();
        });

    });

</script>

@endsection