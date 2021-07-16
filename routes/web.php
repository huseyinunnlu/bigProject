<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RationController;
use App\Http\Controllers\FRationController;
use App\Http\Controllers\RationGuideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class, 'welcome'])->name('welcome');
Route::middleware('auth')->group(function () {
	Route::get('/profile/{id}-{slug}', [ProfileController::class, 'index'])->name('profile');
	Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard')->middleware('GoDashboard');
	Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index')->middleware('GoDashboard');
	Route::get('/rations/create', [RationController::class, 'create'])->name('rations.create')->middleware('GoDashboard');
	Route::get('/rations', [FRationController::class, 'index'])->name('frations.index')->middleware('GoDashboard');
	Route::middleware('isAdmin')->prefix('adminpanel')->group(function () {
		Route::get('/users', [UserController::class, 'index'])->name('users.index');
		Route::get('/rations', [RationController::class, 'index'])->name('rations.index')->middleware('GoDashboard');
		Route::get('/contact', [IndexController::class, 'adminContactIndex'])->name('admin.contact.index')->middleware('GoDashboard');
	});
	Route::get('/rations/guide', [RationGuideController::class, 'index'])->name('guide.index')->middleware('GoDashboard');
	Route::get('/contact', [IndexController::class, 'contact'])->name('contact.index')->middleware('GoDashboard');
	Route::post('/contact/store', [IndexController::class, 'store'])->name('contact.store')->middleware('GoDashboard');
	Route::post('/answer/store', [IndexController::class, 'answerStore'])->name('answer.store')->middleware('GoDashboard');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

