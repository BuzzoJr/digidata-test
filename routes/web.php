<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

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
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login.page');
Route::post('/login/auth', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'create'])->name('login.create');
Route::get('/register/{id}', [UserController::class, 'edit'])->name('login.edit');
Route::post('/register/auth', [UserController::class, 'store'])->name('login.store');
Route::post('/register/update', [UserController::class, 'update'])->name('login.update');
Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('login.destroy');

Route::get('/dashboard/{status?}', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/logout', function(){
    Auth::logout();
    return view('login.index');
})->name('logout');