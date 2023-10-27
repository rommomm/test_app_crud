<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('sign-up', [AuthController::class, 'signUp'])->name('signUp');
Route::post('sign-in', [AuthController::class, 'signIn'])->name('signIn');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('sign-out', [AuthController::class, 'signOut'])->name('signOut');
    Route::apiResource('manager', ManagerController::class)->names('managers');
    Route::apiResource('test', TestController::class)->names('tests');
    Route::post('test/{test}/rate', [TestController::class, 'rate'])->name('testRate');
});
