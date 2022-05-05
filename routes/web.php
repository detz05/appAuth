<?php

use Illuminate\Support\Facades\Auth;
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
    if((Auth::check())):
        return redirect("/home");
    else:
        return view('login');
    endif;
})->name("login");

Route::get('/register', function () {
    if((Auth::check())):
        return redirect("/home");
    else:
        return view('register');
    endif;
});

Route::get('/logout', function () {

    Auth::logout();

    return redirect("/");
})->name("login");

Route::get('/home', function () {
    return view('home');
})->middleware('auth');
