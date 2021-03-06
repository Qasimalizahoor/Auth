<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\User\DashboardController as DashboardUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|(
*/


Route::prefix('admin')->namespace('Auth\Admin')->group(function(){
        
        Route::get('login', [LoginController::class,'showLoginForm'])->name('admin.login');
        Route::post('login', [LoginController::class,'login']);
        Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');
});
Route::prefix('user')->namespace('User')->group(function(){

    Route::get('dashboard',[DashboardUserController::class,'index'])->name('user.dashboard');
});
Route::prefix('admin')->namespace('Admin')->group(function(){

    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
