<?php

use Illuminate\Support\Facades\Route;
use App\Models\Note;
use App\Models\User;

Route::get('/', function () {
     return redirect('/notes');
})->middleware('auth');

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
        Route::resource('notes', \App\Http\Controllers\NoteController::class);
        Route::get('link', [\App\Http\Controllers\NoteController::class, 'getLink'])->name('get-link');

        Route::get('/statistics', function () {
            $users = User::all();
            $data = [];
            foreach($users as $user){
                $on_date = Note::where('user_id', $user->id)->where('type', 'on date')->count();
                $urgent = Note::where('user_id', $user->id)->where('type', 'urgent')->count();
                $normal = Note::where('user_id', $user->id)->where('type', 'normal')->count();
                array_push($data, [
                    'name' => $user->name,
                    'urgent' => $urgent,
                    'normal' => $normal,
                    'on date' => $on_date,
                ]);
            }
            return view('stat', ['data' => $data]);
        })->name('stat');
});

Route::get('shared/{id}', [\App\Http\Controllers\NoteController::class, 'viewThroughLink'])->name('view-through-link');

