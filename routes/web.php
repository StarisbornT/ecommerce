<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\FrontendProductController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');



require __DIR__.'/auth.php';

// Add to Cart Routes


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'employee', 'as' => 'user.'], function() {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');




});