<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
class FormController extends Controller
{
    // Handle AJAX form submission and save the user in the database
    public function add(Request $req)
    {
        // Validate the data received from the form
        $req->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/|between:3,20',
            'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'age' => 'required|numeric|digits_between:1,3',
            'country' => 'required|regex:/^[a-zA-Z ]+$/|between:3,20',
            'skills' => 'required|array',
            'gender' => 'required',
            'color' => 'required',
            'salary' => 'required',
        ]);
        // Insert the new user into the database
        $id = DB::table('users')->insert([
            'name' => $req->name,
            'email' => $req->email,
            'age' => $req->age,
            'country' => $req->country,
            'skills' => implode(',', $req->skills),
            'gender' => $req->gender,
            'color' => $req->color,
            'salary' => $req->salary
        ]);
       return response()->json([
        'success' => true,
        'message' => 'Data Added Successfully..',
       ]);
    }
    // Display the form, countries
    public function index()
    {
        $response = Http::get('https://countriesnow.space/api/v0.1/countries');
        $countries = $response->json('data');
        // Send countries and users to the Blade file
        return view('user-data', ['countries' => $countries]);
    }

    public function averageage(){
    // Get all existing users from the database
    $averageage = DB::table('users')->avg('age');
    $maleusers = DB::table('users')->where('gender', 'Male')->count();
    $femaleusers = DB::table('users')->where('gender', 'Female')->count();
    $totalusers = DB::table('users')->count('id');
    return view('dashboard', ['averageage' => $averageage , 'maleusers' => $maleusers , 'femaleusers' => $femaleusers, 'totalusers'=> $totalusers ]);
    }

    public function search(Request $request){
    $searchdata = DB::table('users')->where('name','like',"%{$request->search}%")->paginate(3)->withQueryString();
    // get the data from the current pagination page
    $collection = $searchdata->getcollection();
    if($request->sort == 'asc'){
    $collection = $collection->sortBy('name');
    }
    else if($request->sort == 'desc'){
    $collection = $collection->sortByDesc('name');
    }
    else if($request->sort == 'asc-email'){
    $collection = $collection->sortBy('email');
    }
    else if($request->sort == 'desc-email'){
    $collection = $collection->sortByDesc('email');
    }
    else if($request->sort == 'asc-age'){
    $collection = $collection->sortBy('age');
    }
    else if($request->sort == 'desc-age'){
    $collection = $collection->sortByDesc('age');
    }
    // take the sorted data , put them back in pagination result , and reset their index values
    $searchdata->setcollection($collection->values());
    return view('view-data',['data' => $searchdata,'recentsearch' => $request->search ]);
    }
}