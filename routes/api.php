<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BusinessCardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\ProductServiceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('register', [PassportController::class, 'register']);
Route::post('create-card', [PassportController::class, 'createBusinessCardOrSkip']);
Route::post('login', [PassportController::class, 'login']);
Route::get('verify-email/{email}', [PassportController::class, 'verifyEmail']);

Route::get('php', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('register-event/{event}', [EventController::class, 'register']);
Route::post('fetch-user', [EventController::class, 'fetchUserByEmail']);

// put all api protected routes here
Route::middleware('auth:api')->group(function () {
    Route::post('user-detail', [PassportController::class, 'userDetail']);
    Route::post('edit-profile', [PassportController::class, 'editProfile']);
    Route::post('update-profile', [PassportController::class, 'updateProfile']);
    Route::post('logout', [PassportController::class, 'logout']);

    // business card route
    Route::post('create-business-card', [BusinessCardController::class, 'create']);
    Route::get('list-cards', [BusinessCardController::class, 'listBusinessCards']);
    Route::get('list-my-cards', [BusinessCardController::class, 'listMyBusinessCards']);

    // event route
    Route::post('create-event', [EventController::class, 'create']);
    Route::post('edit-event', [EventController::class, 'editEvent']);
    Route::post('save-event-registration', [EventController::class, 'saveEventRegistration']);
    Route::post('create-event-category', [EventController::class, 'createEvenCategory']);
    Route::get('fetch-event-category', [EventController::class, 'fetchEvenCategory']);
    Route::get('list-events', [EventController::class, 'listEvents']);
    Route::get('list-my-events', [EventController::class, 'listMyEvents']);

    // interests route
    Route::post('create-interest', [InterestController::class, 'createInterests']);
    Route::get('fetch-interest', [InterestController::class, 'fetchInterests']);

    // product_service_name route
    Route::post('create-product-service', [ProductServiceController::class, 'createProductService']);
    Route::get('fetch-product-service', [ProductServiceController::class, 'fetchProductService']);

});
