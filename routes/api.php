<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Index;
use App\Http\Controllers\Emails;
use App\Http\Controllers\Monitoring;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;


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

Route::post('/login',[Authentication::class,'login']);
Route::post('/register',[Authentication::class,'register']);

Route::get('/email',[Emails::class,'index']);



Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout',[Authentication::class, 'logout']);
    Route::get('/users',[Authentication::class, 'users']);
    Route::get('/index',[Index::class,'index']);
    Route::get('/monitoring/{id}', [Monitoring::class, 'index']);
    Route::get('/monitoring/{id}/{status}',[Monitoring::class,'status']);

});

