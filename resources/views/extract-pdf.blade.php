@extends('layouts/mainlayout')

@section('title')
Extract-PDF
@endsection

@section('content')

<!-- Form section -->
<div class="row">

    <div class="container">

        <!-- Page heading -->
        <form id="userform" action="" method="post" enctype="multipart/form-data">

            <div class="heading">
                <h1>Extract Your Pdf</h1>
                <p>Get text and information from your pdf.</p>
            </div>

            <hr>

            @csrf

            <!-- Name -->
            <div class="input-one form-group">
                <label>Select a file:</label>
                <input class="form-control" type="file" name="extract">
                @error('extract')
                <span class = "text-danger"><small>{{ $message }}</small></span>
                @enderror
            </div>

            
            <!-- Submit button -->
            <div class="input-nine">
                <input class="form-control" type="submit" name="extract" value="Get Excel File">
            </div>

        </form>
    </div>
</div>

@endsection