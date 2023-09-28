<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company');
Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');

Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.create');
Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');

Route::post('/company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');
Route::post('/employees/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');

Route::get('company/{id}/edit',[App\Http\Controllers\CompanyController::class, 'edit']);
Route::put('company/{id}/update',[App\Http\Controllers\CompanyController::class, 'update']);
Route::delete('company/{id}/delete',[App\Http\Controllers\CompanyController::class, 'destroy']);


Route::get('employees/{id}/edit',[App\Http\Controllers\EmployeeController::class, 'edit']);
Route::put('employees/{id}/update',[App\Http\Controllers\EmployeeController::class, 'update']);
Route::delete('employees/{id}/delete',[App\Http\Controllers\EmployeeController::class, 'destroy']);
Route::get('employees/{profile_picture}/getProfilePicture', [App\Http\Controllers\EmployeeController::class,'getProfilePicture']);

Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
Route::post('/payment/checkout', [App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');