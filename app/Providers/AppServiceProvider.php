<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    View::composer('layouts/mainlayout',function($view){
    if(Auth::check()){
    $company_name = DB::table('company_info')->where('user_id',Auth::id())->first();  
    $view->with('company',$company_name);
    }
    });
    }

    

}
