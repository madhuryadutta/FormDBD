<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\DashboardController;
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



// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Form Routes
Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
Route::get('/forms/{id}', [FormController::class, 'show'])->name('forms.show');
Route::get('/forms/{id}/generate-code', [FormController::class, 'generateCode'])->name('code.generate');
Route::get('/forms/{formId}/fields/{fieldId}/edit', [FormFieldController::class, 'edit'])->name('fields.edit');

Route::put('/forms/{formId}/fields/{fieldId}', [FormFieldController::class, 'update'])->name('fields.update');

Route::get('/forms/{formId}/fields/create', [FormFieldController::class, 'create'])->name('fields.create');
Route::post('/forms/{formId}/fields', [FormFieldController::class, 'store'])->name('fields.store');
