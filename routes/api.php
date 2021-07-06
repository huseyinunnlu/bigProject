<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RationController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FRationController;

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
Route::get('/animals/{id}/weight', [AnimalController::class, 'getWeight']);
Route::post('/animals/{id}/create', [AnimalController::class, 'addWeight']);
//Ration,
//ration Food
Route::get('/rations/getfood', [RationController::class, 'getFoods']);
Route::get('/rations/food/{id}/details', [RationController::class, 'getFood']);
Route::post('/rations/addfood', [RationController::class, 'addFood']);
Route::post('/rations/food/{id}/update', [RationController::class, 'updateFood']);
Route::delete('/rations/{id}/deletefood', [RationController::class, 'deleteFood']);
//Ration Type
Route::get('/rations/gettype', [RationController::class, 'getTypes']);
Route::post('/rations/addType', [RationController::class, 'addType']);
Route::delete('/rations/{id}/deletetype', [RationController::class, 'deleteType']);
Route::get('/rations/type/{id}/details', [RationController::class, 'getType']);
Route::post('/rations/type/{id}/update', [RationController::class, 'updateType']);
//Creating Ration
Route::get('/rations/selectedtype', [FRationController::class, 'getSelectedType']);
Route::get('/rations/getfood', [FRationController::class, 'getFood']);
Route::post('/rations/addration', [FRationController::class, 'addRation']);
