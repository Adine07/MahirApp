<?php

use App\Http\Controllers\API\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\UserApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('/cities/{provinces_id}', [LocationController::class, 'cities'])->name('api-cities');
Route::get('/districts/{cities_id}', [LocationController::class, 'districts'])->name('api-districts');
Route::get('/villages/{districts_id}', [LocationController::class, 'villages'])->name('api-villages');

Route::get('/members/{id}', [MemberController::class, 'member'])->name('api-members');
Route::get('/payments/{id}', [PaymentController::class, 'payment'])->name('api-payments');
Route::post('/payments', [PaymentController::class, 'store'])->name('api-payments-store');
Route::get('/payments-cash/{id}', [PaymentController::class, 'paymentCash'])->name('api-payments-cash');
Route::get('/fullpay/{id}', [PaymentController::class, 'fullpay'])->name('api-fullpay');

Route::get('/active/{id}', [UserApiController::class, 'active'])->name('active-project');
Route::get('/history/{id}', [UserApiController::class, 'history'])->name('history-project');
Route::get('/totin/{id}', [UserApiController::class, 'totin'])->name('totin-project');
