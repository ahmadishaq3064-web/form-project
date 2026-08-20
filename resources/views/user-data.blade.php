<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="heading">
    <h1>Personal Info.</h1>
    </div>
    <div class="container">
    <form action="" method="post">
    @csrf

    <div class=input-one>
    <label>Name: </label>
    <br>
    <input maxlength="15" minlength="3" "{{old('name')}}" class="form-control @error('name') is-invalid @enderror" onkeydown="return /[a-zA-Z ]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)" type="text" placeholder="enter your name" name="name">
    <span class="text-danger">@error('name'){{$message}}@enderror</span>
    </div>

    <div class=input-two>
    <label>Email: </label>
    <br>
    <input class="form-control" value="{{old('email')}}" @error('name') is-invalid @enderror" type="text" placeholder="enter your email" name="email">
    <span class="text-danger">@error('email'){{$message}}@enderror</span>
    </div>

    <div class=input-three>
    <label>Age: </label>
    <br>
    <input id="age" maxlength="3" value="{{old('age')}}" class="form-control @error('name') is-invalid @enderror" onkeydown="return /[1-9]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)" type="text" placeholder="enter your age" name="age">
    <span class="text-danger">@error('age'){{$message}}@enderror</span>
    </div>

    <div class=input-four>
    <label>Country: </label>
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

    <div class=input-five>
    <label>Skills: </label>
    <br>
    <label>PHP </label> <input type="checkbox" {{old('skills')=="php"?'checked':''}} name="skills[]" value="php">
    <label>Laravel </label> <input type="checkbox" {{old('skills')=="laravel"?'checked':''}} name="skills[]" value="laravel">
    <label>MYSQL </label> <input type="checkbox" {{old('skills')=="mysql"?'checked':''}} name="skills[]" value="mysql">
    <span class="text-danger"><br>@error('skills'){{$message}}@enderror</span>
    </div>

    <div class=input-six>
    <label>Gender: </label>
    <br>
    <label>Male </label> <input type="radio" {{old('gender')=="male"?'checked':''}} name="gender" value="male">
    <label>Female </label> <input type="radio" {{old('gender')=="female"?'checked':''}} name="gender" value="female">
    <span class="text-danger"><br>@error('gender'){{$message}}@enderror</span>
    </div>

    <div class=input-seven>
    <label>Select your favorite color: </label>
    <input class="form-control" value="{{old('color')}}" type="color" name="color" value="#000000" >
    </div>

    <div class=input-eight>
    <label>What is your Salary expectations?</label>
    <br>
    <input type="range" value="{{old('salary',50000)}}" name="salary" class="slider"  min="10000" max="100000" id="range">
    <div class="slider-values">
    <span>10000</span>
    <span id="rangeValue">{{ old('salary', 50000) }}</span>
    <span>100000</span>
    </div>
    <span class="text-danger"><br>@error('range'){{$message}}@enderror</span>
    </div>
    
    <div class=input-nine>
    <input class="form-control" type="submit" name="submit">
    </div>
    </form>
    </div>

    <script>
    const slider = document.getElementById('range');
    const rangeValue = document.getElementById('rangeValue');

    slider.addEventListener('input', function () {
        rangeValue.textContent = this.value;
    });

    const age = document.getElementById('age');
    age.addEventListener('input',function() {
    let value = age.value;
    if(value>120){
    this.value=120;
    alert("age should be less than 120");
    }
    });
</script>
</body>
</html>
