<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Index;
use App\Http\Controllers\Emails;
use App\Http\Controllers\Monitoring;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
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
Route::post('/login',[Authentication::class,'login']);

//register route
Route::post('/register',[Authentication::class,'register']);

//user must be login to access this routes
Route::middleware('auth:sanctum')->group(function(){

    //logout route
    Route::post('/logout',[Authentication::class, 'logout']);

    //get dashboard, user and client data
    Route::get('/monitoring',[Monitoring::class,'index']);

    // get letters based on client
    Route::get('/monitoring/{id}', [Monitoring::class, 'client']);

    //get client's letters based on its status
    Route::get('/monitoring/{id}/{status}',[Monitoring::class,'status']);
});

