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
        // Get countries from the API
        $countries = [];
        $offset = 0;
        $limit = 100;
        do {
            $response = Http::withToken(env('REST_COUNTRIES_API_KEY'))->get('https://api.restcountries.com/countries/v5', [
                'limit' => $limit,
                'offset' => $offset,
                'response_fields' => 'names.common',
            ]);
            $data = $response->json('data');
            $countries = array_merge($countries, $data['objects'] ?? []);
            $more = $data['meta']['more'] ?? false;
            $offset += $limit;
        } while ($more);
        
        // Send countries and users to the Blade file
        return view('user-data', ['countries' => $countries]);
        
    }

    public function show(){
    // Get all existing users from the database
    $userdata = DB::table('users')->get();
    return view('view-data', ['data' => $userdata]);
    }

    public function averageage(){
    // Get all existing users from the database
    $averageage = DB::table('users')->avg('age');
    $maleusers = DB::table('users')->where('gender', 'Male')->count();
    $femaleusers = DB::table('users')->where('gender', 'Female')->count();
    $totalusers = DB::table('users')->count('id');
    return view('dashboard', ['averageage' => $averageage , 'maleusers' => $maleusers , 'femaleusers' => $femaleusers, 'totalusers'=> $totalusers ]);
    }
}