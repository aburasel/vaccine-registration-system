<?php

use App\Http\Controllers\Patient\PatientRegistrationController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [PatientRegistrationController::class, 'create'])->name('patient.create');

    Route::post('register', [PatientRegistrationController::class, 'store'])->name('patient.register');
});

require __DIR__.'/auth.php';
