@extends('layouts/mainlayout')

@section('title')
View-Users
@endsection

@section("content")

    <div class="recent-users">
            <h2>Users Complete Info.</h2>
            <form action="{{url('view-data')}}" method="get" id="searchform">
            <input type="text" class="form-control" placeholder="Search.." name="search" id="search" value="{{$recentsearch ?? "" }}">
            <button id="search"><i class="bi bi-search"></i></button>
            </form>
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
   {{ $data->links("pagination::bootstrap-5") }}
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    $(document).ready(function(){

    // ajax for pagination
    $(".table-container").on('click','.pagination a',function(e){
    e.preventDefault();
    // to get the link of pagination
    let url = $(this).attr('href');
    $.ajax({
    url : url,
    type : "GET",
    success : function(response){
    let newtable = $(response).find(".table-container").html();
    $(".table-container").html(newtable);
    }
    })
    });

    // ajax for search
    $("#searchform").submit(function(e){
    e.preventDefault();
    // to get the action of action
    let url = $(this).attr('action');
    // to get the enter value in search box
    let search = $("#search").val();
    $.ajax({
    url:url,
    type:"GET",
    data:{
    search:search
    },
    success:function(response){
    let newtable = $(response).find(".table-container").html();
    $(".table-container").html(newtable);    
}
    })
    })

    })

</script>

@endsection