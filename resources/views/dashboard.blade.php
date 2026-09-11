@extends('layouts/mainlayout')

@section('title')
Dashboard
@endsection

@section("content")
<!-- Main Content -->
            <h1>Welcome - {{Auth::user()->name}}</h1>
            <hr style="border: 2px solid rgb(1, 1, 1);">
            <h1>Dashboard</h1>
            <p class="welcome">Welcome to the user management dashboard.</p>

            <!-- Dashboard Boxes -->
            <div class="boxes">
                <!-- total number of users -->
                <div class="box">
                    <h3>Total Users</h3>
                    <h2>{{$totalusers}}</h2>
                    <p>Total number of users</p>
                </div>

                <!-- Average Age -->
                <div class="box">
                    <h3>Average Age</h3>
                    <h2>{{ round($averageage,1)  }}</h2>
                    <p>Average age of users</p>
                </div>


                <!-- Male -->
                <div class="box">
                    <h3>Male</h3>
                    <h2>{{ $maleusers }}</h2><p>Total male users</p>
                </div>


                <!-- Female -->
                <div class="box">
                    <h3>Female</h3>
                    <h2>{{ $femaleusers }}</h2>
                    <p>Total female users</p>
                </div>

            </div>

<script>

    // session storage
    sessionStorage.setItem("name","{{Auth::user()->name}}");
    sessionStorage.setItem("username","{{Auth::user()->email}}");
    sessionStorage.setItem("phone","{{Auth::user()->phone_number}}");

</script>

        

@endsection


    

