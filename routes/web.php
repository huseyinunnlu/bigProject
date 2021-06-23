<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;

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
	Route::middleware('isAdmin')->prefix('adminpanel')->group(function () {
		Route::get('/users', [UserController::class, 'index'])->name('users.index');
	});
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

