<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ExternalNoteController;

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


Route::group(['middleware' => ['apiAuth', 'auth:sanctum']],function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);

    Route::get('notes', [ExternalNoteController::class, 'index']);
    Route::post('notes', [ExternalNoteController::class, 'store']);
    Route::put('notes/{id}', [ExternalNoteController::class, 'update']);
    Route::delete('notes/{id}', [ExternalNoteController::class, 'destroy']);


});

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);

