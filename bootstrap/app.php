<?php


use App\Http\Middleware\inactive;
use App\Http\Middleware\otppending;
use App\Http\Middleware\preventbackbutton;
use App\Http\Middleware\registrationcompleted;
use App\Http\Middleware\validuser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        $middleware->alias([
        // passport API ky liye hai 
        'client' => CheckClientCredentials::class,
        'isuservalid' => validuser::class,
        'registrationcompleted' => registrationcompleted::class,
        'verificationstep' => otppending::class,
        'inactivelogout' => inactive::class,
        'preventbackbutton' => preventbackbutton::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    
    ->create();