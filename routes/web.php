<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\user\FileController;
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
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'index']);
Route::post('/validate-email/{email}', [EmailController::class, 'validateEmail'])->name('validate-email');
Route::controller(TasksController::class)->group(function() {
    Route::get('/tasks-list', 'index')->name('task.list');
    Route::post('/create', 'store')->name('task.store');
    Route::delete('/delete-task/{id}', 'destroy')->name('task.destroy');
    Route::put('/task-update-sate/{id}', 'updateState')->name('task.update_state');
    Route::put('/update-task/{id}', 'update')->name('task.update');
    Route::get('/edit-task/{id}', 'edit')->name('task.edit');
});
Route::controller(FileController::class)->group(function(){
    Route::get('/files', 'index')->name('files.index');

});
Auth::routes();


