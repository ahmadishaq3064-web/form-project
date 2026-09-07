<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class login extends Controller
{
    public function registration(Request $request){
    $request->validate([
    'name'=> 'required|regex:/^[a-zA-Z ]+$/|between:3,20',
    'email'=> 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'phone'=> 'required|regex:/^03[0-9]{9}$/',
    'password'=> 'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/',
    'password_confirmation' => 'required|same:password'
    ]);

    $credentials = DB::table('credentials')->insert([
    'name' => $request->name,
    'email' => $request->email,
    'phone_number' => $request->phone,
    'password' => Hash::make($request->password),
    ]);

    if($credentials){
    return redirect('/')->with("success","Registration Successfull! You can login now.");
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
    return redirect("/")->withErrors(['password' => 'The email or password is incorrect.'])->withInput();
    }
    }

    public function logout(){
    Auth::logout();
    return redirect('/');
    }
}
