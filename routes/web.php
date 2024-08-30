<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\controllers\LoanController;


Route::controller(LoginRegisterController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home')->middleware('auth');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(LoanController::class)->group(function(){
    Route::get('loandetail','loandetail')->name('loandetail')->middleware('auth');
    Route::get('processdetail','processdetail')->name('processdetail')->middleware('auth');
    Route::post('processbuttonclick','processbuttonclick')->name('processbuttonclick')->middleware('auth');
    
});

Route::get('/', function () {
    return view('auth.login');
});
