<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\ProfileImageController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth
Route::post('login', [AuthController::class, 'login']);

Route::post('user-reg', [AuthController::class, 'store']);


Route::get('user/{id}', [AuthController::class, 'userProfile']);



//forget pw step 1
Route::post('check-user', [AuthController::class, 'checkUser']);


Route::post('update-password', [AuthController::class, 'changePassword']);

Route::get('delete-user/{id}', [AuthController::class, 'delete']);


Route::middleware('changeLang')->group(function () {

//Introduction
Route::get('introductions', [IntroductionController::class, 'list']);
Route::post('introduction-create', [IntroductionController::class, 'save']);
Route::get('introduction/{id}', [IntroductionController::class, 'view']);
Route::get('introduction/delete/{id}', [IntroductionController::class, 'delete']);
Route::post('introduction/edit/{id}', [IntroductionController::class, 'edit']);



//profile images
Route::get('images', [ProfileImageController::class, 'list']);
Route::post('image-create', [ProfileImageController::class, 'save']);
Route::get('image/{id}', [ProfileImageController::class, 'view']);
Route::get('image/delete/{id}', [ProfileImageController::class, 'delete']);
Route::post('image/edit/{id}', [ProfileImageController::class, 'edit']);
});


Route::middleware(['auth:api','changeLang'])->group(function () {

    Route::post('/user-update', [AuthController::class, 'updateProfile']);

});
