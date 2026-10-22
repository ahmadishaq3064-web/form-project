@extends('layouts/mainlayout')

@section('title')
Extracted-Data
@endsection

@section('content')

<!-- Form section -->
<div class="row">

    <div class="container">

        <h1 style="text-align: center">Extracted Data</h1> 
        <hr style="border: 1; border-top: 2px solid #040404; margin-bottom: 30px;">
        <p>{{$extracteddata}}</p>
        <!-- Submit button -->
        <div class="input-nine">
        <input class="form-control" type="submit" name="extract" value="Get excel file">
        </div>
        
    </div>
</div>

@endsection