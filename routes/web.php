<?php

use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        Route::get('/', function () {
            return view('welcome')->name('welcome');
        });
        Route::group(
            [
                'middleware' => ['auth:sanctum'],
            ], function()
            {
                Route::get('/home', 'HomeController@index')->name('home');


 //--------------------------Admin Dashboard Route---------------------------------
                Route::group(
                [
                    'prefix' => 'admin',
                    'namespace' => 'Admin',
                    'middleware' => ['admin'],
                ], function()
                {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('clientslist', ClientController::class);
        Route::resource('restaurants', RestaurantController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('/menuCategory', MenuCategoryController::class);
        Route::resource('/cms', CmsController::class);

    });


    //--------------------------Restaurant Dashboard Route---------------------------------

    Route::group(
        [
            'prefix' => 'restaurant',
            'namespace' => 'Restaurant',
            'middleware' => ['restaurant'],
        ], function()
        {

Route::get('/restaurantDashboard', function () {
    return view('restaurant.dashboard');
})->name('restaurantDashboard');

Route::resource('/restaurantProfile', RestaurantController::class);
Route::resource('/restaurantMenu', MenuController::class);
Route::resource('/restaurantPackages', PackageController::class);
Route::get('/restaurantOrders/{id}', 'OrderController@index')->name('restaurantOrders');
Route::get('/restaurantOrders/chaneStatus/{id}', 'OrderController@complete')->name('chaneStatus');
Route::get('/restaurantOrdersDetails/{id}', 'OrderController@show')->name('restaurantOrdersDetails');
});


});

});
