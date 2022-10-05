<?php

use App\Jobs\ReconileAccount;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $pipeline = app(Illuminate\Pipeline\Pipeline::class);

    $pipeline->send('hello freaking wordl freaking')
        ->through([
            function ($string, $next){
                $string =ucwords($string);
                return $next($string);
            },
            function ($string, $next){
                $string = str_ireplace('freaking', '', $string);
                return $next($string);
            },
            ReconileAccount::class
        ])
        ->then(function ($string){
        dump($string);
    });

   //$user = User::first();
    //dispatch(new ReconileAccount($user));

    //ReconileAccount::dispatch($user)->onQueue('high');

    return 'finished';
    //return view('welcome');
});
