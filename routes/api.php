<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => '/auth'], function () {
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

    Route::post('/spending', [SpendingController::class, 'store'])->name('spending.store');
    Route::post('/spending-entries', [SpendingController::class, 'entries'])->name('spending.entries');
    Route::post('/spending-search', [SpendingController::class, 'search'])->name('spending.search');
    Route::post('/spending-outs', [SpendingController::class, 'outs'])->name('spending.outs');
    Route::post('/spending-user', [SpendingController::class, 'getByUser'])->name('spending.getByUser');
    Route::post('/spending-show', [SpendingController::class, 'show'])->name('spending.show');
    Route::post('/spending-update', [SpendingController::class, 'update'])->name('spending.update');
    Route::post('/spending-delete', [SpendingController::class, 'delete'])->name('spending.delete');
});

Route::middleware(['guest'])->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
});

