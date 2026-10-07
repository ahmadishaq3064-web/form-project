<?php

namespace App\Http\Controllers;

use App\Mail\emailotpverify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Kreait\Laravel\Firebase\Facades\Firebase;

class login extends Controller
{
    public function registration(Request $request){
    $request->validate([
    'profile_photo'=> 'required|image|max:3000',
    'name'=> 'required|regex:/^[a-zA-Z ]+$/|between:3,20',
    'email'=> 'required|unique:credentials,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'phone'=> 'required|array',
    'phone.0'=> 'required',
    'phone.1'=>'required|regex:/^3[0-9]{9}$/',
    'password'=> 'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/',
    'password_confirmation' => 'required|same:password'
    ]);

    $otp_expires_at = now()->addMinutes(1);
    // yahan py hum ny country code or phone number ko merge kiya hai
    $phone = $request->phone[0] . $request->phone[1];
    // yahan py hum ny phone number ko + ky sign py separate kiya hai
    $position = strpos($phone,"+");
    // yahan py + sign sy phly ki values ayein gii
    $country_code = substr($phone,0,$position);
    // yahan py + sign ky baad ki values ayein gi 
    $phone_number = substr($phone,$position);
    $path = $request->profile_photo->store('images','public');
    $credentials = DB::table('credentials')->insertGetId([
    'profile_photo' => $path,
    'name' => $request->name,
    'email' => $request->email,
    'country_code' => $country_code,
    'phone_number' => $phone_number,
    'password' => Hash::make($request->password),
    'otp' => null,
    'verified_status' => 0,
    'otp_expires_at' => $otp_expires_at,
    'registration_completed' => 0,
    ]);
    // ye session is liye bnaya gya hai taky sirf registration wala form complete hony ky baad hee verify-otp wala page access kiya ja saky
    session(['registered_user_id'=>$credentials,'otp_pending'=>true]);
    if($credentials){
    if($request->otp_method == 'gmail'){
    $otp = rand(100000,999999);
    $userid = session('registered_user_id');
    DB::table('credentials')->where("id",$userid)->update(['otp' => $otp]);
    Mail::to($request->email)->send(new emailotpverify($otp));
    return redirect('verify-otp-gmail');
    }
    if($request->otp_method == 'sms'){
    session(['phone_number' => $phone_number]);
    return redirect('verify-otp-sms');
    }
    }
    }

    public function phonecode(){
    $response = Http::get('https://countries.dev/countries?fields=name,alpha2Code,callingCodes&sort=name');
    return response()->json($response->json());
    }

    public function verifyotpgmail(Request $request){
    $request->validate([
    'otp' => 'required|digits:6'
    ]);
    // ye session is liye store kraya gya hai taky latest registered user ko sirf verify-otp ka access diya ja saky ..
    $userid = session('registered_user_id');
    // is query ky zariye hum latest user ko access krty han
    $user = DB::table('credentials')->where('id',$userid)->first();
    if(!$user){
    return redirect('registration');
    }
    // Otp ki expiry check krny ky liye
    if(now()->greaterThanOrEqualTo($user->otp_expires_at)){
    return back()->withErrors([ 'otp' => 'OTP has expired.']);
    }
    // agr user ki otp aur input ki otp same ho gi to ye verified status ko 0 sy 1 kr dy ga 
    if($user->otp == $request->otp){
    DB::table('credentials')->where("id",$userid)->update(['verified_status' => 1]);
    // ye session company-info waly page ko access krny ky liye hai
    session(['otpverified'=>true]);
    // yahan hum ny verify-otp ko access krny ky liye jo session bnaya usko khtm krdiya hai taky dobara sy ye page access na kiya ja saky
    session()->forget('otp_pending');
    return redirect('company-info');
    }
    return back()->withErrors([ 'otp' => 'Invalid OTP.']);
    }

    public function resendotpgmail(Request $request){
    $userid = session('registered_user_id');
    $user = DB::table('credentials')->where('id',$userid)->first();
    if(!$user){
    return redirect('registration');
    }
    if(now()->lessThan($user->otp_expires_at)){
    return back()->withErrors(['otp'=>'Please wait before requesting another OTP.']);
    }
    $otp = rand(100000,999999);
    $newotpexpiry = now()->addMinutes(1);
    DB::table('credentials')->where('id',$userid)->update(['otp'=>$otp,'otp_expires_at'=>$newotpexpiry]);
    Mail::to($user->email)->send(new emailotpverify($otp));
    return back();
    }

    public function verifyotpsms(Request $request){
    $request->validate([
    'firebase_token' => 'required',
    'otp' => 'required|digits:6',
    
    ]);
    try{
    if(Firebase::auth()->verifyIdToken($request->firebase_token)){
    $otp = $request->otp;
    $userid = session('registered_user_id');
    DB::table('credentials')->where("id",$userid)->update(['verified_status' => 1,'otp'=> $otp]);
    session(['otpverified'=>true]);
    return response()->json(['success'=>true]);
    }
    }catch(Exception $e){
    return response()->json(['message'=>'Phone verification failed.'],401);
    }
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
    DB::table('credentials')->where('id',$userid)->update(['registration_completed' => 1]);
    if($companyinfo){
    session()->forget('otpverified');
    session()->forget('registered_user_id');
    return redirect('login')->with("success","Registration Successfull! You can login now.");
    }
    }

    public function login(Request $request){
    $request->validate([
    'email'=> 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'password'=> 'required|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/',
    ]);

    $credentials = [
    'email' => $request->email,
    'password' => $request->password,
    'registration_completed' => 1,
    ];


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
