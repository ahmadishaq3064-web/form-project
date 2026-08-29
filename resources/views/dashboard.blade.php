@extends('layouts/mainlayout')

@section("content")
<!-- Main Content -->
        
            <h1>Dashboard</h1>
            <p class="welcome">Welcome to the user management dashboard.</p>

            <!-- Dashboard Boxes -->
            <div class="boxes">
                <!-- Average Age -->
                <div class="box">
                    <h3>Average Age</h3>
                    <h2>{{ $averageAge ?? 0 }}</h2>
                    <p>Average age of users</p>
                </div>


                <!-- Male -->
                <div class="box">
                    <h3>Male</h3>
                    <h2>{{ $maleUsers ?? 0 }}</h2><p>Total male users</p>
                </div>


                <!-- Female -->
                <div class="box">
                    <h3>Female</h3>
                    <h2>{{ $femaleUsers ?? 0 }}</h2>
                    <p>Total female users</p>
                </div>

            </div>

        

@endsection


    

