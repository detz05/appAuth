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
    return view('login');
})->name("login");

Route::get('/register', function () {
    return view('register');
});

Route::get('/edit/{ids}', function () {
    return view('edit');
});

Route::get('/logout', function () {

    Auth::logout();

    return redirect("/");
})->name("login");

Route::get('/home', function () {
    return view('home');
})->middleware('auth');
