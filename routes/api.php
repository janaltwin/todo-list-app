<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//Route::resource('name', TaskController::class);

//Public Routes
//Route::get('/name/search/{name}',[TaskController::class, 'search']);
Route::get('/name',[TaskController::class, 'index']);
Route::get('/name/{id}',[TaskController::class, 'show']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);




//Protected Routes
Route::group(['middleware'=>['auth:sanctum']], function(){  
    Route::post('/name',[TaskController::class, 'store']);
    Route::put('/name/{id}',[TaskController::class, 'update']);
    Route::delete('/name/{id}',[TaskController::class, 'destroy']);   
    Route::post('/logout',[AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
