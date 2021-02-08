<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;

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
	Route::get('/projects/status/{id}/{status}', [ProjectController::class, 'status']);
	Route::get('/projects/payment/{id}', [ProjectController::class, 'payment'])->name('projects.payment');
	Route::get('/projects/payment/edit/{id}', [ProjectController::class, 'payment_edit'])->name('projects.payment.edit');
	Route::post('/projects/payment/{id}', [ProjectController::class, 'payment_store'])->name('projects.payment.store');
	Route::put('/projects/payment/{id}', [ProjectController::class, 'payment_update'])->name('projects.payment.update');
	Route::delete('/projects/payment/{id}', [ProjectController::class, 'payment_delete'])->name('projects.payment.delete');
	Route::resource('/role', RoleController::class);
	Route::resource('/clients', ClientController::class);
	Route::get('/cashs', [KasController::class, 'index'])->name('cashs.index');
	Route::get('/cashs/income', [KasController::class, 'income'])->name('cashs.income');
	Route::get('/cashs/expense', [KasController::class, 'expense'])->name('cashs.expense');
	Route::post('/cashs', [KasController::class, 'store'])->name('cashs.store');
	Route::get('/cashs/{id}/edit', [KasController::class, 'edit'])->name('cashs.edit');
	Route::put('/cashs/{id}', [KasController::class, 'update'])->name('cashs.update');
	Route::delete('/cashs/{id}', [KasController::class, 'destroy'])->name('cashs.destroy');
	Route::get('/cashs/{id}', [KasController::class, 'show'])->name('cashs.show');
	Route::resource('/category', CategoryController::class);
	Route::resource('/users', UserController::class);
	Route::get('/reports', [ReportController::class, 'index'])->name('reports');
	Route::resource('/schedules', ScheduleController::class);
});