@extends('layouts/mainlayout')

@section("content")

<div class="recent-users">
<h2>Users Complete Info.</h2>
</div>
<!-- User table -->
    <div class="table-container">
        <table class="table" id="usertable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Country</th>
                    <th>Skills</th>
                    <th>Gender</th>
                    <th>Color</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <!-- Existing database records -->
                @foreach ($data as $id => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->country }}</td>
                        <td>{{ $user->skills }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->color }}</td>
                        <td>{{ $user->salary }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection


    

