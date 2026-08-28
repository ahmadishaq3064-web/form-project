<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View-User-Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="logo.svg">
</head>
<body>
    

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


    
</body>
</html>