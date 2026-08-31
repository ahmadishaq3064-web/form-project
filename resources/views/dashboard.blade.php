@extends('layouts/mainlayout')

@section('title')
Dashboard
@endsection

@section("content")
<!-- Main Content -->
        
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

        

@endsection


    

