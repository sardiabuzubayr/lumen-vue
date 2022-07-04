<?php
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('api/test', function(){
    return response()->json([
        'error_code'=>0,
        'data'=>[
            'title'=>'Tes dashboard',
            'message'=>'Data ini dari request api'
        ]
    ]);
});


$router->get('/', function () {
    return view('index');
});

$router->get('/{any}', function () {
    return view('index');
});
