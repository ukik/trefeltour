<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Str;
use Uasoft\Badaso\Facades\Badaso;
use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoAuthenticate;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;
use Uasoft\Badaso\Middleware\BadasoCheckPermissionsForCRUD;

use \App\Http\Middleware\BadasoCheckPermissions as RootBadasoCheckPermissions;
use \App\Http\Middleware\BadasoCheckPermissionsForCRUD as RootBadasoCheckPermissionsForCRUD;
use \App\Http\Middleware\BadasoAuthenticate as RootBadasoAuthenticate;

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

Route::group(['prefix' => '/typehead/travel', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers\TypeHeads'], function ($request) {
    Route::get('/user', 'TravelTypeHeadController@getUser');
    Route::get('/add_to_cart_user', 'TravelTypeHeadController@getUser');
    Route::post('/get_prices_booking', 'TravelTypeHeadController@get_prices_booking');
    Route::post('/update_to_cart', 'TravelTypeHeadController@update_to_cart');
    Route::post('/add_to_cart', 'TravelTypeHeadController@add_to_cart');


    Route::get('/travel_reservations_dialog_user', 'TravelTypeHeadController@travel_reservations_dialog_user');
    Route::get('/travel_stores_dialog_user', 'TravelTypeHeadController@travel_stores_dialog_user');
    Route::get('/dialog_prices_travel_reservations', 'TravelTypeHeadController@dialog_prices_travel_reservations');
    Route::get('/dialog_prices_travel_stores', 'TravelTypeHeadController@dialog_prices_travel_stores');

    Route::get('/dialog_cart_price', 'TravelTypeHeadController@dialog_cart_price');

    // Route::get('/dialog_reservation_travel_stores', 'TravelTypeHeadController@dialog_reservation_travel_stores');

    Route::get('/dialog_booking_travel_bookings', 'TravelTypeHeadController@dialog_booking_travel_bookings');
    Route::get('/dialog_booking_travel_payments_validations', 'TravelTypeHeadController@dialog_booking_travel_payments_validations');
});

