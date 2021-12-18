<?php

use Illuminate\Support\Facades\Route;
use App\Api\V1\Controllers\Auth\SignUpController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('recaptchacreate', [SignUpController::class, 'index']);
Route::post('register', [SignUpController::class, 'register']);