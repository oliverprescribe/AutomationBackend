<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LetterDeleteTaskTestingController;
use App\Http\Controllers\TestingController;
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

Route::get('/mail', [TestingController::class, 'email']);
Route::get('/timedifference', [TestingController::class, 'automationEmailTest']);
// Route::get('/letterdelete', [TestingController::class, 'deleteLetter']);
Route::get('/letterdelete', [LetterDeleteTaskTestingController::class, 'letter_delete_task']);






