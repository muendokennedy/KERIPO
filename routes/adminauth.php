<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {

    Route::get('/adminsignup', [RegisteredUserController::class, 'adminCreate'])->name('admin.register.show');
    Route::get('/adminlogin', [AuthenticatedSessionController::class, 'adminLogin'])->name('admin.login.show');
    Route::post('/adminStore', [RegisteredUserController::class, 'store'])->name('admin.store');
    Route::post('/adminAuthenticate', [AuthenticatedSessionController::class, 'adminLoginStore'])->name('admin.authenticate');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('/adminlogout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
