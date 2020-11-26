<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

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
Route::redirect('/', '/home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProccess'])->name('login.proccess');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::resource('/projects', ProjectController::class);
	Route::resource('/clients', ClientController::class);
	Route::resource('/cash', KasController::class);
	Route::resource('/users', UserController::class);
	Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});