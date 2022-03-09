<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\FacebookAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GithubAuthController;

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
    return view('index');
});

Route::prefix('auth')->group(function () {

    Route::get('/login',[AuthController::class,'login']);
    Route::get('/logout',[AuthController::class,'logout']);

    Route::get('/github',[GithubAuthController::class,'redirect']);
    Route::get('/github/callback',[GithubAuthController::class,'loginGithub']);

    Route::get('/facebook',[FacebookAuthController::class,'redirect']);
    Route::get('/facebook/callback',[FacebookAuthController::class,'loginFacebook']);
});

Route::group(['middleware' => 'UserAction'], function () {

});