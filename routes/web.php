<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Admin\AdminPropertyController;

Route::middleware('prevent.back.history')->group(function () {

    Route::get('/', [PagesController::class, 'Home'])->name('client.home');
    Route::get('/urban/plots', [PagesController::class, 'UrbanPlots'])->name('client.urban');
    Route::get('/upcountry/plots', [PagesController::class, 'UpcountryPlots'])->name('client.upcountry');
    Route::get('/buildings/apartments', [PagesController::class, 'Apartments'])->name('client.apartments');
    Route::get('/buildings/houses', [PagesController::class, 'Houses'])->name('client.houses');
    Route::get('/contact', [PagesController::class, 'Contact'])->name('client.contact');


    require __DIR__.'/adminauth.php';

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'adminHome'])->name('admin.dashboard');
        Route::get('/analytics', [AdminController::class, 'adminAnalytics'])->name('admin.analytics');
        Route::get('/products', [AdminController::class, 'adminProducts'])->name('admin.products');
        Route::get('/orders', [AdminController::class, 'adminOrders'])->name('admin.orders');
        Route::get('/stock', [AdminController::class, 'adminStock'])->name('admin.stock');
        Route::get('/clientinfo', [AdminController::class, 'adminClientinfo'])->name('admin.clientinfo');
        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        // Admin auth routes

        Route::post('/property/store', [AdminPropertyController::class, 'storeProperty'])->name('admin.property.store');
        Route::put('/property/update/{property}', [AdminPropertyController::class, 'updateProperty'])->name('admin.property.update');
        Route::delete('/property/delete/{property}', [AdminPropertyController::class, 'deleteProperty'])->name('admin.property.delete');
    });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

});
