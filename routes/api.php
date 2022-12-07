<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// route for registration
Route::post('/users', [RegisterController::class, 'save_user']);

// route for login
//Route::get('/login', [LoginController::class, 'login']->name('login'));

Route::post('/user_login',[LoginController::class, 'user_login']);

Route::get('/email/verify', function () 
{
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return "welcome";
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/login',function(){
    return "Login";
})->name('login');
