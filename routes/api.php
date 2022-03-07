<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'namespace' => 'Api',
    ], function()
    {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@createApiregister');

        
        Route::get('categories', 'BeforeLoginController@categories');
        Route::get('restaurants', 'BeforeLoginController@restaurants');
        Route::get('restaurant_details/{id}', 'BeforeLoginController@restaurant_details');

        Route::get('faqs', 'BeforeLoginController@faqs');
        Route::get('about_us', 'BeforeLoginController@about_us');
        Route::get('terms', 'BeforeLoginController@terms');

        Route::group(
            [
                'middleware' => ['jwt','client'],
            ], function()
            {
                Route::resource('orders', 'OrderController');
                Route::post('addReview', 'AfterLoginController@addReview');
                Route::post('addFavorite', 'AfterLoginController@addFavorite');
                Route::get('favorite', 'AfterLoginController@favorites');

                Route::post('editImage', 'AuthController@edit_image');
                Route::post('editPhone', 'AuthController@edit_phone');
                Route::post('editPassword', 'AuthController@edit_password');

            });

});
