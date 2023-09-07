<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signin', [AuthController::class, 'signin']);
Route::post('signup', [AuthController::class, 'signup']);

// Route::middleware('auth:sanctum')->group(function(){
//     Route::resource('cars', CarController::class);
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('car', CarController::class);
Route::post('cars', [CarController::class, 'search'])->name('car.search');
Route::post('login', [CarController::class, 'login'])->name('car.login');
Route::resource('brand', BrandController::class);
Route::post('brands', [BrandController::class, 'search'])->name('brand.search');