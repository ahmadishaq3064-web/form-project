
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Company-Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>
<body>

<div class="auth-container">

    <div class="auth-content">

        <div class="auth-card">

            <div class="auth-heading">
            <h1>Company-Info</h1>
            <p>Register your Company</p>
            </div>

            <hr>

            <form action="{{url('company-info')}}" method="POST">

            @csrf

            <div class="form-group">
            <label>Company Name</label>

            <input
            type="text"
            id="company"
            name="company"
            value="{{ old('company')}}"
            class="form-control @error('company') is-invalid @enderror"
            placeholder="Enter your company name"
            maxlength="30" 
            minlength="3"
            onkeydown="return /[a-zA-Z &#,.-]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
            @error('company')
            <span class = "text-danger"><small>{{ $message }}</small></span>
            @enderror
            </div>

            <div class="form-group">
            <label>Owner Name</label>

            <input
            type="text"
            id="owner"
            name="owner"
            value="{{ old('owner')}}"
            class="form-control @error('owner') is-invalid @enderror"
            placeholder="Enter owner name"
            maxlength="20" 
            minlength="3"
            onkeydown="return /[a-zA-Z ]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
            @error('owner')
            <span class = "text-danger"><small>{{ $message }}</small></span>
            @enderror
            </div>



            <div class="form-group">
            <label>Contact</label>

            <input
            type="tel"
            id="phone"
            name="phone"
            value="{{ old('phone')}}"
            class="form-control @error('phone') is-invalid @enderror"
            placeholder="03XXXXXXXXX"
            maxlength="11"
            minlength="11"
            onkeydown="return /[0-9]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">
            @error('phone')
            <span class = "text-danger"><small>{{ $message }}</small> </span>
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
            <label>Address</label>
            <textarea
            type="text"
            id="address"
            name="address"
            class="form-control @error('address') is-invalid @enderror"
            placeholder="Enter your address"
            maxlength="120" 
            minlength="20"
            onkeydown="return /[a-zA-Z0-9 #,.-]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)">{{ old('address')}}</textarea>
            @error('address')
            <span class = "text-danger"><small>{{ $message }}</small></span>
            @enderror
            </div>



            <div class="auth-button">
            <button type="submit" class="form-control">
            Save
            </button>
            </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>
