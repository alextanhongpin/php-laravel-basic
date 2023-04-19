<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


# localhost:8000/api/cars
//Route::get('cars', function (Request $request) {
    //return App\Models\Cars::all();
//});

Route::apiResource("cars", Controllers\CarController::class);
Route::apiResource("drivers", Controllers\DriverController::class);
