<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/Auth/login', [UserController::class, 'login']);
Route::post('/Auth/register', [UserController::class, 'register']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/Auth/user', [UserController::class, 'user']);
    Route::get('/Auth/logout', [UserController::class, 'logout']);
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/all-category', 'index');
        Route::get('/show/category/{id}', 'show');
        Route::post('/create/category', 'store');
        Route::post('/update/category', 'update');
        Route::get('/edit/category/{id}', 'edit');
        Route::post('/category/delete', 'destroy');
    });
    Route::controller(CarController::class)->group(function() {
        Route::get('/all-car', 'index');
        Route::get('/show/car/{id}', 'show');
        Route::post('/create/car', 'store');
        Route::post('/update/car', 'update');
        Route::get('/edit/car/{id}', 'edit');
        Route::post('/car/delete', 'destroy');
    });
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
