<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use RealRashid\SweetAlert\Facades\Alert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home/create/', [PostController::class, 'create']);
    Route::post('/home/store/', [PostController::class, 'store']);
    Route::get('/home/search/', [PostController::class, 'search']);
    Route::get('/home/view/{post}', [PostController::class, 'show']);
    Route::get('/home/edit/{post}', [PostController::class, 'edit']);
    Route::put('/home/update/{post}', [PostController::class, 'update']);
    Route::get('/home/delete/{post}', [PostController::class, 'destroy']);
});

