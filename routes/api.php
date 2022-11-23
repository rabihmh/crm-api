<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/test', [TestController::class, 'index']);
    Route::apiResource('customers', CustomerController::class);

    Route::get('/customers/{customerId}/notes/', [NoteController::class, 'index']);
    Route::get('/customers/{customerId}/notes/{id}', [NoteController::class, 'show']);
    Route::post('/customers/{customerId}/notes/', [NoteController::class, 'store']);
    Route::put('/customers/{customerId}/notes/{id}', [NoteController::class, 'update']);
    Route::delete('/customers/{customerId}/notes/{id}', [NoteController::class, 'destroy']);


//Route::get('/customers/{customerId}/projects/', [ProjectController::class, 'index']);
//Route::get('/customers/{customerId}/projects/{id}', [ProjectController::class, 'show']);
    Route::post('/customers/{customerId}/projects', [ProjectController::class, 'createProject']);
//Route::put('/customers/{customerId}/projects/{id}', [ProjectController::class, 'update']);
//Route::delete('/customers/{customerId}/projects/{id}', [ProjectController::class, 'destroy']);

});

Route::post('/users',[UserController::class,'store']);
