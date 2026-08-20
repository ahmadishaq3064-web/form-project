<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FormController extends Controller
{

    function add(Request $req){

        $req->validate([
        'name'=>'required|regex:/^[a-zA-Z ]+$/|between:3,20',
        'email'=>'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'age'=>'required|numeric|digits_between:1,3',
        'country'=>'required|regex:/^[a-zA-Z ]+$/|between:3,20',
        'skills'=>'required|array',
        'gender'=> 'required',
        'color'=>'required',
        'salary'=>'required',
        ]);

        $user = DB::table('users')->insert(
        ['name' => $req->name,
        'email' => $req->email,
        'age' => $req->age,
        'country' => $req->country,
        'skills' => implode(',',$req->skills),
        'gender' => $req->gender,
        'color' => $req->color,
        'salary' => $req->salary
        ]
    );


    
    if($user){
    echo "<h1>Data Successfully added ..</h1>";
    }else{
        echo "<h1>Data not added</h1>";
    }}
    
    public function index()
    {
    $countries = [];
    $offset = 0;
    $limit = 100;
    do{
    $response = Http::withToken(env('REST_COUNTRIES_API_KEY'))->get('https://api.restcountries.com/countries/v5', ['limit' => $limit,'offset' => $offset,'response_fields' => 'names.common',]);
    $data = $response->json('data');
    $countries = array_merge($countries,$data['objects'] ?? []);
    $more = $data['meta']['more'] ?? false;
    $offset += $limit;
    }while($more);
    return view('user-data', compact('countries'));
    }
    
}
