<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\EmployeeProfileController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::resource('employee', EmployeeProfileController::class);

?>