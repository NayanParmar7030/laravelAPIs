<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\API\AuthController;
 use App\Http\Controllers\API\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('signup',[AuthController::class,'signup']);
// Route::post('login',[AuthController::class,'login']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');


// Route::get('allpost',[PostController::class, 'index']);
Route::apiResource('post', PostController::class)->middleware('auth:sanctum');