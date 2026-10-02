<?php


use App\Http\Middleware\inactive;
use App\Http\Middleware\otpverified;
use App\Http\Middleware\preventbackbutton;
use App\Http\Middleware\registrationcompleted;
use App\Http\Middleware\validuser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'isuservalid' => validuser::class,
        'registrationcompleted' => registrationcompleted::class,
        'verificationstep' => otpverified::class,
        'inactivelogout' => inactive::class,
        'preventbackbutton' => preventbackbutton::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    
    ->create();