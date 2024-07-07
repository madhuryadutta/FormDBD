<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormEntryController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\MyDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserActivityController;
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
    return view('business');
});
// Route::get('/', function () {
//     return redirect('/login');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [ProfileController::class, 'userList'])->name('users.list');
    Route::get('/createuser', [ProfileController::class, 'createuserView'])->name('user.createview');
    Route::post('/createuser', [ProfileController::class, 'createuser'])->name('user.create');
    Route::get('/users/{user}/edit', [ProfileController::class, 'editUser'])->name('user.edit');
    Route::put('/users/{user}', [ProfileController::class, 'updateUser'])->name('user.update');
    Route::put('/users/{user}/disable', [ProfileController::class, 'disableUser'])->name('user.disable');
    Route::put('/users/{user}/makeadmin', [ProfileController::class, 'makeAdmin'])->name('user.makeadmin');
    Route::put('/users/{user}/removeadmin', [ProfileController::class, 'removeAdmin'])->name('user.removeadmin');
});
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/user-activities', [UserActivityController::class, 'index'])->name('admin.user_activities.index');
});

Route::get('/success', [MyDashboardController::class, 'success'])->name('dashboard.sucess');
Route::get('/fail', [MyDashboardController::class, 'fail'])->name('dashboard.fail');
Route::get('/wrong-secret', [MyDashboardController::class, 'wrongPublishableSecret'])->name('dashboard.wrongSecret');

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

Route::get('/forms/entries/{form}', [FormEntryController::class, 'index'])->name('entries.index');
Route::get('/view-submission', [FormEntryController::class, 'viewAll'])->name('entries.viewAll');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MyDashboardController::class, 'index'])->name('dashboard.index');
});

require __DIR__.'/auth.php';
