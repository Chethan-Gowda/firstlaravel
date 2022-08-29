<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;


Route::get('/',[WebsiteController::class, 'index'])->name('home');
Route::get('/dashboard',[WebsiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/login',[WebsiteController::class, 'login'])->name('login');

Route::post('/loginprocess',[WebsiteController::class, 'loginCheck'])->name('loginCheck');

Route::get('/logout',[WebsiteController::class, 'logout'])->name('logout');

Route::get('/forget-password',[WebsiteController::class, 'forgetPassword'])->name('forgetPassword');

Route::post('/forget-password',[WebsiteController::class, 'forgetPasswordProcess']);



Route::get('/reset/password/{token}/{email}',[WebsiteController::class, 'resetPassword']);



Route::post('/change/password',[WebsiteController::class, 'resetPasswordSubmit'])->name('changePassword');




Route::get('/registration',[WebsiteController::class, 'registration'])->name('registration');
Route::post('/register',[WebsiteController::class, 'registrationStore'])->name('register');
Route::get('/registration/verify/{token}/{email}',[WebsiteController::class, 'registrationVerify']);


