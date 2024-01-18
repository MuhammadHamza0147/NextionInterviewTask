<?php

use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\DefectController;
use App\Http\Controllers\Dashboard\DeviceController;
use App\Http\Controllers\Dashboard\UserProfileController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Auth;
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

// pass lang to session
Route::get('/localization/{locale}' , [LocalizationController::class , 'index'])->name('localization');

Route::middleware('locale')->group(function () {

    Auth::routes(['verify' => true]);

    // Root Route
    Route::get('/', function () {
        return redirect('/login');
    });

    // Handle 404 Error
    Route::fallback(function () {
        return response()->view('errors.404');
    });

    // Authenticated Routes...
    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Dashboard
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // User Profile
        Route::get('user/profile' , [UserProfileController::class, 'index'])->name('user.profile');
        Route::post('user/profile/store' , [UserProfileController::class, 'store'])->name('user.profile.store');
        Route::put('user/profile/update' , [UserProfileController::class, 'update'])->name('user.profile.update');

        //Brands
        Route::get('brands', [BrandController::class , 'index'])->name('brands');
        Route::post('brands/store', [BrandController::class , 'store'])->name('brands.store');
        Route::post('brands/update', [BrandController::class , 'update'])->name('brands.update');
        Route::post('brands/destroy', [BrandController::class , 'destroy'])->name('brands.destroy');
        
        // This Route Directly Hit API and get All Devices against Our Listed Brands
        Route::get('devices/api', [DeviceController::class , 'HitDeviceAPi'])->name('devices.api');

        //Devices
        Route::get('devices', [DeviceController::class , 'index'])->name('devices');
        Route::get('devices/sync', [DeviceController::class , 'syncApi'])->name('devices.sync');
        Route::post('devices/update', [DeviceController::class , 'update'])->name('devices.update');
        Route::post('devices/destroy', [DeviceController::class , 'destroy'])->name('devices.destroy');

        // This Route Directly Hit API and get All Defects against Our Listed Devices
        Route::get('defects/api', [DefectController::class, 'HitDefectAPi'])->name('defects.api');

        //Defects
        Route::get('defects', [DefectController::class, 'index'])->name('defects');
        Route::get('defects/sync', [DefectController::class, 'syncApi'])->name('defects.sync');
        Route::post('defects/update', [DefectController::class , 'update'])->name('defects.update');
        Route::post('defects/destroy', [DefectController::class , 'destroy'])->name('defects.destroy');
    });
});