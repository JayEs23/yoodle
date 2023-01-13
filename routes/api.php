<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
 
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
  
Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
});
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
Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::post('login', 'AuthController@login');
    // Route::post('logout', 'AuthController@logout');

    // Route::middleware(['auth:api'])->group(function () {
    //     Route::get('user', 'AuthController@user');
    // });

    Route::middleware(['auth:api', 'tenant'])->group(function () {
        Route::get('libraries', 'LibraryController@index');
        Route::get('libraries/{library}', 'LibraryController@show');
        Route::post('libraries', 'LibraryController@store');
        Route::patch('libraries/{library}', 'LibraryController@update');
        Route::delete('libraries/{library}', 'LibraryController@destroy');
    });

    Route::middleware(['auth:api', 'tenant'])->group(function () {
        Route::get('books', 'BookController@index');
        Route::get('books/{book}', 'BookController@show');
        Route::post('books', 'BookController@store');
        Route::patch('books/{book}', 'BookController@update');
        Route::delete('books/{book}', 'BookController@destroy');
    });

    
    Route::middleware(['auth:api', 'tenant'])->group(function () {
        Route::get('users', 'UserController@index');
        Route::get('users/{user}', 'UserController@show');
        Route::post('users', 'UserController@store');
        Route::patch('users/{user}', 'UserController@update');
        Route::delete('users/{user}', 'UserController@destroy');
    });
    
    
});


