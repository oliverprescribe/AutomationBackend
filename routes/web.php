<?php

use App\Http\Controllers\Index;
use App\Http\Controllers\Emails;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', [Emails::class, 'index']);
Route::get('/timedifference', [Index::class, 'automationEmailTest']);
Route::get('/letterdelete', [Index::class, 'deleteLetter']);


