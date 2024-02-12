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

Route::group(['prefix' => '/typehead/transport', 'middleware' => ['sanctum_1','BADASO_ApiRequest'], 'namespace' => 'App\Http\Controllers'], function ($request) {
    Route::get('/user', 'TransportTypeHeadController@getUser');

    // transport-bookings
    Route::get('/transport-bookings', 'TransportTypeHeadController@transport_bookings');
    Route::get('/transport-drivers', 'TransportTypeHeadController@transport_drivers');
    Route::get('/transport-maintenances', 'TransportTypeHeadController@transport_maintenances');
    Route::get('/transport-payments', 'TransportTypeHeadController@transport_payments');
    Route::get('/transport-payments-validations', 'TransportTypeHeadController@transport_payments_validations');
    Route::get('/transport-rentals', 'TransportTypeHeadController@transport_rentals');
    Route::get('/transport-returns', 'TransportTypeHeadController@transport_returns');
    Route::get('/transport-vehicles', 'TransportTypeHeadController@transport_vehicles');
    Route::get('/transport-workshops', 'TransportTypeHeadController@transport_workshops');

});

