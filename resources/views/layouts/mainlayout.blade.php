<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title','Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
</head>

<body>

    <!-- Header -->
    <header class="header">
        <h2>User Dashboard</h2>
        <p>Manage your users easily</p>
    </header>
    
        

    <!-- Main Layout -->
    <div class="layout">

        <!-- Navigation -->
        <nav class="sidebar">
            <a href="{{ url('dashboard') }}" class="nav-button {{ request()->is('dashboard') ? 'active' : ' ' }}">Dashboard</a>
            <a href="{{ url('user-data') }}" class="nav-button {{ request()->is('user-data') ? 'active' : ''}}">Add User</a>
            <a href="{{ url('view-data') }}" class="nav-button {{ request()->is('view-data') ? 'active' : ''}}">View Users</a>
            <hr style="border: 2px solid rgb(1, 1, 1);">
            <a href="{{ url('logout') }}" id="logout">Logout</a>
        </nav>

        <!-- Main Content -->
        <main class="content">
            @yield('content')
        </main>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <p>© 2026 User Dashboard. All Rights Reserved.</p>
    </footer>

</body>
</html>