<?php

use App\Http\Controllers\HolidayPlanController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\AuthController;
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
Route::post('createuser', [UsersController::class, 'store']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/holiday/pdf/{id}', [HolidayPlanController::class, 'generatePdf']);

    Route::apiResource('/holiday', HolidayPlanController::class );

    Route::post('/holiday/{id}/participants', [ParticipantsController::class, 'store']);
});

