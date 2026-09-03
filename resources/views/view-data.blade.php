@extends('layouts/mainlayout')

@section('title')
View-Users
@endsection

@section("content")

    <div class="recent-users">
            <h2>Users Complete Info.</h2>
            <form action="{{url('view-data')}}" method="get" id="searchform">
            <button type="button" id="reset">reset</button>
            <select name="sort" id="sort" class="form-control">
            <option>Select Option</option>
            <option value="asc">Name - [A-Z] - ASC</option>
            <option value="desc">Name - [Z-A] - DESC</option>
            <option value="asc-email">Email - [A-Z] - ASC</option>
            <option value="desc-email">Email - [Z-A] - DESC</option>
            <option value="asc-age">Age - [1-120] - ASC</option>
            <option value="desc-age">Age - [120-1] - DESC</option>
            </select>
            <button type="submit">sort</button>
            <input type="text" class="form-control" placeholder="Search.." name="search" id="search" value="{{$recentsearch ?? "" }}">
            <button id="searchbtn"><i class="bi bi-search"></i></button>
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

    async function cachedata(url , successfunction){
    // to create/open a cache box in cache storage 
    let cachecreate = await caches.open('users-data');
    // to check whether this url already exists in cachebox
    let cachechecked = await cachecreate.match(url);
    if(cachechecked){
    // to get the html response from already stored url in cache storage
    let response = await cachechecked.text();
    successfunction(response);
    }else{
    $.ajax({url:url,
        type:'GET',
        success:async function (response) {
        successfunction(response);
        await cachecreate.put(url, new Response(response));
        }    
    })   
    }
    };


    $(document).ready(function(){


    // ajax for pagination
    $(".table-container").on('click','.pagination a',function(e){
    e.preventDefault();
    // to get the current link of pagination
    let url = $(this).attr('href');
    cachedata(url, function(response){
    let newtable = $(response).find(".table-container").html();
    $(".table-container").html(newtable);
    })
    });
    // ajax for search
    $("#searchform").submit(function(e){
    e.preventDefault();
    // to get the enter value in search box
    let search = $("#search").val();
    // to get the selected option of select tag
    let sort = $("#sort").val();
    let page;
    // if we click on search , go to page 1 and show data there
    if($(document.activeElement).attr("id") == "searchbtn"){
    page = 1;
    }else{
    // if we using sort option on any page , stay on the current active page
    page = $(".pagination .active span").text();
    }
    let url = "{{ url('view-data')}}" + "?" + $.param({
    search:search,
    sort:sort,
    page:page
    });
    cachedata(url, function(response){
    let newtable = $(response).find(".table-container").html();
    $(".table-container").html(newtable);
    })
    })


    // to reset search and sort value
    $("#reset").click(function(e){
    e.preventDefault();
    // clear the inputs from the screen
    $("#search").val("");
    $("#sort").val("Select Option");
    let url = "{{ url('view-data')}}";
    cachedata(url, function(response){
    let newtable = $(response).find(".table-container").html();
    $(".table-container").html(newtable);
    })
    })

    })

</script>

@endsection