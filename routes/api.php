<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public routes

// new user registeration
Route::post('/register', [AuthController::class, 'register']);
// user login and token creation
Route::post('/login', [AuthController::class, 'login']);
// get all users
Route::get('/users', [AuthController::class, 'index']);
// get specified user by id
Route::get('/users/{id}', [AuthController::class, 'show']);
// search user by name
Route::get('/users/search/{name}', [AuthController::class, 'search']);
//get profile picture
Route::get('/users/{id}/pic', [AuthController::class, 'indexWeb']);


// protected routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    // create new url 
    Route::post('/users/{id}', [AuthController::class, 'url_post'])->middleware('auth', 'check_user_ownership');
    // change the information of user by id
    Route::put('/users/{id}', [AuthController::class, 'update'])->middleware('auth', 'check_user_ownership');
    // change the informations of url by id
    Route::put('/users/{id}/urls/{url_id}', [AuthController::class, 'url_update'])->middleware('auth', 'check_user_ownership');
    // delete selected user by id
    Route::delete('/users/{id}', [AuthController::class, 'destroy'])->middleware('auth', 'check_user_ownership');
    // delete selected url by id
    Route::delete('/users/{id}/urls/{url_id}', [AuthController::class, 'url_destroy'])->middleware('auth', 'check_user_ownership');
    // user logout and token destroy
    Route::post('/logout', [AuthController::class, 'logout']);
    //add profile picture   
    Route::post('/users/{id}/pic', [AuthController::class, 'storeImage'])->middleware('auth', 'check_user_ownership');
    //set new password
    Route::put('/users/{id}/pass', [AuthController::class, 'updatePassword'])->middleware('auth', 'check_user_ownership');

    // // sent a new record to accounts table
    // Route::post('/accounts', [AccountController::class, 'store']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
