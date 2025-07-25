<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AdminPropertyOrderController;
use App\Http\Controllers\Client\ClientInformationController;

Route::middleware('prevent.back.history')->group(function () {

    Route::get('/', [PagesController::class, 'Home'])->name('client.home');
    Route::get('/urban/plots', [PagesController::class, 'UrbanPlots'])->name('client.urban');
    Route::get('/upcountry/plots', [PagesController::class, 'UpcountryPlots'])->name('client.upcountry');
    Route::get('/buildings/apartments', [PagesController::class, 'Apartments'])->name('client.apartments');
    Route::get('/buildings/houses', [PagesController::class, 'Houses'])->name('client.houses');
    Route::get('/contact', [PagesController::class, 'Contact'])->name('client.contact');
    Route::get('/notification', function(){
        return Inertia::render('Client/Notification');
    })->name('client.notification');

    require __DIR__.'/adminauth.php';

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'adminHome'])->name('admin.dashboard');
        Route::get('/analytics', [AdminController::class, 'adminAnalytics'])->name('admin.analytics');
        Route::get('/properties', [AdminController::class, 'adminProperties'])->name('admin.properties');
        Route::get('/orders', [AdminController::class, 'adminOrders'])->name('admin.orders');
        Route::get('/clientinfo', [AdminController::class, 'adminClientinfo'])->name('admin.clientinfo');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');


        Route::get('/orderinfo/{order}', [AdminPropertyOrderController::class, 'orderInfo'])->name('admin.orderInfo');
        Route::post('/order/approve/{order}', [AdminPropertyOrderController::class, 'approveOrder'])->name('admin.order.approve');
        Route::post('/order/reject/{order}', [AdminPropertyOrderController::class, 'rejectOrder'])->name('admin.order.reject');
        Route::post('/order/message/send/{order}', [AdminPropertyOrderController::class, 'sendMessage'])->name('admin.order.message.send');



        Route::get('/property/new/show', [AdminPropertyController::class, 'showNewPropertyForm'])->name('admin.property.new.show');
        Route::post('/property/store', [AdminPropertyController::class, 'storeProperty'])->name('admin.property.store');
        Route::get('/property/edit/{property}', [AdminPropertyController::class, 'showEditPropertyForm'])->name('admin.property.edit');
        Route::put('/property/update/{property}', [AdminPropertyController::class, 'updateProperty'])->name('admin.property.update');
        Route::delete('/property/delete/{property}', [AdminPropertyController::class, 'deleteProperty'])->name('admin.property.delete');

        Route::post('/admin/new', [AdminManagementController::class, 'inviteNewAdmin'])->name('admin.new.admin.invite');
    });

    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/conditions', [PagesController::class, 'Conditions'])->name('client.conditions');
        Route::get('/conditions/check', [PagesController::class, 'conditionsCheck'])->name('client.conditions.check');
        Route::post('/client/information/store', [ClientInformationController::class, 'userInfo'])->name('client.information.store');
    });

    require __DIR__.'/auth.php';

});
