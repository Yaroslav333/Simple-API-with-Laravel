<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'RegisterController@register');


Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });
});

Route::prefix('topics')->group(function() {
    Route::get('/', 'TopicController@index');
    Route::get('/{topic}', 'TopicController@show');

    Route::middleware(['auth:api'])->group(function() {
        Route::post('/', 'TopicController@store');
        Route::patch('/{topic}', 'TopicController@update');
        Route::delete('/{topic}', 'TopicController@destroy');
    });

    Route::prefix('/{topic}/posts')->group(function() {

        Route::middleware(['auth:api'])->group(function() {
            Route::post('/', 'PostController@store');
            Route::patch('/{post}', 'PostController@update');
            Route::delete('/{post}', 'PostController@destroy');
        });

        Route::prefix('/{post}/likes')->group(function () {

            Route::middleware(['auth:api'])->group(function() {
                Route::post('/', 'PostLikeController@store');
            });
        });
    });
});

