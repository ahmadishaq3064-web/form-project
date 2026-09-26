<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class login extends Controller
{
    public function registration(Request $request){
    $request->validate([
    'profile_photo'=> 'required|image|max:3000',
    'name'=> 'required|regex:/^[a-zA-Z ]+$/|between:3,20',
    'email'=> 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'phone'=> 'required|array',
    'phone.0'=> 'required',
    'phone.1'=>'required|regex:/^3[0-9]{9}$/',
    'password'=> 'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/',
    'password_confirmation' => 'required|same:password'
    ]);

    $path = $request->profile_photo->store('images','public');
    $credentials = DB::table('credentials')->insertGetId([
    'profile_photo' => $path,
    'name' => $request->name,
    'email' => $request->email,
    'phone_number' => implode(" ",$request->phone),
    'password' => Hash::make($request->password),
    ]);
    session(['registered_user_id'=>$credentials]);

    if($credentials){
    return redirect('company-info');
    }
    }

    public function phonecode(){
    $response = Http::get('https://countries.dev/countries?fields=name,alpha2Code,callingCodes&sort=name');
    return response()->json($response->json());
    }

    public function companyinfo(Request $request){
    $request->validate([
    'company'=>'required|regex:/^[a-zA-Z &#,.-]+$/|between:3,30',
    'owner'=>'required|regex:/^[a-zA-Z ]+$/|between:3,20',
    'phone'=> 'required|array',
    'phone.0'=> 'required',
    'phone.1'=>'required|regex:/^3[0-9]{9}$/',
    'email'=>'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'address'=>'required|regex:/^[a-zA-Z #,.-]+$/|between:20,120'
    ]);

    $userid = session('registered_user_id');
    $companyinfo = DB::table('company_info')->insert([
    'company_name'=>$request->company,
    'user_id'=>$userid,
    'owner_name'=>$request->owner,
    'contact'=>implode(" ",$request->phone),
    'email'=>$request->email,
    'address'=>$request->address,
    ]);
    if($companyinfo){
    session()->forget('registered_user_id');
    return redirect('login')->with("success","Registration Successfull! You can login now.");
    }
    }

    public function login(Request $request){
    $credentials = $request->validate([
    'email'=> 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'password'=> 'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/',
    ]);

    if(Auth::attempt($credentials)){
    return redirect("dashboard");
    }else {
    // withInput() hamesha back ky sath hee use ho sakta hai
    return redirect("login")->withErrors(['password' => 'The email or password is incorrect.'])->withInput();
    }
    }

    public function logout(){
    Auth::logout();
    return redirect('login');
    }
}
