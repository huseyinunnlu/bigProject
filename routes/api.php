<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnimalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Profile
Route::get('profile/{id}', [ProfileController::class, 'getUser']);
Route::get('profile/{id}/desc', [ProfileController::class, 'getDesc']);
Route::post('profile/{id}/update', [ProfileController::class, 'updateDesc']);
Route::post('profile/{id}/updateimg', [ProfileController::class, 'updateimg']);
Route::post('profile/{id}/settings',[ProfileController::class, 'updateSettings']);
Route::post('profile/{id}/adddesc',[ProfileController::class, 'addDesc']);
//Users
Route::get('users', [UserController::class, 'list']);
Route::get('users/{id}', [UserController::class, 'userDetail']);
Route::post('users/{id}/update', [UserController::class, 'update']);
Route::delete('users/{id}/delete', [UserController::class, 'destroy'])->prefix('adminpanel/');
//Animals
Route::get('/animals', [AnimalController::class, 'list']);
Route::get('/animals/{id}', [AnimalController::class, 'getAnimal']);
Route::post('/animals/create', [AnimalController::class, 'store']);
Route::post('/animals/{id}/edit', [AnimalController::class, 'update']);
Route::post('/animals/{id}/addmilk', [AnimalController::class, 'storeMilk']);
Route::delete('animals/{id}/deleteMilk', [AnimalController::class, 'destroyMilk']);