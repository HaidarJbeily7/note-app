<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
     return redirect('/notes');
})->middleware('auth');

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
        Route::resource('notes', \App\Http\Controllers\NoteController::class);
});



