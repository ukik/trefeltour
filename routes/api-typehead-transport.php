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

Route::group(['prefix' => '/typehead/transport', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers\TypeHeads'], function ($request) {
    Route::get('/user', 'TransportTypeHeadController@getUser');
    Route::get('/add_to_cart_user', 'TransportTypeHeadController@getUser');
    Route::post('/get_prices_booking', 'TransportTypeHeadController@get_prices_booking');
    Route::post('/update_to_cart', 'TransportTypeHeadController@update_to_cart');
    Route::post('/add_to_cart', 'TransportTypeHeadController@add_to_cart');

    // Route::get('/dialog_product_transport_stores', 'TransportTypeHeadController@dialog_product_transport_stores');
    // Route::get('/dialog_prices_transport_products', 'TransportTypeHeadController@dialog_prices_transport_products');

    Route::get('/dialog_rental_transport_vehicles', 'TransportTypeHeadController@dialog_rental_transport_vehicles');
    Route::get('/dialog_vehicle_transport_maintenances', 'TransportTypeHeadController@dialog_vehicle_transport_maintenances');
    Route::get('/dialog_workshop_transport_maintenances', 'TransportTypeHeadController@dialog_workshop_transport_maintenances');

    Route::get('/dialog_booking_transport_bookings', 'TransportTypeHeadController@dialog_booking_transport_bookings');
    Route::get('/dialog_booking_transport_payments_validations', 'TransportTypeHeadController@dialog_booking_transport_payments_validations');
});

