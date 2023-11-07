<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\MonitoringController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Models\Dashboard;

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

//login route
Route::post('/login',[AuthenticationController::class,'login']);

//register route
Route::post('/register',[AuthenticationController::class,'register']);

//user must be login to access this routes
Route::middleware('auth:sanctum')->group(function(){

    //logout route
    Route::post('/logout',[AuthenticationController::class, 'logout']);

    //get dashboard, user and client data
    Route::get('/monitoring',[MonitoringController::class,'index']);

    // get letters based on client
    Route::get('/monitoring/{id}', [MonitoringController::class, 'client']);

    //get client's letters based on its status
    Route::get('/monitoring/{id}/{status}',[MonitoringController::class,'status']);
});

