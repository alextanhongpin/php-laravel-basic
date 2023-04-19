<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', ['users' => App\Models\User::all()]);
});

Route::get('/cars', function () {
    $cars = DB::table('cars')
        -> join('users', 'users.id', 'cars.id')
        ->select('users.name', 'users.email', 'cars.*')
        ->get();

    return view('cars', ['cars' => $cars]);
});
